@extends('layouts.app')
@section('style')
    <style>
        .page-top-description {
            padding: 30px 0;
        }

        h2.page-title {
            font-weight: bolder;
        }

        h1.product-title-d {
            font-size: 25px;
            margin-top: 35px;
        }

        .product-price {
            font-weight: bold;
            font-size: 16px;
            margin: 13px 0;
            color: #19110b;
        }

        label.product_attribute_label {
            color: #19110b;
            font-size: 18px;
        }

        .product_attribute {
            border: 1px solid #ecebe7;
        }

        input.form-control.product_quantity {
            margin-top: 30px;
            height: 47px;
            border-radius: 0;
            text-align: center;
        }

        .product_attribute {
            border-radius: 0;
            height: 40px;
        }

        .cart-area {
            margin-top: 30px;
        }
        .header-title{
            float: left;
            /* padding: 10px; */
        }
        .mains-body{
            float: left;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .carts-body-part .mains-body .image-body{
            width: 400px;
            background: #F5F4F2;
            border: 6px solid #FFFFFF;
        }
        .product-details-head {
            padding: 20px;
        }
        .product-details-head h3{
            font-size: 14px;
        }
        .product-details-head h2{
            font-weight: bold;
        }
        .table-data{
            padding-left: 16px;
            padding-right: 16px;
        }
        .footers-body{
            padding-top: 10px;

        }

        .services .cards{
            display: inline-block;
            margin:10px;
        }
        .services .cards:hover{
            background: #F3F3F3;
        }
        /* .why_we-area{
            background: #edf1f3;
            padding-top: 80PX;
            padding-bottom: 80PX;
        } */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .img2 {
            float: left;
            background: #F5F4F2;
            margin-right: 15px;
            /*width:100px;*/
        }
        .contentSer .long-text{
            color: #000;
            padding-right: 8px;
        }
        .contentSer .long-text1{
            color: #000;
            padding-right: 8px;
            text-decoration: underline;
        }
        .contentSer h3{
            font-weight: bold;
        }
        .related-product{
            margin-top:30px;
        }
        .related-product h1{
            font-weight: bold;
            margin-bottom: 15px;
        }
        .checkout{
            margin-top: 20px;
            float: end;
        }
        .btn-style-2{
            margin-top: 10px;
            background: linear-gradient(98deg,#193c7b,#009cde 93%);
        }
        .cart-info-data{
            border: 8px solid #FFFFFF;
            background: #F6F5F3;
            border-top: 1px solid #F6F5F3;
        }
        .bottom-info-data{
            padding-bottom: 40px;
            /* border-bottom: 1px solid #C5C5C5; */
        }
        .smart-cart{
            float: left;
            margin-right: 15px;
            font-size: 30px;
        }
        .carts-section{
            float:right;
        }
        .smart-carts-info{
            padding: 30px 20px 30px 20px;
            border-top: 1px solid #C5C5C5;
        }
        .smart-carts-info .carts-info .smart-cart{
            margin-top: 15px;
        }
        .text-info-main{
            margin: 0px;
            padding: 0px;
        }
        .small-text{
            font-weight: bold;
            font-size: 13PX;
            color: #000;
        }
        .small-text2{
            font-size: 12px;
        }
        .carts-header-title .header-title h2{
            color: #000;
            font-weight: bold;
        }
        .carts-header-title .header-title p{
            color: #000;
            text-decoration: underline;
        }
        .carts-header-title .header-title .qty-info {
            font-weight: normal;
            font-size: 16px;
        }
        .carts-header-title{
            margin-bottom: 20px;
        }
        .data-qty {
            padding: 8px 6px;
        }
        .btn-style-1:hover {
            background: #EAE8E4;
            color: #000 !important;
            border: 1px solid #000 !important;
        }

        /* Modal Start */
        .modal-body{
            padding: 0px;
        }
        .modal-header{
            align-items: center;
            /*box-shadow: 0px -5px 10px 0px rgb(0 0 0 / 50%);*/
        }
        .card-title-header{
            /* border-bottom: 1px solid #000; */
        }
        .cart-main-title{
            padding-left: 8px;
            color: #000;
            font-weight: bold;
        }
        .cart-modal-header{
            display: block;
            padding: 10px 0px;
        }
        .cart-modal-btn {
            padding: 10px 10px;
            height: auto !important;
            min-height: 10px !important;
            line-height: initial;
            text-transform: uppercase;
        }
        button.close-modal-btn i {
            color: #000;
            font-size: 30px;
            padding-right: 7px;
            font-weight: normal !important;
        }
        button.close-modal-btn {
            background: transparent;
            border: none;
        }
        .modal-dialog {
            max-width: 600px;
            margin: 75px auto;
        }
        a.back-button:hover {
            background: #F6F5F3;
        }
        .cart-main-title{
            padding-left: 45px;
            color: #000;
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
        }
        .side-navigation-inner{
            position: relative;
        }
        .modal-content-data {
            padding: 20px 30px 30px 30px;
        }
        .modal-content-data p{}
        .slide-bar-gift-details{
            padding: 30px 15px 30px 15px;
        }
        .slide-bar-gift-details .gift-title{

        }
        .slide-bar-gift-details .gift-title p{
            font-size: 13px;
            color: #615C58;
            padding-top: 20px;
        }
        .gift-box{
            position: absolute;
            top: 100px;
            margin-top: 40px;
            padding-top: 40px;
            padding-bottom: 40px;
            left: 0;
            right: 0;
            /* height: 100px; */
            text-align: center;
            align-items: center;
            background-color: #F6F5F3;
        }
        .gift-box .gift-title-limit{
            padding-bottom: 15px;
        }
        .middle-box{
            /*width: 503px;*/
            padding-left: 3px;
        }
        .middle-box p{
            text-align: center;
            background: #FFFFFF;
            height: 170px;
            padding: 20px 20px 20px 20px;
            color: #000;
        }
        .gift-title-removed{
            padding-top: 10px;
        }
        .gift-title-removed a{
            text-decoration: underline;
        }
        .return-exchange{
            padding-top: 40px;
            padding-left: 7px;
            padding-bottom: 30px;
            background: #FFFFFF;
        }
        .return-exchange .exchange-box{
                background: #F6F5F3;
                width: 381px;
                margin-left: 58px;
        }
        .return-exchange .exchange-box img{
            width: 60px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .return-exchange .exchange-box .exchange-name{
            font-size: 18px;
            color: #000;
            text-transform: uppercase;
            padding: 0px 20px;
        }
        .return-exchange .exchange-box .exchange-desciption{
            padding: 0px 20px 20px 20px;

        }
        .gift-apply{
            box-shadow: 0px -5px 10px rgb(0 0 0 / 18%);
            padding-top: 23px;
        }
        .gift-apply button{
            background: #000;
            color: #ffffff;
            padding: 7px 30px;
            width: 338px;
            text-align: center;
        }

        modal-dialog-slider{
        	max-width: 1000px;
        }
        .slider-resize {
            width: 544px;
            height: 500px;
            margin-left: 23px;
        }
        button.close-modal-btn i {
            color: #000;
            font-size: 30px;
            padding-right: 7px;
            font-weight: normal !important;
            margin-left: 459px;
        }
    </style>
    <style>
        @media (min-width: 320px) and (max-width: 400px){      /* For Mobile */
            .note-text-area{             /* For Mobile */
                width: 345px;
                border: none;
                text-align: center;
                padding: 20px;
                padding-top: 79px;
                height: 176px;
            }
            .return-exchange .exchange-box{
                background: #F6F5F3;
                width: 318px;
                margin-left: 32px;
            }

            .gift-apply button{                /* For Mobile */
                margin-left: 5px;
            }
        }
        .mains-body a {
            position: relative;
        }

        i.product-zoom-sign {
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 19px;
            color: #000;
            font-weight: 300;
        }
        .note-text-area{             /* For Mobile */
            width: 371px;
            border: none;
            text-align: center;
            padding: 20px;
            padding-top: 79px;
            height: 176px;
        }
        /* For removed modal */
        .modal-cancle{
            margin-left: 50px;
            width: 247px;
            background: #fff;
            color: #000;
        }
        .cart-delete{
            width: 247px;
        }
        .footer-modal{
            padding: 20px 0px 58px 0px;
        }
        .cart-modal-header {
            display: block;
            padding: 20px 0px;
            border-bottom: 1px solid #f1f1f1;
        }
        .modal-remove-data{
            padding: 20px 50px 20px 50px;
        }

        /* Hero */
        .slide-bar-prodect-details{
            padding-top: 40px;
            padding-left: 20px;
            border-bottom: 1px solid #DBDCDD;
        }
        .hero-sub{
            display: flex;
            align-items: center;
            padding-bottom: 15px;
        }
        .hero-sub .col-style img{
            background: #F6F5F3;
        }
        .hero-sub .product-style{
            padding-left: 26px;
        }
        .product-style .nav-product-name{
            font-weight: 500;
        }
        .cart-pointer {
            cursor: auto !important;
        }
        .removed-content{
            padding-bottom: 25px;
            margin-left: 8px;
            padding-top: 25px;
        }
        .body-parts-empty{
            padding: 10px 10px 89px 10px;
        }
        .body-parts-empty .item-empty{
            font-weight: 500;
            padding-bottom: 20px;
        }
        .body-parts-empty .item-empty a{
            color: #000;
        }
        .empty-content-data a:hover {
            background: #EAE8E4;
        }
        .gift-title-image img{
            width:450px;
            padding-top:40px;
            padding-bottom: 40px;
        }
        @media (min-width: 320px) and (max-width: 400px){      /* For Mobile */
            .empty-content-data{
                margin-top: 93px;
            }
            .modal-cancle{
                margin-left: 50px;
                width: 247px;
                background: #fff;
                color: #000;
            }
            .cart-delete{
                margin-left: 50px;
                margin-top: 10px;
            }
            .cart-page-button{
                margin-right: 43px;
            }
            .gift-title-image img{
                width: 350px;
                padding-top: 16px;
                padding-left: 18px;
            }
        }
        .cart-page-button{
            width: 83%;
            margin-left: 45px;
            min-height: 4rem;
            line-height: 4rem;
            margin-bottom: 18px;
        }
    </style>
@endsection

@section('content')
    <div id="product-zoom-area"> </div>
    <div class="page-content-inner body-height-full">
        <div class="container">
            <div class="row pt--80 pb--80 pt-md--45 pt-sm--25 pb-md--60 pb-sm--40">
                @if($products->isEmpty())
                <div class="col-lg-8 mb-md--30">
                    <div class="carts-body-part">
                        <div class="row">
                            <div class="col-12 col-md-12 mains-body">
                                <div class="card text-center empty-content-data">
                                    <div class="card-body body-parts-empty">
                                      <img src="{{ asset('img/empty-large.png') }}" alt="">
                                      <h1 class="item-empty">YOUR SHOPPING BAG IS EMPTY</h1>
                                      <a href="{{ route('home') }}" style="background: #fff;color:#000; border: 1px solid #000;" class="btn btn-primary empty-button">START SHOPPING</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-8 mb-md--30">
                    <div class="carts-body-part">
                        <div class="carts-header-title">
                            <div class="row">
                                <div class="col-8 col-md-9 header-title">
                                    <h2>MY SHOPPING CART <span class="qty-info">({{ count($products) }})</span></h2>
                                </div>
                                <div class="col-4 col-md-3 header-title text-sm-end">
                                    <a href="{{ route('home') }}"><p>Continue Shopping</p></a>
                                </div>
                            </div>
                        </div>
                        @foreach($products as $product)
                        <div class="row">
                            <div class="col-12 col-md-6 mains-body mb-4">
                                <?php
                                    $sliderId = $product->id;
                                    $sliderProductId = explode('-',$sliderId);
                                ?>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModalSlider" id="getPicture" onClick="getPicture({{ $sliderProductId[0] }})">
                                    <img class="image-body" style="width: 100%" src="{{ asset(colorImages($product->id,$product->attributes->color_id)[0]->thumbs ?? '') }}" alt="">
                                </a>
                            </div>
                            <div class="col-12 col-md-6 mains-body">
                                <div class="card">
                                    <div class="card-body"  style="min-height: 377px;">
                                        <form class="cart-form" action="#">
                                            <div class="row g-0">
                                                <div class="product-details-head">
                                                    <?php
                                                        $proId = $product->id;
                                                        $productId = explode('-',$proId);
                                                    ?>
                                                    <a href="#productDetails" class="toolbar-btn" id="getData" onClick="getData({{ $productId[0] }})">
                                                        <h2>{{ $product->name }}</h2>
                                                        {{-- <h2>{{ $productId[0] }}</h2>  --}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row g-0 border-top">
                                                <div class="col-12">
                                                    <div class="table-content table-responsive">
                                                        <div class="table-data">
                                                            <table class="table table-sm">
                                                                <tbody>
                                                                @if ($product->attributes->color)
                                                                    <tr>
                                                                        <td>Color</td>
                                                                        <td class="data text-sm-end">{{ $product->attributes->color }}</td>
                                                                    </tr>
                                                                @endif
                                                                @if ($product->attributes->size && checkSizeType($product->attributes->size_id)->type == 1)
                                                                    <tr>
                                                                        <td>Size</td>
                                                                        <td class="data text-sm-end">{{ $product->attributes->size }}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td>
                                                                        <input type="hidden" class="product_id" value="{{ $product->id }}">
                                                                        <select class="data-qty cart_quantity" name="cars" id="quantity_select">
                                                                            @for($i = 1;($product->quantity + 1) >= $i; $i++)
                                                                            <option {{ $product->quantity == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </td>
                                                                    <td class="data text-sm-end">
                                                                        {{ convertCurrencySign(convertCurrency($product->associatedModel->id,$product->attributes->color_id,$product->attributes->size_id) * $product->quantity) }}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-0 border-top">
                                                <div class="col-6 text-center border-left footers-body">
                                                    <a href="#productDetails" class="toolbar-btn" id="getData" onClick="getData({{ $productId[0] }})"><p><i class="fa fa-eye"></i> View Details</p></a>
                                                </div>
                                                <div class="col-6 text-center footers-body">
                                                    <a href="#" id="RemovedProductItem" onClick="RemovedProductItem('{{ $product->id }}','{{ $product->associatedModel->id }}','{{ $product->attributes->color_id }}')" data-bs-toggle="modal" data-bs-target="#productRemoved"><p><i class="fa fa-trash"></i> Remove</p></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="related-product">
                        <h1>ART OF GIFTING</h1>
                        <div class="card" style="border: 2px solid #FFFFFF;">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <img class="img2" src="{{ asset('img/bag_picture_for_thumb.jpeg') }}" style="width:80px;" alt="Image">
                                        <div class="contentSer">
                                            <h3>PACKAGING</h3>
                                            <p class="long-text">Complimentary BD tote bags with all orders <br><span class="long-text1">Learn More</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card cart-info-data" style="">
                            <a href="#giftNavigation" class="toolbar-btn">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <img class="img2" src="{{ asset('img/Gift__Message__Envelops.jpg') }}" style="width:76px;" alt="Image">
                                        <div class="contentSer">
                                            <h3>GIFT MESSAGES</h3>
                                            <p class="long-text" id="customer_personal_note"> {{ request()->session()->get('customer_personal_note_msg') ?? 'Add a personal note' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @if (!Cart::isEmpty())
                    <a href="{{ route('checkout') }}" class="btn btn-dark checkout">Proceed To Checkout</a>
                    @endif
                    <p style="color: red;font-size: 14px">
                        {{ session('login_message') }}
                    </p>
                </div>
                @endif
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="cart-collaterals bottom-info-data" style="">
                                <div class="cart-totals">
                                    <h5 class="mb--15">Cart total</h5>
                                    <div class="table-content table-responsive">
                                        <table class="table order-table">
                                            <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>{{ convertCurrencySign($subTotal) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>
                                                    <span>{{ convertCurrencySign($shippingCost) }}</span>
                                                </td>
                                            </tr>

                                            <tr class="order-total">
                                                <th style="font-weight:bold; color:#000;">Total</th>
                                                <td>
                                                    <span class="product-price-wrapper">
                                                        <span class="money">{{ convertCurrencySign($subTotal+$shippingCost) }}</span>
                                                    </span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <p style="color: red;font-size: 14px">
                                    {{ session('login_message') }}
                                </p>
                                @if (!Cart::isEmpty())
                                    <a href="{{ route('checkout') }}" class="btn btn-fullwidth btn-style-1">
                                        Proceed To Checkout
                                    </a>
                                @endif
                            </div>
                            <div class="row smart-carts-info">
                                <div class="col-12">
                                    <div class="payment-issue-part-view-page border-bottom-payment">
                                        <img src="{{ asset('img/payment.png') }}" alt="">
                                        <div class="details-payment-issue">
                                            <h3>Payment</h3>
                                            <p>Credit card, debit card or bKash</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="payment-issue-part-view-page border-bottom-payment">
                                        <img src="{{ asset('img/truck.png') }}" alt="">
                                        <div class="details-payment-issue">
                                            <h3>SHIPPING & DELIVERY</h3>
                                            <p>Complimentary Local Delivery </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="payment-issue-part-view-page">
                                        <img src="{{ asset('img/exchange.png') }}" alt="">
                                        <div class="details-payment-issue">
                                            <h3>RETURNS & EXCHANGES</h3>
                                            <p>Complimentary</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade fadeInLeft" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header cart-modal-header">
                                                <div class="row card-title-header">
                                                    <div class="col-6">
                                                        <p class="cart-main-title pull-left">PACKAGING</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="close-modal-btn pull-right" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('img/bag_picture_for_modal.jpeg') }}" alt="">
                                                <div class="modal-content-data">
                                                    <p>
                                                        BD’s signature packaging is inspired by the minimal color tone of the brand.
                                                        Our bags come with foil printed ‘BD’ and ‘Bangladesh’ house monograms on each side of its body.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Removed-->
                                <div class="modal fade fadeInLeft" id="productRemoved" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header cart-modal-header">
                                                <div class="row card-title-header" >
                                                    <div class="col-8">
                                                        <p class="cart-main-title pull-left">REMOVE THIS PRODUCT</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="button" class="close-modal-btn pull-right" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-remove-data">
                                                    <p class="removed-content">Do you wish to remove this product from your shopping bag?</p>
                                                    <div class="hero-sub">
                                                        <div class="col-style">
                                                            <img style="width:100px;" id="removedImageItems" src="" alt="">
                                                        </div>
                                                        <div class="product-style">
                                                            <p class="nav-product-name" id="removedImageItemsNames"> <br>
                                                                <span class="nav-product-price"></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="footer-modal">
                                                <div class="row">
                                                    <form action="">
                                                        <div class="col-md-12">
                                                            <input type="hidden" id="removedImageItemsID" class="form-control">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <a role="button" class="btn btn-secondary modal-cancle" data-bs-dismiss="modal">Cancel</a>
                                                            <a role="button" class="modal-remove cart-delete btn btn-secondary">Remove</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Side Navigation for MyCart Start -->
                                <aside class="side-navigation modal-dialog-scrollable side-navigation--left" id="giftNavigation">
                                    <div class="side-navigation-wrapper modal-dialog-scrollable">
                                        <div class="slide-bar-login-area">
                                            <h3>GIFT MESSAGE</h3>
                                            <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                                        </div>
                                        <div class="side-navigation-inner">
                                            <form action="">

                                                <div class="slide-bar-gift-details">
                                                    <div class="gift-title">
                                                        <p>Your gift will be wrapped and you can personalize it with a complimentary message.</p>
                                                    </div>
                                                    <div class="gift-box">
                                                        <p class="gift-title-limit">6 line(s) left</p>
                                                        <div class="middle-box">
                                                            <textarea class="note-text-area" name="personal_note" id="personalNote" placeholder="Write your personal note here" rows="6">{{ request()->session()->get('customer_personal_note_msg') }}</textarea>
                                                        </div>
                                                        <div class="gift-title-removed">
                                                            <a class="current-text-remove"> Remove message</a>
                                                        </div>
                                                        <div class="gift-title-image">
                                                            <img style="" src="{{ asset('img/gift_message_envelops.png') }}" alt="">
                                                        </div>
                                                        <div class="return-exchange">
                                                            <div class="exchange-box">
                                                                <img style="" src="{{ asset('img/exchange.png') }}" alt="">
                                                                <p class="exchange-name">RETURNS & EXCHANGES</p>
                                                                <p class="exchange-desciption">
                                                                    All products with the exception of personalized and Made-to-Order products can be returned by
                                                                    the gift recipient. Full Return & Exchange policy will be sent along with the gift receipt.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div style="background: #FFFFFF; height: 123px;" class="gift-apply">
                                                            <button type="button" class="btn-next note-save">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </aside>
                                <!-- Side Navigation for MyCart End -->

                                <!-- Side Navigation for MyCart Start -->
                                <aside class="side-navigation modal-dialog-scrollable side-navigation--left" id="productDetails">
                                    <div class="side-navigation-wrapper modal-dialog-scrollable">
                                        <div class="slide-bar-login-area">
                                            <h3>VIEW DETAILS</h3>
                                            <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                                        </div>
                                        <div class="side-navigation-inner">
                                            <div class="slide-bar-prodect-details">
                                                <div class="hero-sub">
                                                    <div class="col-style">
                                                        <img class="pro-main-image" id="pimage" src=" " alt="" style="width: 100px;">
                                                    </div>
                                                    <div class="product-style">
                                                        <p class="nav-product-name" id="productName"> <br>
                                                        <span class="nav-product-price">$7,800.00</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-description-navbar" style="padding-top: 25px;">
                                                <p style="font-size: 13px;" id="productDescription"></p>
                                            </div>
                                        </div>
                                        <div style="background: #FFFFFF; height: 123px;" class="gift-apply">
                                            <nav class="navbar navbar-expand-sm navbar-dark fixed-bottom" style="background: #ffffff; padding-top: 25px;box-shadow: 0px -5px 10px 0px rgb(0 0 0 / 20%);">
                                                <a href="#" class="btn btn-dark cart-page-button">View Product Page</a>
                                            </nav>
                                        </div>
                                    </div>
                                </aside>
                                <!-- Side Navigation for MyCart End -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $(function () {

            $("#confirm-gift-note").click(function (){
                var giftMessage = $("#gift-note-box").val();
                if(giftMessage != ''){
                    $("#gift_note").val(giftMessage);
                    $("#gift_note_show").html(giftMessage);
                }
            });
            $("#remove-gift-note").click(function (){
               $("#gift-note-box").val('');
                $("#gift_note").val('');
                $("#gift_note_show").html('Add a personal note');

            });

            $('.cart_quantity').change(function () {
                var quantity = $(this).val();

                var productId = $(this).closest('td').find('.product_id').val();

                $.ajax({
                    method: "POST",
                    url: "{{ route('update_cart') }}",
                    data: {id: productId, quantity: quantity}
                }).done(function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                });
            });

            $('.cart-delete').click(function () {

                var productId = $('#removedImageItemsID').val();
                // alert(productId);

                $.ajax({
                    method: "POST",
                    url: "{{ route('remove_from_cart') }}",
                    data: {id: productId}
                }).done(function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                });
            });
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function getData(id){
            $.ajax({
                type: 'GET',
                url: "{{ url('/navigation_details') }}/"+id,
                dataType:'json',
                // data: {id: id},
                success:function(data){
                    // console.log(data.productName);
                    // alert(data.productName);
                    // $('#pimage').attr('src','https://bangladeshdrip.com/bd-drip/public/'+data.productThumble);
                    $('#pimage').attr('src',data.productThumble);
                    $('#productName').text(data.productName);
                    $('#productDescription').text(data.productFeatures);
                }
            })
        } // End Product View with Modal
        function closeProductZoom()
        {
            $("html").css("overflow", 'auto');
            $("#product-zoom-area").html(" ");
        }
        function getPicture(productId,colorId){
            $("#product-zoom-area").html(" ");
            $.ajax({
                type: 'GET',
                url: "{{ route('cart_product_image_zoom') }}",
                dataType:'json',
                 data: {productId: productId,colorId:colorId},
                success:function(data){
                    $("#product-zoom-area").html(data);
                }
            })
        } // End Product View with Modal

        //New today
        function RemovedProductItem(cartId,productId,colorId){

            $("#removedImageItemsID").val(cartId);

            $.ajax({
                type: 'GET',
                url: "{{ route('product_removed_item_wise') }}",
                dataType:'json',
                data: {id:productId,colorId:colorId},
                success:function(data){

                    $('#removedImageItems').attr('src',data.productThumbleImage);
                    $('#removedImageItemsNames').text(data.productRemovedNamess);
                    $('#removedImageItemsID').text(data.productRemovedID);
                }
            })
        } // End Product View with Modal

        $('.note-save').click(function (event) {

            let personalNote = $('#personalNote').val();

            $.ajax({
                type: "POST",
                url: "{{ route('personal_note_post') }}",
                data: {personalNote:personalNote}
            }).done(function (response) {
                if (response.success) {
                    $("#customer_personal_note").html(response.customer_personal_note);
                    $("#giftNavigation .btn-close").click()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        $(".current-text-remove").click(function (){
            {{ Session::forget('customer_personal_note_msg') }}
            $("#personalNote").val("");
            $("#customer_personal_note").html("Add a personal note");
        });
    </script>



@endsection
