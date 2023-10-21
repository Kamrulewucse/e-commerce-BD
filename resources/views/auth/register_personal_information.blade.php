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
            font-size: 13px;
            border-radius: 0;

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
        ul.filter-list {
            padding: 0;
            text-align: left;
        }
        ul.filter-list li a {
            border-right: 1px solid #eee;
        }
        ul.filter-list li a i {
            color: #000;
            font-size: 18px;
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
        /* The message box is shown when the user clicks on the password field */
        #message {
            display:none;
            background: #ffffff;
            color: #000;
            position: relative;
            padding: 10px;
            margin-top: 10px;
        }

        #message p {
            padding: 0px 15px;
            font-size: 12px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -15px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: #000000;
        }

        .invalid:before {
            position: relative;
            left: -15px;
            content: "o";
            font-size: 20px;
            line-height: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row">
            <div class="col-12">
                <ul class="filter-list">
                    <li><a href="{{ route('register') }}"><i class="fa fa-angle-left"></i> Back</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="other-page-content-area body-height-full">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-1">
                    <div class="register-area">
                        <h1 class="contact-page-title">CREATE A NEW ACCOUNT</h1>
                        <h1 class="other-box-title">LOGIN INFORMATION(2/3)</h1>
                        <form method="post" action="{{ route('register_personal_information') }}">
                            @csrf
                            <div class="other-page-box">
                                <div class="row">
                                    <label class="col-12 register-label" for="password">PASSWORD <span class="text-danger">*</span>
                                        <span class="form-group">
                                        <input type="password" value="{{ old('password') }}" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control register-input"
                                               placeholder="PASSWORD">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span id="message">
                                                <p id="letter" class="invalid">A lowercase letter</p>
                                                <p id="capital" class="invalid">A capital (uppercase) letter</p>
                                                <p id="number" class="invalid">A number</p>
                                                <p id="length" class="invalid">Minimum 8 characters</p>
                                            </span>
                                    </span>
                                    </label>
                                    <label class="col-12 register-label" for="password_confirmation">PASSWORD CONFIRMATION <span
                                            class="text-danger">*</span>
                                        <span class="form-group">
                                        <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation"  class="form-control register-input"
                                               placeholder="PASSWORD CONFIRMATION">
                                        @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </span>
                                    </label>
                                </div>
                            </div>
                            <h1 class="other-box-title" style="margin-top: 15px;">PERSONAL INFORMATION</h1>
                            <div class="other-page-box">
                                <div class="row">
                                    <label class="col-12 register-label" for="password">TITLE <span class="text-danger">*</span>
                                        <span class="form-group">
                                        <select name="title" id="title" class="form-control register-input">
                                            <option value="">Select Your Title</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Mx">Mx</option>
                                            <option value="null">Prefer not to say</option>
                                        </select>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </span>
                                    </label>
                                    <label class="col-12 register-label" for="first_name">FIRST NAME <span
                                            class="text-danger">*</span>
                                        <span class="form-group">
                                        <input type="text" value="{{ old('first_name') }}" name="first_name" id="first_name"  class="form-control register-input"
                                               placeholder="FIRST NAME">
                                        @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </span>
                                    </label>
                                    <label class="col-12 register-label" for="last_name">LAST NAME <span
                                            class="text-danger">*</span>
                                        <span class="form-group">
                                        <input type="text" value="{{ old('last_name') }}" name="last_name" id="last_name"  class="form-control register-input"
                                               placeholder="LAST NAME">
                                        @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </span>
                                    </label>
                                    <label class="col-12 register-label" for="country">COUNTRY/REGION <span class="text-danger">*</span>
                                        <span class="form-group">
                                        <select name="country" id="country" class="form-control register-input">
                                            <option value="">Select Your Title</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </span>
                                    </label>
                                </div>
                            </div>
                            <div class="other-page-box" style="margin-top: 30px">
                                <div class="row">
                                    <label class="col-12 register-label" for="agree">
                                        <span class="form-group">
                                        <input  type="checkbox" name="agree" id="agree" class="stylish-checkbox">
                                          Subscribe to receive Bangladesh Drip emails. By subscribing you agree to our Privacy Policy.
                                            @error('agree')
                                            <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </span>
                                    </label>
                                </div>
                            </div>
                           <div class="row">
                               <div class="col-md-5 offset-md-7">
                                   <button class="btn-next">Next</button>
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

@section('script')
    <script>
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>
@endsection
