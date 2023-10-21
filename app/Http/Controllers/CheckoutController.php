<?php

namespace App\Http\Controllers;

use App\Enumeration\OrderStatus;
use App\Enumeration\Role;
use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Mail\NewOrder;
use App\Models\AddressBooks;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\DeliveryOption;
use App\Models\Inventory;
use App\Models\ProductSaleOrder;
use App\Models\AddressBook;
use App\Models\PersonalNote;
use App\Models\State;
use App\Models\stripeSubmission;
use App\Models\SaleOrder;
use App\Models\Setting;
use App\Notifications\NewOrderNotification;
use App\Models\User;
//use Darryldecode\Cart\Cart;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index(Request $request) {
       // dd($request->session()->get('customer_personal_note_msg'));
            if (Cart::isEmpty())
                return redirect()->route('home');

            $lastOrder = null;
            $user = null;

            if (Auth::check() && Auth::user()->role == Role::$BUYER){
                $user = Auth::user();
                $lastOrder = SaleOrder::where('user_id', Auth::user()->id)->latest()->first();
            }

            $countries = Country::all();
            $phoneCodes = Country::where('phonecode','!=',0)->orderBy('phonecode')->get();
            $products = Cart::getContent();
            $subTotal = convertCurrencyFlat(Cart::getSubTotal() ?? 0);
            $setting = Setting::first();
            $shippingCost = $setting->shipping_cost;
            $deliveryOptions = DeliveryOption::orderBy('sort')->where('status',1)->get();

            return view('frontend.checkout', compact('phoneCodes','lastOrder', 'user', 'subTotal', 'setting', 'shippingCost','products','countries',
            'deliveryOptions'));
        }


    public function checkoutPost(Request $request) {

            $cartItems = Cart::getContent();
            $setting = Setting::first();

            if (Auth::check() && Auth::user()->role == Role::$BUYER){
                $user = Auth::user();
                $address  = AddressBooks::where('id',$request->address_book_id)
                    ->where('user_id',$user->id)
                    ->first();
            }else{
                $user = User::where('email',$request->email)->first();
                if ($user){
                    $address = AddressBooks::where('user_id',$user->id)->first();
                    if (!$address){
                        return response()->json([
                            'success' => false,
                            'message' => 'Opps... Something Wrong!',
                        ]);
                    }
                }
                if (!$user){
                    $guestUserAddress = $request->session()->get('guest_address_details');
                    if (!$guestUserAddress){
                        return response()->json([
                            'success' => false,
                            'message' => 'Opps... Something Wrong!',
                        ]);
                    }
                    $guestUserAddress = $guestUserAddress[0];
                    $user = new User();
                    $user->role = Role::$BUYER;
                    $user->title = $guestUserAddress['title'];
                    $user->name = $guestUserAddress['first_name'].' '.$guestUserAddress['last_name'];
                    $user->first_name = $guestUserAddress['first_name'];
                    $user->last_name = $guestUserAddress['last_name'];
                    $user->mobile_no = $guestUserAddress['mobile_no_1'] ?? Null;
                    $user->email = $request->email;
                    $user->password = bcrypt(12345678);
                    $user->country_id = $request->country;
                    $user->status = 1;
                    $user->save();


                    $customerAddress = new AddressBook();
                    $customerAddress->user_id = $user->id;
                    $customerAddress->description = $guestUserAddress['description'];
                    $customerAddress->title = $guestUserAddress['title'];
                    $customerAddress->first_name = $guestUserAddress['first_name'];
                    $customerAddress->last_name = $guestUserAddress['last_name'];
                    $customerAddress->country_id = $guestUserAddress['country'];
                    $customerAddress->state_id = $guestUserAddress['city'];
                    $customerAddress->delivery_address = $guestUserAddress['delivery_address'];
                    $customerAddress->apartment_details = $guestUserAddress['apartment_details'];
                    $customerAddress->area = $guestUserAddress['area'];

                    if ($guestUserAddress['mobile_no_1'] ?? false){
                        $customerAddress->mobile_no_code_1 = $guestUserAddress['mobile_no_code_1'];
                        $customerAddress->mobile_no_type_1 = $guestUserAddress['mobile_no_type_1'];
                        $customerAddress->mobile_no_1 = $guestUserAddress['mobile_no_1'];
                    }else{
                        $customerAddress->mobile_no_code_1 = null;
                        $customerAddress->mobile_no_type_1 = null;
                        $customerAddress->mobile_no_1 = null;
                    }
                    if ($guestUserAddress['mobile_no_2'] ?? false){
                        $customerAddress->mobile_no_code_2 = $guestUserAddress['mobile_no_code_2'];
                        $customerAddress->mobile_no_type_2 = $guestUserAddress['mobile_no_type_2'];
                        $customerAddress->mobile_no_2 = $guestUserAddress['mobile_no_2'];
                    }else{
                        $customerAddress->mobile_no_code_2 = null;
                        $customerAddress->mobile_no_type_2 = null;
                        $customerAddress->mobile_no_2 = null;
                    }
                    if ($guestUserAddress['mobile_no_3'] ?? false){
                        $customerAddress->mobile_no_code_3 = $guestUserAddress['mobile_no_code_3'];
                        $customerAddress->mobile_no_type_3 = $guestUserAddress['mobile_no_type_3'];
                        $customerAddress->mobile_no_3 = $guestUserAddress['mobile_no_3'];
                    }else{
                        $customerAddress->mobile_no_code_3 = null;
                        $customerAddress->mobile_no_type_3 = null;
                        $customerAddress->mobile_no_3 = null;
                    }
                    $customerAddress->save();
                    $address = AddressBooks::find($customerAddress->id);
                }
            }

        ///dd($address);

        $deliveryOption = DeliveryOption::where('id',$request->delivery_option_id)->first();

        if ($address->country_id == 18 && $address->state_id == 348){
            if ($deliveryOption->id == 1){
                foreach ($cartItems as $product){
                    if($product->associatedModel->product_weight <= 0.5){
                        $deliveryOption->delivery_fee = 70 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 0.5 && $product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 80 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1 && $product->associatedModel->product_weight <= 2){
                        $deliveryOption->delivery_fee = 90 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 2){
                        $actualWeight = $product->associatedModel->product_weight - 2;
                        $deliveryOption->delivery_fee = (90 + ($actualWeight * 15)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 2){
                foreach ($cartItems as $product) {
                    if ($product->associatedModel->product_weight <= 1) {
                        $deliveryOption->delivery_fee = 150;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actual_Weight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (150 + ($actual_Weight * 25)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 4){
                foreach ($cartItems as $product){
                    if($product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 60 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actualWeight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (60 + ($actualWeight * 20)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 5){
                foreach ($cartItems as $product){
                    if($product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 80 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actualWeight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (80 + ($actualWeight * 20)) * $product->quantity;
                    }
                }
            }
        }elseif ($address->country_id == 18 && $address->state_id != 348){
            if ($deliveryOption->id == 3) {
                foreach ($cartItems as $product) {
                    if ($product->associatedModel->product_weight <= 0.5) {
                        $deliveryOption->delivery_fee = 120 * $product->quantity;
                    } elseif ($product->associatedModel->product_weight > 0.5 && $product->associatedModel->product_weight <= 1) {
                        $deliveryOption->delivery_fee = 140 * $product->quantity;
                    } elseif ($product->associatedModel->product_weight > 1 && $product->associatedModel->product_weight <= 2) {
                        $deliveryOption->delivery_fee = 140 * $product->quantity;
                    } elseif ($product->associatedModel->product_weight > 2) {
                        $actualWeight = $product->associatedModel->product_weight - 2;
                        $deliveryOption->delivery_fee = (140 + ($actualWeight * 25)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 6){
                foreach ($cartItems as $product){
                    if($product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 120 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actualWeight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (120 + ($actualWeight * 20)) * $product->quantity;
                    }
                }
            }
        }
         $subTotal = 0;

        // Create Order
        $orderDate = date('YmdHis');
        $checkLastOrder = SaleOrder::orderBy('id','desc')->first();
        if ($checkLastOrder){
            $orderNoGenerate = $orderDate.($checkLastOrder->id + 1);
        }else{
            $orderNoGenerate = $orderDate;
        }

        $order = new SaleOrder();
        $order->user_id = $user->id;
        $order->address_books_id = $address->id;
        $order->currency = 'BDT';
        $order->delivery_option_id = $request->delivery_option_id;
        $order->transaction_id = null;
        $order->order_no = $orderNoGenerate;
        $order->email = $user->email ?? '';
        $order->mobile_no = $address->mobile_no_1;
        $order->alternative_mobile = $request->alternative_mobile_no;
        $order->country_id = $address->country_id;
        $order->city = $address->state_id;
        $order->billing_address = $address->apartment_details.' ,'.$address->area.' ,'.$address->delivery_address;
        $order->shipping_address = $address->apartment_details.' ,'.$address->area.' ,'.$address->delivery_address;
        $order->notes = $request->notes;
        $order->delivery_duration = $deliveryOption->delivery_duration;
        $order->gift_message = $request->session()->get('customer_personal_note_msg') ?? Null;
        $order->payment_method = $request->payment_option;
        $order->status = OrderStatus::$PENDING;
        $order->payment_status = 'Pending';
        $order->subtotal = 0;
        //$order->shipping_cost = $setting->shipping_cost;
        $order->shipping_cost = $deliveryOption->delivery_fee;
        $order->vat = 0;
        $order->total = 0;
        $order->paid = 0;
        $order->due = 0;
        $order->save();
        Session::forget('order_place_id');
        Session::push('order_place_id', $order->id);

            $productsName = '';
            foreach ($cartItems as $product) {
                $inventory = Inventory::where('product_id',$product->associatedModel->id)
                    ->where('type_id',$product->attributes->type_id)
                    ->where('color_id',$product->attributes->color_id)
                    ->where('size_id',$product->attributes->size_id)
                    ->first();
                $productsName .= $product->name;
                ProductSaleOrder::create([
                    'sale_order_id' => $order->id,
                    'product_id' => $product->associatedModel->id,
                    'product_name' =>$product->associatedModel->name,
                    'type_id' => $product->attributes->type_id,
                    'type' => $product->attributes->type,
                    'color_id' => $product->attributes->color_id,
                    'color' => $product->attributes->color,
                    'size_id' => $product->attributes->size_id,
                    'size' => $product->attributes->size,
                    'product_weight' => $product->associatedModel->product_weight??0,
                    'quantity' => $product->quantity,
                    'unit_price' => $inventory->selling_unit_price,
                    'total' => $product->quantity * $inventory->selling_unit_price,
                ]);

                $subTotal += $product->quantity * $inventory->selling_unit_price;
            }

            //dd($subTotal);

            $order->subtotal = $subTotal;
            $order->vat = 0;
            $order->total = $subTotal + $deliveryOption->delivery_fee;
            $order->due = $subTotal + $deliveryOption->delivery_fee;
            $order->save();

            $subject = "Order Confirmation: Order No. ".$order->order_no;

            Mail::to($user->email)->send(new NewOrder($order, $subject));

            // Send Notification
             //$adminsUsers = User::where('role',Role::$ADMIN)->get();
            //Notification::send($adminsUsers, new NewOrderNotification($order));
        //Payment Port Wallet
        if ($request->payment_option == 2){
            return OnlinePaymentController::portWalletMakePayment($order,$address,$productsName);
        }


        return redirect()->route('checkout_complete');
    }

    public function checkoutComplete(Request $request) {
        if (!$request->session()->has('orderId')) {
            return redirect()->route('home');
        }

        $orderId = $request->session()->get('orderId');

        $order = SaleOrder::where('id', $orderId)->first();

        return view('frontend.order_complete', compact('order'));
    }

    public function getArea(Request $request) {
        $areas = Area::where('city_id', $request->cityId)->get();

        return response()->json($areas->toArray());
    }
    public function getCity(Request $request) {
        $countries = State::where('country_id', $request->countryId)->get();
        return response()->json($countries->toArray());
    }
    public function getCustomerCity(Request $request) {
        //dd($request->all());
        $city = State::where('id', $request->cityId)->first();
        return response()->json($city);
    }
    public function getCustomerCountry(Request $request) {
        $country = Country::where('id', $request->countryId)->first();
        return response()->json($country);
    }
    public function getPhoneCode(Request $request) {
        $countries = Country::where('id', $request->countryId)->get();
        return response()->json($countries->toArray());
    }


    public function CheckoutAddressDetails(Request $request){
        if($request->id == 0){

            $array = Session::get('guest_address_details');
            $convertArray = array_merge(...$array);
            return response()->json([
                'success'=>false,
                'guest_address_details'=>$convertArray,
            ]);
        }

        $address = AddressBook::where('id', $request->id)->first();
        return response()->json($address);
    }
    public function checkoutCreditCardDetails(Request $request){
        if($request->id == 0){
            $array = Session::get('guest_credit_card_details');
            $convertArray = array_merge(...$array);
            return response()->json([
                'success'=>false,
                'guest_credit_card_details'=>$convertArray,
            ]);
        }
        $creditCard = stripeSubmission::where('id', $request->id)->first();
        return response()->json($creditCard);
    }
    public function getCheckoutAddressDetails(Request $request){

        if (Auth::check()){
            if (auth()->user()->role != Role::$BUYER){
                return response()->json([
                    'loggedIn'=>false,
                ]);
            }

        }else{
            return response()->json([
                'loggedIn'=>false,
            ]);
        }

        $addresses =  AddressBook::where('user_id',Auth::id())->get();
        $address =  AddressBook::where('user_id',Auth::id())->first();
        $deliveryOption =  DeliveryOption::where('id',$request->deliveryOptionId)->first();

        $products = Cart::getContent();

        if ($request->countryId == 18 && $request->cityId == 348){
            if ($deliveryOption->id == 1){
                foreach ($products as $product){
                    if($product->associatedModel->product_weight <= 0.5){
                        $deliveryOption->delivery_fee = 70 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 0.5 && $product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 80 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1 && $product->associatedModel->product_weight <= 2){
                        $deliveryOption->delivery_fee = 90 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 2){
                        $actualWeight = $product->associatedModel->product_weight - 2;
                        $deliveryOption->delivery_fee = (90 + ($actualWeight * 15)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 2){
                foreach ($products as $product) {
                    if ($product->associatedModel->product_weight <= 1) {
                        $deliveryOption->delivery_fee = 150;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actual_Weight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (150 + ($actual_Weight * 25)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 4){
                foreach ($products as $product){
                    if($product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 60 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actualWeight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (60 + ($actualWeight * 20)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 5){
                foreach ($products as $product){
                    if($product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 80 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actualWeight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (80 + ($actualWeight * 20)) * $product->quantity;
                    }
                }
            }
        }elseif ($request->countryId == 18 && $request->cityId != 348){
            if ($deliveryOption->id == 3) {
                foreach ($products as $product) {
                    if ($product->associatedModel->product_weight <= 0.5) {
                        $deliveryOption->delivery_fee = 120 * $product->quantity;
                    } elseif ($product->associatedModel->product_weight > 0.5 && $product->associatedModel->product_weight <= 1) {
                        $deliveryOption->delivery_fee = 140 * $product->quantity;
                    } elseif ($product->associatedModel->product_weight > 1 && $product->associatedModel->product_weight <= 2) {
                        $deliveryOption->delivery_fee = 140 * $product->quantity;
                    } elseif ($product->associatedModel->product_weight > 2) {
                        $actualWeight = $product->associatedModel->product_weight - 2;
                        $deliveryOption->delivery_fee = (140 + ($actualWeight * 25)) * $product->quantity;
                    }
                }
            }elseif ($deliveryOption->id == 6){
                foreach ($products as $product){
                    if($product->associatedModel->product_weight <= 1){
                        $deliveryOption->delivery_fee = 120 * $product->quantity;
                    }elseif ($product->associatedModel->product_weight > 1){
                        $actualWeight = $product->associatedModel->product_weight - 1;
                        $deliveryOption->delivery_fee = (120 + ($actualWeight * 20)) * $product->quantity;
                    }
                }
            }
        }

        //dd($deliveryOption->delivery_fee);

        $deliveryFees = convertCurrencySign(convertCurrencyFlat($deliveryOption->delivery_fee));
        $totalOrderAmount = convertCurrencySign(convertCurrencyFlat($deliveryOption->delivery_fee + Cart::getSubTotal()));



        $address_list = view('frontend.partial.address_list_area',compact('addresses'))->render();

        $address_selected = view('frontend.partial.selected_address',compact('address','deliveryOption'))->render();

        //dd($address_selected);

        return response()->json([
                'loggedIn'=>true,
                'address_list'=>$address_list,
                'address_selected'=>$address_selected,
                'shipping_fees'=>$deliveryFees,
                'total_order_amount'=>$totalOrderAmount,
            ]);
    }
    public function getCustomerCreditCardDetails(){

        if(auth()->check() && auth()->user()->role == Role::$BUYER){
            $cards =  stripeSubmission::where('user_id',Auth::id())->get();
            $card=  stripeSubmission::where('user_id',Auth::id())->first();

            $cards = view('frontend.partial.credit_card_list',compact('cards'))->render();
            $card = view('frontend.partial.selected_credit_card',compact('card'))->render();

            return response()->json([
                    'cards'=>$cards,
                    'card'=>$card,
                    'success'=>true,
                ]);
        } else{
            return response()->json([
                'success'=>false,
            ]);
        }



    }

    //Address Details
    public function AddressDetailsEdit(Request $request){
        $address_edit = AddressBook::where('id', $request->id)->first();
        return response()->json($address_edit);
    }

    public function UpdateDetailsData(Request $request){
        $address_id = $request->id;

        AddressBook::findOrFail($address_id)->update([
            'user_id' => $request->user_id,
            'customer_location' => $request->customer_location,
            'description' => $request->description,
            'title' => $request->title,
            'address_first_name' => $request->address_first_name,
            'address_last_name' => $request->address_last_name,
            'company_name' => $request->company_name,
            'country_id' => $request->country,
            'state_id' => $request->customer_state,
            'city' => $request->customer_city,
            'delivery_address' => $request->delivery_address,
            'address_1' => $request->address_one,
            'address_2' => $request->address_two,
            // address_3 => $request[]->description,
            'postal_code' => $request->postal_code,
            'mobile_no_code_1' => $request->mobile_no_code[0]?? '',
            'mobile_no_code_2' => $request->mobile_no_code[1]?? '',
            'mobile_no_code_3' => $request->mobile_no_code[2]?? '',
            'mobile_no_type_1' => $request->mobile_no_type[0]?? '',
            'mobile_no_type_2' => $request->mobile_no_type[1]?? '',
            'mobile_no_type_3' => $request->mobile_no_type[2]?? '',
            'mobile_no_1' => $request->mobile_no[0]?? '',
            'mobile_no_2' => $request->mobile_no[1]?? '',
            'mobile_no_3' => $request->mobile_no[2]?? '',
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }
}
