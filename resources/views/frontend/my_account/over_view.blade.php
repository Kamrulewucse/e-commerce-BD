@extends('layouts.app')
@section('style')
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/frontend/owlcarousel/assets/owl.theme.default.min.css') }}">
    <style>
        /* Feel free to change duration  */
        .animated {
            -webkit-animation-duration: 1000ms;
            animation-duration: 1000ms;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        /* .owl-animated-out - only for current item */
        /* This is very important class. Use z-index if you want move Out item above In item */
        .owl-animated-out {
            z-index: 1
        }

        /* .owl-animated-in - only for upcoming item
        /* This is very important class. Use z-index if you want move In item above Out item */
        .owl-animated-in {
            z-index: 0
        }

        /* .fadeOut is style taken from Animation.css and this is how it looks in owl.carousel.css:  */
        .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }

        @-webkit-keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
    <style>
        .page-content-inner {
            padding: 14px 0;
        }

        h1.user-card-title {
            font-size: 18px;
            font-weight: bold;
        }

        h1.account-page-title {
            font-weight: bold;
        }

        label.col-form-label {
            text-align: right;
        }

        input.form-control {
            margin: 8px 0;
            height: 42px;
        }

        h1.user-card-title {
            padding: 8px 0;
        }

        /*@media screen and (max-width: 450px) {*/
        /*    .user-nav {*/
        /*        margin-top: 57px;*/
        /*    }*/
        /*    .user-nav ul li a {*/
        /*        padding: 2px;*/
        /*    }*/
        /*}*/
        .cover-view {
            height: 310px;
            position: relative;
            overflow: hidden;
        }

        .cover-view img {
            min-width: 100%;
            min-height: 100%;
            max-width: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto;
        }

        .bd-letters-area {

        }

        .bd-letters {
            background-color: #fff;
            border: 1px solid #eae8e4;
            border-radius: 50%;
            color: #19110b;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto -1.875rem;
            text-align: center;
            transform: translateY(-50%);
            text-transform: uppercase;
            font-family: "Louis Vuitton Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 1.5rem;
            line-height: 1.1666666666666667;
            letter-spacing: 0;
            width: 10.75rem;
            height: 10.75rem;
        }

        .bd-identity {
            margin-top: 1rem;
            text-align: center;
            font-family: "Louis Vuitton Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 1.125rem;
            line-height: 1.1111111111111112;
            letter-spacing: 0;
        }

        .bd-identity {
            margin-top: 1rem;
            text-align: center;
            font-family: "Louis Vuitton Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 22px;
            line-height: 1.1111111111111112;
            letter-spacing: 0;
            color: #000;
        }

        @media only screen and (min-width: 48em) {
            .bd-letters {
                width: 10.75rem;
                height: 10.75rem;
                margin-bottom: -5.125rem;
            }
        }

        @media only screen and (min-width: 64em) {
            .bd-letters {
                font-family: "Louis Vuitton Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-style: normal;
                font-weight: 500;
                font-size: 3.75rem;
                line-height: 1.1428571428571428;
                letter-spacing: 0;
            }
        }

        .bd-identity {
            margin-bottom: 25px;
        }

        .wp-contact-modes {
            padding: 0 1.5rem 1.5rem 1.5rem;
        }

        @media only screen and (min-width: 48em) {
            .wp-contact-modes {
                padding: 0 2rem 2rem 2rem;
            }
        }

        .wp-contact-modes ul {
            border: 1px solid #e1dfd8;
            display: flex;
            flex-flow: row wrap;
        }

        .wp-contact-modes li {
            box-sizing: border-box;
            padding: 2rem .5rem 5rem;
            padding-top: 5rem;
            position: relative;
            text-align: center;
            width: 50%;
        }

        .wp-contact-modes li:nth-child(2n+2) {
            border-left: 1px solid #e1dfd8;
        }

        .wp-contact-modes li:nth-child(n+3) {
            border-top: 1px solid #e1dfd8;
        }

        .wp-contact-modes svg {
            height: 3rem;
            width: 2rem;
        }

        .wp-contact-modes .contact-status {
            left: calc(50% - -1rem);
        }

        .wp-contact-modes .contact-status-yes {
            color: #5c7e08;
        }

        .wp-contact-modes span {
            font-weight: 400;
            font-size: .875rem;
            line-height: 1.7142857142857142;
            letter-spacing: .4px;
        }

        .wp-contact-modes .contact-status {
            position: absolute;
            top: 4rem;
            width: 3rem;
        }

        .wp-contact-modes span {
            font-weight: 400;
            font-size: 1.2rem;
            line-height: 1.7142857142857142;
            letter-spacing: .4px;
            color: #000;
        }


        .mask, .visuallyHidden, .sr-only {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
            padding: 0;
            border: 0;
            height: 1px;
            width: 1px;
            overflow: hidden;
        }

        .wp-contact-modes .contact-status-no {
            color: #c53929;
        }

        a:visited {
            text-decoration: none !important;
        }

        .owl-carousel .owl-stage {

        }

        .item.wishlist-item:hover {
            border: 8px solid #eee;
        }

        .wishlist-item {
            transition: all 0.5s ease;
            border: 1px solid #e1dfd8;
        }

        .wishlist-item {
            text-align: center;
            padding: 15px 0;
        }

        button.owl-prev, button.owl-next {
            top: 39%;
            border-radius: 0 !important;

        }

        button.owl-prev {
            border-left: 0 solid #eae8e4 !important;
            border-top: 1px solid #eae8e4 !important;
            border-right: 1px solid #eae8e4 !important;
            border-bottom: 1px solid #eae8e4 !important;
            left: -26px !important;
        }

        button.owl-next {
            border-left: 1px solid #eae8e4 !important;
            border-top: 1px solid #eae8e4 !important;
            border-right: 0 solid #eae8e4 !important;
            border-bottom: 1px solid #eae8e4 !important;
            right: -26px !important;
        }

        .owl-theme .owl-nav .disabled {
            opacity: 1;
        }

        .logout-btn {
            width: 100px !important;
            float: right;
            margin: 30px 0;
            background-color: transparent !important;
        }

        .logout-btn:hover {
            background-color: #eae8e4;
            box-shadow: inset 0 0 0 1px #eae8e4;
            color: #19110b;
        }

        .owl-carousel .owl-item img {
            display: block;
            width: 255px;
            height: 284px;
            object-fit: scale-down;
        }

        .wishlist-item {
            background: #f6f6f6;
        }

        img.img2{
            margin-left: -12px;
            margin-top: -12px;
        }

    </style>
@endsection
@section('content')
    @include('layouts.partial.user_nav')
    <div class="page-content-inner body-height-full">
        <div class="cover-view">
            <img src="{{ asset('img/cover_photo.png') }}" alt="">
        </div>
        <div class="bd-letters-area">
            <div class="bd-letters">
                <span class="bd-letters-firstname">{{ substr($user->first_name, 0, 1) }}</span>.<span
                    class="bd-letters-lastname">{{ substr($user->last_name, 0, 1) }}</span>
            </div>
            <div class="bd-identity">
                <span class="bd-identity-firstname" itemprop="givenName">{{ $user->first_name }}</span> <span
                    class="bd-identity-lastname" itemprop="name">{{ $user->last_name }}</span>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="other-page-box">
                        <h1 class="other-box-title">MY ACCOUNT</h1>
                        <hr>
                        <p class="email-text"><b>Email :</b> {{ $user->email }}</p>
                        <h1 class="other-box-title">CONTACT PREFERENCES</h1>
                        <div class="wp-contact-modes">
                            <ul>
                                <li>
                                    <a href="{{ route('active_service',['service'=>'newsletter']) }}">
                                        <div class="svg-wrapper">
                                            <svg  viewBox="0 0 80 80" focusable="false" aria-hidden="true"
                                                 class="ui-icon-informations-email">
                                                <path
                                                    d="M41.1 39a10.7 10.7 0 0 1-4.6-1.1C32.5 36 3.8 20.6 2.6 20S-.3 17.4.1 15.8s3.8-3.1 5.1-3.2h69.7c2.7 0 4.5 1 4.9 2.7s-1.7 4-2.6 4.6C73.5 22.7 48.8 36 45.4 37.8a8 8 0 0 1-4.3 1.2zm-2.3-5.9c2.3 1.1 3.6.3 3.7.3l.3-.2c8.5-4.6 21.2-11.6 27.5-15.3H10c8.7 4.7 25.9 13.8 28.8 15.2zm34 34.4H7C3.4 67.4.4 64.1.4 60.2V28.5A3.8 3.8 0 0 1 2.2 25c2-1.2 4.2.1 5.9 1.1h.2c11.3 7 28.9 16.7 32.8 16.7 1.7 0 8-2.2 31.2-16.8 1.7-1.3 3.7-2.7 5.7-1.8a3.6 3.6 0 0 1 2 3.5v32.5a7.1 7.1 0 0 1-7.2 7.2zM5.7 30.9v29.3c0 1 .8 1.9 1.3 1.9h65.8a1.8 1.8 0 0 0 1.9-1.9V30.9C50.5 46.2 44.1 48.3 41.1 48.3c-6.8 0-30.5-14.4-35.4-17.4"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                          @if($user->newsletter_active == 1)
                                            <span class="contact-status contact-status-yes">
                                              <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-valid">
                                                  <path fill-rule="evenodd" d="M74.7 8.7L80 14 23.2 71.3 0 47.9l5.3-5.3 17.9 18L74.7 8.7z"></path></svg></span>
                                          @else
                                                <span class="contact-status contact-status-no">
                                                <svg fill="#ff0000" viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-close"><path fill-rule="evenodd"
                                                                                                                                                   d="M40 34.3L65.5 8.9l5.6 5.6L45.7 40l25.4 25.5-5.6 5.6L40 45.7 14.5 71.1l-5.6-5.6L34.3 40 8.9 14.5l5.6-5.6L40 34.3z"></path></svg>
                                            </span>
                                         @endif
                                        </div>
                                        <span>Email newsletter</span>
                                        <span class="sr-only">yes</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('active_service',['service'=>'phone']) }}">
                                        <div class="svg-wrapper">
                                            <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true"
                                                 class="ui-icon-controls-contact">
                                                <path
                                                    d="M46.8 9.4H33.6a2.9 2.9 0 0 0 0 5.9h13.2a2.9 2.9 0 1 0 0-5.9zm0 54.1H33.6a2.9 2.9 0 0 0 0 5.9h13.2a2.9 2.9 0 1 0 0-5.9zM54.2 0a10.9 10.9 0 0 1 10.9 10.8v58.4A10.9 10.9 0 0 1 54.2 80H25.8a10.9 10.9 0 0 1-10.9-10.8V10.8A10.9 10.9 0 0 1 25.8 0zm5 10.8v58.4a5 5 0 0 1-5 5H25.8a5 5 0 0 1-5-5V10.8a5 5 0 0 1 5-5h28.4a5 5 0 0 1 5 5"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                            @if($user->phone_active == 1)
                                                <span class="contact-status contact-status-yes">
                                              <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-valid">
                                                  <path fill-rule="evenodd" d="M74.7 8.7L80 14 23.2 71.3 0 47.9l5.3-5.3 17.9 18L74.7 8.7z"></path></svg></span>
                                            @else
                                                <span class="contact-status contact-status-no">
                                                <svg  fill="#ff0000" viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-close"><path fill-rule="evenodd"
                                                                                                                                                   d="M40 34.3L65.5 8.9l5.6 5.6L45.7 40l25.4 25.5-5.6 5.6L40 45.7 14.5 71.1l-5.6-5.6L34.3 40 8.9 14.5l5.6-5.6L40 34.3z"></path></svg>
                                            </span>
                                            @endif
                                        </div>
                                        <span>Phone</span>
                                        <span class="sr-only">no</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('active_service',['service'=>'chat']) }}">
                                        <div class="svg-wrapper">
                                            <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true"
                                                 class="ui-icon-social-chat">
                                                <path
                                                    d="M74.9 7.9H5.1A5.1 5.1 0 0 0 0 13v44.3a5.1 5.1 0 0 0 5.1 5.1h11.3v6.2a3.5 3.5 0 0 0 3.5 3.5l1.4-.3 21.9-9.4h31.7a5.1 5.1 0 0 0 5.1-5.1V13a5.1 5.1 0 0 0-5.1-5.1zM5.1 57.7a.4.4 0 0 1-.4-.4V13a.4.4 0 0 1 .4-.4h69.8a.4.4 0 0 1 .4.4v44.3a.4.4 0 0 1-.4.4H42.3l-21.2 9.1v-9.1z"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                            @if($user->chat_active == 1)
                                                <span class="contact-status contact-status-yes">
                                              <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-valid">
                                                  <path fill-rule="evenodd" d="M74.7 8.7L80 14 23.2 71.3 0 47.9l5.3-5.3 17.9 18L74.7 8.7z"></path></svg></span>
                                            @else
                                                <span class="contact-status contact-status-no">
                                                <svg fill="#ff0000" viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-close"><path fill-rule="evenodd"
                                                                                                                                                   d="M40 34.3L65.5 8.9l5.6 5.6L45.7 40l25.4 25.5-5.6 5.6L40 45.7 14.5 71.1l-5.6-5.6L34.3 40 8.9 14.5l5.6-5.6L40 34.3z"></path></svg>
                                            </span>
                                            @endif
                                        </div>
                                        <span>Text Chat App</span>
                                        <span class="sr-only">no</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('active_service',['service'=>'mail']) }}">
                                        <div class="svg-wrapper">
                                            <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true"
                                                 class="ui-icon-navigation-newsletter">
                                                <path
                                                    d="M5.2 28.2l35.1 37.2.2.2 34.3-37.3v41.6H5.2zm3.4-4h5.7v6zm57 0h5.8l-5.8 6.3zm-46 11.6V10.1h40.8v26.1l-20 21.7zM14.3 4.9V19H0v56.1h80V19H65.7V4.9z"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                            @if($user->mail_active == 1)
                                                <span class="contact-status contact-status-yes">
                                              <svg viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-valid">
                                                  <path fill-rule="evenodd" d="M74.7 8.7L80 14 23.2 71.3 0 47.9l5.3-5.3 17.9 18L74.7 8.7z"></path></svg></span>
                                            @else
                                                <span class="contact-status contact-status-no">
                                                <svg fill="#ff0000" viewBox="0 0 80 80" focusable="false" aria-hidden="true" class="ui-icon-controls-close"><path fill-rule="evenodd"
                                                                                                                                                   d="M40 34.3L65.5 8.9l5.6 5.6L45.7 40l25.4 25.5-5.6 5.6L40 45.7 14.5 71.1l-5.6-5.6L34.3 40 8.9 14.5l5.6-5.6L40 34.3z"></path></svg>
                                            </span>
                                            @endif
                                        </div>
                                        <span>Mail</span>
                                        <span class="sr-only">no</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('account_details') }}" class="btn-next">Edit my Profile</a>
                    </div>
                    <div class="other-page-box">
                        <h1 class="other-box-title">MY APPOINTMENTS</h1>

                        @if(count($upcomingAppointments) > 0)
                            @foreach($upcomingAppointments as $appointment)
                                <div class="other-page-box">
                                    <div class="row">
                                        <div class="col-12 pb-5">
                                            <h3><b id="">{{ $appointment->appointment_day->format('l, F d, Y') }}, at <span style="text-transform: uppercase">{{ $appointment->appointment_time }}</span></b></h3>
                                            @if($appointment->type == 1)
                                                <h4><b id="">In-Store Appointment</b></h4>
                                            @else
                                                <h4><b id="">Virtual appointment</b></h4>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <img src="{{ asset('img/store.png') }}" alt="" class="store-img">
                                            </div>
                                            <div class="col-6">
                                                <h3><b>Lalmatia, Dhaka</b></h3>
                                                <h4>2/1 Block A, Lalmatia, Dhaka</h4>
                                                <h4>+8801608911692</h4>
                                            </div>
                                            <div class="col-12 pt-4">
                                                <a style="color: #000" href="{{ route('booking_appointments') }}"><u>Re-book an appointment at this store</u></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">

                                                <button onclick="appointmentCancel('{{ $appointment->id }}')" type="button" class="btn-next cancel-btn">Cancel my appointment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else

                        <p class="email-text">You have no upcoming appointments.</p>
                        @endif

                        <a href="{{ route('stores') }}" class="btn-next">Book in-store appointment</a>
                        <a href="{{ route('appointments') }}" class="btn-next btn-next-bg-transparent">View my appointment
                            history</a>
                    </div>

                </div>
                <div class="col-md-6">
                    @if(count($onGoingOrders) > 0)
                    <div class="related-product">
                        <h1 class="other-box-title">MY ORDERS</h1>
                        @foreach($onGoingOrders as $onGoingOrder)
                            @if(count($onGoingOrder->products) == 1)
                                <div class="card" style="border: 2px solid #FFFFFF;border-radius: 15px;margin-bottom: 15px;box-shadow: 1px 2px 2px 2px #ece8e8;">
                                    <a href="{{ route('order_details',['order'=>$onGoingOrder->id]) }}" data-bs-target="#exampleModal">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                @foreach($onGoingOrder->products as $item)
                                                <img class="img2" src="{{ asset(colorImages($item->product_id,$item->color_id)[0]->thumbs ?? '') }}" style="width:90px;" alt="Image">
                                                <h4 style="position: absolute;margin-top: -78px;margin-left: 103px;">{{$item->product_name}}</h4><i style="float: right;margin-top: 30px;" class="fa fa-chevron-right"></i>
                                                <hr style="color: inherit;background-color: #e5dfdf;border: 0;opacity: 0.25;margin-top: -1px;height: 1.5px;">
                                                @endforeach
                                                <div class="contentSer">
                                                    <p class="long-text">{{date('m-d-Y',strtotime($onGoingOrder->created_at))}}<br> <span>Order No: <strong>{{$onGoingOrder->order_no}}</strong></span><span style="float: right">{{convertCurrencySign($onGoingOrder->total)}}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif(count($onGoingOrder->products) > 1 )
                                <div class="card" style="border: 2px solid #FFFFFF;border-radius: 15px;margin-bottom: 15px;box-shadow: 1px 2px 2px 2px #ece8e8;">
                                    <a href="{{ route('order_details',['order'=>$onGoingOrder->id]) }}" data-bs-target="#exampleModal">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                @foreach($onGoingOrder->products as $key => $item)
                                                    @if($key == 0)
                                                    <img class="img2" src="{{ asset(colorImages($item->product_id,$item->color_id)[0]->thumbs ?? '') }}" style="width:90px;" alt="Image">
                                                    @endif
                                                @endforeach
                                                    <h4 style="position: absolute;margin-top: -78px;margin-left: 103px;">{{count($onGoingOrder->products)}} Products</h4><i style="float: right;margin-top: 30px;" class="fa fa-chevron-right"></i>
                                                    <hr style="color: inherit;background-color: #e5dfdf;border: 0;opacity: 0.25;margin-top: -1px;height: 1.5px;">
                                                <div class="contentSer">
                                                    <p class="long-text">{{date('m-d-Y',strtotime($onGoingOrder->created_at))}} <br> <span>Order No: <strong>{{$onGoingOrder->order_no}}</strong></span><span style="float: right">{{convertCurrencySign($onGoingOrder->total)}}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
{{--                    <div class="other-page-box">--}}
{{--                        <h1 class="other-box-title">MY ORDERS</h1>--}}
{{--                        <hr>--}}
{{--                        @if(count($onGoingOrders) > 0)--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tbody>--}}
{{--                            @foreach($onGoingOrders as $onGoingOrder)--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <div class="row">--}}
{{--                                            @foreach($onGoingOrder->products as $item)--}}
{{--                                            <div class="col-6">--}}
{{--                                                <img  src="{{ asset(colorImages($item->product_id,$item->color_id)[0]->thumbs ?? '') }}"--}}
{{--                                                      alt="" height="50" width="200" style="margin-bottom: 3px">--}}
{{--                                            </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $onGoingOrder->order_no }}</td>--}}
{{--                                    <td>--}}
{{--                                        @if($onGoingOrder->status == \App\Enumeration\OrderStatus::$PENDING)--}}
{{--                                            <span class="text-warning">Pending</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$PROCESSING)--}}
{{--                                            <span class="text-info">Processing</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$APPROVED)--}}
{{--                                            <span class="text-info">Approved</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$ON_SHIPPING)--}}
{{--                                            <span class="text-info">On Shipping</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$SHIPPED)--}}
{{--                                            <span class="text-info">Shipped</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$DELIVERED)--}}
{{--                                            <span class="text-success">Delivered</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$CANCELLED)--}}
{{--                                            <span class="text-danger">Cancelled</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$RETURNED_INIT)--}}
{{--                                            <span class="text-warning">Return Initiate</span>--}}
{{--                                        @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$RETURNED)--}}
{{--                                            <span class="text-danger">Returned</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $onGoingOrder->updated_at->format('d-m-Y h:i A') }}</td>--}}
{{--                                    <td><a href="{{ route('order_details',['order'=>$onGoingOrder->id]) }}"><i class="fa fa-eye"></i></a></td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        @else--}}
{{--                        <p class="email-text text-center text-black"><b>There are no current orders</b></p>--}}
{{--                        @endif--}}
{{--                        <a href="{{ route('home') }}" class="btn-next">Start Shopping</a>--}}
{{--                    </div>--}}
                    <div class="other-page-box">
                        <h1 class="other-box-title">MY WISHLIST <sup>({{ count(json_decode($user->wishlist)) }})</sup>
                        </h1>

                        @if(count($products) > 0)
                            <div class="wishlist-slider-area">
                                <div class="wishlist_carousel owl-carousel owl-theme">
                                    @foreach($products as $product)

                                        <a href="{{ $product->product_type == 1 ? route('page.product_details',['slug'=>$product->slug]) : route('page.view_by_look_product_details',['slug'=>$product->slug]) }} ?color_id={{ $product->attributes->color_id }}&type_id={{ $product->attributes->type_id }}&size_id={{ $product->attributes->size_id }}"
                                           class="item wishlist-item">
                                            @if($product->product_type == 1)
                                                <img
                                                    src="{{ asset(colorImages($product->attributes->product_id,$product->attributes->color_id)[0]->thumbs ?? '') }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset($product->view_thumb ?? '') }}" alt="">
                                            @endif
                                            <p>{{ $product->name }}</p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <a href="{{ route('wishlist') }}" class="btn-next">Edit my wishlist</a>
                        @else
                            <p class="email-text text-center text-black"><b>There are no wishlist item.</b></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn-next btn-next-bg-transparent logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                $('#logout').submit();">
                        <form method="POST" id="logout" action="{{ route('logout') }}">
                            @csrf
                            Logout
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('themes/frontend/owlcarousel/owl.carousel.js') }}"></script>
    <script>
        $(function () {
            $('.wishlist_carousel').owlCarousel({
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                loop: false,
                nav: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                items: 2,
                dots: false,
                margin: 0,
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
                        items: 2
                    }
                }
            });
        })
    </script>
@endsection
