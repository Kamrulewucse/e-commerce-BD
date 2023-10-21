@extends('layouts.app')
@section('style')
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
            height: 42px;
        }

        h1.user-card-title {
            padding: 8px 0;
        }

        h1.other-box-title {
            margin: 25px 0;
        }

        .other-box-sub-title {
            font-size: 19px !important;
            margin: 0 !important;
            padding: 0 !important;
            margin-bottom: 25px !important;
        }

        input.form-control.register-input {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 5rem;
            text-align: left;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 1.5rem;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39, 0.575, 0.565, 1);
            padding: 0 1rem;
            line-height: 4.5rem;

        }

        .register-label {
            font-size: 13px;
            margin-bottom: 8px;
        }

        .select-input {
            height: 4.5rem;
            line-height: 3.5rem;
            border-radius: 0 !important;
            color: #19110b;

        }

        .date-of-birth-fieldset {
            margin: 0;
            padding: 0;
            border: 0;
        }

        .label {
            color: #19110b;
            display: block;
            margin: 0 0 0.5rem;
            font-weight: 400;
            letter-spacing: .4px;
        }

        .date-of-birth-fieldset legend {
            padding: 0;
        }

        .form-pattern .form-line .inputColumn, .formPattern1 .form-line .inputColumn, .formPattern2 .form-line .inputColumn, .formPattern3 .form-line .inputColumn, .formPattern4 .form-line .inputColumn {
            display: block;
            margin-bottom: 1.5rem;
        }

        @media only screen and (min-width: 48em) {
            .date-of-birth-fieldset .displayTableCell {
                padding-right: 0.5rem;
            }
        }

        .displayTableCell {
            display: table-cell;
        }

        select {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 5rem;
            text-align: left;
            font-family: "Louis Vuitton Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: normal;
            font-weight: 500;
            font-size: 1.5rem;
            line-height: 2;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39, 0.575, 0.565, 1);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2080%2080'%20focusable='false'%20aria-hidden='true'%20class='ui-icon-controls-chevron-down'%3E%3Cpath%20fill='%2319110b'%20fill-rule='evenodd'%20d='M46.2%2048.6L17.8%2020.3l-5.5%205.4%2028.4%2028.4%205.4%205.5.1.1.1-.1%205.3-4.5L80%2026.7l-5.5-6.4-28.3%2028.3z'/%3E%3C/svg%3E") no-repeat right 1rem top 50%;
            background-size: 3rem 1.8rem;
            max-width: 100%;
            padding: 0 4rem 0 1rem;
            position: relative;
            text-overflow: ellipsis;
        }

        .readonly-input {
            background: #f6f5f3 !important;
            border: none !important;
        }

        .modal-dialog {
            max-width: 775px;
        }

        button.close-modal-btn {
            background: transparent;
            border: none;
        }

        button.close-modal-btn i {
            color: #000;
            font-size: 23px;
            font-weight: normal !important;
        }

        .modal-title {
            font-weight: bold;
            margin-left: 17px;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem 30px;
        }

        .modal-footer {
            justify-content: flex-start;
        }

        .modal-footer {
            padding: 11px 27px;
        }

        .btn-modal-custom {
            padding: 0 4rem;
        }

        .address-book-add-btn {
            font-weight: normal;
            display: inline;
            font-size: 15px;
            padding: 15px 16px;
            background: #f6f5f3 !important;
        }

        .address-book-add-btn:hover {
            background: #EAE8E4 !important;
            border: 1.5px solid #19110B !important;
        }

        button {
            border: 1.5px solid #19110B !important;
        }

        .transferent-btn-style {
            background: transparent !important;
            color: #000 !important;
            border: 1.5px solid #19110B !important;
        }

        h2.other-box-name {
            font-weight: bold;
            font-size: 24px;
        }


        #address-book-add-new {
            overflow: hidden;
        }

        .address-new-hid-box {
            top: 100%;
            position: relative;
            transition: all .3s ease-out;
            background: #428bca;
            height: 100%;
        }

        a.cancel-btn-address {
            border: 1px solid #ddd;
            height: 45px;
            width: 45px;
            line-height: 42px;
            text-align: center;
            font-size: 23px;
            color: #000;
            font-weight: 400;
            margin-bottom: 15px;
        }

        @media (min-width: 320px) and (max-width: 400px) {
            .btn-next-bg-transparent {
                display: block;
            }


            .btn-next {
                text-align: center;
                color: #fff;
                line-height: 20px;
            }

            select {
                width: 106px;
            }
        }

        @media (min-width: 300px) and (max-width: 900px) {
            .btn-next-bg-transparent {
                display: block;
            }

            .btn-next {
                text-align: center;
                color: #fff;
                line-height: 20px;
            }

            select {
                width: 106px;
            }
        }

    </style>
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

        .header-title {
            float: left;
            /* padding: 10px; */
        }

        .mains-body {
            float: left;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .carts-body-part .mains-body .image-body {
            width: 400px;
            background: #F5F4F2;
            border: 6px solid #FFFFFF;
        }

        .product-details-head {
            padding: 20px;
        }

        .product-details-head h3 {
            font-size: 14px;
        }

        .product-details-head h2 {
            font-weight: bold;
        }

        .table-data {
            padding-left: 16px;
            padding-right: 16px;
        }

        .footers-body {
            padding-top: 10px;

        }

        .services .cards {
            display: inline-block;
            margin: 10px;
        }

        .services .cards:hover {
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
            width: 100px;
        }

        .contentSer .long-text {
            color: #000;
            padding-right: 8px;
        }

        .contentSer .long-text1 {
            color: #000;
            padding-right: 8px;
            text-decoration: underline;
        }

        .contentSer h3 {
            font-weight: bold;
        }

        .related-product {
            margin-top: 30px;
        }

        .related-product h1 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .checkout {
            margin-top: 20px;
            float: end;
        }

        .btn-style-2 {
            margin-top: 10px;
            background: linear-gradient(98deg, #193c7b, #009cde 93%);
        }

        .cart-info-data {
            border: 8px solid #FFFFFF;
            background: #F6F5F3;
            border-top: 1px solid #F6F5F3;
        }

        .bottom-info-data {
            padding-bottom: 40px;
            /* border-bottom: 1px solid #C5C5C5; */
        }

        .smart-cart {
            float: left;
            margin-right: 15px;
            font-size: 30px;
        }

        .carts-section {
            float: right;
        }

        .smart-carts-info {
            padding: 30px 20px 30px 20px;
            border-top: 1px solid #C5C5C5;
        }

        .smart-carts-info .carts-info .smart-cart {
            margin-top: 15px;
        }

        .text-info-main {
            margin: 0px;
            padding: 0px;
        }

        .small-text {
            font-weight: bold;
            font-size: 13PX;
            color: #000;
        }

        .small-text2 {
            font-size: 12px;
        }

        .carts-header-title .header-title h2 {
            color: #000;
            font-weight: bold;
        }

        .carts-header-title .header-title p {
            color: #000;
            text-decoration: underline;
        }

        .carts-header-title .header-title .qty-info {
            font-weight: normal;
            font-size: 16px;
        }

        .carts-header-title {
            margin-bottom: 20px;
        }

        .data-qty {
            padding: 8px 6px;
        }

        /* Identification page */
        .con-header {
            padding: 25px 22px;
        }

        .con-header .con-number {
            color: white;
            border: 1px solid #000;
            background: #000;
            padding: 3px 9px;
            border-radius: 50%;
            margin-right: 12px;
        }

        .con-header p {
            color: #000;
            font-weight: bold;
            font-size: 16px;
        }

        .middle-content-header {
        }

        .middle-content-header .middle-content {
            padding-bottom: 20px;
        }

        .middle-content-header .middle-content .email-title {
            color: #000;
        }

        .middle-content-header .middle-content .email-name {
            color: #000;
            font-weight: bold;
        }

        .welcome-content {
            padding-bottom: 10px;
        }

        .welcome-content .welcome-title {
            font-weight: bold;
            color: #000;
        }

        .welcome-content .welcome-name {
            color: #000;
        }

        .password-content .password-name label {
            color: #000;
        }

        .password-content .password-name input {
            color: #000;
            padding: 8px 8px;
        }

        .password-content .password-name .forgot-password a {
            color: #000;
            text-decoration: underline;
        }

        .password-name {
            padding-bottom: 25px;
        }

        .delivery-main {
            margin-top: 25px;
            padding: 10px 0;
        }

        .delivery-section .delivery-content .delivery-number {
            color: #BFBDBA;
            font-weight: bold;
            border: 3px solid #BFBDBA;
            padding: 3px 9px;
            border-radius: 50%;
            margin-right: 12px;
        }

        .delivery-number-data {
            color: #fff;
            font-weight: bold;
            border: 3px solid #000;
            background: #000;
            padding: 3px 9px;
            border-radius: 50%;
            margin-right: 12px;
        }

        .delivery-section .delivery-content p {
            color: #BFBDBA;
            font-weight: bold;
            font-size: 16px;
        }

        .shop-header .shop-cart-name {
            color: #000;
            font-weight: bold;
            font-size: 14px;
        }

        .shop-header .shop-content-qty {
            color: #000;
            font-size: 12px;
        }

        .shop-header .shop-content-link {
            color: #000;
            font-size: 12px;
            margin-left: 42px;
            font-weight: normal;
            text-decoration: underline;
        }

        .payment-order-part-view-page img {
            position: absolute;
            padding: 3px;
            height: 100px;
            left: 0;
            top: 0px;
            background: #F5F4F2;
        }

        .payment-order-part-view-page {
            position: relative;
            padding-bottom: 24px;
        }

        .collapse-btn {
            display: block;
        }

        .card {
            border-radius: 0;
            border-bottom: none;
        }

        .middle-content-header {
            padding: 15px 15px;
        }

        .btn-transparent-custom {
            background: #fff;
            color: #000;
        }

        .btn-transparent-custom:hover, .btn-black-custom:hover, .checkout-active:hover {
            background: #EAE8E4;
            color: #000 !important;
            border: 1.4px solid #000 !important;
        }

        .bd-custom-btn {
            min-height: 5rem;
            line-height: 5rem;
            border: 1.4px solid #000 !important;
        }

        .email-check-completed-show {
            display: none;
        }

        .authentication-checked-active {
            background: #5C7E08 !important;
            border: 1px solid #5C7E08 !important;
        }

        .single-delivery-option {
            position: relative;
        }

        .delivery_option_input {
            position: absolute;
        }

        .single-delivery-option {
            background: #F3F2F0;
            padding: 25px 6px;
        }

        .delivery_option_input {
            left: 12px;
            top: 44px;
        }

        .payment_option_input {
            position: absolute;
            left: 12px;
            top: 46px;
        }

        span.delivery-option-name {
            font-size: 14px;
            font-weight: bold;
        }

        span.delivery-option-status {
            margin-top: 11px;
            display: block;
            text-align: right;
            color: #000;
            font-weight: 500;
            padding: 0 13px;
        }

        .single-delivery-option {
            margin-bottom: 15px;
        }

        /* Side navigation */
        .slide-bar-prodect-details {
            padding-top: 40px;
            padding-left: 20px;
            border-bottom: 1px solid #DBDCDD;
        }

        .gift-apply a { /* For Mobile */
            background: #000;
            color: #ffffff;
            padding: 7px 30px;
            width: 338px;
            margin-left: 86px;
            margin-bottom: 18px;
            text-align: center;
        }

        .main-table-details {
            padding: 16px 0px 20px 0px;
        }

        .main-table-details .inner-content-details h3 {
            font-weight: 600;
            letter-spacing: -1px;
            font-size: 18px;
            padding-left: 0px;
        }

        .single-delivery-option-nav {
            position: relative;
        }

        .single-delivery-option-nav {
            padding: 25px 6px;
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
        }

        .delivery_option_input_data {
            position: absolute;
        }

        .delivery_option_input_data {
            left: 12px;
            top: 26px;
        }

        span.delivery-option-status-data a {
            margin-top: 0px;
            display: block;
            text-align: right;
            color: #000;
            font-weight: 600;
            padding: 0 13px;
            text-decoration: underline;
        }

        .slide-bar-login-area h3 {
            margin-left: 26px;
        }

        @media (min-width: 320px) and (max-width: 400px) {
            /* For Mobile */
            /*.col-8 {*/
            /*    flex: 0 0 auto;*/
            /*    width: 268px;*/
            /*    margin-left: 34px;*/
            /*}*/

            /*.col-4 {*/
            /*    flex: 0 0 auto;*/
            /*    width: 33.3333%;*/
            /*}*/

            span.delivery-option-status-data a {
                display: block;
                text-align: left;
                color: #000;
                font-weight: 500;
                padding-top: 5px;
                padding-left: 34px;
                text-decoration: underline;
            }

            .gift-apply a {
                background: #000;
                color: #ffffff;
                padding: 7px 30px;
                width: 338px;
                margin-left: 29px;
                margin-bottom: 18px;
                text-align: center;
            }
        }

        .register-input-datas {
            width: 331px;
        }

        .add-more-element {
            margin-bottom: 52px;
            background: #fff;
            color: #000;
            width: 467px;
        }

        .save-all-elements {
            width: 100%;
        }

        .new-data-addition {
            padding-top: 29px;
            padding-left: 8px;
        }

        .details-button-new {
            width: 100%;
            background: #fff;
            color: #000;
            border: 1px solid #000;
        }

        .details-button-new:hover {
            border: none;
            background: #EAE8E4;
            color: #000;
        }

        .fall-back {
            padding-bottom: 11px;
        }

        .fall-back i {
            padding: 15px 34px;
            background: #f1f1f1;
            color: #000;
        }

        .fall-back i:hover {
            background: #EAE8E4;
            color: #000;
        }

        .call-back {
            margin-top: 15px;
        }

        .form-check-input:checked {
            background-color: #000000;
            border-color: #000000;
        }

        .btn-primary:hover, .btn-dark:hover,.btn-check:focus + .btn-primary, .btn-primary:focus{
            color: #000;
            background-color: #eae8e4;
            border-color: #eae8e4 !important;
        }

        div#customer_new_mobile_add_area {
            margin: 0;
            padding: 0;
        }
        @media (max-width: 61.94em){
            .delivery_option_input_data {
                left: -12px !important;
            }
            .delivery_option_input {
                left: -18px;
            }
            .payment_option_input {
                left: -17px;
            }
        }
        @media (min-width: 320px) and (max-width: 400px){

        }
        .payment-order-part-view-page img {
            height: 54px;
        }
    </style>
    <style type="text/css">
        .lds-ring-custom-new,
        .lds-ring-custom-new div {
            box-sizing: border-box;
        }

        .lds-ring-wrapper {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            text-align: center;
            background: #000000b8;
            overflow-x: hidden;
            overflow-y: hidden;
            z-index: 99;
        }
        .lds-ring-custom-new {
            width: 100%;
            height: 100%;
            text-align: center;
            left: 47%;
            position: absolute;
            top: 47%;
        }
        .lds-ring-custom-new div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid #ffffff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #ffffff transparent transparent transparent;
            z-index: 9999;
        }
        .lds-ring-custom-new div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .lds-ring-custom-new div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring-custom-new div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring-custom-new {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .details-payment-issue {
            margin-left: 110px;
        }
        .payment-order-part-view-page img {
            height: 100px;
        }

        /*@media (max-width: 74.9375em){*/
        /*    .container-fluid {*/
        /*        padding-left: 1.5rem;*/
        /*        padding-right: 1.5rem;*/
        /*    }*/
        /*}*/
        /*@media (max-width: 61.94em){*/
        /*    .header-mobile {*/
        /*        display: block;*/
        /*        position: sticky;*/
        /*        top: -1px;*/
        /*        z-index: 2;*/
        /*    }*/
        /*}*/
    </style>
@endsection
@section('content')
    <div class="lds-ring-wrapper">
        <div class="lds-ring-custom-new">
            <div></div><div></div><div></div><div></div>
         </div>
    </div>
    <?php
    $isLoginCustomer = (auth()->check() && auth()->user()->role == \App\Enumeration\Role::$BUYER) ? true : false;
    ?>
    <div class="page-content-inner body-height-full">
        <div class="container">
            <div class="row pb--20 pt--20">
                <div class="col-12">
                    <div class="previous-back">
                        <i class="fa fa-long-arrow-left"></i>
                    </div>
                </div>
            </div>
            <form id="checkout-form">
                <div class="row pb--50  pb-md--60 pb-sm--40 pt-sm--60">
                    <div class="col-lg-8 mb-md--30">
                        <div class="carts-body-part">
                            <div class="row">
                                <div class="col-12 mb--15">
                                    <a href="#demo" class="collapse-btn" data-bs-toggle="collapse">
                                        <div class="card card-top-title">
                                            <div class="card-body">
                                                <div class="con-header">
                                                    <div class="con-content">
                                                        <p>
                                                            <span class="con-number authentication-checked {{ $isLoginCustomer ? 'active authentication-checked-active' : '' }}">1</span>IDENTIFICATION
                                                        </p>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="demo" class="collapse show">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="middle-content-header">
                                                    <div id="login-step-1" style="display: {{ $isLoginCustomer ? 'block' : 'none' }}">
                                                        Your email is <br> <b class="email-show">{{ auth()->user()->email ?? '' }}</b>
                                                    </div>
                                                    <div id="login-step-2" style="display: {{ $isLoginCustomer ? 'none' : 'block' }}">
                                                        <p>In order to better assist you,
                                                            please enter your email address before continuing your
                                                            purchase.</p>

                                                        <div  class="password-name">
                                                            <label for="email" class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email" class="form-control" name="email"
                                                                   id="email">
                                                            <span class="text-danger" id="login_email_error"></span>
                                                        </div>
                                                        <div  class="mb-3 mt-0 password-name">
                                                            <label for="email_checked" class="form-label">
                                                                <input type="checkbox" id="email_checked" name="email_checked">
                                                                Check the box if you would like to receive Bangladesh Drip emails.
                                                            </label>
                                                        </div>
                                                        <div class="col-6 offset-md-6 p-0 text-center">
                                                            <a type="button" id="customer-email-continue"
                                                               class="btn btn-dark w-100 bd-custom-btn btn-black-custom">Continue</a>
                                                        </div>
                                                    </div>
                                                    <div id="login-step-3" style="display: none">
                                                        <p><b>Welcome back!</b><br>
                                                            Please sign-in for us to assist you better.</p>
                                                        <div  class="password-name">
                                                            <input type="hidden" class="form-control" name="get_email"
                                                                   id="get_email">
                                                            <label for="password" class="form-label">Password <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" class="form-control"
                                                                   autocomplete="new-password" name="password"
                                                                   id="password">
                                                            <span class="text-danger" id="login_password_error"></span><br>
                                                            <a style="font-size: 11px;color: #000" href="{{ route('password.request') }}">Forgot your password?</a>
                                                        </div>
                                                        <div class="col-6 offset-md-6 p-0 text-center">
                                                            <a type="button" id="sign-in-checkout"
                                                               class="btn btn-dark w-100 bd-custom-btn btn-black-custom">Sign In</a>
                                                        </div>
                                                    </div>
                                                    <div id="login-step-4" class="login-step" style="display: {{ $isLoginCustomer ? 'block' : 'none' }}">
                                                        <div class="col-6 offset-md-6 pt-sm--30 text-center">
                                                            <a type="button" id="email_modify"
                                                               class="btn col-sm-12 offset-sm-12 btn-outline-dark w-100 bd-custom-btn btn-transparent-custom">Modify Email</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb--15">
                                    <div id="active-delivery"
                                         style="display: {{ $isLoginCustomer ? 'block' : 'none' }}">
                                        <a href="#demo2" class="collapse-btn" data-bs-toggle="collapse">
                                            <div class="card card-top-title">
                                                <div class="card-body">
                                                    <div class="con-header">
                                                        <div class="con-content">
                                                            <p><span class="con-number delivery-checked">2</span>DELIVERY
                                                                OPTIONS</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div id="demo2" class="collapse {{ $isLoginCustomer ? 'show' : '' }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="middle-content-header">
                                                        <a href="#" style="display: none" id="email-modify-final2"
                                                           role="button">Modify?</a>
                                                        <div class="password-content">
                                                            <div id="hide_address_content1">
                                                                <p id="hide_address_content"
                                                                   style="color: #000; font-weight:500;">Enter your
                                                                    country and city to see all available delivery
                                                                    options</p>
                                                                <div
                                                                    class=" mb-3 password-name delivery-check-completed-show">
                                                                    <label for="country" class="form-label">Country
                                                                        <span class="text-danger">*</span></label>
                                                                    <select style="width: 100% !important;" required
                                                                            class="form-control" name="country"
                                                                            id="country">
                                                                        <option value="">Select Country</option>
                                                                        @foreach($countries as $country)
                                                                            <option {{ auth()->check() ? auth()->user()->country_id == $country->id ? 'selected' : '' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div id="country_error" class="text-danger"></div>
                                                                </div>
                                                                <div
                                                                    class="mb-3 password-name delivery-check-completed-show">
                                                                    <label for="city" class="form-label">City <span
                                                                            class="text-danger">*</span></label>
                                                                    <select style="width: 100% !important;" required
                                                                            class="form-control" name="city" id="city">
                                                                        <option value="">Select City</option>
                                                                    </select>
                                                                    <div id="city_error" class="text-danger"></div>
                                                                </div>

                                                                <div class="row submit-section">
                                                                    <div
                                                                        class="delivery-check-completed-hide col-6 col-md-4 offset-md-8 text-center">
                                                                        <a type="button" id="delivery-check"
                                                                           class="btn btn-dark w-100 bd-custom-btn hide_address_content5 btn-black-custom">Continue</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 password-name delivery-check-completed-show"
                                                                id="hide_address_content2" style="display: none;">
                                                                <h3><b>DELIVER TO AN ADDRESS</b></h3>
                                                                <div id="country" class="text-success"></div>
                                                                <div class="delivery-option-area">
                                                                    @foreach($deliveryOptions as $key => $deliveryOption)
                                                                        @if($deliveryOption->sort <=2 || $deliveryOption->sort == 4 )
                                                                    <a data-id="{{ $deliveryOption->id }}" href="#delivery_address"
                                                                       class="toolbar-btn check-daliver-data{{ $key }} get_single_deliver_address" style="display: initial;">
                                                                        <div class="single-delivery-option">
                                                                            <input type="radio" value="{{ $deliveryOption->id }}" class="delivery_option_input" name="delivery_option" id="delivery_option{{ $key }}">
                                                                            <label for="delivery_option{{ $key}}" class="row">
                                                                            <span class="col-8 col-md-7 offset-md-1">
                                                                                <span class="delivery-option-name">{{ $deliveryOption->name }}</span>
                                                                                <p class="delivery-option-description">{{ $deliveryOption->delivery_duration }}</p>
                                                                            </span>
                                                                            <span class="col-4">
                                                                                @if($deliveryOption->id == 1)
                                                                                <span class="delivery-option-status">Free</span>
                                                                                @else
                                                                                    <span class="delivery-option-status">Fees {{ convertCurrencySign(convertCurrencyFlat($deliveryOption->delivery_fee)) }}</span>
                                                                                @endif
                                                                            </span>
                                                                            </label>
                                                                        </div>
                                                                    </a>
                                                                     @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 password-name delivery-check-completed-show"
                                                                id="hide_address_content3" style="display: none;">
                                                                <h3><b>DELIVER TO AN ADDRESS</b></h3>
                                                                <div id="country" class="text-success"></div>
                                                                <div class="delivery-option-area">
                                                                    @foreach($deliveryOptions as $key => $deliveryOption)
                                                                        @if($deliveryOption->sort == 3 || $deliveryOption->sort==6 )
                                                                    <a data-id="{{ $deliveryOption->id }}" href="#delivery_address"
                                                                       class="toolbar-btn check-daliver-data{{ $key }} get_single_deliver_address"
                                                                       style="display: initial;">
                                                                        <div class="single-delivery-option">
                                                                            <input type="radio" value="{{ $deliveryOption->id }}"
                                                                                   class="delivery_option_input"
                                                                                   name="delivery_option"
                                                                                   id="delivery_option{{ $key }}">
                                                                            <label for="delivery_option{{ $key}}" class="row">
                                                                            <span class="col-8 col-md-7 offset-md-1">
                                                                                <span class="delivery-option-name">{{ $deliveryOption->name }}</span>
                                                                                <p class="delivery-option-description">{{ $deliveryOption->delivery_duration }}</p>
                                                                            </span>
                                                                            <span class="col-4">
                                                                                <span class="delivery-option-status">Fees {{ convertCurrencySign(convertCurrencyFlat($deliveryOption->delivery_fee)) }}</span>
                                                                            </span>
                                                                            </label>
                                                                        </div>
                                                                    </a>
                                                                     @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="mb-20 mt-20" id="delivery_show_data" style="display: none; margin: 33px 0px;"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="inactive-delivery"
                                         style="display: {{ $isLoginCustomer ? 'none' : 'block' }}">
                                        <div class="card delivery-main">
                                            <div class="card-body">
                                                <div class="delivery-section">
                                                    <div class="delivery-content">
                                                        <p><span class="delivery-number">2</span>DELIVERY OPTIONS</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb--15">
                                    <div id="active-payment" style="display: none">
                                        <a href="#demo3" class="collapse-btn" data-bs-toggle="collapse">
                                            <div class="card card-top-title">
                                                <div class="card-body">
                                                    <div class="con-header">
                                                        <div class="con-content">
                                                            <p><span class="con-number payment-checked">3</span>PAYMENT
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div id="demo3" class="collapse">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="middle-content-header">
                                                        <div class="password-content">
                                                            <div id="payment_option_area" class="mb-3 password-name">
                                                                <div class="delivery-option-area" style="display: none">
                                                                    <input type="hidden" id="credit_card_id" name="credit_card_id">
                                                                    <a id="credit_card_payment" href="#payment_details"
                                                                       class="toolbar-btn check-payment-data1 get_single_payment"
                                                                       style="display: initial;">
                                                                        <div class="single-delivery-option">
                                                                            <input type="radio" value="1"
                                                                                   class="payment_option_input"
                                                                                   name="payment_option"
                                                                                   id="payment_option1">
                                                                            <label for="payment_option1" class="row">
                                                                            <span class="col-8 col-md-7 offset-md-1">
                                                                                <p class="delivery-option-description">Credit Card</p>
                                                                            </span>
                                                                            </label>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 password-name">
                                                                <a id="port_wallet_payment" href="#" class="check-payment-data2 get_single_payment"
                                                                   style="display: initial;">
                                                                    <div class="single-delivery-option">
                                                                        <input type="radio" value="2"
                                                                               class="payment_option_input"
                                                                               name="payment_option"
                                                                               id="payment_option2">
                                                                        <label for="payment_option2" class="row">
                                                                            <span class="col-8 col-md-7 offset-md-1">
                                                                                <p class="delivery-option-description">
                                                                                    <img height="50px" src="{{ asset('img/port_wallet.png') }}" alt="">
                                                                                </p>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="mb-20 mt-20" id="payment_show_data" style="display: none; margin: 33px 0;"></div>
                                                            <div class="row submit-section checkout_btn_area" style="display: none">
                                                                <div
                                                                    class="delivery-check-completed-hide col-6 col-md-4 offset-md-8 text-center">
                                                                    <a type="button" id="payment_checkout"
                                                                       class="btn btn-dark w-100 bd-custom-btn btn-black-custom">Continue</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="inactive-payment">
                                        <div class="card delivery-main">
                                            <div class="card-body">
                                                <div class="delivery-section">
                                                    <div class="delivery-content">
                                                        <p><span class="delivery-number">3</span>PAYMENT</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="cart-collaterals bottom-info-data" style="">
                                    <div class="cart-totals shop-header">
                                        <p class="shop-cart-name">MY SHOPPING CART<span class="shop-content-qty"> ({{ count($products) }})</span>
                                        </p>
                                    </div>
                                    <div class="row cart-totals">
                                        <div class="col-12">
                                            @foreach($products as $product)
                                                <div class="payment-order-part-view-page mb--15">
                                                    <img
                                                        src="{{ asset(colorTypeImages($product->id,$product->attributes->color_id,$product->attributes->type_id)[0]->thumbs ?? '') }}"
                                                        alt="">
                                                    <div class="details-payment-issue">
                                                        <h3 style="text-transform: uppercase">{{ $product->name }}</h3>
                                                        <p> {{ convertCurrencySign(convertCurrency($product->associatedModel->id,$product->attributes->color_id,$product->attributes->size_id) * $product->quantity) }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="cart-totals">
                                        <h5 class="mb--15">Cart totals</h5>
                                        <div class="table-content table-responsive">
                                            <table class="table order-table">
                                                <tbody>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>{{ convertCurrencySign($subTotal) }}</td>

                                                </tr>
                                                <tr id="shipping_fees_area">
                                                    <th>Shipping</th>
                                                    <td>
                                                        <span id="shipping_fees"> </span>
                                                    </td>
                                                </tr>

                                                <tr class="order-total">
                                                    <th style="font-weight:bold; color:#000;">Total</th>
                                                    <td>
                                                    <span class="product-price-wrapper">
                                                        <span id="total_order_amount"
                                                            class="money">{{ convertCurrencySign($subTotal) }}</span>

                                                    </span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Side Navigation for Address Start -->
            <aside class="side-navigation modal-dialog-scrollable side-navigation--left" id="delivery_address">
                <div class="side-navigation-wrapper modal-dialog-scrollable" id="blur_remove">
                    <div class="slide-bar-login-area">
                        <h3><span class="delivery-number-data">2</span>DELIVERY OPTIONS</h3>
                        <a href="#" id="delivery_address" data-dismiss="modal" class="btn-close"><i
                                class="dl-icon-close"></i></a>
                    </div>
                    <div class="side-navigation-inner">
                        <div class="main-table-details">
                            <div class="inner-content-details">

                                <div class="delivery-option-area" id="address-book-list-area-data">
                                    <h3>DELIVER TO AN ADDRESS</h3>
                                    <div id="address-list-area"></div>
                                    <div class="new-data-addition" style="padding-bottom: 30px;">
                                        <a href="#" class="btn details-button-new" id="add-new-address-data">Create a
                                            New Address</a>
                                    </div>
                                    <div style="background: #FFFFFF; height: 123px;" class="gift-apply">
                                        <nav class="navbar navbar-expand-sm navbar-dark fixed-bottom"
                                             style="background: #ffffff; padding-top: 25px;box-shadow: 0px -5px 10px 0px rgb(0 0 0 / 20%);">
                                            <a role="button" id="save-data-personal" class="btn-next">Continue</a>
                                        </nav>
                                    </div>
                                </div>

                                <div class="new-address-create" id="address-book-add-new-data"
                                     style="padding-bottom:50px; padding-top: 0px; display:none;">
                                    <div class="fall-back">
                                        <a role="button" id="new-address-cancel-data"><i
                                                class="fa fa-long-arrow-left"></i></a>
                                    </div>
                                    <h3>DELIVER TO AN ADDRESS</h3>

                                    <form id="add_new_address_form">
                                        <div class="row">
                                            <input type="hidden" id="edit_address_id" name="edit_address_id">

                                            <label class="col-12 register-label" for="description">DESCRIPTION (example:
                                                Home, Work...)
                                                <span class="form-group">
                                                <input type="text" name="description" id="description"
                                                       class="form-control register-input" placeholder="">
                                                    <span id="description_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="password">Title <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <select name="title" id="title" class="form-control register-input select-input">
                                                    @if(auth()->check())
                                                    <option {{ auth()->user()->title == 'Mr' ? 'selected' : '' }} value="Mr">Mr</option>
                                                    <option {{ auth()->user()->title == 'Mrs' ? 'selected' : '' }} value="Mrs">Mrs</option>
                                                    <option {{ auth()->user()->title == 'Ms' ? 'selected' : '' }} value="Ms">Ms</option>
                                                    <option {{ auth()->user()->title == 'Mx' ? 'selected' : '' }} value="Mx">Mx</option>
                                                    <option {{ auth()->user()->title == null ? 'selected' : '' }} value="null">Prefer not to say</option>
                                                    @else
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="Mx">Mx</option>
                                                        <option value="null">Prefer not to say</option>
                                                    @endif
                                                    <option value="null">Prefer not to say</option>
                                                </select>
                                                    <span id="title_error" class="text-danger"></span>
                                            </span>
                                            </label>
                                            <label class="col-12 register-label" for="address_first_name">First Name
                                                Kindly insert English characters only when completing your
                                                information
                                                <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" name="first_name" id="first_name"
                                                       class="form-control register-input" value="{{ auth()->check()? auth()->user()->first_name: '' }}">
                                                    <span id="first_name_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="last_name">Last Name <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" name="last_name" id="last_name"
                                                       class="form-control register-input" value="{{ auth()->check()? auth()->user()->last_name: '' }}">
                                                <span id="last_name_error" class="text-danger"></span>
                                                </span>
                                            </label>

                                            <label class="col-12 register-label" for="delivery_address">Delivery Address
                                                <span class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" name="delivery_address" id="delivery_address_field"
                                                       class="form-control register-input">

                                                <span id="delivery_address_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="apartment_details">Building Name,
                                                Apartment # ,Villa #... (Optional)
                                                <span class="form-group">
                                                <input type="text" name="apartment_details" id="apartment_details"
                                                       class="form-control register-input">

                                                <span id="apartment_details_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="country">Country <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <select name="country" id="customer_country"
                                                        class="form-control register-input select-input">
                                                    <option value="">Select Your Country</option>
{{--                                                    @foreach($countries as $country)--}}
{{--                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
{{--                                                    @endforeach--}}
                                                </select>
                                                    <span id="customer_country_error" class="text-danger"></span>
                                                </span>
                                            </label>

                                            <label class="col-12 register-label" for="customer_city">City <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                     <select name="city" id="customer_city"
                                                             class="form-control register-input select-input">
                                                    <option value="">Select City</option>
                                                </select>
                                                <span id="customer_city_error" class="text-danger"></span>
                                                </span>
                                            </label>

                                            <label class="col-12 register-label" for="area">Area<span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" name="area"
                                                       id="area" class="form-control register-input"
                                                       placeholder="">
                                                <span id="area_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <div id="customer_new_mobile_add_area">
                                                <span class="new_mobile_item">
                                                    <label class="col-12 register-label" for="mobile_no_type">Phone Number
                                                    <span class="form-group">
                                                        <select name="mobile_no_type_1"
                                                                class="mobile_no_type_class form-control register-input select-input">
                                                            <option value="Mobile">Mobile</option>
                                                            <option value="Home">Home</option>
                                                            <option value="work">Work</option>
                                                        </select>
                                                    </span>
                                                </label>
                                                 <div class="col-12 field_wrapper">
                                                    <fieldset class="date-of-birth-fieldset">
                                                        <div class="inputColumn pb-3 row">
                                                            <div class="col-12 col-md-3">
                                                                <select class="mobile_no_code_class mobile_no_code_1"
                                                                        name="mobile_no_code_1">
                                                                    <option value="">Phone Code</option>
{{--                                                                    @foreach($phoneCodes as $phoneCode)--}}
{{--                                                                        <option value="{{ $phoneCode->phonecode }}">--}}
{{--                                                                            +{{ $phoneCode->phonecode }}</option>--}}
{{--                                                                    @endforeach--}}

                                                                </select>
                                                            </div>
                                                           <div class="col-12 col-md-9">
                                                               <input width="100%" type="text" name="mobile_no_1"
                                                                      class="mobile_no_class form-control register-input register-input-datas">
                                                                <span class="text-danger mobile_no_1_error"></span>
                                                           </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                               </span>
                                            </div>

                                            <div class="col-6 add_button_area">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-dark add_button add-more-element"
                                                   title="Add Attribute" style="text-transform: inherit"> <i
                                                        class="fa fa-mobile-phone"></i> Add a Phone Number</a>
                                            </div>
                                            <div class="col-6 remove_button_area" style="display: none">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-dark remove_button add-more-element"
                                                   title="Remove Attribute" style="text-transform: inherit"> <i
                                                        class="fa fa-mobile-phone"></i> Remove a Phone Number</a>
                                            </div>
                                        </div>
                                        <button id="save-new-address" type="button"
                                                class="btn btn-primary save-all-elements save-new-address">Continue
                                        </button>
                                    </form>
                                    <div class="call-back">
                                        <a role="button" id="back_to_previous_navigation"
                                           class="btn details-button-new">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-description-navbar" style="padding-top: 25px;">
                            <p style="font-size: 13px;" id="productDescription"></p>
                        </div>
                    </div>
                </div>
            </aside>
            <aside class="side-navigation modal-dialog-scrollable side-navigation--left" id="payment_details">
                <div class="side-navigation-wrapper modal-dialog-scrollable" id="blur_remove">
                    <div class="slide-bar-login-area">
                        <h3><span class="delivery-number-data">3</span>Payment</h3>
                        <a href="#" id="payment_btn_close" data-dismiss="modal" class="btn-close"><i
                                class="dl-icon-close"></i></a>
                    </div>
                    <div class="side-navigation-inner">
                        <div class="main-table-details">
                            <div class="inner-content-details">
                                <div class="delivery-option-area" id="payment-list-area-data">

                                    <h3>CREDIT CARD</h3>
                                    <div id="credit-card-list"></div>
                                    <div class="new-data-addition" style="padding-bottom: 30px;">
                                        <a href="#" class="btn details-button-new" id="add-new-payment-card">ADD A
                                            CREDIT CARD</a>
                                    </div>
                                    <div style="background: #FFFFFF; height: 123px;" class="gift-apply">
                                        <nav class="navbar navbar-expand-sm navbar-dark fixed-bottom"
                                             style="background: #ffffff; padding-top: 25px;box-shadow: 0px -5px 10px 0px rgb(0 0 0 / 20%);">
                                            <a role="button" id="credit_card_payment_continue" class="btn-next">Continue</a>
                                        </nav>
                                    </div>
                                </div>
                                <div class="new-address-create" id="payment-add-new-card"
                                     style="padding-bottom:150px; padding-top: 25px; display:none;">
                                    <div class="fall-back">
                                        <a role="button" id="payment-cancel-card"><i class="fa fa-long-arrow-left"></i></a>
                                    </div>
                                    <form  id="credit_card_form">
                                        <div class="row">
                                            <label class="col-12 register-label" for="card_number">Credit Card Number <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" id="card_number" name="card_number"
                                                       class="form-control register-input">
                                                <span id="card_number_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="card_holder">Name of Card Holder <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" id="card_holder" name="card_holder"
                                                       class="form-control register-input">
                                                <span id="card_holder_error" class="text-danger"></span>
                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="card_expiry">Expiration Date <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" id="card_expiry" name="card_expiry"
                                                       class="form-control register-input" placeholder="MM/YY">

                                                <span id="card_expiry_error" class="text-danger"></span>

                                                </span>
                                            </label>
                                            <label class="col-12 register-label" for="security_code">Security Code <span
                                                    class="text-danger">*</span>
                                                <span class="form-group">
                                                <input type="text" id="security_code" name="security_code"
                                                       class="form-control register-input">

                                                <span id="security_code_error" class="text-danger"></span>

                                                </span>
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary save-all-elements save-new-address card-save" id="card_save">Continue</button>

                                    </form>
                                    <div class="call-back">
                                        <a role="button" id="back_to_previous_payment_listback_to_previous_navigation"
                                           class="btn details-button-new">Cancel</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="product-description-navbar" style="padding-top: 25px;">
                            <p style="font-size: 13px;" id="productDescription"></p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <template id="add_mobile_number_template">
       <span class="new_mobile_item">
            <label class="col-12 register-label" for="mobile_no_type">Phone Number
            <span class="form-group">
            <select name="mobile_no_type" class="mobile_no_type_class form-control register-input select-input">
            <option value="Mobile">Mobile</option>
            <option value="Home">Home</option>
            <option value="work">Work</option>
            </select>
            </span>
            </label>
            <div class="col-12 field_wrapper">
            <fieldset class="date-of-birth-fieldset">
            <div class="inputColumn row pb-3">
            <div class="col-12 col-md-3">
                <select class="mobile_no_code_class mobile_no_code_1" name="mobile_no_code">
                    <option>Phone Code</option>
                    @foreach($phoneCodes as $phoneCode)
                        <option value="{{ $phoneCode->phonecode }}">
                            +{{ $phoneCode->phonecode }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-9">
                 <input style="width: 100%" type="text" name="mobile_no"
                        class="mobile_no_class form-control register-input register-input-datas">
                <span class="text-danger"></span>
            </div>
            </div>
            </fieldset>
            </div>
            </span>
    </template>
@endsection
@section('script')
    <script>
        $(function () {
            var citySelected = '{{ old('city') }}';
            $('#country').change(function () {
                var countryId = $(this).val();


                //$('#customer_country').val(countryId);
                $('#mobile_no_code_1').val("change");


                $('#city').html('<option value="">Select City</option>');
                $('.mobile_no_code_1').html('<option value="">Phone Code</option>');
                $('#customer_country').html('<option value="">Select Country</option>');

                if (countryId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_city') }}",
                        data: {countryId: countryId}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            if (citySelected == item.id)
                                $('#city').append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                            else
                                $('#city').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    });

                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_customer_country') }}",
                        data: {countryId: countryId}
                    }).done(function (data) {
                        $('#customer_country').append('<option value="' + data.id + '" selected>' + data.name + '</option>');
                    });

                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_phone_code') }}",
                        data: {countryId: countryId}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            if (countryId == item.id)
                                $('.mobile_no_code_1').append('<option value="' + item.phonecode + '" selected>' + "+"+ item.phonecode + '</option>');
                            else
                                $('.mobile_no_code_1').append('<option value="' + item.phonecode + '">' + item.phonecode + '</option>');
                        });
                    });
                }
            });

            $("#city").change(function (){
                var cityId = $(this).val();
                $('#customer_city').html('<option value="">Select City</option>');
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_customer_city') }}",
                    data: {cityId: cityId}
                }).done(function (data) {
                    $('#customer_city').append('<option value="' + data.id + '" selected>' + data.name + '</option>');
                });
                //$('#customer_city').val(cityId);
            })

            $('#country').trigger("change");


            $("#add-new-address-data").click(function () {
                $("#edit_address_id").val(' ');
                $("#address-book-add-new-data").show();
                $("#address-book-list-area-data").hide();
            })

            $("#new-address-cancel-data").click(function () {
                $("#address-book-add-new-data").hide();
                $("#address-book-list-area-data").show();
            })

            $("#back_to_previous_navigation").click(function () {
                $("#address-book-add-new-data").hide();
                $("#address-book-list-area-data").show();
            })

            $(".edit-details-data").click(function () {
                $("#address-book-edit-now-data").show();
                $("#address-book-list-area-data").hide();
            })
            $("#edit-address-cancel-data").click(function () {
                $("#address-book-edit-now-data").hide();
                $("#address-book-list-area-data").show();
            })

            $("#back_to_previous_navigation_data").click(function () {
                $("#address-book-edit-now-data").hide();
                $("#address-book-list-area-data").show();
            })


            $("#add-new-payment-card").click(function () {
                $("#payment-add-new-card").show();
                $("#payment-list-area-data").hide();
            })

            $("#payment-cancel-card").click(function () {
                $("#payment-list-area-data").show();
                $("#payment-add-new-card").hide();
            })

            $("#back_to_previous_payment_list").click(function () {
                $("#payment-list-area-data").show();
                $("#payment-add-new-card").hide();
            })

            $('#authentication-check').click(function () {
                var email = $('#email').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('check_authentication') }}",
                    data: {email: email}
                }).done(function (response) {
                    if (response.success) {
                        if (response.authorized) {
                            //$('#email').val(' ');
                            $(".email-show").html(response.email);
                            $(".email-check-completed-hide").hide();
                            $(".email-check-completed-show").show();
                        } else {
                            $(".email-show").html(response.email);
                            $(".email-check-completed-hide").hide();

                            $(".success_email_area").show();
                            $("#email-modify-final").show();
                            $(".authentication-checked").addClass('authentication-checked-active');
                            $("#inactive-delivery").hide();
                            $("#active-delivery").show();
                            $("#demo2").addClass('show');
                            $("#demo2").removeClass('collapse');
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                });
            });

            $('#customer-email-continue').click(function () {
                var email = $('#email').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('customer_email_with_continue') }}",
                    data: {email: email}
                }).done(function (response) {
                    if (response.success) {
                        if(response.getLogin){
                            $(".email-show").html(response.email);
                            $("#get_email").val(response.email);
                            $("#login-step-1").show();
                            $("#login-step-2").hide();
                            $("#login-step-3").show();

                            $("#email_modify_area").hide();
                            $("#customer-email-continue-area").hide();
                        }else{
                            $(".email-show").html(response.email);
                            $("#login-step-1").show();
                            $("#login-step-2").hide();
                            $("#login-step-4").show();

                            $(".authentication-checked").addClass('authentication-checked-active');
                            $("#inactive-delivery").hide();
                            $("#active-delivery").show();

                            $("#demo2").addClass('show');
                            $("#demo2").removeClass('collapse');
                        }
                    } else {
                        $("#login_email_error").html('');
                        if (response.errors) {
                            if (response.errors.email) {
                                $("#login_email_error").html(response.errors.email);
                            }
                        }

                    }
                });
            });
            $('#sign-in-checkout').click(function () {
                var email = $('#get_email').val();
                var password = $('#password').val();

                $.ajax({
                    method: "POST",
                    url: "{{ route('sign_in_checkout') }}",
                    data: {email: email, password: password}
                }).done(function (response) {
                    if (response.success) {
                        $(".email-show").html(response.email);
                        $(".authentication-checked").addClass('authentication-checked-active');
                        $("#inactive-delivery").hide();
                        $("#active-delivery").show();
                        $("#demo2").addClass('show');
                        $("#demo2").removeClass('collapse');

                        $("#login-step-3").hide();
                        $("#login-step-4").show();
                    } else {
                        $("#login_password_error").html('');
                        if (response.errors) {
                            if (response.errors.password) {
                                $("#login_password_error").html(response.errors.password);
                            }
                        }
                        if(response.success == false){
                            if (response.email_error) {
                                $("#login_password_error").html(response.email_error);
                            }
                        }
                    }
                });
            });

            $('#email_modify').click(function () {
               $('#login-step-1').hide();
               $('#login-step-2').show();
               $('#login-step-3').hide();
               $('#login-step-4').hide();
                $("#inactive-delivery").show();
                $("#active-delivery").hide();
            });

            $('#delivery-check').click(function () {
                $("#country_error").html(' ');
                $("#city_error").html(' ');



                if ($("#country").val() == '') {
                    $("#country_error").html('The country field is required.');
                    return false;
                }
                if ($("#city").val() == '') {
                    $("#city_error").html('The city field is required.');
                    return false;
                }

                if ($("#city").val() == 348 && $("#country").val() == 18 ) {
                    $("#hide_address_content2").show();
                    $("#hide_address_content3").hide();
                }else if($("#country").val() == 18){
                    $("#hide_address_content3").show();
                    $("#hide_address_content2").hide();
                }else{
                    $("#hide_address_content3").hide();
                    $("#hide_address_content2").hide();
                }



            });

            $('#payment-check').click(function () {

                var payment_id = $("input[name='payment_option']:checked").val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('check_payment') }}",
                    data: {payment_option: payment_id}
                }).done(function (response) {
                    if (response.success) {
                        $("#demo3").removeClass('show');
                        $("#demo3").addClass('collapse');
                        $(".payment-checked").addClass('authentication-checked-active');
                        $("#checkout-active").show();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                });
            });

            $(document).ready(function () {
                // Product Attributes add/removed script
                var maxField = 3;
                var addButton = $('.add_button');
                var removeButton = $('.remove_button');
                var wrapper = $('#customer_new_mobile_add_area');
                var fieldHTML = $("#add_mobile_number_template").html(); //New input field html
                var x = 1;
                //Once add button is clicked
                $('body').on('click', '.add_button', function () {
                    var mobileNumberArea = $("#customer_new_mobile_add_area span.new_mobile_item").length;

                    if (mobileNumberArea == 2) {
                        $('.add_button_area').hide();
                        $('.remove_button_area').show();
                        $(wrapper).append(fieldHTML);
                        var countryId = $('#customer_country').val();
                        if (countryId != '') {
                            $('.mobile_no_code_1').html('<option value="">Phone Code</option>');
                            $.ajax({
                                method: "GET",
                                url: "{{ route('get_phone_code') }}",
                                data: {countryId: countryId}
                            }).done(function (data) {
                                $.each(data, function (index, item) {
                                    if (countryId == item.id)
                                        $('.mobile_no_code_1').append('<option value="' + item.phonecode + '" selected>' + "+"+ item.phonecode + '</option>');
                                    else
                                        $('.mobile_no_code_1').append('<option value="' + item.phonecode + '">' + item.phonecode + '</option>');
                                });
                            });
                        }
                        //$('#customer_country').trigger("change");

                    } else {
                        $('.add_button_area').show();
                        $('.remove_button_area').hide();
                        $(wrapper).append(fieldHTML);
                        var countryId = $('#customer_country').val();
                        if (countryId != '') {
                            $('.mobile_no_code_1').html('<option value="">Phone Code</option>');
                            $.ajax({
                                method: "GET",
                                url: "{{ route('get_phone_code') }}",
                                data: {countryId: countryId}
                            }).done(function (data) {
                                $.each(data, function (index, item) {
                                    if (countryId == item.id)
                                        $('.mobile_no_code_1').append('<option value="' + item.phonecode + '" selected>' + "+"+ item.phonecode + '</option>');
                                    else
                                        $('.mobile_no_code_1').append('<option value="' + item.phonecode + '">' + item.phonecode + '</option>');
                                });
                            });
                        }
                        //$('#customer_country').trigger("change");

                    }
                    var selectMobileChild_1 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(1)");
                    var selectMobileChild_2 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(2)");
                    var selectMobileChild_3 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(3)");
                    selectMobileChild_1.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_1');
                    selectMobileChild_2.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_2');
                    selectMobileChild_3.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_3');

                    selectMobileChild_1.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_1');
                    selectMobileChild_2.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_2');
                    selectMobileChild_3.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_3');
                    selectMobileChild_1.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_1');
                    selectMobileChild_2.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_2');
                    selectMobileChild_3.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_3');

                    selectMobileChild_1.closest('span').find('.text-danger').addClass('mobile_no_1_error');
                    selectMobileChild_2.closest('span').find('.text-danger').addClass('mobile_no_2_error');
                    selectMobileChild_3.closest('span').find('.text-danger').addClass('mobile_no_3_error');

            });

                //Once remove button is clicked
                $('body').on('click', '.remove_button', function () {

                    var mobileNumberArea = $("#customer_new_mobile_add_area span.new_mobile_item").length;

                    if (mobileNumberArea == 2) {
                        $('.add_button_area').show();
                        $('.remove_button_area').hide();
                        $("#customer_new_mobile_add_area span.new_mobile_item").last().remove();
                    } else {
                        $('.add_button_area').hide();
                        $('.remove_button_area').show();
                        $("#customer_new_mobile_add_area span.new_mobile_item").last().remove();
                    }
                    var selectMobileChild_1 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(1)");
                    var selectMobileChild_2 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(2)");
                    var selectMobileChild_3 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(3)");
                    selectMobileChild_1.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_1');
                    selectMobileChild_2.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_2');
                    selectMobileChild_3.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_3');

                    selectMobileChild_1.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_1');
                    selectMobileChild_2.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_2');
                    selectMobileChild_3.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_3');
                    selectMobileChild_1.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_1');
                    selectMobileChild_2.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_2');
                    selectMobileChild_3.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_3');

                    selectMobileChild_1.closest('span').find('.text-danger').addClass('mobile_no_1_error');
                    selectMobileChild_2.closest('span').find('.text-danger').addClass('mobile_no_2_error');
                    selectMobileChild_3.closest('span').find('.text-danger').addClass('mobile_no_3_error');

                });
            });

            $(document).ready(function () {
                $(".check-daliver-data0").click(function () {
                    $("#delivery_option0").prop("checked", true);
                    $("#delivery_option1").prop("checked", false);
                });
                $(".check-daliver-data1").click(function () {
                    $("#delivery_option0").prop("checked", false);
                    $("#delivery_option1").prop("checked", true);
                });
            });

            $(document).ready(function () {
                $(".check-payment-data1").click(function () {
                    $("#payment_option1").prop("checked", true);
                    $("#payment_option2").prop("checked", false);
                });
                $(".check-payment-data2").click(function () {
                    $("#payment_option2").prop("checked", true);
                    $("#payment_option1").prop("checked", false);
                });
            });

            $('#save-data-personal').click(function () {

                $(".delivery-checked").addClass('authentication-checked-active');
                $("#inactive-payment").hide();
                $("#active-payment").show();
                $("#demo3").addClass('show');
                $("#demo3").removeClass('collapse');
                $("#delivery_address .btn-close").click()

                $("#demo2").show();
                $("#hide_address_content1").hide();
                $("#hide_address_content2").hide();
                $("#hide_address_content3").hide();
                $("#delivery_show_data").show();
            });


        })
    </script>
    <script>

        $("#cash_on_delivery_payment,#credit_card_payment_continue").click(function (){
            $(".checkout_btn_area").show();
        })

         function cardSelect(id){
            $("#credit_card_id").val(id);
         }
        function deleteCard(id) {

            $.ajax({
                type: 'GET',
                url: "{{ route('card_details_delete') }}",
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    if(data.success){
                        $("#credit-card-list").html(data.cards);
                    }
                }
            })
        }

        $('#credit_card_payment').click(function (event) {

            $.ajax({
                type: 'GET',
                url: "{{ route('get_customer_address_details') }}",
            }).done(function (response) {
                if(response.loggedIn){
                    $("#address-book-add-new-data").hide();
                    $("#address-book-list-area-data").show();
                    $('#address-list-area').html(response.address_list);
                    $('#delivery_show_data').html(response.address_selected);

                }else{
                    $("#address-book-add-new-data").show();
                    $("#address-book-list-area-data").hide();
                    $("#address-book-add-new-data .fall-back").hide();
                    $('#address-list-area').html('');
                    $('#delivery_show_data').html('');
                }

            });
        });


        function customerAddress(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('customer_address_details') }}",
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    if(response.success === false){
                         var data = response.guest_address_details
                        $("#edit_address_id").val(data.id);
                        $("#description").val(data.description);
                        $("#title").val(data.title);
                        $("#first_name").val(data.first_name);
                        $("#last_name").val(data.last_name);
                        $("#customer_country").val(data.country);
                        $("#delivery_address_field").val(data.delivery_address);
                        $("#apartment_details").val(data.apartment_details);
                        $("#customer_city").val(data.city);
                        $("#area").val(data.area);

                        var mobileNumberArea = $("#customer_new_mobile_add_area span.new_mobile_item").length;

                        if (mobileNumberArea == 2) {
                            $('.add_button_area').hide();
                            $('.remove_button_area').show();
                        } else {
                            $('.add_button_area').show();
                            $('.remove_button_area').hide();
                        }

                        if(data.mobile_no_1){
                            $('select[name="mobile_no_type_1"]').val(data.mobile_no_type_1);
                            $('input[name="mobile_no_1"]').val(data.mobile_no_1);
                            $('select[name="mobile_no_code_1"]').val(data.mobile_no_code_1);
                        }
                        if(data.mobile_no_2 != null){
                            var wrapper = $('#customer_new_mobile_add_area');
                            var fieldHTML = $("#add_mobile_number_template").html(); //New input field html
                            $(wrapper).append(fieldHTML);

                            var selectMobileChild_2 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(2)");
                            selectMobileChild_2.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_2');
                            selectMobileChild_2.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_2');
                            selectMobileChild_2.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_2');
                            selectMobileChild_2.closest('span').find('.text-danger').addClass('mobile_no_2_error');


                            $('select[name="mobile_no_type_2"]').val(data.mobile_no_type_2);
                            $('input[name="mobile_no_2"]').val(data.mobile_no_2);
                            $('select[name="mobile_no_code_2"]').val(data.mobile_no_code_2);
                        }
                        if(data.mobile_no_3 != null){

                            var wrapper = $('#customer_new_mobile_add_area');
                            var fieldHTML = $("#add_mobile_number_template").html(); //New input field html
                            $(wrapper).append(fieldHTML);

                            var selectMobileChild_3 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(3)");
                            selectMobileChild_3.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_3');
                            selectMobileChild_3.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_3');
                            selectMobileChild_3.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_3');
                            selectMobileChild_3.closest('span').find('.text-danger').addClass('mobile_no_3_error');

                            $('select[name="mobile_no_type_3"]').val(data.mobile_no_type_3);
                            $('input[name="mobile_no_3"]').val(data.mobile_no_3);
                            $('select[name="mobile_no_code_3"]').val(data.mobile_no_code_3);
                        }
                        var mobileNumberArea = $("#customer_new_mobile_add_area span.new_mobile_item").length;

                        if (mobileNumberArea == 3) {
                            $('.add_button_area').hide();
                            $('.remove_button_area').show();
                        } else {
                            $('.add_button_area').show();
                            $('.remove_button_area').hide();
                        }

                        var setCountryId = data.country;
                        var selectStateId = data.city;
                        $('#customer_city').html('<option value=""City</option');
                        if (setCountryId != '') {
                            $.ajax({
                                method: "GET",
                                url: "{{ route('get_city') }}",
                                data: {countryId: setCountryId}
                            }).done(function (data) {
                                $.each(data, function (index, item) {
                                    if (selectStateId == item.id)
                                        $('#customer_city').append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                                    else
                                        $('#customer_city').append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                            });
                            $("#delivery_address").addClass('open');
                            $(".ai-global-overlay").addClass('overlay-open');
                            $("#address-book-add-new-data").show();
                            $("#address-book-list-area-data").hide();
                        }
                    }else {
                        $("#edit_address_id").val(response.id);
                        $("#description").val(response.description);
                        $("#title").val(response.title);
                        $("#first_name").val(response.first_name);
                        $("#last_name").val(response.last_name);
                        $("#customer_country").val(response.country_id);
                        $("#delivery_address_field").val(response.delivery_address);
                        $("#apartment_details").val(response.apartment_details);
                        $("#customer_city").val(response.state_id);
                        $("#area").val(response.area);

                        var mobileNumberArea = $("#customer_new_mobile_add_area span.new_mobile_item").length;

                        if (mobileNumberArea == 2) {
                            $('.add_button_area').hide();
                            $('.remove_button_area').show();
                        } else {
                            $('.add_button_area').show();
                            $('.remove_button_area').hide();
                        }

                        if (response.mobile_no_1) {
                            $('select[name="mobile_no_type_1"]').val(response.mobile_no_type_1);
                            $('input[name="mobile_no_1"]').val(response.mobile_no_1);
                            $('select[name="mobile_no_code_1"]').val(response.mobile_no_code_1);
                        }
                        if (response.mobile_no_2 != null) {
                            var wrapper = $('#customer_new_mobile_add_area');
                            var fieldHTML = $("#add_mobile_number_template").html(); //New input field html
                            $(wrapper).append(fieldHTML);

                            var selectMobileChild_2 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(2)");
                            selectMobileChild_2.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_2');
                            selectMobileChild_2.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_2');
                            selectMobileChild_2.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_2');
                            selectMobileChild_2.closest('span').find('.text-danger').addClass('mobile_no_2_error');


                            $('select[name="mobile_no_type_2"]').val(response.mobile_no_type_2);
                            $('input[name="mobile_no_2"]').val(response.mobile_no_2);
                            $('select[name="mobile_no_code_2"]').val(response.mobile_no_code_2);
                        }
                        if (response.mobile_no_3 != null) {

                            var wrapper = $('#customer_new_mobile_add_area');
                            var fieldHTML = $("#add_mobile_number_template").html(); //New input field html
                            $(wrapper).append(fieldHTML);

                            var selectMobileChild_3 = $("#customer_new_mobile_add_area span.new_mobile_item:nth-child(3)");
                            selectMobileChild_3.closest('span').find('.mobile_no_type_class').attr('name', 'mobile_no_type_3');
                            selectMobileChild_3.closest('span').find('.mobile_no_code_class').attr('name', 'mobile_no_code_3');
                            selectMobileChild_3.closest('span').find('.mobile_no_class').attr('name', 'mobile_no_3');
                            selectMobileChild_3.closest('span').find('.text-danger').addClass('mobile_no_3_error');

                            $('select[name="mobile_no_type_3"]').val(response.mobile_no_type_3);
                            $('input[name="mobile_no_3"]').val(response.mobile_no_3);
                            $('select[name="mobile_no_code_3"]').val(response.mobile_no_code_3);
                        }
                        var mobileNumberArea = $("#customer_new_mobile_add_area span.new_mobile_item").length;

                        if (mobileNumberArea == 3) {
                            $('.add_button_area').hide();
                            $('.remove_button_area').show();
                        } else {
                            $('.add_button_area').show();
                            $('.remove_button_area').hide();
                        }

                        var setCountryId = response.country_id;
                        var selectStateId = response.state_id;
                        $('#customer_city').html('<option value="">City</option');
                        if (setCountryId != '') {
                            $.ajax({
                                method: "GET",
                                url: "{{ route('get_city') }}",
                                data: {countryId: setCountryId}
                            }).done(function (data) {
                                $.each(data, function (index, item) {
                                    if (selectStateId == item.id)
                                        $('#customer_city').append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                                    else
                                        $('#customer_city').append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                            });

                        $("#delivery_address").addClass('open');
                        $(".ai-global-overlay").addClass('overlay-open');
                        $("#address-book-add-new-data").show();
                        $("#address-book-list-area-data").hide();
                        }
                    }
                }
            })

        }

        $('#save-new-address').click(function (event) {
            $("#description_error").html(' ');
            $("#title_error").html(' ');
            $("#first_name_error").html(' ');
            $("#last_name_error").html(' ');
            $("#customer_country_error").html(' ');
            $("#delivery_address_error").html(' ');
            $("#apartment_details_error").html(' ');
            $("#customer_city_error").html(' ');
            $("#area_error").html(' ');
            $(".mobile_no_error_1").html(' ');
            $(".mobile_no_error_2").html(' ');
            $(".mobile_no_error_3").html(' ');
            var add_new_address_form = new FormData($('#add_new_address_form')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('customer_address_details_post') }}",
                data: add_new_address_form,
                processData: false,
                contentType: false,
            }).done(function (response) {
                if (response.success) {
                    $("#address-book-add-new-data").hide();
                    $("#address-book-list-area-data").show();
                    $('#address-list-area').html(response.address_list);
                    $('#delivery_show_data').html(response.address_selected);
                }else if(response.success == false){

                    $('#delivery_show_data').html(response.address_selected);

                    $(".delivery-checked").addClass('authentication-checked-active');
                    $("#inactive-payment").hide();
                    $("#active-payment").show();
                    $("#demo3").addClass('show');
                    $("#demo3").removeClass('collapse');
                    $("#delivery_address .btn-close").click()

                    $("#demo2").show();
                    $("#hide_address_content1").hide();
                    $("#hide_address_content2").hide();
                    $("#hide_address_content3").hide();
                    $("#delivery_show_data").show();

                }else{
                    if (response.errors) {

                        if (response.errors.description) {
                            $("#description_error").html(response.errors.description);
                        }
                        if (response.errors.title) {
                            $("#title_error").html(response.errors.title);
                        }
                        if (response.errors.first_name) {
                            $("#first_name_error").html(response.errors.first_name);
                        }
                        if (response.errors.last_name) {
                            $("#last_name_error").html(response.errors.last_name);
                        }
                        if (response.errors.country) {
                            $("#customer_country_error").html(response.errors.country);
                        }
                        if (response.errors.delivery_address) {
                            $("#delivery_address_error").html(response.errors.delivery_address);
                        }
                        if (response.errors.apartment_details) {
                            $("#apartment_details_error").html(response.errors.apartment_details);
                        }
                        if (response.errors.city) {
                            $("#customer_city_error").html(response.errors.city);
                        }
                        if (response.errors.area) {
                            $("#area_error").html(response.errors.area);
                        }

                        if (response.errors.mobile_no_1) {
                            $(".mobile_no_1_error").html(response.errors.mobile_no_1);
                        }
                        if (response.errors.mobile_no_2) {
                            $(".mobile_no_2_error").html(response.errors.mobile_no_2);
                        }
                        if (response.errors.mobile_no_3) {
                            $(".mobile_no_3_error").html(response.errors.mobile_no_3);
                        }

                    }
                }


            });
        });


        $('.get_single_deliver_address').click(function (event) {
                let deliveryOptionId = $(this).data("id");
                let cityId = $('#city').val();
                let countryId = $('#country').val();
                //alert(countryId);
            $.ajax({
                type: 'GET',
                url: "{{ route('get_customer_address_details') }}",
                data:{deliveryOptionId:deliveryOptionId,cityId:cityId,countryId:countryId},
            }).done(function (response) {
                if(response.loggedIn){
                    $("#address-book-add-new-data").hide();
                    $("#address-book-list-area-data").show();
                    $('#address-list-area').html(response.address_list);
                    $('#delivery_show_data').html(response.address_selected);
                    $('#shipping_fees_area').show();
                    $('#shipping_fees').text(response.shipping_fees);
                    $('#total_order_amount').text(response.total_order_amount);

                }else{
                    $("#address-book-add-new-data").show();
                    $("#address-book-list-area-data").hide();
                    $("#address-book-add-new-data .fall-back").hide();
                    $('#address-list-area').html('');
                    $('#delivery_show_data').html('');
                }

            });
        });

        $("#credit_card_payment_continue").click(function (){
            var selectCreditCardId = $('input[name="credit_card_modal_id"]:checked').val();
            $("#credit_card_id").val(selectCreditCardId);
            $('#payment_show_data').show();
            $("#payment_btn_close.btn-close").click()
        })

        function customerCreditCard(id) {
            $("#payment-list-area-data").hide();
            $.ajax({
                type: 'GET',
                url: "{{ route('customer_credit_card_details') }}",
                dataType: 'json',
                data: {id: id},
                success: function (response) {
                    if(response.success === false){
                        var data = response.guest_credit_card_details
                        $("#edit_credit_card_id").val(' ');
                        $("#card_number").val(data.card_number);
                        $("#card_holder").val(data.card_holder);
                        $("#card_expiry").val(data.card_expiry);
                        $("#security_code").val(data.security_code);

                        $("#payment_details").addClass('open');
                        $(".ai-global-overlay").addClass('overlay-open');
                        $("#payment-add-new-card").show();
                    }else {
                        $("#edit_credit_card_id").val(response.id);
                        $("#card_number").val(response.card_number);
                        $("#card_holder").val(response.card_holder);
                        $("#card_expiry").val(response.card_expiry);
                        $("#security_code").val(response.card_cvc);

                        $("#payment_details").addClass('open');
                        $(".ai-global-overlay").addClass('overlay-open');
                        $("#payment-add-new-card").show();
                    }
                }
            })

        }

        $("#credit_card_payment").click(function (){
            $(".checkout_btn_area").hide();
            $("#payment-add-new-card").hide();
            $("#payment_option_area").hide();
            $.ajax({
                method: "GET",
                url: "{{ route('get_customer_credit_card_details') }}",
            }).done(function (data) {
                if(data.success){
                    $("#payment-list-area-data").show();
                    $("#payment-add-new-card").hide();
                    $("#credit-card-list").html(data.cards);
                    $('#payment_show_data').html(data.card);
                }else{
                    $("#payment-list-area-data").hide();
                    $("#payment-add-new-card").show();
                }

            });
        })

        $('#card_save').click(function (event) {

            $("#card_number_error").html(' ');
            $("#card_holder_error").html(' ');
            $("#security_code_error").html(' ');
            $("#card_expiry_error").html(' ');

            var add_new_credit_form = new FormData($('#credit_card_form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('card_submit_post') }}",
                data: add_new_credit_form,
                processData: false,
                contentType: false,
            }).done(function (response) {
                if (response.success) {
                    $("#payment-list-area-data").show();
                    $("#payment-add-new-card").hide();
                    $("#credit-card-list").html(response.cards);
                }else if(response.success == false){
                    $('#payment_show_data').html(response.credit_card_selected);
                    $('#payment_option_area').hide();
                    $('#payment_show_data').show();
                    $("#payment-list-area-data").hide();
                    $("#payment-add-new-card").hide();

                    $("#payment_details").removeClass('open');
                    $(".ai-global-overlay").removeClass('overlay-open');
                    $(".checkout_btn_area").show();
                }else {
                    if (response.errors) {

                        if (response.errors.card_number) {
                            $("#card_number_error").html(response.errors.card_number);
                        }
                        if (response.errors.card_holder) {
                            $("#card_holder_error").html(response.errors.card_holder);
                        }
                        if (response.errors.security_code) {
                            $("#security_code_error").html(response.errors.security_code);
                        }
                        if (response.errors.card_expiry) {
                            $("#card_expiry_error").html(response.errors.card_expiry);
                        }
                    }
                }
            });
        });
        $("#port_wallet_payment").click(function (){
            $(".ai-global-overlay").removeClass('overlay-open');
            $(".checkout_btn_area").show();
        })

        $("#payment_checkout").click(function (){
            $(".lds-ring-wrapper").show();
            $("html").css('overflow','hidden');

            var checkoutFormData = new FormData($('#checkout-form')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('checkout') }}",
                data: checkoutFormData,
                processData: false,
                contentType: false,
            }).done(function (response) {
                if(response.success){
                    $(".lds-ring-wrapper").hide();
                    $("html").css('overflow','auto');
                    window.location.href = response.redirect_url;
                }else{
                    $(".lds-ring-wrapper").hide();
                    $("html").css('overflow','auto');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        })
    </script>

@endsection
