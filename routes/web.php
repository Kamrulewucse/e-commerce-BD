<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryOptionController;
use App\Http\Controllers\Admin\QuestionAnswerController;
use App\Http\Controllers\Admin\QuestionAnswerTypeController;
use App\Http\Controllers\Admin\StoreListController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ViewByLookProductController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\FinishedGoodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\OnlinePaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Admin\MagazineCategoryController;
use App\Http\Controllers\Admin\MagazineController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;


// Admin Routes
Route::get('admin/login', [AuthController::class,'login'])->name('admin.login');
Route::post('admin/login', [AuthController::class,'loginPost']);

Route::prefix('admin')->middleware(['admin'])->group(function (){
    Route::post('logout', [AuthController::class,'logout'])->name('admin.logout');

    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    // Warehouse
    Route::get('warehouse', [WarehouseController::class,'index'])->name('warehouse');
    Route::get('warehouse/add', [WarehouseController::class,'add'])->name('warehouse.add');
    Route::post('warehouse/add', [WarehouseController::class,'addPost']);
    Route::get('warehouse/edit/{warehouse}', [WarehouseController::class,'edit'])->name('warehouse.edit');
    Route::post('warehouse/edit/{warehouse}', [WarehouseController::class,'editPost']);
    // Delivery
    Route::get('delivery-option', [DeliveryOptionController::class,'index'])->name('delivery_option');
    Route::get('delivery-option/add', [DeliveryOptionController::class,'add'])->name('delivery_option.add');
    Route::post('delivery-option/add', [DeliveryOptionController::class,'addPost']);
    Route::get('delivery-option/edit/{deliveryOption}', [DeliveryOptionController::class,'edit'])->name('delivery_option.edit');
    Route::post('delivery-option/edit/{deliveryOption}', [DeliveryOptionController::class,'editPost']);

    // Video
    Route::get('video-photo', [VideoController::class,'index'])->name('video');
    Route::get('video-photo/add', [VideoController::class,'add'])->name('video.add');
    Route::post('video-photo/add', [VideoController::class,'addPost']);
    Route::get('video-photo/edit/{video}', [VideoController::class,'edit'])->name('video.edit');
    Route::post('video-photo/edit/{video}', [VideoController::class,'editPost']);
    Route::post('video-photo/delete', [VideoController::class,'delete'])->name('video.delete');
    // Unit
    Route::get('unit', [UnitController::class,'index'])->name('unit');
    Route::get('unit/add', [UnitController::class,'add'])->name('unit.add');
    Route::post('unit/add', [UnitController::class,'addPost']);
    Route::get('unit/edit/{unit}', [UnitController::class,'edit'])->name('unit.edit');
    Route::post('unit/edit/{unit}', [UnitController::class,'editPost']);
    // Brand
    Route::get('brand', [BrandController::class,'index'])->name('brand');
    Route::get('brand/add', [BrandController::class,'add'])->name('brand.add');
    Route::post('brand/add', [BrandController::class,'addPost']);
    Route::get('brand/edit/{brand}', [BrandController::class,'edit'])->name('brand.edit');
    Route::post('brand/edit/{brand}', [BrandController::class,'editPost']);
    // Color
    Route::get('color', [ColorController::class,'index'])->name('color');
    Route::get('color/add', [ColorController::class,'add'])->name('color.add');
    Route::post('color/add', [ColorController::class,'addPost']);
    Route::get('color/edit/{color}', [ColorController::class,'edit'])->name('color.edit');
    Route::post('color/edit/{color}', [ColorController::class,'editPost']);
    // Size
    Route::get('size', [SizeController::class,'index'])->name('size');
    Route::get('size/add', [SizeController::class,'add'])->name('size.add');
    Route::post('size/add', [SizeController::class,'addPost']);
    Route::get('size/edit/{size}', [SizeController::class,'edit'])->name('size.edit');
    Route::post('size/edit/{size}', [SizeController::class,'editPost']);

    // Type
    Route::get('type', [TypeController::class,'index'])->name('type');
    Route::get('type/add', [TypeController::class,'add'])->name('type.add');
    Route::post('type/add', [TypeController::class,'addPost']);
    Route::get('type/edit/{type}', [TypeController::class,'edit'])->name('type.edit');
    Route::post('type/edit/{type}', [TypeController::class,'editPost']);

    // Collection
    Route::get('collection', [CollectionController::class,'index'])->name('collection');
    Route::get('collection/add', [CollectionController::class,'add'])->name('collection.add');
    Route::post('collection/add', [CollectionController::class,'addPost']);
    Route::get('collection/edit/{collection}', [CollectionController::class,'edit'])->name('collection.edit');
    Route::post('collection/edit/{collection}', [CollectionController::class,'editPost']);

    // Category
    Route::get('category', [CategoryController::class,'index'])->name('category');
    Route::get('category/add', [CategoryController::class,'add'])->name('category.add');
    Route::post('category/add', [CategoryController::class,'addPost']);
    Route::get('category/edit/{category}', [CategoryController::class,'edit'])->name('category.edit');
    Route::post('category/edit/{category}', [CategoryController::class,'editPost']);


    // Sub Category
    Route::get('sub-category', [SubCategoryController::class,'index'])->name('sub_category');
    Route::get('sub-category/add', [SubCategoryController::class,'add'])->name('sub_category.add');
    Route::post('sub-category/add', [SubCategoryController::class,'addPost']);
    Route::get('sub-category/edit/{subCategory}', [SubCategoryController::class,'edit'])->name('sub_category.edit');
    Route::post('sub-category/edit/{subCategory}', [SubCategoryController::class,'editPost']);

    // Sub Sub Category
    Route::get('sub-sub-category', [SubSubCategoryController::class,'index'])->name('sub_sub_category');
    Route::get('sub-sub-category/add', [SubSubCategoryController::class,'add'])->name('sub_sub_category.add');
    Route::post('sub-sub-category/add', [SubSubCategoryController::class,'addPost']);
    Route::get('sub-sub-category/edit/{subSubCategory}', [SubSubCategoryController::class,'edit'])->name('sub_sub_category.edit');
    Route::post('sub-sub-category/edit/{subSubCategory}', [SubSubCategoryController::class,'editPost']);
    Route::get('admin-get-sub-category', [SubSubCategoryController::class,'getSubCategory'])->name('admin.get_sub_category');

    // Product
    Route::get('product', [ProductController::class,'index'])->name('product');
    Route::get('product/add', [ProductController::class,'add'])->name('product.add');
    Route::post('product/add', [ProductController::class,'addPost'])->name('product.store');
    Route::post('product/media', [ProductController::class,'storeMedia'])->name('product.store_media');
    Route::get('product/edit/{product}', [ProductController::class,'edit'])->name('product.edit');
    Route::post('product/edit', [ProductController::class,'editPost'])->name('product.update');
    Route::get('admin-get-sub-sub-category', [ProductController::class,'getSubSubCategory'])->name('admin.get_sub_sub_category');

    // View By Look Product
    Route::get('view-by-look-product', [ViewByLookProductController::class,'index'])->name('view_by_look_product');
    Route::get('view-by-look-product/add', [ViewByLookProductController::class,'add'])->name('view_by_look_product.add');
    Route::post('view-by-look-product/add', [ViewByLookProductController::class,'addPost']);
    Route::get('view-by-look-product/edit/{product}', [ViewByLookProductController::class,'edit'])->name('view_by_look_product.edit');
    Route::post('view-by-look-product/edit/{product}', [ViewByLookProductController::class,'editPost']);
    Route::get('admin-get-sub-sub-view-by-look-category', [ViewByLookProductController::class,'getViewByLookSubSubCategory'])->name('admin.get_view_by_look_sub_sub_category');


    // Magazine Category
    Route::get('magazine-category', [MagazineCategoryController::class,'index'])->name('magazine_category');
    Route::get('magazine-category/add', [MagazineCategoryController::class,'add'])->name('magazine_category.add');
    Route::post('magazine-category/add', [MagazineCategoryController::class,'addPost']);
    Route::get('magazine-category/edit/{category}', [MagazineCategoryController::class,'edit'])->name('magazine_category.edit');
    Route::post('magazine-category/edit/{category}', [MagazineCategoryController::class,'editPost']);

    // Magazine
    Route::get('magazine', [MagazineController::class,'index'])->name('magazine');
    Route::get('magazine/add', [MagazineController::class,'add'])->name('magazine.add');
    Route::post('magazine/add', [MagazineController::class,'addPost']);
    Route::get('magazine/edit/{magazine}', [MagazineController::class,'edit'])->name('magazine.edit');
    Route::post('magazine/edit/{magazine}', [MagazineController::class,'editPost']);



    Route::get('finished-goods', [FinishedGoodController::class,'finishedGoods'])->name('finished_goods');
    Route::get('finished-goods/datatable', [FinishedGoodController::class,'finishedGoodsDatatable'])->name('finished_goods.datatable');
    Route::get('finished-goods/add', [FinishedGoodController::class,'finishedGoodsAdd'])->name('finished_goods.add');
    Route::post('finished-goods/add', [FinishedGoodController::class,'finishedGoodsAddPost']);

    Route::get('inventory', [FinishedGoodController::class,'inventory'])->name('inventory');
    Route::get('inventory/datatable', [FinishedGoodController::class,'inventoryDatatable'])->name('inventory.datatable');
    Route::get('inventory-log/{product}', [FinishedGoodController::class,'inventoryLog'])->name('inventory_log');
    Route::get('inventory-log-datatable', [FinishedGoodController::class,'inventoryLogDatatable'])->name('inventory_log.datatable');


    //Route::get('order/pending', [OrderController::class,'pendingOrders'])->name('order.pending');
    //Route::get('order/approved', [OrderController::class,'approvedOrders'])->name('order.approved');
    Route::get('order/processing', [OrderController::class,'processingOrders'])->name('order.processing');
    Route::post('pathao_delivery_order_request', [OrderController::class,'pathaoDeliveryOrderRequest'])->name('pathao_delivery_order_request');
    Route::post('ecourier_delivery_order_request', [OrderController::class,'ecourierDeliveryOrderRequest'])->name('ecourier_delivery_order_request');

    //Route::get('order/on-shipping', [OrderController::class,'onShippingOrders'])->name('order.on_shipping');
    Route::get('order/shipped', [OrderController::class,'shippedOrders'])->name('order.shipped');
    Route::get('order/delivered', [OrderController::class,'deliveredOrders'])->name('order.delivered');
    //Route::get('order/return-initiate', [OrderController::class,'returnInitiateOrders'])->name('order.return_initiate');
    Route::get('order/returned', [OrderController::class,'returnedOrders'])->name('order.returned');
    Route::get('order/view/{order}', [OrderController::class,'viewOrder'])->name('order.view');
    Route::get('order/customer-copy/{order}', [OrderController::class,'customerCopy'])->name('order.customer_copy');

    //Route::post('order/approved', [OrderController::class,'approvedOrder'])->name('order.approved.post');
    Route::post('order/processing', [OrderController::class,'processingOrder'])->name('order.processing.post');
    Route::post('order/cancel', [OrderController::class,'cancelOrder'])->name('order.cancel.post');
    //Route::post('order/ship', [OrderController::class,'shipOrder'])->name('order.ship.post');
    Route::post('order/shipped', [OrderController::class,'shippedOrder'])->name('order.shipped.post');
    Route::post('order/delivered', [OrderController::class,'deliveryOrder'])->name('order.delivered.post');
    Route::post('order/returned', [OrderController::class,'returnedOrder'])->name('order.returned.post');

    //Route::get('order/pending-datatable', [OrderController::class,'pendingDatatable'])->name('order.pending_datatable');
    //Route::get('order/approved-datatable', [OrderController::class,'approvedDatatable'])->name('order.approved_datatable');
    Route::get('order/processing-datatable', [OrderController::class,'processingDatatable'])->name('order.processing_datatable');
   // Route::get('order/on-shipping-datatable', [OrderController::class,'onShippingDatatable'])->name('order.on_shipping_datatable');
    Route::get('order/shipped-datatable', [OrderController::class,'shippedDatatable'])->name('order.shipped_datatable');
    Route::get('order/complete-datatable', [OrderController::class,'completeDatatable'])->name('order.complete_datatable');
   // Route::get('order/return-initiate-datatable', [OrderController::class,'returnInitiateDatatableDatatable'])->name('order.return_initiate_datatable');
    Route::get('order/returned-datatable', [OrderController::class,'returnedDatatable'])->name('order.returned_datatable');

    //Question and Answer

    // Nike and BD Drip Question Type
//    Route::get('nike-and-bd-drip-question-type', [QuestionAnswerTypeController::class,'bdDripIndex'])->name('nike_and_bd_drip_question_type');
//    Route::get('nike-and-bd-drip-question-type/add', [QuestionAnswerTypeController::class,'bdDripAdd'])->name('nike_and_bd_drip_question_type.add');
//    Route::post('nike-and-bd-drip-question-type/add', [QuestionAnswerTypeController::class,'bdDripAddPost']);
//    Route::get('nike-and-bd-drip-question-type/edit/{type}', [QuestionAnswerTypeController::class,'bdDripEdit'])->name('nike_and_bd_drip_question_type.edit');
//    Route::post('nike-and-bd-drip-question-type/edit/{type}', [QuestionAnswerTypeController::class,'bdDripEditPost']);
//
    // Faq Question Type
//    Route::get('faq-question-type', [QuestionAnswerTypeController::class,'faqIndex'])->name('faq_question_type');
//    Route::get('faq-question-type/add', [QuestionAnswerTypeController::class,'faqAdd'])->name('faq_question_type.add');
//    Route::post('faq-question-type/add', [QuestionAnswerTypeController::class,'faqAddPost']);
//    Route::get('faq-question-type/edit/{type}', [QuestionAnswerTypeController::class,'faqEdit'])->name('faq_question_type.edit');
//    Route::post('faq-question-type/edit/{type}', [QuestionAnswerTypeController::class,'faqEditPost']);

    // Product care Question Type
//    Route::get('product-care-question-type', [QuestionAnswerTypeController::class,'productCareIndex'])->name('product_care_question_type');
//    Route::get('product-care-question-type/add', [QuestionAnswerTypeController::class,'productCareAdd'])->name('product_care_question_type.add');
//    Route::post('product-care-question-type/add', [QuestionAnswerTypeController::class,'productCareAddPost']);
//    Route::get('product-care-question-type/edit/{type}', [QuestionAnswerTypeController::class,'productCareEdit'])->name('product_care_question_type.edit');
//    Route::post('product-care-question-type/edit/{type}', [QuestionAnswerTypeController::class,'productCareEditPost']);


    //Answer & Question
    // Nike and BD Drip Question
//    Route::get('nike-and-bd-drip-question', [QuestionAnswerController::class,'bdDripIndex'])->name('nike_and_bd_drip_question');
//    Route::get('nike-and-bd-drip-question/add', [QuestionAnswerController::class,'bdDripAdd'])->name('nike_and_bd_drip_question.add');
//    Route::post('nike-and-bd-drip-question/add', [QuestionAnswerController::class,'bdDripAddPost']);
//    Route::get('nike-and-bd-drip-question/edit/{questionAnswer}', [QuestionAnswerController::class,'bdDripEdit'])->name('nike_and_bd_drip_question.edit');
//    Route::post('nike-and-bd-drip-question/edit/{questionAnswer}', [QuestionAnswerController::class,'bdDripEditPost']);
//
    // Faq Question
    Route::get('faq-question', [QuestionAnswerController::class,'faqIndex'])->name('faq_question');
    Route::get('faq-question/add', [QuestionAnswerController::class,'faqAdd'])->name('faq_question.add');
    Route::post('faq-question/add', [QuestionAnswerController::class,'faqAddPost']);
    Route::get('faq-question/edit/{questionAnswer}', [QuestionAnswerController::class,'faqEdit'])->name('faq_question.edit');
    Route::post('faq-question/edit/{questionAnswer}', [QuestionAnswerController::class,'faqEditPost']);

    // Product care Question
//    Route::get('product-care-question', [QuestionAnswerController::class,'productCareIndex'])->name('product_care_question');
//    Route::get('product-care-question/add', [QuestionAnswerController::class,'productCareAdd'])->name('product_care_question.add');
//    Route::post('product-care-question/add', [QuestionAnswerController::class,'productCareAddPost']);
//    Route::get('product-care-question/edit/{questionAnswer}', [QuestionAnswerController::class,'productCareEdit'])->name('product_care_question.edit');
//    Route::post('product-care-question/edit/{questionAnswer}', [QuestionAnswerController::class,'productCareEditPost']);

    // Store List

    Route::get('store-list', [StoreListController::class,'index'])->name('store_list');
    Route::get('store-list/add', [StoreListController::class,'add'])->name('store_list.add');
    Route::post('store-list/add', [StoreListController::class,'addPost']);
    Route::get('store-list/edit/{storeList}', [StoreListController::class,'edit'])->name('store_list.edit');
    Route::post('store-list/edit/{storeList}', [StoreListController::class,'editPost']);

    //Common

    //E-Courier
    Route::get('get-ecourier-api-city',[CommonController::class,'getEcourierApiCity'])->name('get_ecourier_api_city');
    Route::get('get-ecourier-api-thana',[CommonController::class,'getEcourierApiThana'])->name('get_ecourier_api_thana');
    Route::get('get-ecourier-api-postcode',[CommonController::class,'getEcourierApiPostcode'])->name('get_ecourier_api_postcode');
    Route::get('get-ecourier-api-area',[CommonController::class,'getEcourierApiArea'])->name('get_ecourier_api_area');
    Route::get('get-ecourier-api-package',[CommonController::class,'getEcourierApiPackage'])->name('get_ecourier_api_package');
   //Pathao
    Route::get('get-pthao-api-city',[CommonController::class,'getPathaoApiCity'])->name('get_pathao_api_city');
    Route::get('get-pthao-api-store',[CommonController::class,'getPathaoApiStore'])->name('get_pathao_api_stores');
    Route::get('get-pthao-api-zone',[CommonController::class,'getPathaoApiZone'])->name('get_pathao_api_zone');
    Route::get('get-pthao-api-area',[CommonController::class,'getPathaoApiArea'])->name('get_pathao_api_area');


    Route::get('get_subCategory', [CommonController::class,'getSubCategory'])->name('get_subCategory');
    Route::get('get-sub-sub-category', [CommonController::class,'getSubSubCategory'])->name('get_subSubCategory');
    Route::get('get-product', [CommonController::class,'getProduct'])->name('get_product');
    Route::get('get-colors', [CommonController::class,'getColors'])->name('get_colors');
    Route::get('get-types', [CommonController::class,'getTypes'])->name('get_types');
    Route::get('get-brand',[CommonController::class,'getBrand'])->name('get_brand');

});

Route::get('/language',[HomeController::class,'languagePage'])->name('dispatch');
Route::get('/change_language',[HomeController::class,'changeLanguage'])->name('change_language');

Route::get('/magazine',[HomeController::class,'worldOfBdDrip'])->name('world_of_bd_drip');

Route::middleware(['currency_check'])->group(function (){

    Route::get('/',[HomeController::class,'home'])->name('home');
    Route::get('/magazine-category/{slug}',[HomeController::class,'magazineCategory'])->name('category_details_magazine');
    Route::get('/magazine-details/{slug}',[HomeController::class,'magazineDetails'])->name('magazine_details');

    Route::get('/category/{category_slug}/{sub_category_slug}/{sub_sub_category_slug}',[CategoryProductController::class,'subSubCategoryPage'])->name('page.sub_sub_category');
    Route::get('/view-by-look/{category_slug}/{sub_category_slug}/{sub_sub_category_slug}',[CategoryProductController::class,'viewByLookCategoryPage'])->name('page.view_by_look_category');
    Route::get('/product/{slug}',[CategoryProductController::class,'productDetails'])->name('page.product_details');
    Route::get('/view-by-look/product/{slug}',[CategoryProductController::class,'viewByLookProductDetails'])->name('page.view_by_look_product_details');
    Route::get('/cart', [HomeController::class,'viewCart'])->name('cart');
    Route::post('/add-to-cart-with-attribute', [HomeController::class,'addToCartWithAttribute'])->name('add_to_cart_with_attribute');
    Route::post('/update-cart',  [HomeController::class,'updateCart'])->name('update_cart');
    Route::post('/remove-from-cart', [HomeController::class,'removeFromCart'])->name('remove_from_cart');
    Route::post('/check-authentication', [HomeController::class,'checkAuthentication'])->name('check_authentication');
    Route::post('/sign-in-checkout', [HomeController::class,'signInCheckout'])->name('sign_in_checkout');
    Route::post('/customer_email_with_continue', [HomeController::class,'customerEmailWithContinue'])->name('customer_email_with_continue');
    Route::post('/check-delivery', [HomeController::class,'checkDelivery'])->name('check_delivery');
    Route::post('/check_payment', [HomeController::class,'checkPayment'])->name('check_payment');

    #Side Address navigation var
    Route::post('/check-delivery-details_option', [HomeController::class,'checkDeliveryAddressOption'])->name('check_delivery_details_option');
    Route::post('/customer-address-details-post', [HomeController::class,'customerAddressPost'])->name('customer_address_details_post');
    Route::post('/address-section-update', [HomeController::class,'AddressUpdateSection'])->name('address_section_update');

    //Newsletter

    Route::get('/newsletter', [HomeController::class,'viewNewsletter'])->name('newsletter');
    Route::post('/newsletter', [HomeController::class,'newsletterPost']);
    // Route::post('/newsletter/unsubscribe/mail', [HomeController::class,'newsletterUnMail'])->name('newsletter_unsubscribe_email');
    Route::post('/newsletter/unsubscribe/mail', [HomeController::class,'newsletterUnMail'])->name('newsletter_unsubscribe_email');

//contact
    Route::get('/contact', [HomeController::class,'viewContact'])->name('contact');
    Route::get('/get_appointment_slot',[HomeController::class,'getAppointmentSlot'])->name('get_appointment_slot');
    Route::get('/get_appointment_slot_by_calender',[HomeController::class,'getAppointmentSlotCalender'])->name('get_appointment_slot_by_calender');

    Route::get('/stores',[HomeController::class,'stores'])->name('stores');
     Route::get('/booking-appointments',[HomeController::class,'bookingAppointments'])->name('booking_appointments')->middleware(['buyer']);

    Route::post('/appointment_form',[HomeController::class,'appointmentForm'])->name('appointment_form');
    Route::get('/notification-feedback',[HomeController::class,'notificationFeedback'])->name('notification_feedback');
    Route::get('/unsubscribe_message',[HomeController::class,'UnsubscribeMessage'])->name('unsubscribe');
    Route::get('/start-the-journey',[HomeController::class,'startTheJourney'])->name('start_the_journey');
    Route::get('/faq',[HomeController::class,'faq'])->name('faq');


//Wishlist
    Route::get('/wishlist', [HomeController::class,'wishlist'])->name('wishlist');
    Route::post('/add-to-wishlist', [HomeController::class,'addToWishlist'])->name('add_to_wishlist');
    Route::post('/remove-to-wishlist', [HomeController::class,'removeToWishlist'])->name('remove_to_wishlist');

//Email Us
    Route::get('/email-us', [HomeController::class,'emailUs'])->name('email.us');
    Route::post('/email-us', [HomeController::class,'emailUsPost']);
    //Search Page
    Route::get('search-page',[HomeController::class,'searchPage'])->name('search_page');


// Checkout
    Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::post('checkout', [CheckoutController::class,'checkoutPost']);
    Route::get('/checkout/complete',[CheckoutController::class,'checkoutComplete'])->name('checkout_complete');
    Route::get('get-area', [CheckoutController::class,'getArea'])->name('get_area');
    Route::get('get-city', [CheckoutController::class,'getCity'])->name('get_city');
    Route::get('get-customer-city', [CheckoutController::class,'getCustomerCity'])->name('get_customer_city');
    Route::get('get-customer-country', [CheckoutController::class,'getCustomerCountry'])->name('get_customer_country');
    Route::get('get-phone-code', [CheckoutController::class,'getPhoneCode'])->name('get_phone_code');

// My Account
    Route::get('active-service/{service}', [MyAccountController::class,'activeService'])->name('active_service')->middleware('buyer');
    Route::get('over-view', [MyAccountController::class,'overView'])->name('over_view')->middleware('buyer');
    Route::get('appointments', [MyAccountController::class,'appointments'])->name('appointments')->middleware('buyer');
    Route::post('appointments-cancel', [MyAccountController::class,'appointmentCancel'])->name('appointment_cancel')->middleware('buyer');
    Route::get('my-bd', [MyAccountController::class,'accountDetails'])->name('account_details')->middleware('buyer');
    Route::post('my-bd', [MyAccountController::class,'accountDetailsPost'])->name('account_details_post')->middleware('buyer');
    Route::get('subscribe-toggle', [MyAccountController::class,'subscribeToggle'])->name('subscribe_toggle')->middleware('buyer');
    Route::get('orders', [MyAccountController::class,'orders'])->name('orders')->middleware('buyer');
    Route::get('orders/{order}', [MyAccountController::class,'orderDetails'])->name('order_details')->middleware('buyer');
    Route::post('cancel-order', [MyAccountController::class,'cancelOrder'])->name('cancel_order')->middleware('buyer');
    Route::post('return-order', [MyAccountController::class,'returnOrder'])->name('return_order')->middleware('buyer');
    Route::post('ajax_password_change', [MyAccountController::class,'ajaxPasswordChange'])->name('ajax_password_change')->middleware('buyer');
    Route::post('ajax_login', [MyAccountController::class,'ajaxLogin'])->name('ajax_login');
    Route::post('address_details_post/{id}', [MyAccountController::class,'AddressDetailsPost']);
    Route::post('address_details_post/edit/{id}', [MyAccountController::class,'AddressDetailsEdit']);

    //Cart Page
    // Route::post('persoalnote',[HomeController::class,'PersonalNote'])->name('personal_note'); // For Reload Using URL
    Route::post('/personal-note-post',[HomeController::class,'personalNotePost'])->name('personal_note_post'); // For Jquery No Reload

    // Credit Card Submittion
    Route::post('/card-submit-post',[HomeController::class,'CardSubmittingPost'])->name('card_submit_post'); // For Jquery No Reload
    Route::post('/customer-card-submit-post',[HomeController::class,'customerCardSubmittingPost'])->name('customer_card_submit_post'); // For Jquery No Reload


    Route::get('get_mega_menu',[CommonController::class,'getMegaMenu'])->name('get_mega_menu');
    Route::get('get_sub_sub_category',[CommonController::class,'getSubSubMenu'])->name('get_sub_sub_menu');
    Route::get('get_sub_sub_category_img',[CommonController::class,'getSubSubSubCategoryImg'])->name('get_sub_sub_category_img');
    Route::get('get_product_details_ajax',[CommonController::class,'getProductDetailsAjax'])->name('get_product_details_ajax');
    Route::get('get_search_data',[CommonController::class,'getSearchData'])->name('get_search_data');

});

// Navigation Product Deatails.
// Route::get('/product/view/modal/{id}',[ShoppingController::class,'ProductModel']);
Route::get('/navigation_details/',[HomeController::class,'NavigationProductDetails'])->name('product_navigation_details');
//Route::get('/picture_details',[HomeController::class,'SliderProductDetails'])->name('cart_product_image_zoom');
Route::get('/picture_details',[HomeController::class,'SliderProductDetails'])
                    ->name('cart_product_image_zoom');
Route::get('/slider_picture_details',[HomeController::class,'SliderProductZoomDetails'])
    ->name('slider_product_image_zoom');

Route::get('/address_details',[MyAccountController::class,'EditAddressDetails'])->name('address_details');
Route::get('/address_details_delete',[MyAccountController::class,'DeleteAddressDetails'])->name('address_details_delete');

Route::get('/card_details_delete',[MyAccountController::class,'DeleteCard'])->name('card_details_delete');

Route::get('/product_removed_item_wise',[HomeController::class,'RemovedItemProduct'])->name('product_removed_item_wise');
// Address Details for checkout
Route::get('/customer_address_details',[CheckoutController::class,'CheckoutAddressDetails'])->name('customer_address_details');
Route::get('/customer_credit_card_details',[CheckoutController::class,'checkoutCreditCardDetails'])->name('customer_credit_card_details');
Route::get('/get_customer_address_details',[CheckoutController::class,'getCheckoutAddressDetails'])->name('get_customer_address_details');
Route::get('/get_customer_credit_card_details',[CheckoutController::class,'getCustomerCreditCardDetails'])->name('get_customer_credit_card_details');
//Address Details
Route::get('/customer-address-edit',[CheckoutController::class,'AddressDetailsEdit'])->name('customer_address_edit');

// Port Wallet Start
Route::get('/port-wallet-payment', [OnlinePaymentController::class, 'portWalletPayment'])->name('port_wallet.payment');
Route::get('/port-wallet-ipn', [OnlinePaymentController::class, 'portWalletPayment'])->name('port_wallet.ipn');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



require __DIR__.'/auth.php';

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});


