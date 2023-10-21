@extends('layouts.app',
[
   'category_dir'=>$product->category->name,
   'sub_category_dir'=>$product->subCategory->name,
   'view_by_sub_sub_category_dir'=>$product->subSubCategory,
    'product_dir'=>$product->name,
]
 )
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
            margin-top: 0px;
        }

        h4.product-title-look {
            margin-top: 15px;
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
            margin-left: 0px;
            margin-top: 20px;
            padding-bottom: 1px;
            padding-left: 7px;
        }

        .product-first-imag {
            height: 100%;
        }

        .product-details-area {
            margin-top: 40px;
        }

        .product-other-thumbs-img img {
            height: 170px;
            width: 170px;
            background-color: #f6f5f3;
        }

        @media screen and (max-width: 400px) {
            .product-description {
                margin-right: 15px;
            }

            .product-description {
                padding-left: 0px;
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
                margin-top: 23px;
            }

            .product-description {
                padding-left: 0px;
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
                margin-top: 23px;
            }

            .product-description {
                padding-left: 0px;
                padding-bottom: 23px;
            }

            .col-md-8.product-detail-img-mobile {
                display: none;
            }
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
                margin-top: 23px;
            }

            .product-description {
                padding-left: 0px;
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
                margin-top: 23px;
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

        .owl-dot span {
            font-size: 70px;
            position: relative;
            top: -5px;
        }

        @media screen and (min-width: 401px) and (max-width: 460px) {
            .product-description {
                padding-left: 0px;
                padding-bottom: 20px;
            }
        }
        @media screen and (min-width: 320px) and (max-width: 500px) {
            .product-other-thumbs-img img {
                height: 168px;
                width: 168px;

            }
        }
        .wishlist-second-area.wishlist-btn {
            position: absolute;
            padding-left: 145px;
            padding-top: 18px;
        }
        .row.thumbs-bg-hover {
            border: 4px solid transparent;
        }
        .row.thumbs-bg-hover:hover {
            border: 4px solid #EAE8E4;
            transition: all 0.5s ease;
        }
        .product-other-thumbs-img {
            margin-bottom: 0;
        }
        .row.thumbs-bg-hover {
            margin-bottom: 15px;
        }
        i.fa.fa-heart-o {
            cursor: pointer;
        }
        h1.product-title-d {
            font-weight: 600;
        }

        .product-image-area {
            position: relative;
        }
        .back-button{
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
        .product-first-imag img {
            background: #f4f4f4 !important;
        }
        .product-image-area {
            height: 107vh;
        }
        .product-first-imag img {
            height: 540px;
        }
        .product-details-area {
            height: 100vh !important;
            overflow: auto;
            scrollbar-color: #d5ac68 #f1db9d !important;
            scrollbar-width: thin !important;
            -ms-overflow-style: none !important;;
        }
        .product-details-area::-webkit-scrollbar {
            height: 5px;
        }

        .product-details-area::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0);
        }

        .product-details-area::-webkit-scrollbar-thumb {
            height: 5px;
            background-color: #d5ac68;
        }

        .product-details-area::-webkit-scrollbar-thumb:hover {
            background-color: #f1db9d;
        }

        .product-details-area::-webkit-scrollbar:vertical {
            display: none;
        }

        /* For Packging */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .img2 {
            float: left;
            background: #FFFFFF;
            margin-right: 15px;
            width:70px;
        }
        .contentSer .long-text{
            color: #949494;
            padding-right: 8px;
            font-size: 11px;
        }
        .contentSer .head-textss{
            font-size: 13px;
            font-weight: 500;
            color: #000;
        }

        /* Modal Start */
        .modal-body{
            padding: 0px;
        }
        .modal-header{
            align-items: center;
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
        .border-top-payment {
            border-top: 1px solid #e1dfd8;
        }
        .modal-content-data {
            padding: 20px 30px 30px 30px;
        }
    </style>
    <style>
        video{
            object-fit: cover;
            height: 618px;
            margin-bottom: -8px;
        }

        section.home-video-section {height: 100vh !important;}

        .video-area {height: 100%;}

        section.home-video-section {position: relative;}

        .video-content-area {position: absolute;left: 0;bottom: 41px;width: 100%;}

        h1.video-title {
            color: #fff;
            font-weight: bold;
            font-size: 3.375rem;
            line-height: 2.375rem;
            text-transform: uppercase;
            margin-bottom: 25px;
            font-family: 'Source Sans Pro', sans-serif;
        }

        a.video-link {background: #fff;text-align: center;color: #000;padding: 12px 50px;font-size: 14px;}

        a.video-link:hover {background: #ddd;}
        button.btn-video-play {color: #fff;background: #000;border-radius: 50%;width: 40px;height: 40px;border: 1px solid #fff;font-size: 9px;}
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
        img.landing-image {
            width: 100%;
            height: 100%;
        }
        section.service-area {
            padding: 70px 0;
        }
        h1.service-title {
            font-weight: 500;
            font-size: 30px;
            margin-bottom: 25px;
        }

        h1.service-link-1 {
            font-size: 15px;
            color: #000;
            font-weight: bold;
            margin-bottom: 3px;
            margin-top: 15px;
        }

        h3.service-link-2 {
            font-size: 15px;
            text-decoration: underline;
            font-weight: 500;
        }
        .service-img img {
            height: 665px;
        }
        @media (min-width: 320px) and (max-width: 400px) {
            /* For Mobile */
            video{
                object-fit: cover;
                height: 100%;
                margin-bottom: -8px;
            }
        }
        @media (max-width: 61.94em){
            .product-details-area {
                /*height: auto !important;*/
                margin-top: 104px;
            }
        }
        .header {
            min-height: 109px;
        }
        video {
            object-fit: contain;
            margin-bottom: -8px;
        }
        /*video {*/
        /*    object-fit: contain;*/
        /*    height: 106vh;*/
        /*    margin-bottom: -8px;*/
        /*}*/
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
            video{
                height: 1046px;
            }
        }
        .wishlist-area {
            top: 0;
        }
    </style>
@endsection
@section('content')

 <div class="card6">
    <div class="shop-page-wrapper">
        <div class="body-height-full">
             <div class="container-fluid" style="padding: 0!important;">
            <div class="col-md-8 product-detail d-md-none d-xl-none d-sm-block">
                <div class="product-image-area">
                    <div class="product-first-imag" style="padding-top: 90px;">
                        <div class="product-image-area">

                            <div class="product-first-imag">

                                @php
                                    $counter = 2;
                                @endphp

                                <?php
                                $ext     = explode('.', $product->video_url); // Explode the string
                                $fileExtension  = end($ext);
                                ?>
                                <section class="video-section">
                                    <div class="video-area">
                                        @if($product->video_url)
                                            <a href="{{ url()->previous() }}" class="back-button"><i class="fa fa-angle-left"></i></a>
                                            <div class="product-first-imag">

                                                <video playsinline webkit-playsinline autoplay muted id="video-{{ $counter }}" width="100%"
                                                       height="300px" src="{{ asset($product->video_url) }}" loop="loop" tabindex="-1" aria-hidden="true" >
                                                </video>

                                                <script>
                                                    document.getElementById('video-2').play();
                                                </script>
                                            </div>
                                        @else
                                            <a href="{{ url()->previous() }}" class="back-button"><i class="fa fa-angle-left"></i></a>
                                            <div class="product-first-imag">
                                                <img src="{{ asset($product->view_thumb) }}" alt="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="video-content-area">
                                        <div class="container">
                                            <div class="row justify-content-between">
                                                <div class="col-4 col-md-4" style="text-align: left">
                                                    <div class="video-control-area">
                                                        <button style="{{ $fileExtension == 'mp4' ? 'display:inline-block' : 'display:none' }}" class="btn-video-play" id="playBtn-2" onclick="myFunction(2)"><i class="fa fa-pause"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                @php
                                    $counter++;
                                @endphp

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="product-ajax-container">
                <div class="col-md-8 col-12 product-detail-img-mobile">
                    <div class="product-image-area">

                        <div class="product-first-imag">

                        @php
                            $counter = 2;
                        @endphp

                        <?php
                        $ext     = explode('.', $product->video_url); // Explode the string
                        $fileExtension  = end($ext);
                        ?>
                        <section class="video-section">
                            <div class="video-area">
                                @if($product->video_url)
                                    <a href="{{ url()->previous() }}" class="back-button"><i class="fa fa-angle-left"></i></a>
                                    <div class="product-first-imag">
                                        <video playsinline webkit-playsinline autoplay muted loop id="video-{{ $counter }}" width="100%" height="300px">
                                            <source src="{{ asset($product->video_url) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @else
                                    <a href="{{ url()->previous() }}" class="back-button"><i class="fa fa-angle-left"></i></a>
                                    <div class="product-first-imag">
                                        <img src="{{ asset($product->view_thumb) }}" alt="">
                                    </div>
                                @endif
                            </div>
                            <div class="video-content-area">
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-4 col-md-4" style="text-align: left">
                                            <div class="video-control-area">
                                                <button style="{{ $fileExtension == 'mp4' ? 'display:inline-block' : 'display:none' }}" class="btn-video-play" id="playBtn-2" onclick="myFunction(2)"><i class="fa fa-pause"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @php
                            $counter++;
                        @endphp

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-details-area">
                        <div id="btn-add-to-cart" class="wishlist-area wishlist-btn d-none d-sm-block d-md-block"
                             data-id="{{ $product->id }}" data-color="0" data-type="0" data-size="0">
{{--                            <i class="fa fa-heart{{ wishlistCheck($product->id,0,0,0) ? '' : '-o' }}"></i>--}}
                        </div>
                        <h3 class="product-title-look">View By Look</h3>
                        <strong><h1 class="product-title-d">{{ $product->name }}</h1></strong>
                        <div class="product-description">
                            {!! $product->features !!}
                        </div>

                            <span id="dots6"></span>
                            <span id="more6">
                        <div class="other-images">
                            @if(json_decode($product->include_products))
                            @foreach(json_decode($product->include_products) as $key => $itemProduct)
                                <?php
                                    $colorTypeProduct = getIncludeProducts($itemProduct);
                                ?>
                            <div class="row thumbs-bg-hover">
                                    <div class="col-6 col-md-6 p-0">
                                        <div class="product-other-thumbs-img">
                                            <img src="{{ asset(colorTypeImages($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id)[0]->thumbs ?? '') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 p-0">
                                        <div class="wishlist-second-area wishlist-btn" data-id="{{ $colorTypeProduct->product_id }}" data-color="{{ $colorTypeProduct->color_id }}" data-type="{{ $colorTypeProduct->type_id }}" data-size="{{ $colorTypeProduct->size_id }}">
                                            <i class="fa fa-heart{{ wishlistCheck($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id,$colorTypeProduct->size_id) ? '' : '-o' }}"></i>

                                        </div>
                                        <div class="text-area" style="padding-top: 50px">
                                            <h2 style="font-size: 19px">{{$colorTypeProduct->product->name ?? '' }}{{ $colorTypeProduct->type->id != 1 ? (' - '.$colorTypeProduct->type->name) : '' }}</h2>
                                            <p>{{ getPriceCurrency($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id,$colorTypeProduct->size_id) }}</p>
                                            <a href="{{ route('page.product_details',['slug'=>$colorTypeProduct->product->slug]) }}?color_id={{ $colorTypeProduct->color_id }}&type_id={{ $colorTypeProduct->type_id }}&size_id={{ $colorTypeProduct->size_id }}"><u>Details</u></a>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                            @endif
                        </div>

                        <div class="payment-section-view-by-look">
                            <div class="row">
                                <div class="col-12">
                                    <div class="related-product border-bottom-payment border-top-payment" style="padding-bottom: 15px; padding-top: 15px;">
                                        <div class="card" style="border: 2px solid #FFFFFF;">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <div class="card-body">
                                                    <div class="clearfix">
                                                        <img class="img2" src="{{ asset('img/bag_picture_for_thumb.jpeg') }}" style="width:70px; background: #fff;" alt="Image">
                                                        <div class="contentSer">
                                                            <p class="head-textss">Packaging <br><span class="long-text">Complimentary BD Tote bags with all orders</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="padding-top: 35px;">
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
                            </div>
                        </div>
                        </span>
                        <p><button onclick="myFunction6(event)" id="button6">Show more</button></p>
                        <!-- Modal -->
                        <div class="modal fade fadeInLeft" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header cart-modal-header">
                                        <div class="row card-title-header">
                                            <div class="col-6">
                                                <p class="cart-main-title pull-left">packaging</p>
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
                    </div>
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
        function myFunction6(event) {
            var card = event.target.closest(".card6");
            var dots = card.querySelector("#dots6");
            var moreText = card.querySelector("#more6");
            var btnText = card.querySelector("#button6");
            //   var btnText1 = document.getElementById("button6");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Show more";
                // btnText1.innerHTML = "Show more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Show less";
                // btnText1.innerHTML = "Show less";
                moreText.style.display = "inline";
            }
        }
    </script>
    <script>
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

        $('body').on('click', '.color-plate-single-checked', function () {
            var colorCheckedId = $(this).data('id');
            $("#selected-color").val(colorCheckedId);
            var selectSizeId = $("#selected-size").val();
            $('.product-plate-single-item').removeClass('single-plate-active');
            $(".product-plate-single-item-select-" + colorCheckedId).addClass('single-plate-active');

            $('.btn-close').parents('.open').removeClass('open');

            if (colorCheckedId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_product_details_ajax') }}",
                    data: {productId: '{{ $product->id }}', colorId: colorCheckedId, selectSizeId: selectSizeId}
                }).done(function (data) {
                    $("#product-ajax-container").html(data);
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



        function sliderActive(className, product, color) {

            $('.' + className).closest('.color-plate-img_' + product).find('li').removeClass('color-palate-active')

            //$('.lds_ring_'+product).css('display','block');

            $('.color_single_plate_' + product + '_' + color).addClass('color-palate-active');

            //$('.lds_ring_'+product).css('display','none');

            $('.color-image-slider_' + product + '_' + color).closest('.single-product-area').find('.product-image-owl').removeClass('color-slide-active')
            $('.color-image-slider_' + product + '_' + color).addClass('color-slide-active');

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        let options = {
            root: null,
            rootMargin: '0px',
            threshold: 1.0,
        };
        let callback = (entries,observer) =>{
            entries.forEach(entry =>{
                if(entry.target.id == 'video-2'){
                    //alert('hello');
                    if(entry.isIntersecting){
                        // entry.target.play();
                    }else{
                        // entry.target.pause();
                    }
                }
            });
        }
        let observer = new IntersectionObserver(callback,options)
        observer.observe(document.querySelector('#video-2'));
    </script>
    <script>
        function myFunction($number) {
            var video = $("#video-"+$number).get(0);

            if (video.paused) {
                video.play();
                $("#playBtn-"+$number).html('<i class="fa fa-pause"></i>');
            } else {
                video.pause();
                $("#playBtn-"+$number).html('<i class="fa fa-play"></i>');
            }


        }
        function toggleMute($number){
            if( $("#video-"+$number).prop('muted') ) {
                $("#video-"+$number).prop('muted', false);
                $("#sound-btn-"+$number).html('<i class="fa fa-volume-up"></i>');
            } else {
                $("#video-"+$number).prop('muted', true);
                $("#sound-btn-"+$number).html('<i class="fa fa-volume-off"></i>');
            }

        }
    </script>
@endsection
