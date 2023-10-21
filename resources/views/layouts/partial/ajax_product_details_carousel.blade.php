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
            height:460px;
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
            height:489px;
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
            height:520px;
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
            height:550px;
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
            height:580px;
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

    @media (max-width: 61.94em){
        a.back-button {
            top: 100px !important;
            left: 17px !important;
        }
        .sticky-product-name h2 {
            font-size: 14px !important;
        }
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
        .col-sm-12.col-12.product-image-owl.owl-carousel{
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
    .product-details-area{
        margin: 200px 0;
    }
    @media screen and (max-width: 767px){
        .border-right-payment {
            border-bottom: 1px solid #e1dfd8;
            border-right: none;
        }
        .product-details-area{
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
    a.item.wishlist-item,a.item.customer-likes-wishlist-item img {
        background: rgb(246, 245, 243);
    }
    h1.product-title-d.customer-likes-p-title {
        margin-bottom: 18px;
        font-weight: 600;
    }
    h1.product-title-d.customer-likes-p-title {
        margin-bottom: 18px;
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
    .cart-modal-header{
        display: block;
        padding: 3px;
        margin-right: 13px;
    }
    .card-title-header{
        /* border-bottom: 1px solid #000; */
    }
    .cart-main-title{
        padding-left: 8px;
        color: #000;
        font-weight: bold;
    }
    .pro-details:after{
        content: "";
        display: table;
        clear: both;
        padding-bottom: 20px;
    }
    .product-info{
        float: left;
        padding-right: 10px;
        font-size: 12px;
    }
    .product-info p{
        padding: 0px;
        margin: 0px;
    }
    .product-info .pro-title-name{
        color: #000;
        font-weight: bold;
    }
    .product-info .pro-title-price{
        color: #000;
    }
    .product-info .pro-main-image{
        width: 105px;
        background: #F5F4F2;
    }
    .modal-body{
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
    .sticky-product-header{
        box-shadow: 0 4px 8px 0 rgb(0 0 0 / 4%), 0 12px 20px 0 rgb(0 0 0 / 8%);
    }
    .sticky-product-header{
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
    .bd-product-purchase-bar__actions{
        display: flex;
        align-items: center;
    }
    .stick-product-img{
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

    .btn-cart-sticky{
        background-color: #19110b;
    }
    .btn-cart-sticky{
        color: #fff;
        line-height: 1;
    }
    .btn-cart-sticky{
        padding: 1rem 1.5rem;
        transition: border .3s cubic-bezier(.39,.575,.565,1),box-shadow .3s cubic-bezier(.39,.575,.565,1),color .3s cubic-bezier(.39,.575,.565,1),background .3s cubic-bezier(.39,.575,.565,1),box-shadow .3s cubic-bezier(.39,.575,.565,1);
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
<?php
$isVideo = colorTypeVideo($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id);

if ($isVideo)
    $colorTypeImages = colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id);
else
    $colorTypeImages = colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)->skip(1);

?>
<div class="col-12 col-md-4 offset-md-4">
    <div class="product-detail-slider-area">
        <div class="product_detail_carousel owl-carousel owl-theme">
            @foreach($colorTypeImages as $img)
                <a class="item wishlist-item">
                    <img src="{{ asset($img->thumbs ?? '') }}" alt=""
                         onClick="getSliderZoom('{{ $img->id }}','{{ $img->product_id }}','{{ $img->color_id }}','{{ $img->type_id }}')">
                </a>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('themes/frontend/owlcarousel/owl.carousel.js') }}"></script>
<script>
    $('.product_detail_carousel').owlCarousel({
        loop:true,
        nav: true,
        navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        items:1,
        margin:0,
        stagePadding:0,
        smartSpeed:450
    });
</script>
