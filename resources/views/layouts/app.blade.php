<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="BD Clothing">
    <meta property="og:type" content="Clothing" />
    <meta property="og:description" content="Bangladesh Clothing Co referred to as Bangladesh Drip or shortened to BD, is a bengali luxury brand.">
    <meta property="og:image" content="{{ asset('img/test3.png') }}">
    <meta property="og:url" content="https://www.bdclothing.com/">
    <meta property=”og:image:width” content=”1200″/>
    <meta property=”og:image:height” content=”630″/>
    <meta property="fb:app_id" content="290716742088995" />
    <meta name="twitter:card" content="summary_large_image">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/apple-touch-icon2.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/apple-touch-icon2.png') }}">

    <!-- Favicons old -->
    <!--<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">-->
    <!--<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">-->
    <!--<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">-->
    <!--<link rel="shortcut icon" href="{{ asset('favicon/favicon (1).ico') }}">-->
    <!-- Title -->
    <title>  {{ __('common_text.title') }}</title>




    <!-- ************************* CSS Files ************************* -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/bootstrap.css') }}">
    <!-- toastr css -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/plugins/toastr/toastr.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/font-awesome.min.css') }}">

    <!-- dl Icon CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/dl-icon.css') }}">

    <!-- All Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/plugins.css') }}">

    <!-- Revoulation Slider CSS  -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/revoulation.css') }}">

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/custom2.css') }}">

    <!-- modernizr JS
    ============================================ -->
    <script src="{{ asset('themes/frontend/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .side-navigation--left .side-navigation-wrapper {
            left: auto;
            right: 0;
            -webkit-transform: translate(200px, 0);
            -moz-transform: translate(200px, 0);
            -ms-transform: translate(200px, 0);
            -o-transform: translate(200px, 0);
            transform: translate(200px, 0);
        }

        /*.body-add-class{*/
        /*    overflow-x: hidden;*/
        /*    overflow-y: hidden;*/
        /*}*/

        .slide-bar-login-area {border: 1px solid #ddd;padding: 24px 9px;}

        .slide-bar-login-area h3 {font-size: 18px;font-weight: bold;}
        .side-navigation-wrapper {
            width: 512px;
        }
        .mini-cart .btn-close, .side-navigation .btn-close {
            top: 1rem;
        }
        button.btn.btn-color-black.btn-lg.btn-login-side {
            color: #fff;
        }
        input.form-control.login-input {
            height: 50px;border: 1px solid #eae8e4;

        }

        .side-navigation-inner {padding: 0px 25px;}

        .slide-bar-login-form h2,.register-slide-area h2{font-weight: 500;}
       .btn-login-side {
            background: #19110b;
            color: #fff;
            border: 1px solid #19110b;
            padding: 10px 0;
            font-weight: bold;
           text-align: center;
        }
        input.form-control.login-input.login-input-password {
            margin-bottom: 0;
        }
        .slide-bar-login-form {border-bottom: 1px solid #ddd;padding-bottom: 67px;}

        .register-slide-area {
            margin-top: 66px;
            margin-bottom: 66px;
        }
        .side-navigation-inner {
            max-height: 100%;
        }
        .side-navigation-inner {
            margin-top: 0;
        }
        .slide-bar-login-form h2{
            margin-top: 27px;
        }
        a.btn-login-side:hover {
            color: #ffffff;
        }
        .header-inner {
            padding-top: 1.1rem;
            padding-bottom: 1.1rem;

        }
        .header-inner:hover {
            -webkit-transition: all 0.3s ease-in;
            -moz-transition: all 0.3s ease-in;
            -ms-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            background: #fff;
        }

        .header-inner:hover .main-navigation .mainmenu__item > a {
            color: #282828;
        }
        .header-inner:hover .header-toolbar__item > a {
            color: #282828;
        }

        .header-inner:hover .logo--normal {
            height: auto !important;
        }
        .header-inner:hover .logo--transparency {
            display: none;
        }
        .slide-bar-login-area h3 {
            margin-left: 16px;
        }
        .fixed-header-custom {
            background-color: #fff;
            visibility: visible;
            transform: translate(0, 0);
            -webkit-transform: translate(0, 0);
            transition: transform 0.5s, background .25s, visibility 0.25s, opacity 0.25s;
        }
        .fixed-header-custom {
            position: fixed;
            top: 0;
            transform: translate(0, -100%);
            -webkit-transform: translate(0, -100%);
            will-change: transform, background;
        }
        .main-navigation .mainmenu__item.menu-item-has-children > ul.megamenu {
            white-space: -moz-nowrap;
            padding: 0;
            width: 100%;
            margin-top: 0;
            top: 55px;
        }

        .header-inner.fixed-header{
            background: #fff;
            box-shadow: inset 0 -1px 0 0 #eae8e4;
        }
        .header {
            min-height: 116px;
        }

        @media screen and (max-width: 400px) {
            h1.video-title {
                font-size: 22px;
                text-align: center;
            }
            .video-link-area {
                text-align: center;
            }
            select#locale {
                margin-left: 7px;
            }
            .language-area i {
                font-size: 22px;
            }
            ul.filter-list {
                display: inline-flex;
                height: 72px;
            }
            ul.filter-list li:first-child {
                font-size: 12px;
            }
            .slide-bar-login-area h3 {
                font-size: 14px;
            }
            .slide-bar-login-area a.btn-close {
                font-size: 17px;
            }
            .side-navigation-wrapper {
                width: 340px;
            }
            .product-other-thumbs-color {
                height: 55px;
            }
        }
        @media screen and (max-width: 320px) and (max-width: 450px) {
            .user-nav {
                margin-top: 57px;
            }
            .user-nav ul li a {
                padding: 0px;
                font-size: 12px;
            }
            .language-area select {
                width: auto;
                padding: 5px 6px;
                display: inline-block;
                margin-left: 10px;
                border: navajowhite;
            }
        }
        @media screen and (max-width: 350px) and (max-width: 450px) {
            .user-nav {
                margin-top: 57px;
            }
            .user-nav ul li a {
                padding: 0px;
                font-size: 11px;
            }
        }
        @media screen and (max-width: 700px) {
            .user-nav {
                margin-top: 55px;
            }
            .user-nav ul li a {
                padding: 0px;
                font-size: 14px;
            }
        }
        @media screen and (max-width: 1000px) {
            .user-nav {
                margin-top: 55px;
            }
            .user-nav ul li a {
                padding: 0px;
                font-size: 15px;
            }
        }

        i.fa.fa-window-close {
            font-size: 22px;
            /* position: absolute;
            padding-left: 1276px; */
            padding-top: 2px;
        }

        .follow-us-area {
            padding-bottom: 10px;
        }
        @media screen and (max-width: 768px){
            .footer-logo{
                text-align: center;
            }
            .language-area{
                text-align: center;
            }
            .footer-common-nav{
                text-align: center;
            }
        }
        a.mainmenu__link {
            padding-right: 0 !important;
        }
    </style>
@yield('style')
    <style>
        .header-toolbar__item > a {
            font-size: 14px;
        }
        .header-toolbar {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            -webkit-justify-content: flex-end;
            -moz-justify-content: flex-end;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            -moz-align-items: center;
            align-items: center;
            flex-wrap: nowrap;
            justify-content: space-around;
        }
        .language-area i {
            font-size: 26px;
            display: inline-block;
            line-height: 0;
        }

        .language-area {
            margin-top: 30px;
        }

        .language-area select {
            width: auto;
            padding: 5px 6px;
            display: inline-block;
            margin-top: -4px;
            border: navajowhite;
        }
        .header-toolbar__item > a {
            width: 8rem;
        }
        .mini-cart-btn sup {
            right: 42%;
        }
        html.js.flexbox.canvas.canvastext.webgl.no-touch.geolocation.postmessage.websqldatabase.indexeddb.hashchange.history.draganddrop.websockets.rgba.hsla.multiplebgs.backgroundsize.borderimage.borderradius.boxshadow.textshadow.opacity.cssanimations.csscolumns.cssgradients.cssreflections.csstransforms.csstransforms3d.csstransitions.fontface.generatedcontent.video.audio.localstorage.sessionstorage.webworkers.no-applicationcache.svg.inlinesvg.smil.svgclippaths {
            overflow-x: hidden;
        }
        .language-area select {
            width: auto;
            padding: 5px 6px;
            display: inline-block;
            margin-left: 10px;
            border: navajowhite;
        }
        @media (max-width: 61.94em){
            .header-mobile {
                display: block;
                position: sticky;
                top: -1px;
                z-index: 2;
            }
        }
        .dl-submenu li .by-style{
            padding-left: 30px;
            color: black;
            font-weight: bold;
            padding-top: 40px;
            padding-bottom: 13px;
        }
        .custom-top-right{
            justify-content: end;
        }
    </style>
    <style>
        .body-height-full {
            min-height: calc(100vh - 117px);
        }
        @media (max-width: 61.94em){
            .header-toolbar__item > a {
                color: #000;
            }
            .menu-btn:after{
                color: #000;

            }
            ul.footer-common-nav li a {
                display: inline-block;
                color: #fff;
                font-size: 13px;
                padding: 11px 7px;
            }
            .footer-logo img {
                height: 36px;
            }
            .footer-logo {
                padding-bottom: 16px;
            }
            footer.footer {
                padding: 16px 0;
            }
            a.video-link {
                background: #fff;
                padding: 5px 20px;
                font-size: 10px;
            }
            h1.video-title {
                font-weight: 600;
                font-size: 2rem;
                line-height: 2rem;
                margin-bottom: 14px;
                margin-top: 32px;
            }
            .service-img img {
                height: 400px;
            }
            section.service-area {
                padding: 25px 0;
            }
            .padding-spacing{
                margin-top: 90px;
            }
            .search-heading {
                padding: 9px 0;

            }

            .search-input-area input {

                padding: 0 13px;
                height: auto !important;
            }
            .search-input-area i {
                margin-top: 5px;
                font-size: 13px;
                padding: 0 6px;
                margin-left: 3px;
            }
            .searchform__popup .btn-close {
                top: -11px;
            }
            .search-category-area-open {
                height: auto;

            }
            ul.search-area-category-list {
                text-align: left;
                padding: 0 32px;
            }
            h3.search-area-category-title {

                margin-left: 35px;
            }
            .search-product-head h3.search-area-category-title {
                margin-left: 0;
            }
            .body-height-full {
                height: auto;
            }
        }
        .slide-bar-login-form {

            padding-bottom: 20px;
        }
        .register-slide-area {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .side-navigation-inner {
            padding: 0 25px !important;
        }
    </style>
    <style>

        .footer-dir-name {
            display: inline-block;
            color: #fff;
            font-size: 15px;
            margin-left: 16px;
        }
        .footer-dir-name a{
            transition: all 0.5s ease;
        }
        .footer-dir-name a:hover {
            color: #fff;
            border-bottom: 1px solid white;
        }
        .swal2-popup {
            font-size: 1.6rem !important;
        }
        /* For MyCart navbar style */
        .shopping-quantity{
            font-size: 14px;
            font-weight: normal;
            padding-left: 5px;
        }
        .shopping-footer-price{
            padding-bottom: 20px;
        }
        .shopping-footer-price .shopping-total-price{
            font-size: 20px;
            font-weight: 500;
        }
        .shopping-footer-price .shopping-total-count{
            font-size: 16px;
            color: #433D38;
        }

        .slide-bar-prodect-details{
            padding-top: 40px;
            padding-left: 20px;
            border-bottom: 1px solid #DBDCDD;
            padding-bottom: 20px;
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
    </style>
    <style type="text/css">
        .animated-b {
            overflow: hidden;
            width: 49%;
            white-space: nowrap;
        }
        .animated-d {
            overflow: hidden;
            width: 49%;
            white-space: nowrap;
        }

        .animated-b > * {
            display: inline-block;
            position: relative;
            animation: 2.4s linear 0s infinite alternate move-b;
        }
        .animated-d > * {
            display: inline-block;
            position: relative;
            animation: 2.4s linear 0s infinite alternate move-d;
        }
        .animate-text-bd.animated-d {

        }

        .animate-text-bd.animated-b {

        }
        .animated-b > *.min {
            min-width: 100%;
        }
        .animated-d > *.min {
            min-width: 100%;
        }

        @keyframes move-b {
            0%,
            25% {
                transform: translateX(0%);
                left: 0%;
            }
            75%,
            100% {
                transform: translateX(-103%);
                left: 103%;
            }
        }


        @keyframes move-d {

            0%,
            25% {
                transform: translateX(-100%);
                left: 100%;
            }

            75%,
            100% {
                transform: translateX(-3%);
                left: -3%;
            }
        }

        /* Non-solution styles */



        .animated-b {
            font-size: 2rem;
            font-family: sans-serif;

            margin: 1rem;
        }
        .animated-d {
            font-size: 2rem;
            font-family: sans-serif;

            margin: 1rem;
        }

        .animated-b > * {
            box-sizing: border-box;
            padding: .5rem 1rem;
        }
        .animated-d > * {
            box-sizing: border-box;
            padding: .5rem 1rem;
        }
        .animate-text-bd {
            color: #000;
            font-size: 100px;
            text-shadow: 8px 0px 2px #545151;
        }
        .bd-animation-area {
            width: 100%;
        }

        .animate-text-bd {
            display: inline-block;
            padding: 0;
            margin: 0;
        }
        .bd-animation-area {
            height: 100%;
            margin: 15% auto;
        }
        .bd-preload-wrapper {
            width: 100%;
            height: 100%;
            background: #ddd;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 999;
            overflow: hidden;
        }
        @media (max-width: 61.94em){
            .side-navigation-wrapper {
                width: 396px !important;
            }
            .product-image-area {
                height: auto !important;
            }
            .product-first-imag {
                height: calc(110vh - 245px);
            }
            .product-first-imag img {
                height: 546px;
            }
            .product-details-area {
                height: auto !important;
            }
        }

        .side-navigation-inner{

            scrollbar-color: #d5ac68 #f1db9d !important;
            scrollbar-width: thin !important;;
            -ms-overflow-style: none !important;;
        }
        .side-navigation-inner::-webkit-scrollbar {
            height: 5px;
        }

        .side-navigation-inner::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0);
        }

        .side-navigation-inner::-webkit-scrollbar-thumb {
            height: 5px;
            background-color: #d5ac68;
        }

        .side-navigation-inner::-webkit-scrollbar-thumb:hover {
            background-color: #f1db9d;
        }

        .side-navigation-inner::-webkit-scrollbar:vertical {
            display: none;
        }
        a.mainmenu__link {
            padding: 0 8px !important;
        }
    </style>
</head>
<body>
<div class="bd-preload-wrapper" style="display: none">
    <div class="bd-animation-area" >

        <div class="animate-text-bd animated-b">
            <span>B</span>
        </div>

        <div class="animate-text-bd animated-d">
            <span>D</span>
        </div>
    </div>
</div>
<!-- Main Wrapper Start -->
<div class="wrapper enable-header-transparent">
    <!-- Header Area Start -->
    <header class="header header-fullwidth header-style-1 d-none d-sm-block d-md-block">
        <div class="header-outer">
            <div class="header-inner fixed-header">
                <div class="container-fluid" >
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <ul class="text-start" style="margin-left: 40px;">
                                <li class="header-toolbar__item search-custom-icon">
                                    <a  href="#searchForm" class="search-btn toolbar-btn">
                                        <i class="dl-icon-search1"></i>
                                        {{ __('common_text.search') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8 text-lg-center">
                            <!-- Logo Start Here -->
                            <a href="{{ route('home') }}" class="logo-box">
                                <img height="50px" src="{{ asset('img/logo.png') }}" alt="Logo" />
                            </a>
                            <!-- Logo End Here -->
                        </div>
                        <div class="col-lg-2">
                            <ul class="header-toolbar text-end custom-top-right">
                                <li class="header-toolbar__item">
                                    <a role="button" onclick="jsRedirectUrl('{{ route('wishlist') }}')" class="mini-cart-btn toolbar-btn">
                                        {{ __('common_text.wishlist') }}
                                        <sup  class="mini-cart-count" id="wishlist-count">{{ $layoutData['wishlistCount'] }}</sup>
                                    </a>
                                </li>
                                <li class="header-toolbar__item">
                                    <a  role="button" href="#sideNavigation" class="mini-cart-btn toolbar-btn {{ count($layoutData['cart_items']) > 0 ? '' : 'cart-pointer' }}">
                                        <i  class="dl-icon-cart4"></i>
                                        <sup id="cart-count" class="mini-cart-count">{{ $layoutData['cartTotalQuantity'] }}</sup>
                                    </a>
                                </li>
                                @if (Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER)
                                    <li class="header-toolbar__item d-sm-none d-lg-block">
                                        <a role="button" onclick="jsRedirectUrl('{{ route('over_view') }}')" class="toolbar-btn">
                                            {{ __('common_text.account_title') }}
                                        </a>
                                    </li>
                                @else
                                    <li class="header-toolbar__item d-sm-none d-lg-block">
                                        <a href="#sideNav" class="toolbar-btn">
                                            {{ __('common_text.account_title') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="main-navigation">
                                <ul class="mainmenu text-center">
                                    @foreach($layoutData['categories'] as $category)
                                    <li class="mainmenu__item menu-item-has-children  click-menu-active">
                                        <a onclick="megaMenuOpen('{{ $category->id }}')" role="button" class="mainmenu__link">
                                            <span class="mm-text">{{ $category->name }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                    <li class="mainmenu__item">
                                        <a class="mainmenu__link" href="{{ route('world_of_bd_drip') }}">
                                            <span class="mm-text"> WORLD OF BD</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="full-height-menu" id="full-height-menu">
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-sticky-header-height"></div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Mobile Header area Start -->
    <header class="header-mobile">
        <div class="header-mobile__outer">
            <div class="header-mobile__inner fixed-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <a href="#" class="menu-btn" onclick="logoChange()"></a>
                        </div>
                        <div class="col-8">
                            <ul class="header-toolbar text-end">
                                <li class="header-toolbar__item d-none d-sm-none d-md-none">
                                    <a role="button" onclick="jsRedirectUrl('{{ route('wishlist') }}')"
                                       class="mini-cart-btn toolbar-btn">
                                        <i class="fa fa-heart"></i>
                                        <sup class="mini-cart-count"
                                             id="wishlist-count">{{ $layoutData['wishlistCount'] }}</sup>
                                    </a>
                                </li>

                                <li class="header-toolbar__item d-lg-none">
                                    <a href="{{ route('home') }}" class="logo-box">
                                        <figure class="logo--normal" id="mobile-logo">
                                            <img height="60px" src="{{ asset('img/logo.png') }}"
                                                 alt="Logo">
                                        </figure>

                                    </a>
                                </li>

                                <li class="header-toolbar__item">
                                    <a href="#searchForm" class="search-btn toolbar-btn">
                                        <i class="dl-icon-search1"></i>
                                    </a>
                                </li>
                                <li class="header-toolbar__item">
                                    <a role="button" onclick="jsRedirectUrl('{{ route('cart') }}')"
                                       class="mini-cart-btn toolbar-btn">
                                        <i class="dl-icon-cart4"></i>
                                        <sup id="cart-count"class="mini-cart-count">{{ $layoutData['cartTotalQuantity'] }}</sup>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Mobile Navigation Start Here -->
                            <div class="mobile-navigation dl-menuwrapper" id="dl-menu">
                                <button class="dl-trigger">Open Menu</button>
                                <ul class="dl-menu">
                                    @foreach ($layoutData['categories'] as $category)
                                        <li>
                                            <a href="#">
                                                {{ $category->name }}
                                            </a>
                                            <ul class="dl-submenu">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <li>
                                                        <a class="megamenu-title" href="#">
                                                            {{ $subCategory->name }}
                                                        </a>
                                                        <ul class="dl-submenu">
                                                            @if (count($subCategory->subSubCategories->where('by_style', 0)) > 0)
                                                                @foreach ($subCategory->subSubCategories->where('by_style', 0) as $subSubCategory)
                                                                    <li><a data-id="{{ $subSubCategory->id }}"
                                                                           class="mouse-hover-img"
                                                                           href="{{ route('page.view_by_look_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                             @if(count($subCategory->subSubCategories->where('by_style', 1)) > 0)
                                                                    @foreach ($subCategory->subSubCategories->where('by_style', 1) as $subSubCategory)
                                                                        <li><a data-id="{{ $subSubCategory->id }}"
                                                                               class="mouse-hover-img"
                                                                               href="{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                        <li><a href="{{ route('world_of_bd_drip') }}">WORLD OF BD</a></li>
                                    @if (Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER)
                                        <li>
                                            <a href="{{ route('over_view') }}">
                                                <i class="fa fa-user"></i> {{ __('common_text.account_title') }}
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('login') }}">
                                                <i class="fa fa-user"></i> {{ __('common_text.account_title') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('wishlist') }}">
                                            <i class="fa fa-heart"></i> {{ __('common_text.wishlist') }}
                                        </a>
                                    </li>

                                        @if($layoutData['language_currency'] == 'bn_bdt')
                                            <li><a href="{{ route('dispatch') }}" class="language-page">
                                                    <img src="{{ asset('img/bn.png') }}" alt="">
                                                    বাংলা/BDT</a>
                                            </li>
                                        @elseif($layoutData['language_currency'] == 'en_bdt')
                                            <li><a href="{{ route('dispatch') }}" class="language-page">
                                                    <img src="{{ asset('img/bn.png') }}" alt="">
                                                    ENGLISH/BDT</a>
                                            </li>
                                        @elseif($layoutData['language_currency'] == 'aed_aed')
                                            <li><a href="{{ route('dispatch') }}" class="language-page">
                                                    <img src="{{ asset('img/aed.png') }}" alt="">
                                                    AED/ عرب </a>
                                            </li>
                                        @elseif($layoutData['language_currency'] == 'en_aed')
                                            <li><a href="{{ route('dispatch') }}" class="language-page">
                                                    <img src="{{ asset('img/aed.png') }}" alt="">
                                                    ENGLISH/AED</a>
                                            </li>
                                        @elseif($layoutData['language_currency'] == 'en_usd')
                                            <li><a href="{{ route('dispatch') }}" class="language-page">
                                                    <img src="{{ asset('img/usa.png') }}" alt="">
                                                    ENGLISH/USD</a>
                                            </li>

                                        @endif

                                </ul>
                            </div>
                            <!-- Mobile Navigation End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-sticky-header-height"></div>
        </div>
    </header>
    <!-- Mobile Header area End -->

    <!-- Main Content Wrapper Start -->
    <div id="content" class="main-content-wrapper">
        <div class="wishlist-notification-wrapper" id="wishlist_notification" style="display: none">
            <div class="wishlist-notification">
                <img src="#" id="wishlist-img" alt="">
                <div class="wishlist-content">
                    <p id="wishlist-msg"></p>
                    <a href="{{ route('wishlist') }}">Access your wishlist</a>
                </div>
            </div>
        </div>

     @yield('content')
    </div>
    <!-- Main Content Wrapper Start -->

    <!-- Footer Start -->
    <footer class="footer footer-1 bg--black">
        <div class="footer-middle" id="follow_us_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="follow-us-area">
                            <a style="float:right"><i id="close_follow_us" class="fa fa-window-close" aria-hidden="true"></i></a>
                            <h3 class="text-center" style="color: white; padding-top:30px;">Follow us</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <ul class="footer-common-nav text-center">
                            <li><a target="_blank" href="https://instagram.com/worldofbdclothing"><i class='fa fa-instagram'
                                                                                                     style='color: white;font-size: x-large'></i></a>
                            <li><a target="_blank" href="https://www.facebook.com/worldofbdclothing"><i class="fa fa-facebook"
                                                                                                        style='color: white;font-size: x-large'></i></a></li>
                            <li><a target="_blank" href="https://www.twitter.com/worldofbda"><i class="fa fa-twitter"
                                                                                                style='color: white;font-size: x-large'></i></a></li>
                            <li><a target="_blank" href="https://www.youtube.com/channel/UCmwPxY_yThhlsAQ9uznyGKQ/"><i class="fa fa-youtube-play"
                                                                                                                       style='color: white;font-size: x-large'></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-logo">
                            <img src="{{ asset('img/logo-trans.png') }}" alt="">
                            <div class="footer-dir-name">

                                @if (\Route::current()->getName() == 'newsletter')
                                    <p>MyBD</p>
                                @elseif(\Route::current()->getName() == 'unsubscribe')
                                    <p>MyBD</p>
                                @elseif(\Route::current()->getName() == 'wishlist')
                                    <p>MyBD</p>
                                @endif


                                {{ isset($category_dir) ? $category_dir : '' }}
                                @isset($sub_sub_category_dir)
                                    &nbsp; - &nbsp;
                                    {{ isset($sub_category_dir) ? $sub_category_dir : '' }} &nbsp; - &nbsp;
                                <a href="{{ route('page.sub_sub_category', ['category_slug' => $sub_sub_category_dir->category->slug, 'sub_category_slug' => $sub_sub_category_dir->subCategory->slug, 'sub_sub_category_slug' => $sub_sub_category_dir->slug]) }}">{{ $sub_sub_category_dir->name }}</a> &nbsp; - &nbsp;
                                {{ isset($product_dir) ? $product_dir : '' }}
                                @endif
                                @isset($view_by_sub_sub_category_dir)
                                    &nbsp; - &nbsp;
                                    {{ isset($sub_category_dir) ? $sub_category_dir : '' }} &nbsp; - &nbsp;

                                    <a href="{{ route('page.view_by_look_category', ['category_slug' => $view_by_sub_sub_category_dir->category->slug, 'sub_category_slug' => $view_by_sub_sub_category_dir->subCategory->slug, 'sub_sub_category_slug' => $view_by_sub_sub_category_dir->slug]) }}">{{ $view_by_sub_sub_category_dir->name }}</a> &nbsp; - &nbsp;
                                    {{ isset($product_dir) ? $product_dir : '' }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="footer-common-nav">

                            @if($layoutData['language_currency'] == 'bn_bdt')
                                <li><a href="{{ route('dispatch') }}" class="language-page">
                                        <img src="{{ asset('img/bn.png') }}" alt="">
                                        বাংলা/BDT</a>
                                </li>
                            @elseif($layoutData['language_currency'] == 'en_bdt')
                                <li><a href="{{ route('dispatch') }}" class="language-page">
                                        <img src="{{ asset('img/bn.png') }}" alt="">
                                        ENGLISH/BDT</a>
                                </li>
                            @elseif($layoutData['language_currency'] == 'aed_aed')
                                <li><a href="{{ route('dispatch') }}" class="language-page">
                                        <img src="{{ asset('img/aed.png') }}" alt="">
                                        AED/ عرب </a>
                                </li>
                            @elseif($layoutData['language_currency'] == 'en_aed')
                                <li><a href="{{ route('dispatch') }}" class="language-page">
                                        <img src="{{ asset('img/aed.png') }}" alt="">
                                        ENGLISH/AED</a>
                                </li>
                            @elseif($layoutData['language_currency'] == 'en_usd')
                                <li><a href="{{ route('dispatch') }}" class="language-page">
                                        <img src="{{ asset('img/usa.png') }}" alt="">
                                        ENGLISH/USD</a>
                                </li>

                            @endif
                            <li><a href="{{ route('newsletter') }}">Newsletter</a>
                            <li><a href="{{ route('start_the_journey') }}">Contact</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a style="color:white" id="follow-us">Follow Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="copyright-text">&copy; {{ __('common_text.title') }}
{{--                            . Design & Developed <i class="fa fa-heart"></i> BY--}}
{{--                            <a target="_blank" href="https://2aitbd.com">2A IT LIMITED</a></p>--}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Search from Start -->
    <div class="searchform__popup" id="searchForm">
        <div class="search-heading">
            <div class="container-fluid" style="position: relative">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="search-form">
                            <form action="{{route('search_page')}}" method="get">
                                <div class="search-input-area" >
                                    <i class="fa fa-search"></i>
                                    <input id="search-product" type="text" name="search_item" class="form-control" placeholder="{{ __('common_text.product_search_placeholder') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="search-close-area">
                    <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                </div>
            </div>
        </div>
        <div class="search-result" id="search-result-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 p-0">
                        <div class="search-category-area-open">
                            @foreach($layoutData['categories']->chunk(2) as $chunkCategories)
                                <div class="row">
                                    @foreach($chunkCategories as $category)
                                        <div class="col-md-6">
                                            <h3 class="search-area-category-title">{{ $category->name }}</h3>
                                            <ul class="search-area-category-list">
                                                @foreach($category->subSubCategories->where('by_style',1)->take(5) as $subSubCategory)
                                                    <li><a href="{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="search-product-head">
                            <h3 class="search-area-category-title">PRODUCTS</h3>
                            <ul class="search-product-list">
                                @foreach($layoutData['products'] as $product)
                                    <li onclick="jsRedirectUrl('{{ route('page.product_details',['slug'=>$product->slug]) }}')">
                                        <img src="{{ asset($product->colorImages[0]->thumbs ?? '') }}" alt="">
                                        <div class="search-list-product-name">
                                            {{ $product->name }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search from End -->
    <!-- Side Navigation Start -->
    <aside class="side-navigation side-navigation--left" id="sideNav">
        <div class="side-navigation-wrapper">
            <div class="slide-bar-login-area">
                <h3>IDENTIFICATION</h3>
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            </div>
            <div class="side-navigation-inner">

               <div class="slide-bar-login-form">
                   <h2>I ALREADY HAVE AN ACCOUNT</h2>
                   <form id="login-form" method="post">

                       <div class="row">
                           <div class="col-md-12">
                               <div class="form-group mb--25">
                                   <label for="email">Email/Username <span class="text-danger">*</span></label>
                                   <input autocomplete="off" type="text" id="email" name="email" class="form-control login-input">
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="form-group mb--25">
                                   <label for="password">Password <span class="text-danger">*</span></label>
                                   <input type="password" id="password" name="password" class="form-control login-input login-input-password">
                                   <a href="{{ route('password.request') }}" class="mb">Forgot your password?</a>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="d-grid">
                                   <button type="button" id="ajax-login" class="btn-login-side">Sign In</button>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
                <div class="register-slide-area">
                    <h2>I DON'T HAVE AN ACCOUNT</h2>
                    <p>Enjoy added benefits and a richer experience by creating a personal account</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-grid">
                                <a href="{{ route('register') }}" class="btn-login-side">Create My Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- Side Navigation for MyCart Start -->
    <aside class="side-navigation side-navigation--left" id="sideNavigation">
        <div class="side-navigation-wrapper scrollable">
            <div class="slide-bar-login-area">
                <h3>YOUR SHOPPING BAG <span class="shopping-quantity">({{ count($layoutData['cart_items']) }})</span></h3>
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            </div>
            <div class="side-navigation-inner">
                <div class="slide-bar-prodect-details">
                    @foreach($layoutData['cart_items'] as $cartItem)
                        <div class="hero-sub">
                            <div class="col-style">
                                <img style="width:100px;" src="{{ asset(colorImages($cartItem->id,$cartItem->attributes->color_id)[0]->thumbs ?? '') }}" alt="">
                            </div>
                            <div class="product-style">
                                <p class="nav-product-name">{{ $cartItem->name }} <span>({{ $cartItem->quantity }})</span> <br>
                                    <span class="nav-product-price">{{ convertCurrencySign(convertCurrency($cartItem->associatedModel->id,$cartItem->attributes->color_id,$cartItem->attributes->size_id) * $cartItem->quantity) }}</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="register-slide-area">
                    <div class="row shopping-footer-price">
                        <div class="col-sm-6">
                            <p class="shopping-total-price">TOTAL</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="float-end shopping-total-count">{{ convertCurrencySign($layoutData['sub_total']) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-grid">
                                <a href="{{ route('cart') }}" class="btn-login-side">View your Shopping Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- Side Navigation for MyCart End -->
    <!-- Global Overlay Start -->
    <div class="ai-global-overlay"></div>
    <!-- Global Overlay End -->
    <!-- Modal Start -->
</div>
<!-- Main Wrapper End -->


<!-- ************************* JS Files ************************* -->

<!-- jQuery JS -->
<script src="{{ asset('themes/frontend/assets/js/vendor/jquery.min.js') }}"></script>

<!-- Bootstrap and Popper Bundle JS -->
<script src="{{ asset('themes/frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- All Plugins Js -->
<script src="{{ asset('themes/frontend/assets/js/plugins.js') }}"></script>

<!-- Ajax Mail Js -->
<script src="{{ asset('themes/frontend/assets/js/ajax-mail.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('themes/frontend/assets/js/main.js') }}"></script>

<!-- REVOLUTION JS FILES -->
<script src="{{ asset('themes/frontend/assets/js/revoulation/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/jquery.themepunch.revolution.min.js') }}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('themes/frontend/assets/js/revoulation/extensions/revolution.extension.video.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('themes/frontend/plugins/toastr/toastr.min.js') }}"></script>
<!-- REVOLUTION ACTIVE JS FILES -->
<script src="{{ asset('themes/frontend/assets/js/revoulation.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $("#bd-preload").delay(2000).fadeOut(800);
    $(function (){
        $('#close_follow_us').click(function() {
            $('#follow_us_area').slideToggle('slow');
        })
        $('#follow_us_area').hide();
        $('#follow-us').click(function() {
            $('#follow_us_area').slideToggle('slow');
        })

    })
    function jsRedirectUrl(url){
        window.location.href = url;
    }
    function megaMenuOpen(categoryId){
        $(".full-height-menu").css('opacity','1')
        $(".full-height-menu").addClass('full-height-menu-open');
        $(".main-navigation .mainmenu__item > a").css('color','#282828');
        $(".header-inner").css('background','#fff');
        $(".header-inner.fixed-header").css('position','fixed');
        $(".header-transparent .header-inner").css('box-shadow','inset 0 -1px 0 0 #010001');
        $(".header-toolbar__item > a").css('color','#282828');
        $(".logo--transparency").css('display','none');
        $(".logo--normal").css('display','block');
        $(".logo--normal").css('height','auto');
        $("body").css('overflow','hidden');
        //$("#full-height-menu").html('');
        $.ajax({
            method: "GET",
            url: "{{ route('get_mega_menu') }}",
            data: {categoryId: categoryId}
        }).done(function (data) {

            setTimeout(() => {

            }, 1500);
            $("#full-height-menu").css('height','calc(100vh - 120px)');
            $("#full-height-menu").html(data.menu);
            //$("#full-height-menu").html(data.preload);
        });

    }
    function megaCancelButton(){
        $(".header-transparent .header-inner").css('box-shadow','none');
        $(".full-height-menu").css('opacity','0')
        $(".full-height-menu").removeClass('full-height-menu-open');
        $(".main-navigation .mainmenu__item > a").css('color','#000');
        $(".header-toolbar__item > a").css('color','#000');
        $(".header-inner").css('background','transparent');
        $(".header-inner.fixed-header").css('position','relative');
        $("#full-height-menu").css('height','0');
        $("body").css('overflow','auto');
        $("body").css('overflow-x','hidden');
    }
    function showSubSubCategory(subCategoryId){
        $.ajax({
            method: "GET",
            url: "{{ route('get_sub_sub_menu') }}",
            data: {subCategoryId: subCategoryId}
        }).done(function (data) {
            $(".sub-menu-layer ul li").removeClass('active');
            $(".sub_category_active"+subCategoryId).addClass('active');
            $("#sub_sub_menu").html(data.menu);
            $("#sub_sub_category_img").attr("src",data.img);
        });
    }
    $('body').on('mouseover', '.mouse-hover-img', function(){
        var subSubCategoryId = $(this).data('id');
        if(subSubCategoryId != ''){
            $.ajax({
                method: "GET",
                url: "{{ route('get_sub_sub_category_img') }}",
                data: {subSubCategoryId: subSubCategoryId}
            }).done(function (data) {
                $("#sub_sub_category_img").fadeIn();
                $("#sub_sub_category_img").attr("src",data);
            });
        }

    });
    $(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#search-product").keyup(function(){
            var keyWord = $(this).val();
            $.ajax({
                method: "GET",
                url: "{{ route('get_search_data') }}",
                data: {keyWord: keyWord}
            }).done(function (data) {
                $("#search-result-data").html(data);
            });
        });
        $('body').on('click', '.wishlist-btn', function(e){
            e.preventDefault();
            e.stopPropagation();
            var itemProduct = $(this);
            var productId = $(this).data('id');
            var colorId = $(this).data('color');
            var typeId = $(this).data('type');
            var sizeId = $(this).data('size');

                $.ajax({
                    method: "POST",
                    url: "{{ route('add_to_wishlist') }}",
                    data: { productId,colorId,typeId,sizeId }
                }).done(function( response ) {
                    if (response.status == 1) {
                        itemProduct.closest('.wishlist-btn').html('<i style="color: #000" class="fa fa-heart"></i>');

                        $("#wishlist-img").attr('src',response.img_url);
                        $("#wishlist-msg").html(response.message);

                        $('#wishlist-count').html(response.wishlistCount);
                        $("#wishlist_notification").show();
                        $("body,html").css('overflow','hidden')
                        setTimeout(function(){
                            $("#wishlist_notification").hide();
                            $("body,html").css('overflow','auto')
                        },1500)
                    }else if (response.status == 2){
                        $('#wishlist-count').html($('#wishlist-count').text() - 1);
                        itemProduct.closest('.wishlist-btn').html('<i class="fa fa-heart-o"></i>');
                    }else if (response.status == 3){
                        itemProduct.closest('.wishlist-btn').html('<i style="color: #000" class="fa fa-heart"></i>');

                        $("#wishlist-img").attr('src',response.img_url);
                        $("#wishlist-msg").html(response.message);

                        $('#wishlist-count').html(response.wishlistCount);
                        $("#wishlist_notification").show();
                        $("body,html").css('overflow','hidden')
                        setTimeout(function(){
                            $("#wishlist_notification").hide();
                            $("body,html").css('overflow','auto')
                        },1500)
                    }
                });
        });
        $(".wishlist-notification-wrapper").click(function (){
            $("body,html").css('overflow','auto')
        })
        $('#ajax-login').click(function () {
            var formData = new FormData($('#login-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('ajax_login') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // toastr.success(response.message);
                        //window.location.href = response.redirect_url;
                        window.location.reload();
                    } else {
                        // toastr.error(response.message);
                    }
                }
            });
        });


        var message = '{{ session('message') }}';
        var error = '{{ session('error') }}';

        var message = '{{ session('message') }}';

        if (!window.performance || window.performance.navigation.type != window.performance.navigation.TYPE_BACK_FORWARD) {
            if (message != '')
                toastr.success(message);

            if (error != '')
                toastr.error(error);
        }

        // $(".toolbar-btn,.btn-close,.ai-global-overlay").click(function(){
        //     $("body").toggleClass("body-add-class");
        // });

        $('body').on('click', '.click-menu-active', function() {
            var clickMenu = $(this);
            var subbbb = clickMenu.children('ul').css('visibility','visible');
            //alert(subbbb);
        });


    })
</script>
@yield('script')
</body>
</html>
