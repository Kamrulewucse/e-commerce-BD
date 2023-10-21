@extends('layouts.app',
[
   'category_dir'=>$product->category->name,
   'sub_category_dir'=>$product->subCategory->name,
   'sub_sub_category_dir'=>$product->subSubCategory,
    'product_dir'=>$product->name,
]
 )
@section('style')
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/frontend/owlcarousel/assets/owl.theme.default.min.css') }}">
    <style>
        .page-top-description {
            padding: 30px 0;
        }

        h2.page-title {
            font-weight: bolder;
        }

        h1.product-title-d {
            font-size: 25px;
            margin-top: 8px;
            text-transform: uppercase;
            font-weight: 500;
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

        .product-description {
            margin-left: 10px;
            margin-top: 20px;
            padding-bottom: 32px;
            padding-left: 7px;
        }

        @media screen and (max-width: 400px) {
            .product-description {
                margin-right: 15px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }
        }

        @media screen and (min-width: 320px) and (max-width: 550px) {
            .col-sm-12.mini-couresoul.d-md-none.d-xl-none.d-sm-block {
                margin-top: 90px;
            }

            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 365px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 371px) and (max-width: 400px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 390px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }

            /*.modal-header{*/
            /*    border-radius: 12px;*/
            /*}*/
        }

        @media screen and (min-width: 401px) and (max-width: 460px) {
            .col-sm-12.mini-couresoul.d-md-none.d-xl-none.d-sm-block {
                margin-bottom: 0px;
            }

            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 460px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 460px) and (max-width: 500px) {
            .col-sm-12.mini-couresoul.d-md-none.d-xl-none.d-sm-block {
                margin-bottom: 0px;
            }

            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 489px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 500px) and (max-width: 520px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 520px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 521px) and (max-width: 550px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 550px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 551px) and (max-width: 575px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 580px;
            }

            .product-details-area {
                padding-left: 30px;
            }

            .product-description {
                padding-left: 20px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media (max-width: 61.94em) {
            .header-mobile {
                display: block;
                position: sticky;
                top: 0;
                z-index: 2;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }

            #product-ajax-container {
                height: auto !important;
            }

            .side-navigation-wrapper {
                width: 396px !important;
            }
        }

        @media screen and (min-width: 576px) and (max-width: 620px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 621px;
            }

            .product-details-area {
                padding-left: 25px;
            }

            .product-description {
                padding-left: 18px;
                padding-bottom: 25px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 621px) and (max-width: 650px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 650px;
            }

            .product-details-area {
                padding-left: 25px;
            }

            .product-description {
                padding-left: 18px;
                padding-bottom: 25px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 651px) and (max-width: 680px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 680px;
            }

            .product-details-area {
                padding-left: 25px;
            }

            .product-description {
                padding-left: 18px;
                padding-bottom: 25px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 681px) and (max-width: 720px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 720px;
            }

            .product-details-area {
                padding-left: 25px;
            }

            .product-description {
                padding-left: 18px;
                padding-bottom: 25px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 721px) and (max-width: 750px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 750px;
            }

            .product-details-area {
                padding-left: 25px;
            }

            .product-description {
                padding-left: 18px;
                padding-bottom: 25px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        @media screen and (min-width: 751px) and (max-width: 768px) {
            .col-sm-12.col-12.product-image-owl.owl-carousel {
                height: 760px;
            }

            .product-details-area {
                padding-left: 25px;
            }

            .product-description {
                padding-left: 18px;
                padding-bottom: 25px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
        }

        .owl-dots {
            text-align: center;
            padding-top: 0px;
        }

        .owl-dots button.owl-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            background: #ccc;
            margin: 0 3px;
        }

        .owl-dots button.owl-dot.active {
            background-color: #000;
        }

        .owl-dots button.owl-dot:focus {
            outline: none;
        }

        /*.owl-nav button {*/
        /*    position: absolute;*/
        /*    top: 50%;*/
        /*    transform: translateY(-50%);*/
        /*    background: rgba(255, 255, 255, 0.38) !important;*/
        /*}*/
        .owl-dot span {
            font-size: 70px;
            position: relative;
            top: -5px;
        }

        /*.owl-nav button:focus {*/
        /*    outline: none;*/
        /*}*/

        /*.owl-carousel .owl-item img {*/
        /*    display: block;*/
        /*    width: 100%;*/
        /*    height: 375px;*/
        /*}*/
        .product-details-area {
            margin: 200px 0;
        }

        @media screen and (max-width: 767px) {
            .border-right-payment {
                border-bottom: 1px solid #e1dfd8;
                border-right: none;
            }

            .product-details-area {
                min-height: auto;
                margin: o;
            }
        }

        .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
            background: none;
        }

        .owl-theme .owl-dots .owl-dot span {
            background: none;
        }

        a.item.wishlist-item, a.item.customer-likes-wishlist-item img {
            background: rgb(246, 245, 243);
        }

        h1.product-title-d.customer-likes-p-title {
            margin-bottom: 1px;
            font-weight: 600;
        }

        p.customer_likes_product_title {
            color: #000;
            text-transform: uppercase;
            font-weight: 600;
            margin: 10px 0;
        }

        .customer-likes-product-wishlist {
            position: absolute;
            right: 15px;
            top: 6px;
            font-size: 17px;
            color: #000;
        }

        .wishlist-area.wishlist-btn {
            color: #000;
        }

        h3.product-details-title {
            color: #000;
            font-size: 18px;
            font-weight: 500;
        }

        .back-button {
            border-radius: 50%;
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 4%), 0 12px 20px 0 rgb(0 0 0 / 8%);
        }

        a.back-button {
            position: absolute;
            top: 17px;
            background: #fff;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 20px;
            color: #000;
            left: 9px;
        }

        a.back-button:hover {
            background: #F6F5F3;
        }

        .modal-dialog {
            max-width: 350px;
            margin: 75px auto;
        }

        button.close-modal-btn {
            background: transparent;
            border: none;
        }

        button.close-modal-btn i {
            color: #000;
            font-size: 12px;
            font-weight: normal !important;
        }

        .cart-modal-btn {
            padding: 10px 10px;
            height: auto !important;
            min-height: 10px !important;
            line-height: initial;
            text-transform: uppercase;
        }

        .cart-modal-header {
            display: block;
            padding: 3px;
            margin-right: 13px;
        }

        .card-title-header {
            /* border-bottom: 1px solid #000; */
        }

        .cart-main-title {
            padding-left: 8px;
            color: #000;
            font-weight: bold;
        }

        .pro-details:after {
            content: "";
            display: table;
            clear: both;
            padding-bottom: 20px;
        }

        .product-info {
            float: left;
            padding-right: 10px;
            font-size: 12px;
        }

        .product-info p {
            padding: 0px;
            margin: 0px;
        }

        .product-info .pro-title-name {
            color: #000;
            font-weight: bold;
        }

        .product-info .pro-title-price {
            color: #000;
        }

        .product-info .pro-main-image {
            width: 105px;
            background: #F5F4F2;
        }

        .modal-body {
            border-top: 2px solid #F5F4F2;
        }

        .cart-modal-dialog {
            margin-right: 0;
            margin-top: 0;
            max-width: 400px;
        }

        .product-details-area {
            margin: 57px 0;
        }
    </style>
    <style>
        .sticky-product-header {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 4%), 0 12px 20px 0 rgb(0 0 0 / 8%);
        }

        .sticky-product-header {
            background: #fff;
            padding: 0.5rem;
            border-bottom: 1px solid #eae8e4;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .purchase-bar__infos {
            display: flex;
            align-items: center;
        }

        .bd-product-purchase-bar__actions {
            display: flex;
            align-items: center;
        }

        .stick-product-img {
            margin-right: 1rem;
        }

        .stick-product-img img {
            background: #F6F5F3;
        }

        .stick-product-img {
            width: 5.5rem;
            height: 5.5rem;
        }

        .stick-product-img img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-cart-sticky {
            background-color: #19110b;
        }

        .btn-cart-sticky {
            color: #fff;
            line-height: 1;
        }

        .btn-cart-sticky {
            padding: 1rem 1.5rem;
            transition: border .3s cubic-bezier(.39, .575, .565, 1), box-shadow .3s cubic-bezier(.39, .575, .565, 1), color .3s cubic-bezier(.39, .575, .565, 1), background .3s cubic-bezier(.39, .575, .565, 1), box-shadow .3s cubic-bezier(.39, .575, .565, 1);
        }

        .sticky-product-price p {
            color: #000;
            font-weight: bold;
            padding: 0 8px;
        }

        .sticky-product-name h2 {
            margin: 0;
            font-size: 18px;
            color: #000;
        }

        .sticky-product-header {
            padding: 14px 8px;
        }

        .sticky-product-header {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            z-index: 999;
        }

        button.btn-cart {
            font-size: 16px;
            padding: 6px 0;
        }

        /*.product-first-imag {*/
        /*    height: calc(100vh - 150px);*/
        /*}*/
    </style>
    <style>
        .get-look-image img {
            height: 450px;
        }

        .get-look-area {
            margin-bottom: 10px;
        }

        .get-look-area-products {
            padding-bottom: 50px;
        }

        a.get-look-product {
            display: block;
            border: 1px solid #ddd;
        }

        .product-other-thumbs-img.get-look-product-img {
            margin: 0;
            width: 122px;
            height: 113px;
            text-align: center;
        }

        .wishlist-second-area.wishlist-btn.get-look-product-wishlist {
            text-align: right;
            padding: 0px 12px;
            font-size: 16px;
        }

        .product-description.product-details-list {
            white-space: pre-line;
        }

        .stock-out-btn {
            background: transparent !important;
            color: darkred !important;
            font-weight: bold !important;
            border-color: darkred !important;
            cursor: not-allowed !important;
        }

        .product-description p span {
            font-size: 15px !important;
        }

        span.type-name {
            font-weight: normal;
            margin-left: 88px;
        }
    </style>
    <style>
        @media (min-width: 320px) and (max-width: 400px) {
            /* For Mobile */
            video {
                object-fit: cover;
                height: 100%;
                margin-bottom: -8px;
            }
        }
        .wishlist-area {
            right: 28px;
            top: 3px;
        }
        @media (max-width: 61.94em) {
            .product-details-area {
                margin-top: 9px;
                margin-bottom: 25px !important;
            }
            .sticky-product-name h2 {
                font-size: 14px !important;
            }
            a.back-button {
                top: 100px !important;
                left: 17px !important;
            }
            .product-image-area {
                margin-top: 90px;
            }
            .product_details_video{
                margin-bottom: 25px !important;
                margin-top: 0 !important;
            }
            .wishlist-area {
                right: 21px !important;
                top: 1px !important;

            }
        }

        .header {
            min-height: 109px;
        }

        a.video-link {
            background: #fff;
            text-align: center;
            color: #000;
            padding: 12px 50px;
            font-size: 14px;
        }

        a.video-link:hover {
            background: #ddd;
        }

        button.btn-video-play {
            color: #fff;
            background: #000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: 1px solid #fff;
            font-size: 9px;
        }

        button.btn-video-sound {
            background: transparent;
            color: #fff;
            border: none;
            font-size: 16px;
            margin-right: 20px;
            margin-top: 10px;
            width: 40px;
            height: 40px;
        }

        .video-control-area {
            margin-top: 46px;
        }

        section.video-section {
            position: relative;
        }

        video {
            object-fit: contain;
            margin-bottom: -8px;
        }

        a.back-button {

            z-index: 1;
        }

        #button6 {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        #button6:hover {
            background-color: #555;
        }

        #more6 {
            display: none;
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            video {
                height: 1046px;
            }

        }

        .product-first-imag {
            position: relative;
        }

        .video-content-area {
            position: absolute;
            left: 0;
            bottom: 41px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <?php
        $isVideo = colorTypeVideo($product->id, $selectFirstAttributes->color_id, $selectFirstAttributes->type_id);
        ?>

    <div id="product-zoom-area"> </div>

    <div class="sticky-product-header" id="sticky-product-bar" style="display: none">
        <div class="purchase-bar__infos">
            <div class="stick-product-img">
                <img
                    src="{{ asset(colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)[0]->thumbs ?? '') }}"
                    alt="">
            </div>
            <div class="sticky-product-name">
                <h2>{{ $product->name }}</h2>
            </div>
        </div>
        <div class="bd-product-purchase-bar__actions">
            <div class="sticky-product-price">
                <p>{{ getPriceCurrency($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) }}</p>
            </div>
            <div class="sticky-product-add-btn">
                @if(getProductStock($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) > 0)
                    <button id="add-to-cart-sticky" class="btn-cart-sticky">Place in Cart</button>
                @else
                    <button disabled class="btn-cart-sticky stock-out-btn">Stock out</button>
                @endif
            </div>
        </div>
    </div>
    <div class="shop-page-wrapper">
        <div class="container-fluid" style="padding: 0!important;">
            <div class="row" id="product-ajax-container" style="background: #F1F0F0;height: calc(90vh - 117px)">
                <div class="col-md-7 product-detail-img-mobile">
                    <div class="product-image-area">
                        <a href="{{ url()->previous() }}" class="back-button"><i class="fa fa-angle-left"></i></a>
                        @if(colorTypeVideo($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id))
                            <div class="product-first-imag" style="background: #ffffff;height: 424px;">
                                <video playsinline webkit-playsinline autoplay muted id="video_1" width="100%"
                                       height="100%" src="{{ asset(colorTypeVideo($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)->video_path ?? '') }}" loop="loop" tabindex="-1" aria-hidden="true" ></video>
                                <script>
                                    document.getElementById('video_1').play();
                                </script>
                                <div class="video-content-area">
                                    <div class="container">
                                        <div class="row justify-content-between">
                                            <div class="col-4 col-md-4" style="text-align: left">
                                                <div class="video-control-area">
                                                    <button class="btn-video-play" id="playBtn-1"
                                                            onclick="myVideoControl(1)"><i class="fa fa-pause"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="product-first-imag" style="height: 400px;">
                                <img id="getPicture" onClick="getPicture('{{ $product->id }}','{{ $selectFirstAttributes->color_id }}','{{ $selectFirstAttributes->type_id }}')" src="{{ asset(colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)[0]->thumbs ?? '') }}"
                                    alt="">
                            </div>
                        @endif

                    </div>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <div class="product-details-area {{ $isVideo ? 'product_details_video' : '' }}">
                        <div class="wishlist-area wishlist-btn "
                             data-id="{{ $product->id }}" data-color="{{ $selectFirstAttributes->color_id }}"
                             data-type="{{ $selectFirstAttributes->type_id }}"
                             data-size="{{ $selectFirstAttributes->size_id }}">
                            <i class="fa fa-heart{{ wishlistCheck($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) ? '' : '-o' }}"></i>

                        </div>
                        <h1 class="product-title-d">{{ $product->name }}</h1>
                        <div
                            class="product-price"> {{ getPriceCurrency($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) }}</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="color-area">
                                    <a href="#color-plate-box" id="color-plate" class="product-color-btn">
                                        <span class="color-text"> Colors</span>
                                        <input type="hidden" id="selected-color"
                                               value="{{ $selectFirstAttributes->color_id }}">
                                        <span class="color-name">{{ $selectFirstAttributes->color->name ??'' }}</span>
                                        @if($selectFirstAttributes->color->color_type == 1)
                                            <span
                                                style="background-color: {{ $selectFirstAttributes->color->code ??'' }}"
                                                class="color box"></span>
                                        @else
                                            <span
                                                style="background: linear-gradient(to left, {{ $selectFirstAttributes->color->code }} 50%, {{ $selectFirstAttributes->color->code2 }} 50%)"
                                                class="color box"></span>
                                        @endif
                                        <span class="product-attribute-icon"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="color-area">
                                    <input type="hidden" id="selected-type"
                                           value="{{ $selectFirstAttributes->type_id }}">
                                    @if($selectFirstAttributes->type_id != 1)
                                    <a href="#type-plate-box" id="type-plate" class="product-color-btn">


                                            <span class="type-text"> Types</span>
                                            <span class="type-name">{{ $selectFirstAttributes->type->name ??'' }}</span>
                                            <span class="product-attribute-icon"><i
                                                    class="fa fa-angle-right"></i></span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="color-area">
                                    <input type="hidden" id="selected-size"
                                           value="{{ $selectFirstAttributes->size_id }}">
                                    @if($selectFirstAttributes->size->type == 1)
                                        <a href="#size-plate-box" id="size-plate" class="product-color-btn">
                                            <span class="size-text"> Sizes</span>
                                            <span
                                                class="color-name size-name-show">{{ $selectFirstAttributes->size->name ??'' }}</span>
                                            <span class="product-attribute-icon"><i
                                                    class="fa fa-angle-right"></i></span>
                                            @endif
                                        </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="qty" value="1">
                                <div class="cart-area">
                                    @if(getProductStock($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) > 0)
                                        <button id="btn-add-to-cart" class="btn-cart">Place in Cart</button>
                                    @else
                                        <button disabled class="btn-cart stock-out-btn">Stock Out</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 0 50px">
                <div class="col-12 col-md-7">
                    <div class="product-description">
                        {!! $product->short_description !!}
                    </div>
                </div>
            </div>
            <div class="row" id="ajax_product_details_carousel">
                <div class="col-12 col-md-4 offset-md-4">
                    <div class="product-detail-slider-area">
                        <div class="product_detail_carousel owl-carousel owl-theme">

                            <?php
                            if ($isVideo)
                                $colorTypeImages = colorTypeImages($product->id, $selectFirstAttributes->color_id, $selectFirstAttributes->type_id);
                            else
                                $colorTypeImages = colorTypeImages($product->id, $selectFirstAttributes->color_id, $selectFirstAttributes->type_id)->skip(1);
                            //dd($colorTypeImages);
                            ?>
                            @foreach($colorTypeImages as $img)
                                <a class="item wishlist-item">
                                    <img src="{{ asset($img->thumbs ?? '') }}" alt=""
                                         onClick="getSliderZoom('{{ $img->id }}','{{ $img->product_id }}','{{ $img->color_id }}','{{ $img->type_id }}')">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 0 50px" id="ajax_product_color_details">
                <div class="col-12 col-md-7">
                    <h3 class="product-details-title">Product details</h3>
                    <hr>
                    <div class="product-description product-details-list">
                        {{ json_decode($product->features,true)[$selectFirstAttributes->color_id.'-'.$selectFirstAttributes->type_id] ?? '' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            @if(json_decode($customerLikeProducts))
                <div class="row" style="padding-bottom: 0px">
                    <div class="col-12 col-md-12">
                        <h1 class="product-title-d customer-likes-p-title">YOU MAY ALSO LIKE</h1>
                        <div class="customer-likes-products-slider-area">
                            <div class="customer_likes_products_carousel owl-carousel owl-theme">
                                @foreach(json_decode($customerLikeProducts) as $customerLikeProduct)

                                    <a href="{{ route('page.product_details',['slug'=>$customerLikeProduct->slug]) }}?color_id={{ $customerLikeProduct->attributes->color_id }}&type_id={{ $customerLikeProduct->attributes->type_id }}&size_id={{ $customerLikeProduct->attributes->size_id }}"
                                       class="item customer-likes-wishlist-item">
                                        <div class="wishlist-area wishlist-btn customer-likes-product-wishlist"
                                             data-id="{{ $customerLikeProduct->attributes->product_id }}" data-color="{{ $customerLikeProduct->attributes->color_id }}" data-type="{{ $customerLikeProduct->attributes->type_id }}" data-size="{{ $customerLikeProduct->attributes->size_id }}">
                                            <i class="fa fa-heart{{ wishlistCheck($customerLikeProduct->attributes->product_id,$customerLikeProduct->attributes->color_id,$customerLikeProduct->attributes->type_id,$customerLikeProduct->attributes->size_id) ? '' : '-o' }}"></i>

                                        </div>
                                        <img src="{{ asset(colorTypeImages($customerLikeProduct->attributes->product_id,$customerLikeProduct->attributes->color_id,$customerLikeProduct->attributes->type_id)[0]->thumbs ?? '') }}"
                                             alt="">
                                        <p class="customer_likes_product_title">{{ $customerLikeProduct->name }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8 product-detail d-none d-md-none d-xl-none d-sm-block">
                    <div class="product-image-area">
                        <div class="product-first-imag" style="height: 400px;">
                            @if($selectFirstAttributes)
                                <img
                                    src="{{ asset(colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)[0]->thumbs ?? '') }}"
                                    alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="get-look-and-include-products-area">
            @if($getLook)
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 text-center">
                            <h1 class="product-title-d customer-likes-p-title">GET THE LOOK</h1>
                        </div>
                    </div>
                </div>
                <div class="get-look-area" style="background: #f6f5f3">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-12 text-center">
                                <div class="get-look-image">
                                    <img src="{{ asset($getLook->view_thumb) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="get-look-area-products">
                    <div class="container">
                        <div class="row justify-content-center">
                            @foreach(json_decode($getLook->include_products) as $key => $itemProduct)
                                <?php
                                $colorTypeProduct = getIncludeProducts($itemProduct);
                                ?>
                                <div class="col-md-4 col-12 mb-4">
                                    <a href="{{ route('page.product_details',['slug'=>$colorTypeProduct->product->slug]) }}?color_id={{ $colorTypeProduct->color_id }}&type_id={{ $colorTypeProduct->type_id }}&size_id={{ $colorTypeProduct->size_id }}"
                                       class="get-look-product">
                                        <div class="row thumbs-bg-hover">
                                            <div class="col-6 col-md-4">
                                                <div class="product-other-thumbs-img get-look-product-img">
                                                    <img style="height: 113px;"
                                                         src="{{ asset(colorTypeImages($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id)[0]->thumbs ?? '') }}"
                                                         alt="">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <div class="wishlist-second-area wishlist-btn get-look-product-wishlist"
                                                     data-id="{{ $colorTypeProduct->product_id }}"
                                                     data-color="{{ $colorTypeProduct->color_id }}"
                                                     data-type="{{ $colorTypeProduct->type_id }}"
                                                     data-color="{{ $colorTypeProduct->size_id }}">
                                                    @if (Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER)
                                                        <i class="fa fa-heart{{ wishlistCheck($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id,$colorTypeProduct->size_id) ? ' ' : '-o' }}"></i>
                                                    @else
                                                        <i class="fa fa-heart-o"></i>
                                                    @endif
                                                </div>
                                                <div class="text-area">
                                                    <h2 style="font-size: 19px">{{$colorTypeProduct->product->name ?? ''}}{{ $colorTypeProduct->type->id != 1 ? (' - '.$colorTypeProduct->type->name) : '' }}</h2>
                                                    <p>{{ getPriceCurrency($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id,$colorTypeProduct->size_id) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div class="col-md-12 text-center">
                                <a href="{{ route('page.view_by_look_product_details',['slug'=>$getLook->slug]) }}"
                                   class="btn-cart-sticky" style="margin-top: 33px">Shop The Look</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="payment-issue-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="payment-issue-part border-right-payment">
                            <img src="{{ asset('img/payment.png') }}" alt="">
                            <h3>Payment</h3>
                            <p>Credit card, debit card or bKash</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="payment-issue-part border-right-payment">
                            <img src="{{ asset('img/truck.png') }}" alt="">
                            <h3>SHIPPING & DELIVERY</h3>
                            <p>Complimentary Local Delivery </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="payment-issue-part">
                            <img src="{{ asset('img/exchange.png') }}" alt="">
                            <h3>RETURNS & EXCHANGES</h3>
                            <p>Complimentary</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <aside class="side-navigation side-navigation--left" id="color-plate-box">
            <div class="side-navigation-wrapper">
                <div class="slide-bar-login-area">
                    <h3>COLORS</h3>
                    <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                </div>
                <div class="side-navigation-inner">
                    <div class="product-item-plate-container" id="color_side_bar_show">
                        @foreach($colors as $color)
                            <div data-id="{{ $color->id }}"
                                 class="product-plate-single-item color-plate-single-checked product-plate-single-item-select-{{ $color->id }}">
                                <div class="product-other-thumbs-img">
                                    <img src="{{ asset(colorImages($product->id,$color->id)[0]->thumbs?? '') }}" alt="">
                                </div>
                                <div class="product-plate-content">
                                    <h3>{{ $color->name }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>
        <aside class="side-navigation side-navigation--left" id="size-plate-box">
            <div class="side-navigation-wrapper">
                <div class="slide-bar-login-area">
                    <h3>SIZES</h3>
                    <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                </div>
                <div class="side-navigation-inner">
                    <div class="product-item-plate-container">
                        <ul class="size-plate-list">
                            @foreach($sizes->where('type',1) as $size)
                                <li data-id="{{ $size->id }}" data-name="{{ $size->name }}"
                                    class="size-plate-single-item size-plate-single-checked">{{ $size->name }} <span
                                        class="size-checked-icon size-plate-icon-{{ $size->id }}"><i
                                            class="fa fa-check"></i></span></li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </aside>
        <aside class="side-navigation side-navigation--left" id="type-plate-box">
            <div class="side-navigation-wrapper">
                <div class="slide-bar-login-area">
                    <h3>TYPES</h3>
                    <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                </div>
                <div class="side-navigation-inner">
                    <div class="product-item-plate-container">
                        <ul class="size-plate-list" id="type_side_bar_show">
                            @foreach($types as $type)
                                <li data-id="{{ $type->id }}" data-name="{{ $type->name }}"
                                    class="type-plate-single-item type-plate-single-checked">{{ $type->name }} <span
                                        class="type-checked-icon type-plate-icon-{{ $type->id }}"></span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="modal fade fadeInLeft" id="modal-cart-notification"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog cart-modal-dialog">
                <div class="modal-content">
                    <div class="modal-header cart-modal-header">
                        <div class="row card-title-header">
                            <div class="col-6">
                                <p class="cart-main-title pull-left">Add to Cart</p>
                            </div>
                            <div class="col-6">
                                <button type="button" class="close-modal-btn pull-right" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="pro-details">
                            <div class="product-info">
                                <img class="pro-main-image" id="modal-product-img" src="#" alt="">
                            </div>
                            <div class="product-info">
                                <p class="pro-title-name" id="name">{{ $product->name }}</p>
                                <p class="" id="color_name_modal"></p>
                                <p class="" id="size_name_modal"></p>
                                <p class="pro-title-price" id="price_modal"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('home') }}" class="btn w-100 btn-secondary cart-modal-btn"
                                   style="font-size:10px;">Continue Shopping</a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('cart') }}" class="btn w-100 btn-secondary cart-modal-btn"
                                   style="font-size:10px;">View my Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script src="{{ asset('themes/frontend/owlcarousel/owl.carousel.js') }}"></script>

    <script>
        function closeProductZoom()
        {
            $("body,html").css("overflow", 'auto');
            $("#product-zoom-area").html(" ");
        }
        function getPicture(productId,colorId,typeId){
            $("#product-zoom-area").html(" ");
            $.ajax({
                type: 'GET',
                url: "{{ route('cart_product_image_zoom') }}",
                dataType:'json',
                data: {productId: productId,colorId:colorId,typeId:typeId},
                success:function(data){
                    $("body,html").css("overflow", 'hidden');
                    $("#product-zoom-area").html(data);
                }
            })
        } // End Product View with Modal

        function getSliderZoom(imageId,productId,colorId,typeId){
            $("#product-zoom-area").html(" ");
            $.ajax({
                type: 'GET',
                url: "{{ route('slider_product_image_zoom') }}",
                dataType:'json',
                data: {imageId:imageId,productId: productId,colorId:colorId,typeId:typeId},
                success:function(data){
                    $("body,html").css("overflow", 'hidden');
                    $("#product-zoom-area").html(data);
                }
            })
        }

        function myVideoControl($number) {
            var video = $("#video_" + $number).get(0);

            if (video.paused) {
                video.play();
                $("#playBtn-" + $number).html('<i class="fa fa-pause"></i>');
            } else {
                video.pause();
                $("#playBtn-" + $number).html('<i class="fa fa-play"></i>');
            }


        }

        $(document).ready(function () {
            $('#sticky-product-bar').hide();
            $(window).scroll(function () {
                if(window.innerWidth >= 650){
                    if ($(document).scrollTop() > 360) {
                        $('#sticky-product-bar').fadeIn('slow');
                    } else {
                        $('#sticky-product-bar').fadeOut('slow');
                    }
                }else{
                    if ($(document).scrollTop() > 760) {
                        $('#sticky-product-bar').fadeIn('slow');
                    } else {
                        $('#sticky-product-bar').fadeOut('slow');
                    }
                }

            });
        });
        $('body').on('click', '#color-plate', function (e) {

            e.preventDefault();
            e.stopPropagation();

            var selectedColor = $("#selected-color").val();
            $(".product-plate-single-item-select-" + selectedColor).addClass('single-plate-active');

            var target = $(this).attr('href');
            // var prevTarget = $('.toolbar-btn').attr('href');
            var prevTarget = $(this).parent().siblings().children('#color-plate').attr('href');
            $(target).addClass('open');
            $(prevTarget).removeClass('open');
            if (!$(this).is('.search-btn')) {
                $('.ai-global-overlay').addClass('overlay-open');
            }
            $('.main-navigation').removeClass('open-mobile-menu');
            $('.dl-menu').removeClass('dl-menuopen');
            $('.menu-btn').removeClass('open');
        });

        $('body').on('click', '#size-plate', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var selectedSize = $("#selected-size").val();

            $(".size-plate-icon-" + selectedSize).addClass('size-checked-icon-active');

            var target = $(this).attr('href');
            // var prevTarget = $('.toolbar-btn').attr('href');
            var prevTarget = $(this).parent().siblings().children('#sizer-plate').attr('href');
            $(target).addClass('open');
            $(prevTarget).removeClass('open');
            if (!$(this).is('.search-btn')) {
                $('.ai-global-overlay').addClass('overlay-open');
            }
            $('.main-navigation').removeClass('open-mobile-menu');
            $('.dl-menu').removeClass('dl-menuopen');
            $('.menu-btn').removeClass('open');
        });
        $('body').on('click', '#type-plate', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var selectedType = $("#selected-type").val();

            $(".type-plate-icon-" + selectedType).addClass('type-checked-icon-active');
            $('.type-checked-icon-active').html('<i class="fa fa-check"></i>');

            var target = $(this).attr('href');
            // var prevTarget = $('.toolbar-btn').attr('href');
            var prevTarget = $(this).parent().siblings().children('#type-plate').attr('href');
            $(target).addClass('open');
            $(prevTarget).removeClass('open');
            if (!$(this).is('.search-btn')) {
                $('.ai-global-overlay').addClass('overlay-open');
            }
            $('.main-navigation').removeClass('open-mobile-menu');
            $('.dl-menu').removeClass('dl-menuopen');
            $('.menu-btn').removeClass('open');
        });

        $('body').on('click', '.color-plate-single-checked', function () {
            var colorCheckedId = $(this).data('id');
            $("#selected-color").val(colorCheckedId);
            var selectSizeId = $("#selected-size").val();
            var selectTypeId = $("#selected-type").val();
            $('.product-plate-single-item').removeClass('single-plate-active');
            $(".product-plate-single-item-select-" + colorCheckedId).addClass('single-plate-active');

            $('.btn-close').parents('.open').removeClass('open');

            if (colorCheckedId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_product_details_ajax') }}",
                    data: {
                        productId: '{{ $product->id }}',
                        colorId: colorCheckedId,
                        selectTypeId: selectTypeId,
                        selectSizeId: selectSizeId,
                        isColor: 1,
                        isType: 0
                    }
                }).done(function (data) {
                    $("#product-ajax-container").html(data.product_section_1);
                    $("#ajax_product_details_carousel").html(data.product_section_2);
                    $("#ajax_product_color_details").html(data.product_section_3);
                    $("#sticky-product-bar").html(data.product_section_4);
                    $("#color_side_bar_show").html(data.product_section_5);
                    $("#type_side_bar_show").html(data.product_section_6);
                    $("#get-look-and-include-products-area").html(data.product_section_7);
                });
            }
        })
        $('body').on('click', '.type-plate-single-checked', function () {
            var typeCheckedId = $(this).data('id');
            var colorCheckedId = $("#selected-color").val();
            var selectSizeId = $("#selected-size").val();

            var typeCheckedName = $(this).data('name');
            $("#selected-type").val(typeCheckedId);
            $(".type-name").html(typeCheckedName);

            $('.type-checked-icon').removeClass('type-checked-icon-active');
            $('.type-checked-icon').html(' ');

            $(".type-plate-icon-" + typeCheckedId).addClass('type-checked-icon-active');
            $('.type-checked-icon-active').html('<i class="fa fa-check"></i>');
            $('.btn-close').parents('.open').removeClass('open');

            if (typeCheckedId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_product_details_ajax') }}",
                    data: {
                        productId: '{{ $product->id }}',
                        colorId: colorCheckedId,
                        selectTypeId: typeCheckedId,
                        selectSizeId: selectSizeId,
                        isColor: 0,
                        isType: 1
                    }
                }).done(function (data) {
                    $("#product-ajax-container").html(data.product_section_1);
                    $("#ajax_product_details_carousel").html(data.product_section_2);
                    $("#ajax_product_color_details").html(data.product_section_3);
                    $("#sticky-product-bar").html(data.product_section_4);
                    $("#color_side_bar_show").html(data.product_section_5);
                    $("#type_side_bar_show").html(data.product_section_6);
                    $("#get-look-and-include-products-area").html(data.product_section_7);
                });
            }

        })

        $('body').on('click', '.size-plate-single-checked', function () {
            var sizeCheckedId = $(this).data('id');
            var sizeCheckedName = $(this).data('name');
            $("#selected-size").val(sizeCheckedId);
            $(".size-name-show").html(sizeCheckedName);


            $('.size-checked-icon').removeClass('size-checked-icon-active');
            $(".size-plate-icon-" + sizeCheckedId).addClass('size-checked-icon-active');

            $('.btn-close').parents('.open').removeClass('open');

        })

        $('body').on('click', '#btn-add-to-cart,#add-to-cart-sticky', function () {

            var colorId = null;
            var sizeId = null;
            var typeId = null;
            var productId = '{{ $product->id }}';
            var qty = $("#qty").val();

            colorId = $('#selected-color').val();
            typeId = $('#selected-type').val();
            sizeId = $('#selected-size').val();

            $.ajax({
                method: "POST",
                url: "{{ route('add_to_cart_with_attribute') }}",
                data: {productId: productId, qty: qty, colorId: colorId, typeId: typeId, sizeId: sizeId}
            }).done(function (response) {
                if (response.status == 1) {
                    $('#sideNavigation').html(response.cartHtml);
                    $('#cart-count').html(response.cartCount);
                    $('#price_modal').html(response.unit_price);
                    $('#color_name_modal').html('Color: ' + response.color_name);
                    $('#modal-product-img').attr('src', response.product_image);
                    if (response.size_name != '') {
                        $('#size_name_modal').html('Size: ' + response.size_name);
                    }

                    $("#modal-cart-notification").modal('show');
                    $("body,html").css('overflow','hidden')
                    setTimeout(function () {
                        $("#modal-cart-notification").modal('hide');
                        $("body,html").css('overflow','auto')
                    }, 500000)
                }
            });
        });

        $(".fa-close,.modal").click(function (){
            $("body,html").css('overflow','auto')
        })


        $('.product-image-owl').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
        })
        $('.product_detail_carousel').owlCarousel({
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            items: 1,
            margin: 0,
            stagePadding: 0,
            smartSpeed: 450
        });
        $('.customer_likes_products_carousel').owlCarousel({
            loop: false,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            items: 3,
            margin: 30,
            stagePadding: 0,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>
@endsection
