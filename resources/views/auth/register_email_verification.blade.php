@extends('layouts.app')
@section('style')
    <style>

        ul.filter-list li:first-child, ul.filter-list li {
            font-size: 16px;
            cursor: auto;
            padding: 0;
            border-left: 0px solid #eee;
            color: #000;
        }

        ul.filter-list {
            padding: 0;
        }

        ul.filter-list li {
            display: inline-block;
        }

        ul.filter-list li a {
            display: inline-block;
            padding: 23px 25px;
            transition: all 0.5s ease;
            margin: 0;
            border-left: 1px solid #eee;
        }

        ul.filter-list li a:hover {
            box-shadow: inset 0 -1px 0 0 #19110b;
        }

        ul.filter-list li a.other-page-active {
            box-shadow: inset 0 -4px 0 0 #19110b;
        }

        .other-page-content-area {
            background: #f6f5f3;
            padding: 0;
        }

        h1.contact-page-title {
            font-weight: bold;
            font-size: 32px;
            border-bottom: #eae8e4 1px solid;
            margin-bottom: 25px;
            padding-bottom: 17px;
        }

        .other-page-box {
            border: 1px solid #eae8e4;
            background: #fff;
            padding: 2rem;
            margin: 0;
        }

        h1.other-box-title {
            font-weight: bold;
            font-size: 17px;
        }

        a.send-and-email {
            align-items: center;
            align-content: center;
            -webkit-appearance: none;
            border: 0 none;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            display: inline-flex;
            min-height: 3rem;
            font-weight: 400;
            line-height: 1.25;
            letter-spacing: .4px;
            font-family: inherit;
            justify-content: center;
            transition: border .3s cubic-bezier(0.39, 0.575, 0.565, 1), box-shadow .3s cubic-bezier(0.39, 0.575, 0.565, 1), color .3s cubic-bezier(0.39, 0.575, 0.565, 1), background .3s cubic-bezier(0.39, 0.575, 0.565, 1);
            background: rgba(234, 232, 228, 0);
            box-shadow: inset 0 0 0 1px #19110b;
            color: #19110b;
            width: 100%;
            padding: 19px 0;
            font-size: 15px;
            margin: 10px 0;
        }

        a.send-and-email:hover {
            background-color: #eae8e4;
            box-shadow: inset 0 0 0 1px #eae8e4;
            color: #19110b;
        }

        .other-select-country-list select {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 3rem;
            text-align: left;
            font-family: "Louis Vuitton Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 1rem;
            line-height: 2;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39, 0.575, 0.565, 1);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2080%2080'%20focusable='false'%20aria-hidden='true'%20class='ui-icon-controls-chevron-down'%3E%3Cpath%20fill='%2319110b'%20fill-rule='evenodd'%20d='M46.2%2048.6L17.8%2020.3l-5.5%205.4%2028.4%2028.4%205.4%205.5.1.1.1-.1%205.3-4.5L80%2026.7l-5.5-6.4-28.3%2028.3z'/%3E%3C/svg%3E") no-repeat right 1rem top 50%;
            background-size: 1rem 1rem;
            max-width: 100%;
            padding: 0 2rem 0 1rem;
            position: relative;
            text-overflow: ellipsis;
        }

        .other-select-country-list select {
            width: 100%;
            height: 50px;
            font-size: 14px;
        }

        ul.filter-list {
            padding: 0;
            text-align: right;
        }

        .accordion-collapse {
            border: 0;
        }

        .accordion-button {
            padding: 0px;
            font-weight: bold;
            border: 0;
            font-size: 15px;
            color: #333333;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .accordion-button:focus {
            box-shadow: none;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background: none;
            color: #dc3545;
        }

        .accordion-body {
            padding: 15px;
            background-color: #f6f6f6;
        }

        .accordion-button::after {
            width: auto;
            height: auto;
            content: "+";
            font-size: 24px;
            background-image: none;
            font-weight: 100;
            color: #1b6ce5;
            transform: translateY(-4px);
        }

        .accordion-button:not(.collapsed)::after {
            width: auto;
            height: auto;
            background-image: none;
            content: "-";
            font-size: 48px;
            transform: translate(-5px, -4px);
            transform: rotate(0deg);
        }

        .accordion-button::after {
            color: #000000;
            font-size: 24px;
            font-weight: 500;
        }

        .accordion-button:not(.collapsed)::after {
            font-size: 34px;
        }

        button.accordion-button.collapsed {
            font-weight: normal;
        }

        .accordion-button:not(.collapsed) {
            background: none;
            color: #000000;
        }

        .accordion-body {
            padding: 15px;
            background-color: #ffffff;
        }

        button.accordion-button.collapsed {
            padding: 18px 0;
        }

        .accordion-body {
            padding: 0;
        }

        .accordion-body.inner-body {
            background: #f6f5f3;
            padding: 1.5rem;
        }

        button.accordion-button {
            cursor: pointer;
        }

        .register-area {
            padding: 50px 0;
        }

        .register-area h1.other-box-title {
            margin-bottom: 20px;
        }

        h1.other-box-title.client-service-title {
            font-size: 18px;
            border-bottom: 1px solid #eae8e4;
            margin: 11px 0 21px 0;
            padding: 16px 0;
        }

        .login-step-detail {
            background: #F6F5F3;
            padding: 17px;
            margin: 30px 0;
        }

        p.register-info {
            font-size: 11px;
            color: #000;
            border-bottom: 1px solid #eae8e4;
            margin: 11px 0;
            padding: 6px 0;
            font-weight: 500;
        }

        input.form-control.register-input {
            height: 44px;
            font-size: 15px;
            border-radius: 0;
            color: #000;
            font-weight: 600;
        }

        .register-label {
            font-size: 13px;
            margin-bottom: 30px;
        }


        button.btn-next {
            background: #19110B;
            color: #fff;
            border: none;
            width: 100%;
            height: 42px;
            margin-top: 30px;
        }
        .contact-icon {
            font-size: 22px;
        }

        a.email-us {
            font-size: 17px;
            color: #000;
        }
        @media screen and (max-width: 767px) {
            ul.filter-list {
                margin-top: 91px;
            }

            ul.filter-list li:first-child, ul.filter-list li {
            }

            ul.filter-list li a {
                padding: 7px;
                font-size: 9px;
            }

            .header-mobile__inner.fixed-header {
                border-bottom: 1px solid #eee;
            }

            ul.filter-list li a.other-page-active {
                box-shadow: inset 0 -2px 0 0 #19110b;
            }

            h1.contact-page-title {
                font-weight: bold;
                font-size: 17px;
                margin-bottom: 11px;
                padding-bottom: 7px;
            }

            .other-page-content-area {
                padding: 16px 0;
            }

            h1.other-box-title {
                font-size: 15px;
            }

            ul.filter-list li:first-child, ul.filter-list li {
                line-height: 56px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="other-page-content-area body-height-full">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-1">
                    <div class="register-area">
                        <h1 class="contact-page-title">CREATE A NEW ACCOUNT</h1>
                        <h1 class="other-box-title">ACCOUNT ACTIVATION</h1>
                        <form method="post" action="{{ route('register_verification') }}">
                            @csrf
                            <div class="other-page-box">
                                <div class="row">
                                    <div class="col-12">
                                        <p>Please enter the activation code you just received by email at <b style="color: #000">{{ $user_register_info['email'] }}</b> to activate your account</p>
                                        <br>
                                    </div>
                                    <label class="col-12 register-label" for="activation_code">ACTIVATION CODE <span class="text-danger">*</span>
                                        <span class="form-group">
                                        <input type="text" value="{{ old('activation_code') }}" name="activation_code" id="activation_code" class="form-control register-input"
                                               placeholder="ex: 12345">
                                            @if(session('error'))
                                                <span class="text-danger">{{ session('error') }}</span>
                                            @endif
                                            @error('activation_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </span>
                                    </label>
                                    <label class="col-12 register-label" for="activation_code">
                                        <a href="{{ route('user_register_verification_send_again') }}" style="color: #000"><b>Send Again?</b></a><br>
                                        @if(session('again_send'))
                                            <span class="text-success">{{ session('again_send') }}</span>
                                        @endif
                                    </label>
                                </div>
                            </div>
                           <div class="row">
                               <div class="col-md-5 offset-md-7">
                                   <button class="btn-next">Activate Account</button>
                               </div>
                           </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-4  offset-md-1">
                    <div class="other-page-box">
                        <h1 class="other-box-title client-service-title">CALL US</h1>
                        <a class="email-us" href="tel:+8801608911692"> <i class="fa fa-mobile-phone contact-icon"></i> +8801608911692</a> <br>
                        <hr>
                        <a class="email-us" href="{{ route('email.us') }}"> <i class="fa fa-envelope"></i> Email Us</a>


                        <div class="login-step-detail">
                            <h1 class="other-box-title">WHAT YOU'LL FIND IN YOUR BD Drip ACCOUNT</h1>
                            <p class="register-info"><i class="fa fa-history"></i> Access your order history</p>
                            <p class="register-info"><i class="fa fa-cog"></i> Manage your personal information</p>
                            <p class="register-info"><i class="fa fa-envelope"></i> Receive Bangladesh Drip's digital
                                communications</p>
                            <p class="register-info"><i class="fa fa-heart"></i> Register your wishlist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
