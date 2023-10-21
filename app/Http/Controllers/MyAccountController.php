<?php

namespace App\Http\Controllers;

use App\Enumeration\OrderStatus;
use App\Enumeration\Role;
use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Model\Order;
use App\Models\AppointmentFormList;
use App\Models\AddressBook;
use App\Models\Country;
use App\Models\NewsLetterList;
use App\Models\stripeSubmission;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MyAccountController extends Controller
{
    public function loginDefault(Request $request)
    {
        $rules = [
            'email' => ['required','email','string'],
            'password' => ['required', 'string'],
        ];
        $request->validate($rules);

        $user = User::where('email', $request->email)
            ->where('status',1)
            ->where('role',Role::$BUYER)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput()
                ->with('error','The provided credentials do not match our records.');

        }
        Auth::login($user, $request->boolean('remember'));

        if ($request->wish_list_save  == 'save-product'){

            $sessionWishlist = $request->session()->get('session_wishlist');

            $wishlists = array();
            if ($user->wishlist == "") {
                array_push($wishlists,$sessionWishlist);
            } else {
                $wishlists = json_decode($user->wishlist);
                if (count($sessionWishlist) > 0){
                    foreach ($sessionWishlist as $sessionWishlistItem){
                        if (in_array($sessionWishlistItem, $wishlists)) {
                            $container = array();
                            foreach ($wishlists as $key) {
                                if ($key != $sessionWishlistItem) {
                                    array_push($container, $key);
                                }
                            }
                            $wishlists = $container;
                        } else {
                            array_push($wishlists, $sessionWishlistItem);
                        }
                    }
                }

            }

            $user->wishlist = json_encode($wishlists);
            $user->save();

            Session::put('session_wishlist',null);
        }


        if ($request->redirect_appointment == true){
            return redirect()->route('booking_appointments');
        }

       return redirect()->route('over_view');
    }
    public function ajaxLogin(Request $request)
    {
        $rules = [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            if ($request->email == '')
                return response()->json(['success' => false, 'message' => 'The email/username field is required.']);


              return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)
            ->where('status',1)
            ->where('role',Role::$BUYER)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'The provided credentials do not match our records.']);
        }

        Auth::login($user, $request->boolean('remember'));

        return response()->json(['success' => true, 'message' => 'Login successfully.','redirect_url'=>route('over_view')]);


    }

    public function ajaxPasswordChange(Request $request)
    {
        $rules = [
            'old_password' => ['required','min:8','string','max:255'],
            'new_password' => ['required','min:8', 'string','max:255'],
            'confirm_password' => ['required','min:8','string','same:new_password','max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->errors()->toArray();
            return response()->json(['success' => false, 'errors' => $messages]);
        }

        $user = Auth::user();

        if (!$user || !Hash::check($request->new_password, $user->password)) {
            return response()->json(['success' => false,
                'errors'=>[
                    'old_password'=>'Your old password is not matched.'
                ],
            ]);
        }else{
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            Auth::login($user,true);
        }

        return response()->json(['success' => true, 'message' => 'Password Change Updated']);


    }
    public function activeService($service)
    {
        $user = User::where('id',Auth::id())->first();

        if ($service == 'newsletter'){

            if ($user->newsletter_active == 1){
                $user->newsletter_active = 0;
            }else{
                $user->newsletter_active = 1;
            }

        }elseif ($service == 'phone'){
            if ($user->phone_active == 1){

                $user->phone_active = 0;
            }else{
                $user->phone_active = 1;
            }
        }elseif ($service == 'chat'){
            if ($user->chat_active == 1){
                $user->chat_active = 0;
            } else{
                $user->chat_active = 1;
            }
        }elseif ($service == 'mail'){
            if ($user->mail_active == 1){
                $user->mail_active = 0;
            }else{
                $user->mail_active = 1;
            }
        }
        $user->save();



        return redirect()->back();
    }
    public function overView()
    {
        $user = Auth::user();
        $products = json_decode($user->wishlist);

        $onGoingOrders = SaleOrder::where('user_id', Auth::user()->id)
            ->whereNotIn('status',[OrderStatus::$DELIVERED,OrderStatus::$RETURNED])
            ->orderBy('id','desc')
            ->get();

       $upcomingAppointments = AppointmentFormList::where('user_id',Auth::id())
            ->where('appointment_day','>=',date('Y-m-d'))
           ->orderBy('appointment_day','desc')
           ->get();


        return view('frontend.my_account.over_view',compact('user',
            'products','onGoingOrders','upcomingAppointments'));
    }
    public function appointments()
    {
        $user = Auth::user();
        $upcomingAppointments = AppointmentFormList::where('user_id',Auth::id())
            ->where('appointment_day','>=',date('Y-m-d'))
             ->orderBy('appointment_day','desc')
            ->get();

        $appointments = AppointmentFormList::where('user_id',Auth::id())
            ->where('appointment_day','<',date('Y-m-d'))
            ->orderBy('appointment_day','desc')
            ->get();
       return view('frontend.my_account.appointments',compact('user',
       'upcomingAppointments','appointments'));
    }

    public function appointmentCancel(Request $request)
    {
        AppointmentFormList::where('user_id',Auth::id())
            ->where('id',$request->id)
            ->delete();
        return response()->json([
                'success'=>true
        ] );
    }

    public function accountDetails()
    {
        $user = Auth::user();
        $newsletter = NewsLetterList::where('email',$user->email)->first();
        $countries = Country::all();
        $phoneCodes = Country::where('phonecode','>',0)->orderBy('phonecode','asc')->get();
        $detailsAddress = AddressBook::where('user_id',Auth::id())->get();
        $cardDetails = stripeSubmission::where('user_id',Auth::id())->get();
       return view('frontend.my_account.account_details',compact('user',
           'newsletter','countries','detailsAddress','cardDetails','phoneCodes'));
    }

    public function subscribeToggle()
    {
        $user = Auth::user();
        $newsLetter = NewsLetterList::where('email',$user->email)->first();

        if ($newsLetter) {
            $newsLetter->delete();
        }else{
            $newsLetterList = new NewsLetterList();
            $newsLetterList->sub_name = $user->title;
            $newsLetterList->first_name = $user->first_name;
            $newsLetterList->last_name = $user->last_name;
            $newsLetterList->country_id = $user->country_id;
            $newsLetterList->email = $user->email;
            $newsLetterList->verification_email = $user->email;
            $newsLetterList->privacy_policy = 'on';
            $newsLetterList->save();
        }

        return redirect()->route('account_details');

    }
    public function orders() {

        $onGoingOrders = SaleOrder::where('user_id', Auth::user()->id)
            ->whereNotIn('status',[OrderStatus::$DELIVERED,
                OrderStatus::$CANCELLED,OrderStatus::$RETURNED])
            ->orderBy('id','desc')
            ->get();

        $orderHistories = SaleOrder::where('user_id', Auth::user()->id)
            ->whereIn('status',[OrderStatus::$DELIVERED,OrderStatus::$CANCELLED])
            ->orderBy('id','desc')
            ->paginate(10);

        return view('frontend.my_account.orders', compact('onGoingOrders',
        'orderHistories'));
    }

    public function orderDetails(SaleOrder $order) {
        if ($order->user_id != Auth::user()->id)
            abort(404);

        return view('frontend.my_account.order_details', compact('order'));
    }


    public function accountDetailsPost(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        $user = Auth::user();
        $user->title = $request->title;
        $user->country_id = $request->country;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name.' '.$request->last_name;
        $user->mobile_type_one = $request->mobile_typeone;
        $user->mobile_code_one = $request->mobile_codeone;
        $user->mobile_number_one = $request->mobile_numberone;
        $user->mobile_type_two = $request->mobile_typetwo;
        $user->mobile_code_two = $request->mobile_codetwo;
        $user->mobile_number_two = $request->mobile_numbertwo;
        $user->contact_email = $request->contact_email;
        $user->contact_phone = $request->contact_phone;
        $user->contact_message = $request->contact_message;
        $dOB = $request->year.'-'.$request->month.'-'.$request->day;
        $user->date_of_birth = Carbon::parse($dOB);
        $user->update();

        return redirect()->back();
    }

    public function cancelOrder(Request $request) {


        SaleOrder::where('id', $request->orderId)
            ->where('user_id', Auth::user()->id)
            ->where('status', OrderStatus::$PENDING)
            ->update([
                'status' => OrderStatus::$CANCELLED,
                'cancelled_at' => Carbon::now(),
            ]);

        return response()->json(['success' =>true, 'message' => 'Order Cancelled.']);
    }
    public function returnOrder(Request $request) {

        $rules = [
            'return_cause' => ['required','string','max:255'],
            'remarks' => ['nullable','max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->errors()->toArray();
            return response()->json(['success' => false, 'errors' => $messages]);
        }

        SaleOrder::where('id', $request->return_order_id)
            ->where('user_id', Auth::user()->id)
            ->where('status', OrderStatus::$DELIVERED)
            ->update([
                'return_cause' => $request->return_cause,
                'return_remarks' => $request->remarks,
                'status' => OrderStatus::$RETURNED_INIT,accountDetails
                // 'return_init_at' => Carbon::now(),
            ]);

        return response()->json(['success' =>true, 'message' => 'Order Return Initiate.']);
    }

    public function AddressDetailsPost(Request $request, $id){

        //dd($request->all());
        $request->validate([
            // 'user_id' => 'required',
            // 'description' => 'required',
            // 'title' => 'required',
            // 'address_first_name' => 'required',
            // 'address_last_name' => 'required',
            // 'company_name' => 'required',
            // 'country_id' => 'required',
            // 'state_id' => 'required',
        ]);

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $customerAddress = new AddressBook;
            $customerAddress->user_id = $id;
            $customerAddress->description = $data['customer_location'];
            $customerAddress->description = $data['description'];
            $customerAddress->title = $data['title'];
            $customerAddress->address_first_name = $data['address_first_name'];
            $customerAddress->address_last_name = $data['address_last_name'];
            $customerAddress->company_name = $data['company_name'];
            $customerAddress->country_id = $data['country'];
            $customerAddress->state_id = $data['customer_state'];
            $customerAddress->city = $data['customer_city'];
            $customerAddress->delivery_address = $data['delivery_address'];
            $customerAddress->address_1 = $data['address_one'];
            $customerAddress->address_2 = $data['address_two'];
            // $customerAddress->address_3 = $data[]->description;
            $customerAddress->postal_code = $data['postal_code'];
            $customerAddress->mobile_no_code_1 = $data['mobile_no_code'][0]?? '';
            $customerAddress->mobile_no_code_2 = $data['mobile_no_code'][1]?? '';
            $customerAddress->mobile_no_code_3 = $data['mobile_no_code'][2]?? '';
            $customerAddress->mobile_no_type_1 = $data['mobile_no_type'][0]?? '';
            $customerAddress->mobile_no_type_2 = $data['mobile_no_type'][1]?? '';
            $customerAddress->mobile_no_type_3 = $data['mobile_no_type'][2]?? '';
            $customerAddress->mobile_no_1 = $data['mobile_no'][0]?? '';
            $customerAddress->mobile_no_2 = $data['mobile_no'][1]?? '';
            $customerAddress->mobile_no_3 = $data['mobile_no'][2]?? '';
            $customerAddress->save();
            return redirect()->route('account_details')->with('success_message','Successfully Updated');
        }
    }

    public function EditAddressDetails(Request $request){
        $editAddressDetails = AddressBook::where('id',$request->id)->first();

        return response()->json($editAddressDetails);
    }

    public function DeleteAddressDetails(Request $request){
        AddressBook::findOrFail($request->id)->delete();
        $notification = array(
            'message' => 'Information Deleted Successfully',
            'alert-type' => 'info'
        );
        return response()->json($notification);
    }

    public function DeleteCard(Request $request){
        $check = stripeSubmission::findOrFail($request->id)->delete();
        if ($check){
            $cards =  stripeSubmission::where('user_id',Auth::id())->get();
            $card=  stripeSubmission::where('user_id',Auth::id())->first();

            $cards = view('frontend.partial.credit_card_list',compact('cards'))->render();

            return response()->json([
                'success'=>true,
                'cards'=>$cards,
                ]);
        }else{
            return response()->json(['success'=>false]);
        }

    }
}
