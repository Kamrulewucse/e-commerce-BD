<?php

namespace App\Http\Controllers;

use App\Enumeration\Role;
use App\Library\PortWallet\Exceptions\InvalidArgumentException;
use App\Library\PortWallet\Exceptions\PortWalletException;
use App\Library\PortWallet\PortWallet;
use App\Library\PortWallet\PortWalletClient;
use App\Mail\AppointmentForm;
use App\Mail\EmailUsFeedBack;
use App\Mail\NewsLetter;
use App\Models\AppointmentFormList;
use App\Models\Area;
use App\Models\Color;
use App\Models\Country;
use App\Models\NewsLetterList;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\QuestionAnswer;
use App\Models\QuestionAnswerType;
use App\Models\Magazine;
use App\Models\MagazineCategory;
use App\Models\Setting;
use App\Models\Size;
use App\Models\StoreList;
use App\Models\Inventory;
use App\Models\AddressBook;
use App\Models\stripeSubmission;
use App\Models\PersonalNote;
use App\Models\Tracker;
use App\Models\Type;
use App\Models\User;
use App\Models\Video;
use App\Models\EmailUs;
use App\Mail\EmailUs as ClientEmailUs;
use Carbon\Carbon;
use Cart;
use Codeboxr\EcourierCourier\Facade\Ecourier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Rats\Zkteco\Lib\ZKTeco;

class HomeController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $languageCurrency = explode('_',$request->lang);

         if ($languageCurrency[0]){
             App::setLocale($languageCurrency[0]);
             session()->put('locale',$languageCurrency[0]);
             session()->put('currency',$languageCurrency[1]);
             session()->put('language_currency',$request->lang);
         }

        $currentLocale = $request->session()->get('locale');
        $currency = $request->session()->get('currency');
        $language_currency = $request->session()->get('language_currency');


        $track = Tracker::where('ip',$_SERVER['REMOTE_ADDR'])->first();
        //dd($request->all());
        if ($track){
            $track->lang = $currentLocale;
            $track->currency = $currency;
            $track->language_currency = $language_currency;
            $track->save();
        }
        return redirect()->route('home');

    }

    public function home()
    {
        $videos = Video::orderBy('sort')
                    ->where('sort','!=',1)
                    ->where('status',1)
                    ->get();

        $videoFirst = Video::where('sort',1)->first();
        if (!$videoFirst)
            $videoFirst = Video::first();

        $track = Tracker::where('ip',$_SERVER['REMOTE_ADDR'])->first();
        if ($track){
            if ($track->lang){
                App::setLocale($track->lang);
                session()->put('locale',$track->lang);
                session()->put('currency',$track->currency);
                session()->put('language_currency',$track->language_currency);
            }
            //dd(app()->getLocale());
        }

        //dd(app()->getLocale());

        return view('frontend.home',compact('videos','videoFirst'));
    }

      public function worldOfBdDrip()
    {
        $categories  = MagazineCategory::with('magazines')->where('status',1)->orderBy('sort')->get();
        $magazine = Magazine::where('home_featured',1)->first();

        if (!$magazine)
            $magazine = Magazine::first();

        return view('frontend.world_of_bd_drip',compact('categories','magazine'));
    }

 public function magazineCategory($slug)
    {
        $category = MagazineCategory::where('slug',$slug)->first();
        if (!$category)
            abort('404');

        $category->load('magazines');

        $magazine = Magazine::where('magazine_category_id',$category->id)
            ->where('category_featured',1)->first();

        if (!$magazine)
            $magazine = Magazine::where('magazine_category_id',$category->id)->first();


        return view('frontend.magazine_category',compact('category','magazine'));
    }
    public function magazineDetails($slug)
    {

        $magazine = Magazine::where('slug',$slug)->first();

        if (!$magazine)
            abort('404');

        return view('frontend.magazine_details',compact('magazine'));
    }
    public function languagePage()
    {
        $previousUrl = url()->previous();
        return view('frontend.dispatch',compact('previousUrl'));
    }

    public function getAppointmentSlot(Request $request)
    {
        $checkAppointments = AppointmentFormList::where('appointment_day',$request->appointmentDay)
            ->get();
        $slots = [];
        if (date('Y-m-d') == date('Y-m-d',strtotime($request->appointmentDay))){

            if (count($checkAppointments) < 1){

                if (date('H') < '12'){
                    $slots = [
                        '0'=>'12pm',
                        '1'=>'2pm',
                    ];
                }elseif (date('H') < '14'){
                    $slots = [
                        '0'=>'2pm',
                    ];
                }
            }else{
                if ($checkAppointments[0]->appointment_time == '12pm'){

                    if (date('H') < '14'){
                        $slots = [
                            '0'=>'2pm',
                        ];
                    }

                }else{
                    if (date('H') < '12'){
                        $slots = [
                            '0'=>'12pm',
                        ];
                    }

                }
            }


        }else{
            if (count($checkAppointments) < 1){
                $slots = [
                    '0'=>'12pm',
                    '1'=>'2pm',
                ];
            }else{
                if ($checkAppointments[0]->appointment_time == '12pm'){
                    $slots = [
                        '0'=>'2pm',
                    ];
                }else{
                    $slots = [
                        '0'=>'12pm',
                    ];
                }
            }
        }

        return $slots;
    }
    public function getAppointmentSlotCalender(Request $request)
    {

        $checkAppointments = AppointmentFormList::where('appointment_day',$request->convertDate)
            ->get();
        $slots = [];
        if (date('Y-m-d') == date('Y-m-d',strtotime($request->appointmentDay))){

            if (count($checkAppointments) < 1){

                if (date('H') < '12'){
                    $slots = [
                        '0'=>'12pm',
                        '1'=>'2pm',
                    ];
                }elseif (date('H') < '14'){
                    $slots = [
                        '0'=>'2pm',
                    ];
                }
            }else{
                if ($checkAppointments[0]->appointment_time == '12pm'){

                    if (date('H') < '14'){
                        $slots = [
                            '0'=>'2pm',
                        ];
                    }

                }else{
                    if (date('H') < '12'){
                        $slots = [
                            '0'=>'12pm',
                        ];
                    }

                }
            }


        }else{
            if (count($checkAppointments) < 1){
                $slots = [
                    '0'=>'12pm',
                    '1'=>'2pm',
                ];
            }else{
                if ($checkAppointments[0]->appointment_time == '12pm'){
                    $slots = [
                        '0'=>'2pm',
                    ];
                }else{
                    $slots = [
                        '0'=>'12pm',
                    ];
                }
            }
        }

        return $slots;
    }
    public function stores(Request $request)
    {

        $areas = StoreList::where('status',1)->orderBy('sort')->get();
        $salesByAreas = json_encode($areas);

        $stores = StoreList::where('status',1)->orderBy('sort')->get();
        //$ipAddress = $request->ip();
        $ipAddress = '27.147.204.147';
        $locationDetail = \Location::get($ipAddress)->toArray();

        $countries = Country::all();
        $socialLinks = \Share::page(route('stores'),'Lalmatia, Dhaka. 2/1 Block A, Lalmatia, Dhaka')
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp()
            ->telegram()
            ->getRawLinks();

        $appointmentDays = [];

        for ($i = 0;$i <= 15;$i++){
            $getDate = date('Y-m-d',strtotime("+$i days"));
            $getDay = date('l',strtotime($getDate));

            $checkAppointment = AppointmentFormList::where('appointment_day',$getDate)
                                        ->get();

            if (count($checkAppointment) < 2){
                if ($getDay != 'Friday'){
                    if ($i == 0){
                        if (date('H') < '14'){
                            array_push($appointmentDays,$getDate);
                        }
                    }else{
                        array_push($appointmentDays,$getDate);
                    }
                }
            }

        }
       $authCheck = Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER;

        return view('frontend.stores',compact('salesByAreas','stores',
        'locationDetail','countries','appointmentDays','authCheck','socialLinks'));
    }
    public function startTheJourney()
    {
        return view('frontend.start_the_journey');
    }
    public function openingHours()
    {
        return view('frontend.opening_hours');
    }
    public function faq()
    {
        $questions = QuestionAnswer::where('status',1)
                        ->orderBy('sort')
                        ->get();

        return view('frontend.faq',compact('questions'));
    }
    public function productCare()
    {
        $questionTypes = QuestionAnswerType::where('status',1)
                        ->with('questionAnswers')
                        ->where('type',3)
                        ->orderBy('sort')
                        ->get();
        return view('frontend.product_care',compact('questionTypes'));
    }
    public function nikeAndBdDrip()
    {
        $questionTypes = QuestionAnswerType::where('status',1)
                        ->with('questionAnswers')
                        ->where('type',1)
                        ->orderBy('sort')
                        ->get();
        return view('frontend.nike_and_bd_drip',compact('questionTypes'));
    }
    public function viewCart() {
        $products = Cart::getContent();
        $setting = Setting::first();
        $subTotal = convertNormalCurrency(Cart::getSubTotal());
        $shippingCost = convertNormalCurrency($setting->shipping_cost);

        return view('frontend.cart', compact('products', 'setting', 'subTotal',
            'shippingCost'));
    }

    public function personalNotePost(Request $request){

        Session::put('customer_personal_note_msg', $request->personalNote);

        return response()->json(array(
            'success'=>true,
            'customer_personal_note'=>$request->personalNote,
        ));
    }

    public function addToCartWithAttribute(Request $request) {

        $product = Product::where('id', $request->productId)
            ->first();

        $size = NULL;
        $color = NULL;
        $name = $product->name;
        $colorId = NULL;
        $sizeId = NULL;
        $colorName = NULL;
        $sizeName = NULL;
        $cartId = $product->id;

        if ($request->qty < 1){
            $qty = 1;
        }else {
            $qty = $request->qty;
        }
        if ($request->colorId)
            $color = Color::find($request->colorId);

        if ($request->typeId){
            $type = Type::find($request->typeId);
        }
        if ($request->sizeId){
            $size = Size::find($request->sizeId);
        }
        if ($color) {
            $cartId .= '-' . $color->id;
            $name .= ' - '.$color->name;
            $colorId = $color->id;
            $colorName = $color->name;
        } else {
            $cartId .= '-0';
        }
        if ($type) {
            $cartId .= '-' . $type->id;
            if ($type->id != 1){
                $name .= ' - '.$type->name;
            }
            $typeId = $type->id;
            $typeName = $type->name;
        } else {
            $cartId .= '-0';
        }
        if ($size) {
            $cartId .= '-' . $size->id;
            if ($size->type != 0){
                $name .= ' - '.$type->name;
            }
            $sizeId = $size->id;
            $sizeName = $size->name;
        } else {
            $cartId .= '-0';
        }

        Cart::add(array(
            'id' => $cartId,
            'name' => $name,
            'price' => $product->inventory->selling_unit_price,
            'quantity' => $qty,
            'attributes' => array(
                'color_id' => $colorId,
                'color' => $colorName,
                'type_id' => $typeId,
                'type' => $typeName,
                'size_id' => $sizeId,
                'size' => $sizeName
            ),
            'associatedModel' => $product
        ));

        $cartItems = Cart::getContent();
        $subTotal = convertNormalCurrency(Cart::getSubTotal());
        $html = view('frontend.partial.cart_item', compact('cartItems','subTotal'))->render();

        return response()->json([
            'status' => 1,
            'message' => 'Added to cart.',
            'cartCount' => Cart::getTotalQuantity(),
            'cartHtml' => $html,
            'color_name' => $colorName,
            'type_name' => $type->id != 1 ? $typeName : '',
            'size_name' => $size->type == 1 ? $sizeName : '',
            'product_image' => asset(colorTypeImages($product->id,$colorId,$typeId)[0]->thumbs ?? ''),
            'unit_price' => getPriceCurrency($product->id,$colorId,$typeId,$sizeId),
        ]);
    }

    public function NavigationProductDetails(Request $request){
        $productImg = ProductImage::with('product')
            ->where('product_id',$request->productId)
            ->where('color_id',$request->colorId)
            ->where('type_id',$request->typeId)
            ->get();
        $product = Product::with('productFirstImage')->findOrFail($request->productId);
        return response()->json(array(
            'products' => $product,
            'productName' => $product->name,
            'slug' => $product->slug,
            'unit_price' => getPriceCurrency($product->id,$request->colorId,$request->typeId,$request->sizeID),
            'productFeatures' => strip_tags($product->short_description),
            'product_image' => asset(colorTypeImages($product->id,$request->colorId,$request->typeId)[0]->thumbs ?? ''),
        ));
    }

//    public function NavigationProductDetails(Request $request){
//        $product = Product::with('productFirstImage')->findOrFail($request->productId);
//        return response()->json(array(
//            'product' => $product,
//            'productName' => $product->name,
//            'productFeatures' => strip_tags($product->short_description),
//            'productThumble' => $product->productFirstImage->thumbs,
//            // 'size' => $product_size,
//        ));
//    }

    public function RemovedItemProduct(Request $request){
        // $removedItemProducts = Product::with('productFirstImage')->where('id',$request->id)->get();



        $removedItemProducts = Product::with('productFirstImage')->findOrFail($request->id);

        return response()->json(array(
            'removedItemProducts' => $removedItemProducts,
            'productThumbleImage' => asset(colorTypeImages($request->id,$request->colorId,$request->typeId)[0]->thumbs ?? ''),
            'unit_price' => getPriceCurrency($request->id,$request->colorId,$request->typeId,$request->sizeID),
            'productRemovedNamess' => $removedItemProducts->name,
            'productRemovedID' => $removedItemProducts->id,
        ));
    }

    public function SliderProductDetails(Request $request){
        $images = ProductImage::with('product')
                                ->where('product_id',$request->productId)
                                ->where('color_id',$request->colorId)
                                ->where('type_id',$request->typeId)
                                ->get();

        $htmlImg = view('layouts.partial.cart_product_image_ajax',compact('images'))->render();
        return response()->json($htmlImg);
    }

    public function SliderProductZoomDetails(Request $request){
        $images = ProductImage::with('product')
                               // ->where('id',$request->imageId)
                                ->where('product_id',$request->productId)
                                ->where('color_id',$request->colorId)
                                ->where('type_id',$request->typeId)
                                ->get();

        $activeImageId = ProductImage::where('id',$request->imageId)->first();

        $htmlImg = view('layouts.partial.cart_product_image_zoom_ajax',compact('images','activeImageId'))->render();
        return response()->json($htmlImg);
    }


    public function checkAuthentication(Request $request) {

        $rules = [
            'email'=>'required|email|max:100'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $user = User::where('email',$request->email)->first();
        if ($user){
            return response()->json(['success' => true,
                'email' => $request->email,
            ]);
        }else{
            return response()->json([
                'success' => true,
                'email' => $request->email,
                'authorized' => false,
            ]);
        }
    }

    public function checkDelivery(Request $request) {
        $rules = [
            'country'=>'required',
            'city'=>'required|max:255',
            // 'delivery_option'=>'required',
            'shipping_address'=>'required|max:255',
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'mobile_no'=>'required|max:255',
            'alternative_mobile_no'=>'nullable|max:255',
            'notes'=>'nullable|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        return response()->json(['success' => true]);
    }

    #Checkout
    public function checkDeliveryAddressOption(Request $request){

        AddressBook::where('status', 1)->update(['status'=>0]);

        AddressBook::where('id', $request->delivery_data_id)->update(['status'=>1]);
        return response()->json(['success' => true]);
    }

    public function AddressUpdateSection(Request $request){
        //  dd($request->all());
        AddressBook::where('id', $request->address_id)->update([
            'id' => $request->address_id,
            'user_id' => $request->user_id,
            'customer_location' => $request->location,
            'description' => $request->description,
            'title' => $request->title,
            'address_first_name' => $request->firstname,
            'address_last_name' => $request->lastname,
            'company_name' => $request->companyname,
            'country_id' => $request->countryid,
            'state_id' => $request->stateid,
            'city' => $request->addresscity,
            'delivery_address' => $request->deliveryaddress,
            'address_1' => $request->addressone,
            'address_2' => $request->addresstwo,
            'postal_code' => $request->postalcode,
            'mobile_no_code_1' => $request->codeone?? '',
            'mobile_no_code_2' => $request->codetwo?? '',
            'mobile_no_code_3' => $request->codethree?? '',
            'mobile_no_type_1' => $request->typeone?? '',
            'mobile_no_type_2' => $request->typetwo?? '',
            'mobile_no_type_3' => $request->typethree?? '',
            'mobile_no_1' => $request->numberone?? '',
            'mobile_no_2' => $request->numbertwo?? '',
            'mobile_no_3' => $request->numberthree?? '',
            'created_at' => Carbon::now(),
        ]);

         return response()->json(['success'=>'Information Updated successfully.']);
    }

    public function customerAddressPost(Request $request){

        //dd($request->all());

        $rules = [
//             'description' => 'nullable|max:255',
             'title' => 'required|max:20',
             'first_name' => 'required|max:255',
             'last_name' => 'required|max:255',
             'country' => 'required|integer',
             'city' => 'required|integer',
             'delivery_address' => 'required|max:255',
             'area' => 'required|max:255',
             'mobile_no_type_1' => 'required|max:255',
             'mobile_no_code_1' => 'required|numeric',
             'mobile_no_1' => 'required|max:200',
        ];

        if ($request->has('mobile_no_2')){
            $rules['mobile_no_type_2'] = 'required|max:255';
            $rules['mobile_no_code_2'] = 'required|max:255';
            $rules['mobile_no_2'] = 'required|max:255';
        }
        if ($request->has('mobile_no_3')){
            $rules['mobile_no_type_3'] = 'required|max:255';
            $rules['mobile_no_code_3'] = 'required|max:255';
            $rules['mobile_no_3'] = 'required|max:255';
        }

        $validator = Validator::make($request->all(), $rules);
        if (count($validator->errors()) > 0)
            return response()->json(['errors'=>$validator->errors()]);

        if(auth()->check() && auth()->user()->role == Role::$BUYER){

            if ($request->edit_address_id != '')
                $customerAddress = AddressBook::find($request->edit_address_id);
            else
                $customerAddress = new AddressBook();

            $customerAddress->user_id = Auth::id();
            $customerAddress->description = $request->description?? null;
            $customerAddress->title = $request->title;
            $customerAddress->first_name = $request->first_name;
            $customerAddress->last_name = $request->last_name;
            $customerAddress->country_id = $request->country;
            $customerAddress->state_id = $request->city;
            $customerAddress->delivery_address = $request->delivery_address;
            $customerAddress->apartment_details = $request->apartment_details;
            $customerAddress->area = $request->area;

            if ($request->filled('mobile_no_1')){
                $customerAddress->mobile_no_code_1 = $request->mobile_no_code_1;
                $customerAddress->mobile_no_type_1 = $request->mobile_no_type_1;
                $customerAddress->mobile_no_1 = $request->mobile_no_1;
            }else{
                $customerAddress->mobile_no_code_1 = null;
                $customerAddress->mobile_no_type_1 = null;
                $customerAddress->mobile_no_1 = null;
            }
            if ($request->filled('mobile_no_2')){
                $customerAddress->mobile_no_code_2 = $request->mobile_no_code_2;
                $customerAddress->mobile_no_type_2 = $request->mobile_no_type_2;
                $customerAddress->mobile_no_2 = $request->mobile_no_2;
            }else{
                $customerAddress->mobile_no_code_2 = null;
                $customerAddress->mobile_no_type_2 = null;
                $customerAddress->mobile_no_2 = null;
            }
            if ($request->filled('mobile_no_3')){
                $customerAddress->mobile_no_code_3 = $request->mobile_no_code_3;
                $customerAddress->mobile_no_type_3 = $request->mobile_no_type_3;
                $customerAddress->mobile_no_3 = $request->mobile_no_3;
            }else{
                $customerAddress->mobile_no_code_3 = null;
                $customerAddress->mobile_no_type_3 = null;
                $customerAddress->mobile_no_3 = null;
            }

            $customerAddress->save();
            $addresses =  AddressBook::where('user_id',Auth::id())->get();
            $address =  AddressBook::where('id',$customerAddress->id)->first();
            $address_list = view('frontend.partial.address_list_area',compact('addresses'))->render();
            $address_selected = view('frontend.partial.selected_address',compact('address'))->render();

            return response()->json(
                [
                    'success'=>true,
                    'address_list'=>$address_list,
                    'address_selected'=>$address_selected,
                ]
            );
        }else{
            $data = $request->all();
            $address_selected = view('frontend.partial.guest_selected_address',compact('data'))->render();
            Session::forget('guest_address_details');
            Session::push('guest_address_details', $data);

            return response()->json([
                    'success'=>false,
                    'address_selected'=>$address_selected,
                ]);
        }



    }


    public function checkPayment(Request $request) {


        $rules = [
            'payment_option'=>'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        return response()->json(['success' => true]);
    }

    public function customerEmailWithContinue(Request $request) {
        $rules = [
            'email'=>'required|email|max:100',
        ];
        $validator = Validator::make($request->all(), $rules);

        if (count($validator->errors()) > 0)
            return response()->json(['errors'=>$validator->errors()]);

        $user = User::where('email',$request->email)->first();

        Auth::logout();

        if ($user) {
            return response()->json(['success' => true,
                'getLogin' => true,
                'email' => $request->email
            ]);
        }
        return response()->json(['success' => true,
            'getLogin' => false,
            'email' => $request->email,
        ]);
    }
    public function signInCheckout(Request $request) {

        $rules = [
            'email'=>'required|email|max:100',
            'password'=>'required|max:100'
        ];
        $validator = Validator::make($request->all(), $rules);

        if (count($validator->errors()) > 0)
            return response()->json(['errors'=>$validator->errors()]);

        $user = User::where('email',$request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false,
                'email_error' => 'The provided credentials do not match our records.'
            ]);
        }else{
            Auth::login($user, $request->boolean('remember'));
            return response()->json(['success' => true,
                'email' => $user->email,
                'user' => $user
            ]);
        }
    }

    public function updateCart(Request $request) {

        if ($request->quantity == 0) {
            Cart::remove($request->id);
        } else {
            Cart::update($request->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => (int)$request->quantity
                ),
            ));
        }

        // $request->session()->flash('message', 'Cart Updated.');

        return response()->json(['status' => 1, 'data' => 'Update cart.']);
    }

    public function removeFromCart(Request $request) {
        Cart::remove($request->id);

        return response()->json([
            'status' => 1,
            'message' => 'Removed from cart.',
        ]);
    }

    public function wishlist(Request $request)
    {
        $products = [];
        if (Auth::check() && Auth::user()->role == Role::$BUYER){
            $user = Auth::user();

            $wishlists = json_decode($user->wishlist) ?? [];

        }else{

            $sessionWishlist = json_encode($request->session()->get('session_wishlist'));

             if ($sessionWishlist == null)
                 $sessionWishlist = json_decode(array());

            $wishlists = json_decode($sessionWishlist) ?? [];
        }

        $products = $wishlists;

        return view('frontend.wishlist',compact('products'));
    }
    public function addToWishlist(Request $request) {

        $product = Product::where('id',$request->productId)->first();

        $productVariantId = $request->productId;
        if ($request->colorId != 0 || $request->colorId != null){
            $productVariantId .= '-'.$request->colorId;
        }else{
            $productVariantId .= '-0';
        }
        if ($request->typeId != 0 || $request->typeId != null){
            $productVariantId .= '-'.$request->typeId;
        }else{
            $productVariantId .= '-0';
        }
        if ($request->sizeId != 0 || $request->sizeId != null){
            $productVariantId .= '-'.$request->sizeId;
        }else{
            $productVariantId .= '-0';
        }

        $wishlistsItem = [
            'id' => $productVariantId,
            'product_type' => $product->type,
            'name' => $product->name,
            'slug' => $product->slug,
            'view_thumb' => $product->view_thumb,
            'attributes' => [
                'product_id' => $request->productId,
                'color_id' => $request->colorId,
                'type_id' => $request->typeId,
                'size_id' => $request->sizeId,
            ],
        ];

        if (Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER){

            $wishlists = [];
            $user = Auth::user();

            if ($user->wishlist == '' || count(json_decode($user->wishlist)) <= 0) {
                array_push($wishlists,$wishlistsItem);
            } else {
                //old
                $wishlists = json_decode($user->wishlist);
                $newItemJsonEncode = json_encode($wishlistsItem);
                if (in_array(json_decode($newItemJsonEncode), $wishlists)) {
                    $container = array();
                    foreach ($wishlists as $key) {
                        if ($key->id != $wishlistsItem['id']) {
                            array_push($container, $key);
                        }else{
                            $request['productIndex'] = $productVariantId;
                            $this->removeToWishlist($request);

                            return response()->json([
                                'status' => 2,
                                'message' => 'This product is already wishlist added.'
                            ]);
                        }
                    }
                    $wishlists = $container;
                    // $key = array_search($course_id, $wishlists);
                    // unset($wishlists[$key]);
                } else {
                    array_push($wishlists,$wishlistsItem);
                }
                //old

            }

            $user->wishlist = json_encode($wishlists);
            $user->save();

            if ($product->type == 2)
                $img_url = asset($product->view_thumb ?? '');
            else
                $img_url = asset(colorTypeImages($request->productId,$request->colorId,$request->typeId)[0]->thumbs ?? '');



            return response()->json([
                'status' => 1,
                'img_url' => $img_url,
                'wishlistCount' => count(json_decode($user->wishlist)),
                'message' => 'This product has been added to your wishlist'
            ]);

        }else{


            $sessionWishlist = $request->session()->get('session_wishlist');

            if ($sessionWishlist){
                if (!in_array($wishlistsItem,$sessionWishlist)){
                    array_push($sessionWishlist,$wishlistsItem);
                    Session::put('session_wishlist',$sessionWishlist);
                }else{

                    $request['productIndex'] = $productVariantId;
                    $this->removeToWishlist($request);
                    return response()->json([
                        'status' => 2,
                        'message' => 'This product is already wishlist added.'
                    ]);
                }
            }else{
                Session::put('session_wishlist',[$wishlistsItem]);
            }

            if ($product->type == 2)
                    $img_url = asset($product->view_thumb ?? '');
                else
                    $img_url = asset(colorTypeImages($request->productId,$request->colorId,$request->typeId)[0]->thumbs ?? '');


            return response()->json([
                'status' => 3,
                'img_url' => $img_url,
                'wishlistCount' => count($request->session()->get('session_wishlist')),
                'message' => 'This product has been added to your wishlist'
            ]);
        }

    }
    public function removeToWishlist(Request $request)
    {
            $user = Auth::user();
            if (auth()->check() && $user->role == Role::$BUYER) {
                $wishlists = json_decode($user->wishlist);
            }else{
                $jsonEncode = json_encode($request->session()->get('session_wishlist'));
                $wishlists = json_decode($jsonEncode);
            }

            $productVariantId = $request->productIndex;
            $container = [];
            foreach ($wishlists as $wishlist) {
                if ($wishlist->id != $productVariantId) {
                    array_push($container, $wishlist);
                }
            }
            $wishlists = $container;


        if (auth()->check() && $user->role == Role::$BUYER){
            $user->wishlist = json_encode($wishlists);
            $user->save();
        }else{
            Session::put('session_wishlist',$wishlists);

        }

        return response()->json([
            'success' => true,
            'product_id' => $request->productId,
            'message' => 'This product is removed from wishlist.'
        ]);


    }

    public function viewNewsletter(){
        $countries = Country::get();
        return view('frontend.newsletter',compact('countries'));
    }

    // public function UnsubscribeMessage(){
    //     $countries = Country::get();
    //     $newDemo = "You form has been unsubscribe confirmation from BD digital communications.";
    //     return view('frontend.unsubscribe',compact('newDemo','countries'));
    // }

    public function notificationFeedback()
    {
        if (session('notification_message') != '')
            return view('frontend.notification.notification_feedback');
        else
            return redirect()->route('home');
    }

    public function bookingAppointments()
    {
        return view('frontend.booking_appointment');
    }
    public function appointmentForm(Request $request){
        $request->validate([
            'appointment_field_date' => 'required|date',
            'appointment_time_field' => 'required',
            'type' => 'required',

        ]);

       $checkAppointments = AppointmentFormList::where('appointment_day',Carbon::parse($request->appointment_field_date))
                ->get();

       if (count($checkAppointments) > 1){
           return redirect()->back()
               ->with('error','Already filled this date'.date('(d F l)-Y',strtotime($request->appointment_field_date)). 'two schedule.');
       }

       $user = auth()->user();


        $appointmentFormList = new AppointmentFormList();
        $appointmentFormList->user_id = Auth::id();
        $appointmentFormList->type = $request->type;
        $appointmentFormList->appointment_day = Carbon::parse($request->appointment_field_date);
        $appointmentFormList->appointment_time = $request->appointment_time_field;
        $appointmentFormList->first_name = $user->first_name;
        $appointmentFormList->last_name = $user->last_name;
        $appointmentFormList->save();

        $subject = "Bangladesh Drip Appointment Request";

        Mail::to(['contact@bangladeshdrip.com'])
            ->send(new AppointmentForm($appointmentFormList, $subject));

        $dateShow = date('l F Y',strtotime($request->appointment_field_date));
        return redirect()->route('appointments')
            ->with('notification_message',"Your Appointment has been set at our Dhaka warehouse on $dateShow at $request->appointment_time_field. Our representative will be there to help you out with your Bangladesh Drip shopping experience.");

    }
    public function newsletterPost(Request $request){

        $message = [
            'email.unique' => 'You are already subscribed to our mailing list.',
        ];

        $request->validate([
            'sub_name' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'country' => 'required',
            'email' => 'required|email|unique:news_letter_lists',
            'verification_email' => 'required|email|same:email',
            'privacy_policy' => 'required',
        ],$message);

        // dd($request->all());

        $newsLetterList = new NewsLetterList();
        $newsLetterList->sub_name = $request->sub_name;
        $newsLetterList->first_name = $request->first_name;
        $newsLetterList->last_name = $request->last_name;
        $newsLetterList->country_id = $request->country;
        $newsLetterList->email = $request->email;
        $newsLetterList->verification_email = $request->verification_email;
        $newsLetterList->privacy_policy = $request->privacy_policy;
        $newsLetterList->save();

        $subject = "Welcome to Bangladesh Drip";

        Mail::to([$newsLetterList->email])->send(new NewsLetter($newsLetterList, $subject));

        $registerUserSubName = $request->sub_name;
        $registerUserFirstName = $request->first_name;
        $registerUserLastName = $request->last_name;

        // return redirect()->route('notification_feedback')
        //     ->with('notification_message',"Thanks for taking the time to join our mailing list. You will now receive latest updates, exclusive drops, special events and priority access to sales and warehouse.");

        return redirect()->route('notification_feedback')
            ->with('user_name', $registerUserSubName." ".$registerUserFirstName." ".$registerUserLastName)->with('notification_message', "We are pleased to confirm that you have successfully subscribed to BD Drip
            digital communications!");

    }

    // public function newsletterUnMail(Request $request){

    //     $request->validate([
    //         'unsubscribe_email' => 'required|email',
    //     ]);

    //     $newsLetter = NewsLetterList::where('email',$request->unsubscribe_email)->first();

    //     if ($newsLetter) {
    //         $newsLetter->delete();
    //     }

    //     return redirect()->route('notification_feedback')
    //         ->with('notification_message',"We are pleased to confirm that you have successfully subscribed to Bangladesh Drip��s digital communications.");

    // }

    public function newsletterUnMail(Request $request){
        $request->validate([
             'email' => 'required|email',
        ]);
//        dd($request->email);

        $newsLetter = NewsLetterList::where('email',$request->email)->first();
//        dd($newsLetter);
        if ($newsLetter) {
            $newsLetter->delete();
        }

        return response()->json(['notification_message' => 'You have been unsubscribed from BD digital communications.']);
    }

    // public function newsletterUnMail(Request $request){
    //     $request->validate([
    //         'unsubscribe_email' => 'required|email',
    //     ]);

    //     $newsLetter = NewsLetterList::where('email',$request->unsubscribe_email)->first();
    //     return redirect()->route('unsubscribe');
    // }

    public function viewContact(){
        return view('frontend.contact');
    }

    public function emailUs() {
        $countries = Country::all();
        return view('frontend.email-us',compact('countries'));
    }
    public function emailUsPost(Request $request){

        $request->validate([
                'name_title' => "required",
                'firstName' => 'required',
                'email' => 'required',
                'country' => 'required',
                'number_prefix' => 'required',
                'subject_message' => 'required',
                'message' => 'required|max:1000',
           ]);
            $emailUs = new EmailUs;
            $emailUs->name_title = $request->name_title;
            $emailUs->first_name = $request->firstName;
            $emailUs->email = $request->email;
            $emailUs->country = Country::find($request->country)->name ?? 'Blank';
            $emailUs->number = $request->number;
            $emailUs->number_prefix = '+'.Country::find($request->number_prefix)->phonecode ?? 'Blank';
            $emailUs->language = $request->language;
            $emailUs->subject_message = $request->subject_message;
            $emailUs->old_number = $request->old_number;
            $emailUs->message = $request->message;
            $emailUs->save();

        $subject = "Bangladesh Drip Client ".$request->subject_message;
        $subject2 = "Welcome to Bangladesh Drip";

        Mail::to(['contact@bangladeshdrip.com'])->send(new ClientEmailUs($emailUs, $subject));
        Mail::to([$request->email])->send(new EmailUsFeedBack($emailUs, $subject2));

        return redirect()->route('notification_feedback')
            ->with('notification_message',"Your Email has been received, thank you. Our team will get back to you shortly to help you out with your Bangladesh Drip shopping experience.");

    }

    public function CardSubmittingPost(Request $request){


        $rules['card_number'] = ['required', 'unique:stripe_submissions'];
        $rules['card_holder'] = ['required'];
        $rules['card_expiry'] = ['required'];
        $rules['security_code'] = ['required'];

        $validator = Validator::make($request->all(), $rules);
        if (count($validator->errors()) > 0)
            return response()->json(['errors'=>$validator->errors()]);

        if(auth()->check() && auth()->user()->role == Role::$BUYER){
            $card = new stripeSubmission;
            $card->user_id = Auth::id();
            $card->card_holder = $request->card_holder;
            $card->card_number = $request->card_number;
            $card->card_expiry = $request->card_expiry;
            $card->card_cvc = $request->security_code;
            $card->save();
            $cards =  stripeSubmission::where('user_id',Auth::id())->get();

            $cards = view('frontend.partial.credit_card_list',compact('cards'))->render();
            return response()->json([
                'success'=>true,
                'cards'=>$cards,
            ]);
        }else{
            $data = $request->all();
            Session::forget('guest_credit_card_details');
            Session::push('guest_credit_card_details',$data);
            $credit_card_selected = view('frontend.partial.guest_selected_credit_card',compact('data'))->render();

            return response()->json([
                'success'=>false,
                'credit_card_selected'=>$credit_card_selected,
            ]);

        }

    }
    public function CustomerCardSubmittingPost(Request $request){

        $rules['card_number'] = ['required', 'unique:stripe_submissions'];
        $rules['card_holder'] = ['required'];
        $rules['card_expiry'] = ['required'];
        $rules['security_code'] = ['required'];

        $validator = Validator::make($request->all(), $rules);
        if (count($validator->errors()) > 0)
            return response()->json(['errors'=>$validator->errors()]);

            $card = new stripeSubmission;
            $card->user_id = Auth::id();
            $card->card_holder = $request->card_holder;
            $card->card_number = $request->card_number;
            $card->card_expiry = $request->card_expiry;
            $card->card_cvc = $request->security_code;
            $card->save();
            return response()->json(['success'=>true]);


    }
    public function searchPage(Request $request){

        $products = Product::where('type',1)->where('name', 'like', '%' .$request->search_item. '%')
            ->where('status', 1)
            ->with('colors', 'sizes','category','subCategory','subSubCategory')
            ->get();

        $searchName = $request->search_item;

        $sizes = Size::where('status', 1)
            ->where('type',1)
            ->orderBy('name')
            ->get();

        $colors = Color::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('frontend.search_page',compact('products','searchName','sizes','colors'));
    }

}
