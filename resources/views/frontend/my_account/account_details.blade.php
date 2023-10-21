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

        /*@media screen and (max-width: 450px) {*/
        /*    .user-nav {*/
        /*        margin-top: 57px;*/
        /*    }*/
        /*    .user-nav ul li a {*/
        /*        padding: 2px;*/
        /*    }*/
        /*}*/

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
            margin-bottom: 30px;
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
            padding: 0 6rem 0 1rem;
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
                width: 100%;
            }
        }

        /* Credit Card */
        .main-card-info h1 {
            color: #333;
            text-align: center;
            font-size: 28px;
            margin: 20px 0
        }

        .main-card-info h2 {
            font-size: 24px
        }

        .main-card-info p {
            font-weight: bold;
            font-size: 18px;
            line-height: 1.5;
            text-align: left;
            margin: 20px auto;
            width: 90%;
            max-width: 360px;
            padding: 10px;
        }

        .main-card-info form {
            width: 98%;
            max-width: 360px;
            margin: 20px auto;
            padding: 15px;

            border: 1px solid #D9DCE3;
            border-radius: 3px;
            background: white;

            overflow: hidden;
        }

        .main-card-info form header {
            background: #000000;
            border-bottom: 1px solid white;
            padding: 1px;
            width: calc(100% + 30px);
            margin: -15px 0 0 -15px;
        }

        .main-card-info form header h2 {
            color: #F5F5F5;
            margin: 0;
            font-size: 20px;
            padding: 7px;
        }

        .main-card-info .field {
            border-color: #EDEDED;
            border-style: solid;
            border-width: 0 0 1px 0;
            display: flex;
            flex-direction: column;
        }

        .main-card-info .field.full {
            clear: both
        }

        .main-card-info .field.adjacent {
            float: left
        }

        .main-card-info .field.adjacent + .field.adjacent {
            border-left-width: 1px
        }

        /* brilliant, but breaks */
        .main-card-info .field.adjacent + .field.adjacent label {
            text-indent: 15px
        }

        .main-card-info .field.half {
            width: 50%
        }

        .main-card-info .field.third {
            width: calc(100% / 3)
        }

        .main-card-info .field label, .main-card-info .field input {
            font-size: 14px;
            padding: 15px;
        }

        .main-card-info .field label, .main-card-info .field label + input {
            height: 14px;
            box-sizing: content-box;
            padding-left: 0;
            padding-right: 0;
        }

        .main-card-info .field label {
            font-weight: bold;
            text-align: center;
            padding-right: 10px;
        }

        .main-card-info .field input {
            border: 0 solid transparent;
            background: transparent;
            -webkit-appearance: none;
            width: 100%;
        }

        .main-card-info .field input:focus {
            outline: 0
        }

        .main-card-info .field input[type="submit"] {
            background: #000;
            color: #F5F5F5;
            border-radius: 3px;
            clear: both;
            margin-top: 15px;
            height: 52px;
        }

        @media (min-width: 360px) {
            .main-card-info .field {
                flex-direction: row
            }

            .main-card-info .field label {
                text-align: left
            }
        }

        .no-border {
            border-width: 0
        }

        @media (min-width: 320px) and (max-width: 400px) {

        }

        .credit-cards {

        }
    </style>
    <style>
        @media only screen and (min-width: 48em)
            .date-of-birth-fieldset .displayTableCell {
                padding-right: 0.5rem;
            }

            .displayTableCell {
                display: table-cell;
            }

            .register-input-datas {
                width: 387px;
            }

            div#customer_new_mobile_add_area {
                padding: 0;
            }

            button.close-modal-btn.password-change-close-btn {
                border: none !important;
                /* font-size: 2px !important; */
            }
    </style>
@endsection
@section('content')
    @include('layouts.partial.user_nav')
    <div class="page-content-inner body-height-full">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="other-box-title text-bold">MY PROFILE</h1>
                    <hr>
                </div>
                <div class="col-md-6">
                    <h1 class="other-box-title">PERSONAL INFORMATION</h1>
                    <div class="other-page-box">
                        <form action="{{ route('account_details_post') }}" method="post">
                            @csrf
                            <div class="row">
                                <label class="col-12 register-label" for="password">TITLE <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                        <select required name="title" id="title"
                                                class="form-control register-input select-input">
                                            <option {{ $user->title == 'Mr' ? 'selected' : '' }} value="Mr">Mr</option>
                                            <option
                                                {{ $user->title == 'Mrs' ? 'selected' : '' }} value="Mrs">Mrs</option>
                                            <option {{ $user->title == 'Ms' ? 'selected' : '' }} value="Ms">Ms</option>
                                            <option {{ $user->title == 'Mx' ? 'selected' : '' }} value="Mx">Mx</option>
                                            <option {{ $user->title == null ? 'selected' : '' }} value="null">Prefer not to say</option>
                                        </select>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </span>
                                </label>
                                <label class="col-12 register-label" for="first_name">FIRST NAME <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                        <input type="text" value="{{ old('first_name',$user->first_name) }}"
                                               name="first_name" id="first_name" class="form-control register-input"
                                               placeholder="FIRST NAME">
                                        @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </span>
                                </label>
                                <label class="col-12 register-label" for="last_name">LAST NAME <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                        <input type="text" value="{{ old('last_name',$user->last_name) }}"
                                               name="last_name" id="last_name" class="form-control register-input"
                                               placeholder="LAST NAME">
                                        @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </span>
                                </label>
                                <label class="col-12 register-label" for="country">COUNTRY/REGION <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                        <select name="country" id="country"
                                                class="form-control register-input select-input">
                                            <option value="">Select Country/Region</option>
                                            @foreach($countries as $country)
                                                <option
                                                    {{ $user->country_id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </span>
                                </label>
                                <label class="col-12 register-label" for="mobile_no_type">MOBILE NUMBER <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                        <select name="mobile_typeone" id="mobile_typeone"
                                                class="form-control register-input select-input">
                                            <option
                                                {{ $user->mobile_type_one == 'Mobile' ? 'selected' : '' }} value="Mobile">Mobile</option>
                                            <option
                                                {{ $user->mobile_type_one == 'Home' ? 'selected' : '' }} value="Home">Home</option>
                                            <option
                                                {{ $user->mobile_type_one == 'Work' ? 'selected' : '' }} value="Work">Work</option>

                                        </select>
                                        @error('mobile_typeone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </span>
                                </label>
                                <div class="col-12 field_wrapper">
                                    <fieldset class="date-of-birth-fieldset">
                                        <div class="inputColumn row">
                                            <div class="col-12 col-md-3">
                                                <select id="dayOfBirthupdateProfileForm" required name="mobile_codeone">
                                                    @foreach($phoneCodes as $phoneCode)
                                                        <option
                                                            {{ $phoneCode->phonecode == $user->mobile_code_one ? 'selected' : '' }} value="{{ $phoneCode->phonecode }}">
                                                            +{{ $phoneCode->phonecode }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" value="{{ $user->mobile_number_one }}"
                                                       name="mobile_numberone" id="mobile_numberone" maxlength="10"
                                                       class="form-control register-input"
                                                       style="width: 100%" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <label class="col-12 register-label" for="mobile_typetwo">OTHER NUMBER <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                    <select name="mobile_typetwo" id="mobile_typetwo"
                                            class="form-control register-input select-input">
                                           <option
                                               {{ $user->mobile_type_two == 'Mobile' ? 'selected' : '' }} value="Mobile">Mobile</option>
                                            <option
                                                {{ $user->mobile_type_two == 'Home' ? 'selected' : '' }} value="Home">Home</option>
                                            <option
                                                {{ $user->mobile_type_two == 'Work' ? 'selected' : '' }} value="Work">Work</option>

                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </span>
                                </label>
                                <div class="col-12 field_wrapper">
                                    <fieldset class="date-of-birth-fieldset">
                                        <div class="inputColumn row">
                                            <div class="col-12 col-md-3">
                                                <select id="dayOfBirthupdateProfileForm" required name="mobile_codetwo">
                                                    @foreach($phoneCodes as $phoneCode)
                                                        <option
                                                            {{ $phoneCode->phonecode == $user->mobile_code_two ? 'selected' : '' }} value="{{ $phoneCode->phonecode }}">
                                                            +{{ $phoneCode->phonecode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" value="{{ $user->mobile_number_two }}"
                                                       name="mobile_numbertwo" id="mobile_no" maxlength="10"
                                                       class="form-control register-input"
                                                       style="width: 100%;" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-12">
                                    <input class="form-check-input" type="checkbox" name="contact_email" value="email"
                                           id="flexCheckDefault" {{ ($user->contact_email) == 'email' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Contactable by Email
                                    </label>
                                </div>
                                <div class="col-12">
                                    <input class="form-check-input" type="checkbox" name="contact_phone" value="phone"
                                           id="flexCheckChecked" {{ ($user->contact_phone) == 'phone' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Contactable by Phone
                                    </label>
                                </div>
                                <div class="col-12" style="margin-bottom:20px;">
                                    <input class="form-check-input" type="checkbox" name="contact_message"
                                           value="message"
                                           id="flexCheckChecked" {{ ($user->contact_message) == 'message' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Contactable by Text Message
                                    </label>
                                </div>
                                <div class="col-12 ">
                                    <fieldset class="date-of-birth-fieldset">
                                        <legend class="label register-label">
                                            DATE OF BIRTH
                                        </legend>
                                        <div class="inputColumn mb--25">
                                            <div class="displayTableCell ">
                                                <!--  -->
                                                <select required id="dayOfBirthupdateProfileForm" name="day">
                                                    <option value="">
                                                        DATE
                                                    </option>
                                                    @for($i=1; $i <= 31; $i++)
                                                        <option
                                                            {{ ($user->date_of_birth ? date('d',strtotime($user->date_of_birth)) : '') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="displayTableCell ">
                                                <!--  -->
                                                <select required id="monthOfBirthupdateProfileForm" title=""
                                                        aria-invalid="false" name="month">
                                                    <option value="">MONTH</option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '01' ? 'selected' : '' }} value="01">
                                                        January
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '02' ? 'selected' : '' }} value="02">
                                                        February
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '03' ? 'selected' : '' }} value="03">
                                                        March
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '04' ? 'selected' : '' }} value="04">
                                                        April
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '05' ? 'selected' : '' }} value="05">
                                                        May
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '06' ? 'selected' : '' }} value="06">
                                                        June
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '07' ? 'selected' : '' }} value="07">
                                                        July
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '08' ? 'selected' : '' }} value="08">
                                                        August
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '09' ? 'selected' : '' }} value="09">
                                                        September
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '10' ? 'selected' : '' }} value="10">
                                                        October
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '11' ? 'selected' : '' }} value="11">
                                                        November
                                                    </option>
                                                    <option
                                                        {{ ($user->date_of_birth ? date('m',strtotime($user->date_of_birth)) : '') == '12' ? 'selected' : '' }} value="12">
                                                        December
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="displayTableCell ">
                                                <select required id="yearOfBirthupdateProfileForm" name="year">
                                                    <option value="">
                                                        YEAR
                                                    </option>
                                                    @for($i=1950; $i <= date('Y'); $i++)
                                                        <option
                                                            {{ ($user->date_of_birth ? date('Y',strtotime($user->date_of_birth)) : '') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>


                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <button class="btn-next">Save your information</button>
                        </form>

                    </div>

                </div>
                <div class="col-md-6">
                    <h1 class="other-box-title">MY NEWSLETTER</h1>
                    <div class="other-page-box">
                        @if($newsletter)
                            <p class="email-text">{{ date('M Y',strtotime($newsletter->created_at)) }}</p>
                        @endif
                        <h1 class="other-box-title other-box-sub-title">DISCOVER THE LATEST NEWSLETTER</h1>
                        <div class="unsubscribe-content-test">
                            <p>Subscribe to never miss out on our new releases, collections and lookbooks.</p>
                        </div>
                        <a href="{{ route('subscribe_toggle') }}" class="btn-next" id="clicktodisable"
                           style="">{{ $newsletter ? 'Unsubscribe' : 'Subscribe'}}</a>
                    </div>
                    <h1 class="other-box-title">LOGIN INFORMATION</h1>
                    <div class="other-page-box">
                        <label class="col-12 register-label" for="first_name">Email
                            <span class="form-group">
                                <input readonly type="text" value="{{ $user->email }}"
                                       class="form-control register-input readonly-input">

                            </span>
                        </label>
                        <label class="col-12 register-label" style="margin-bottom: 0;">Password</label>
                        <button role="button" id="change-password" class="btn-next" style="width: 100px">Change</button>
                    </div>
                    <h1 class="other-box-title">MY ADDRESS BOOK
                        <a id="add-new-address" class="btn-next btn-next-bg-transparent logout-btn address-book-add-btn"
                           style="line-height: 23px;" role="button">ADD NEW
                            ADDRESS</a></h1>

                    <div id="address-book-list-area">

                        <div class="other-page-box">
                            @foreach($detailsAddress as $key=> $address)
                                <div class="row">
                                    <h3 style="color:#000;text-transform: uppercase;margin-top: 10px">
                                        <b>{{ $address->description }}</b></h3>
                                    <div class="col-12">
                                        <span
                                            class="delivery-option-description">{{ $address->first_name.' '.$address->last_name }}</span><br>
                                        <span class="delivery-option-description">{{ $address->delivery_address}}</span><br>
                                        <span
                                            class="delivery-option-description">{{ $address->apartment_details}}</span><br>
                                        <span
                                            class="delivery-option-description">{{ $address->state->name ?? ''}}</span><br>
                                        <span class="delivery-option-description">{{ $address->area }}</span><br>
                                        <span
                                            class="delivery-option-description">{{ $address->country->name ?? '' }}</span><br>
                                        @if($address->mobile_no_type_1)
                                            <span class="delivery-option-description">{{ $address->mobile_no_type_1 }}: (+{{ $address->mobile_no_code_1 }}) {{ $address->mobile_no_1 }}</span>
                                            <br>
                                        @endif

                                        @if($address->mobile_no_type_2)
                                            <span class="delivery-option-description">{{ $address->mobile_no_type_2 }}: (+{{ $address->mobile_no_code_2 }}) {{ $address->mobile_no_2 }}</span>
                                            <br>
                                        @endif
                                        @if($address->mobile_no_type_3)
                                            <span class="delivery-option-description">{{ $address->mobile_no_type_3 }}: (+{{ $address->mobile_no_code_3}}) {{ $address->mobile_no_3 }}</span>
                                            <br>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <button role="button" class="btn-next edit-address-details" id="customerEdit"
                                                onClick="customerAddress({{ $address->id }})" style="width: 150px">Edit
                                        </button>
                                        <button role="button" class="btn-next transferent-btn-style" id="deleteDetails"
                                                onClick="deleteDetails({{ $address->id }})" style="width: 150px">Delete
                                        </button>

                                        @if(count($detailsAddress) - 1 != $key)
                                            <hr>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="address-book-add-new" style="display: none">
                        <div class="other-page-box address-new-hid-box">
                            <div class="cancel-button-area" style="text-align: right">
                                <a id="new-address-cancel" role="button" class="cancel-btn-address">x</a>
                            </div>
                            <form method="post" id="add_new_address_form" class="row">
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
                                                <select name="title" id="address_title"
                                                        class="form-control register-input select-input">
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mx">Mx</option>
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
                                                <input type="text" name="first_name" id="address_first_name"
                                                       class="form-control register-input">
                                                    <span id="first_name_error" class="text-danger"></span>
                                                </span>
                                </label>
                                <label class="col-12 register-label" for="last_name">Last Name <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                                <input type="text" name="last_name" id="address_last_name"
                                                       class="form-control register-input">

                                                <span id="last_name_error" class="text-danger"></span>
                                                </span>
                                </label>
                                <label class="col-12 register-label" for="country">Country <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                                <select name="country" id="customer_country"
                                                        class="form-control register-input select-input">
                                                    <option value="">Select Your Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                    <span id="customer_country_error" class="text-danger"></span>
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
                                                        <div class="inputColumn row pb-3">
                                                            <div class="col-12 col-md-3">
                                                                <select class="mobile_no_code_class"
                                                                        name="mobile_no_code_1">
                                                                    @foreach($phoneCodes as $phoneCode)
                                                                        <option value="{{ $phoneCode->phonecode }}">
                                                                            +{{ $phoneCode->phonecode }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                           <div class="col-12 col-md-9">
                                                               <input style="width: 100%" type="text" name="mobile_no_1"
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
                                <button type="button" id="save-customer-address" class="btn-next">Save Address</button>
                            </form>
                        </div>
                    </div>

                    <div id="card-list-areas">
                        <h2 style="padding:10px 0px;"><span style="font-weight: bold; padding-right: 20px;">MY CREDIT CARDS</span><a
                                id="add-new-card"
                                class="btn-next btn-next-bg-transparent logout-btn address-book-add-btn add-new-cards"
                                style="line-height: 23px;" role="button">ADD NEW</a></h2>

                        <div class="other-page-box" style="margin: 20px 0px;">
                            @foreach($cardDetails as $key=> $cardDetail)
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 style="color:#000;text-transform: uppercase;margin-top: 10px"><b>Card
                                                Holder: {{ $cardDetail->card_holder }}</b></h3>
                                        <p style="color: #000;">
                                            <span>Card Number: {{ $cardDetail->card_number }}</span><br>
                                            <span>Expirations Date: {{ $cardDetail->card_expiry }}</span><br>
                                            <span>CVC Number: {{ $cardDetail->card_cvc }}</span><br>
                                            <button role="button"
                                                    class="btn-next transferent-btn-style show-alert-delete-box"
                                                    id="deleteCard" onClick="deleteCard({{ $cardDetail->id }})"
                                                    style="width: 150px;margin-top: 30px;">Delete
                                            </button>
                                        </p>
                                    </div>
                                    <div class="col-md-6 credit-cards" style="text-align: right;"><i
                                            class="fa fa-cc-visa fa-10x" style="background: #FFD43B;"></i></div>
                                </div>
                                @if(count($cardDetails) - 1 != $key)
                                    <hr>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div id="card-insert-areas" style="display: none;">
                        <h2><strong>Credit Card Add</strong></h2>
                        <div class="other-page-box">
                            <div class="cancel-button-area" style="text-align: right">
                                <a id="card-cancel" role="button" class="cancel-btn-address">x</a>
                            </div>
                            <form id="credit_card_form" method="post">
                                <label class="col-12 register-label" for="card_holder">CARD HOLDER <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                    <input type="text" name="card_holder" id="card_holder"
                                           class="form-control register-input">
                                    <span id="card_holder_error" class=" text-danger"></span>
                                    </span>
                                </label>
                                <label class="col-12 register-label" for="card_number">CARD NUMBER <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                    <input type="number" name="card_number" id="card_number"
                                           class="form-control register-input">
                                    <span id="card_number_error" class=" text-danger"></span>
                                    </span>
                                </label>
                                <label class="col-12 register-label" for="card_expiry">CARD EXPIRY <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                    <input type="text" name="card_expiry" id="card_expiry"
                                           class="form-control register-input" placeholder="DD/MM">
                                     <span id="card_expiry_error" class=" text-danger"></span>
                                    </span>
                                </label>
                                <label class="col-12 register-label" for="security_code">CARD EXPIRY <span
                                        class="text-danger">*</span>
                                    <span class="form-group">
                                    <input type="text" name="security_code" id="security_code"
                                           class="form-control register-input">
                                    <span id="security_code_error" class=" text-danger"></span>
                                   </span>
                                </label>
                                <button type="button" id="card-save" class="btn-next">Save Credit Card</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="password-change-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">CHANGE YOUR PASSWORD</h1>
                    <button type="button" class="close-modal-btn password-change-close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                        X
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-form-password-change" name="modal-form-password-change">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-danger pull-right">Mandatory fields *</span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="old_password">Old Password <span class="text-danger">*</span></label>
                                    <input type="password" id="old_password" class="form-control register-input"
                                           name="old_password">
                                    <span class="text-danger" id="old_password_error"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="new_password">New Password <span class="text-danger">*</span></label>
                                    <input type="password" id="new_password" class="form-control register-input"
                                           name="new_password">
                                    <span class="text-danger" id="new_password_error"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Your Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" id="confirm_password" class="form-control register-input"
                                           name="confirm_password">
                                    <span class="text-danger" id="confirm_password_error"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a role="button" id="password-change-submit" class="btn-next btn-modal-custom"
                       style="width: 100px !important;">Save</a>
                </div>
            </div>
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
            <div class="inputColumn pb-3 row">
            <div class="col-12 col-md-3">
                <select class="mobile_no_code_class" name="mobile_no_code">
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
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function () {

            $("#add-new-address").click(function () {
                $("#address-book-add-new").show();
                $("#address-book-list-area").hide();
                $("#address-book-edit-now").hide();
            })
            $("#new-address-cancel").click(function () {
                $("#address-book-add-new").hide();
                $("#address-book-list-area").show();
            })

            $(".edit-address-details").click(function () {
                $("#address-book-edit-now").show();
                $("#address-book-list-area").hide();
            })
            $("#edit-address-cancel").click(function () {
                $("#address-book-edit-now").hide();
                $("#address-book-list-area").show();
            })

            $(".add-new-cards").click(function () {
                $("#card-insert-areas").show();
                $("#card-list-areas").hide();
            })
            $("#card-cancel").click(function () {
                $("#card-insert-areas").hide();
                $("#card-list-areas").show();
            })

            $(".clicktoenable").click(function () {
                $("#clicktodisable").css("pointer-events", 'auto', "color", 'white');
            })


            $("#change-password").click(function () {
                $("#password-change-modal").modal('show');
            })
            $('#password-change-submit').click(function () {
                var formData = new FormData($('#modal-form-password-change')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax_password_change') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            $('#password-change-modal').modal('hide');
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        } else {
                            if (response.errors.old_password) {
                                $("#old_password_error").html(response.errors.old_password);
                            } else {
                                $("#old_password_error").html(' ');
                            }

                            if (response.errors.new_password) {
                                $("#new_password_error").html(response.errors.new_password);
                            } else {
                                $("#new_password_error").html(' ');
                            }
                            if (response.errors.confirm_password) {
                                $("#confirm_password_error").html(response.errors.confirm_password);
                            } else {
                                $("#confirm_password_error").html(' ');
                            }
                        }
                    }
                });
            });
        })
    </script>

    <script>
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
                } else {
                    $('.add_button_area').show();
                    $('.remove_button_area').hide();
                    $(wrapper).append(fieldHTML);
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
        $('#customer_country').change(function () {
            var countryId = $(this).val();
            $('#customer_city').html('<option value="">Select City</option>');

            if (countryId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_city') }}",
                    data: {countryId: countryId}
                }).done(function (data) {
                    $.each(data, function (index, item) {
                        $('#customer_city').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                });
            }
        });
        $('#customer_country').trigger("change");
        $('#save-customer-address').click(function (event) {
            var add_new_address_form = new FormData($('#add_new_address_form')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('customer_address_details_post') }}",
                data: add_new_address_form,
                processData: false,
                contentType: false,
            }).done(function (response) {
                if (response.success) {
                    location.reload()
                } else {
                    if (response.errors) {
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

        function customerAddress(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('customer_address_details') }}",
                dataType: 'json',
                data: {id: id},
                success: function (response) {

                    $("#edit_address_id").val(response.id);
                    $("#description").val(response.description);
                    $("#address_title").val(response.title);
                    $("#address_first_name").val(response.first_name);
                    $("#address_last_name").val(response.last_name);
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
                        $("#address-book-add-new").show();
                    }
                }
            })

        }
    </script>

@endsection
