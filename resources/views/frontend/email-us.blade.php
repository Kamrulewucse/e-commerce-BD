@extends('layouts.app')
@section('style')
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .email-section {
            background-color: #f5f5f5;
            padding: 35px 50px;
        }
        .email-title {
            font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 400;
            font-style: normal;
            font-weight: 700;
            font-size: 2.125rem;
            line-height: 1.0588235294117647;
            letter-spacing: 0;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .email-section-left {
            padding: 3rem;
            box-sizing: border-box;
            padding-left: 6.4vw;
            padding-right: 6.4vw;
        }
        .email-section-content{
            background: #fff;
            padding: 2rem;
        }
        .email-us-mandatory{
            display: flex;
            flex-direction: row;
            align-content: end;
            padding: 5px 0px;
        }
        .email-form{
            background: #fff;
            padding: 2rem;
        }
        label {
            color: #19110b;
            display: block;
            margin: 0 0 0.5rem;
            font-weight: 400;
            font-size: 1.3rem;
            line-height: 1.4285714285714286;
            letter-spacing: .4px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }
        select {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 4rem;
            text-align: left;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 400;
            font-style: normal;
            font-weight: 500;
            font-size: 1.3rem;
            line-height: 2;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff url(data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2080%2080'%20focusable='false'%20aria-hidden='true'%20class='ui-icon-controls-chevron-down'%3E%3Cpath%20fill='%2319110b'%20fill-rule='evenodd'%20d='M46.2%2048.6L17.8%2020.3l-5.5%205.4%2028.4%2028.4%205.4%205.5.1.1.1-.1%205.3-4.5L80%2026.7l-5.5-6.4-28.3%2028.3z'/%3E%3C/svg%3E) no-repeat right 1rem top 50%;
            background-size: 1rem 1rem;
            padding: 0 2rem 0 1rem;
            text-overflow: ellipsis;
            width: 100%;
        }

        input{
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            width: 100%;
            background-size: 1rem 1rem;
            padding: 0 2rem 0 1rem;
            height: 4rem;
            line-height: 2;
            letter-spacing: .4px;
        }
        .input-col{
            display: block;
            margin-bottom: 2.5rem;
        }
        .phone-number-section select{
            width: 32%;
        }
        .phone-number-section input{
            width: 66%;
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            font-size: 1.3rem;
            line-height: 2;
            letter-spacing: .4px;
            margin-left: 3px;
            margin-top: 2px;
        }
        textarea {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 4rem;
            text-align: left;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 400;
            font-style: normal;
            font-weight: 500;
            font-size: 1rem;
            line-height: 2;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1);
            height: 10rem;
            padding: 0.6875rem 1rem;
            width: 100%;
        }
        .send-email-btn{
            margin-top: 2.5rem;
            display: flex;
            justify-content: flex-end;
        }
        .send-email-btn button {
            align-items: center;
            align-content: center;
            -webkit-appearance: none;
            border: 0 none;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            display: inline-flex;
            min-height: 4rem;
            padding: 1.5rem 2.5rem;
            font-weight: 400;
            font-size: 1.5rem;
            line-height: 1.25;
            letter-spacing: .4px;
            font-family: inherit;
            justify-content: center;
            background: #19110b;
            color: #fff;
        }
        .email-use-page-footer {
            font-weight: 300;
            font-size: 1rem;
            line-height: 2;
            letter-spacing: .4px;
            margin: 2.5rem 0 0 0;
            border-top:1px solid #eae8e4;
            padding: 30px 0px;
        }

        @media only screen and (max-width: 600px) {
            .email-section {
                background-color: #f5f5f5;
                padding: 0px 0px;
            }
            .email-section-content{
                margin-top: 1px;
            }
            .email-section-left {
                padding: 11px;
                box-sizing: border-box;
                padding-left: 6.4vw;
                padding-right: 6.4vw;
            }
            h1.other-box-title {
                font-weight: bold;
                font-size: 26px;
                margin-bottom: 13px;
                padding-bottom: 0px;
            }
        }
        @media only screen and (min-width: 64em) {
            .email-use-page-footer {
                border-top: #eae8e4 1px solid;
                margin-top: 2.5rem;
                padding-top: 2.5rem;
            }
        }
        .has-error{
            color:red;
        }
        .error{
            border-color:red;
        }
        h1.other-box-title {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
    <style>

        ul.filter-list li:first-child,ul.filter-list li{
            font-size: 16px;
            cursor: auto;
            padding: 0;
            border-left: 0px solid #eee;
            color: #000;
        }
        ul.filter-list {
            padding: 0;
        }
        ul.filter-list li{
            display: inline-block;
        }
        ul.filter-list li a {
            display: inline-block;
            padding: 23px 25px;
            transition: all 0.5s ease;
            margin: 0;
            border-left: 1px solid #eee;
        }
        ul.filter-list li a:hover{
            box-shadow: inset 0 -1px 0 0 #19110b;
        }
        ul.filter-list li a.other-page-active{
            box-shadow: inset 0 -4px 0 0 #19110b;
        }
        .other-page-content-area {
            background: #f6f5f3;
            padding: 50px 0;
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
            margin: 7px 0;
        }
        h1.other-box-title {
            font-weight: bold;
            font-size: 20px;
        }
        a.send-and-email{
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
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1),box-shadow .3s cubic-bezier(0.39,0.575,0.565,1),color .3s cubic-bezier(0.39,0.575,0.565,1),background .3s cubic-bezier(0.39,0.575,0.565,1);
            background: rgba(234,232,228,0);
            box-shadow: inset 0 0 0 1px #19110b;
            color: #19110b;
            width: 100%;
            padding: 19px 0;
            font-size: 15px;
            margin: 10px 0;
        }
        a.send-and-email:hover{
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
            font-family: "Louis Vuitton Web","Helvetica Neue",Helvetica,Arial,sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 1rem;
            line-height: 2;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1);
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
        .fall-back i{
            margin-left: 10px;
            padding: 30px 50px;
            background:#fff;
            color: #000;
        }
        .fall-back i:hover{
            background:#EAE8E4;
            color: #000;
        }

        @media (min-width: 320px) and (max-width: 400px) {
            .email-section-content{
                margin-top: 1px;
            }
            ul.filter-list li a{
                margin-left: 20px;
                font-size: 13px;
            }
        }
    </style>
@endsection

@section('content')
    @include('frontend.partial.other_page_nav')
    <div class="row body-height-full">
        <div class="email-section" style="background-color: #f5f5f5; padding: 2px 26px 35px 26px;">
            <div class="col-12 col-sm-12 col-md-8 col-xl-8 email-section-left">
                @if(Session::has('status'))
                    <div class="alert alert-success">{{ Session()->get('status') }}</div>
                @endif
                 <h1 class="other-box-title">EMAIL US</h1>
                <p class="email-section-content">Please provide the following information and the client service will answer your enquiry as quickly as possible. You can also visit the FAQ section where you can find the list of the most frequently asked questions.</p>
                <div class="col-12 col-sm-12 email-us-mandatory d-flex justify-content-end">
                    <p>
                        <b>Mandatory fields<exp style="color: darkred">*</exp></b>
                    </p>
                </div>
                <div class="col-12 col-sm-12">
                    <form action="{{ route('email.us') }}" method="post">
                        @csrf
                        <div class="email-form">
                            <div class="input-col">
                                <label for="" class="{{ $errors->has('name_title') ? 'has-error' :'' }}">
                                    Title*
                                </label>
                                <div class="inputColumnTable">
                                    <div class="inputColumnRow">
                                        <select  name="name_title"  class="{{ $errors->has('name_title') ? 'error' :'' }}">
                                            <option  value="">Select:</option>
                                            <option {{ old('name_title') == 'Mr' ? 'selected' : '' }} value="Mr">Mr</option>
                                            <option {{ old('name_title') == 'Mrs' ? 'selected' : '' }} value="Mrs">Mrs</option>
                                            <option {{ old('name_title') == 'Mx' ? 'selected' : '' }} value="Mx">Mx</option>
                                            <option {{ old('name_title') == 'Unknown' ? 'selected' : '' }} value="Unknown">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-col">
                                <label for="firstName" class="fieldLabel {{ $errors->has('firstName') ? 'has-error' :'' }}">
                                    First name*
                                </label>
                                <div class="inputColumn">
                                    <div class="inputColumnTable">
                                        <div class="inputColumnRow">
                                            <input id="firstName" aria-describedby="firstNameDescription firstNameError" maxlength="40" dir="auto" name="firstName" aria-invalid="false" value="{{ old('firstName') }}" type="text" class="{{ $errors->has('firstName') ? 'error' :'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-col">
                                <label for="email" class="fieldLabel {{ $errors->has('email') ? 'has-error' :'' }}">
                                    E-mail Address*
                                </label>
                                <div class="inputColumn">
                                    <div class="inputColumnTable">
                                        <div class="inputColumnRow">
                                            <input class="{{ $errors->has('email') ? 'error' :'' }}" id="email" aria-describedby="emailDescription emailError" maxlength="50" dir="auto" aria-invalid="false" name="email"  value="{{ old('email') }}" type="email" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-col">
                                <label for=""  class="{{ $errors->has('country') ? 'has-error' :'' }}">
                                    Country/Region*
                                </label>
                                <div class="inputColumnTable">
                                    <div class="inputColumnRow">
                                        <select id="country" name="country" class="{{ $errors->has('country') ? 'error' :'' }}">
                                            <option value=""> Select your Country/Region </option>
                                            @foreach($countries as $country)
                                            <option {{ old('country') == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="input-col ">
                                <label for=" emailUsPhoneNumber " class="fieldLabel ">
                                    Phone
                                </label>
                                <div class="inputColumn">
                                    <div class="inputColumnTable">
                                        <div class="phone-number-section">
                                            <select id="phone_code" title="Country code " name="number_prefix" aria-invalid="false">
                                            <option value="">Select Phone Code</option>
                                            @foreach($countries->where('phonecode','!=',0)->sortBy('phonecode') as $country)
                                                <option {{ old('number_prefix') == $country->id ? 'selected' : '' }} value="{{ $country->id }}">+{{ $country->phonecode }}</option>
                                            @endforeach
                                            </select>
                                            <input maxlength="15" dir="auto" name="number" aria-invalid="false" value="{{ old('number') }}" type="tel">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-col">
                                <label for=""  class="{{ $errors->has('subject_message') ? 'has-error' :'' }}">
                                    Subject of your message*
                                </label>
                                <div class="inputColumnTable">
                                    <div class="inputColumnRow">
                                        <select name="subject_message" aria-invalid="false" class="{{ $errors->has('subject_message') ? 'error' :'' }}">
                                            <option  value="">Select Subject</option>
                                            <option {{ old('subject_message') == 'Product Information' ? 'selected' : '' }} value="Product Information"> Product Information</option>
                                            <option {{ old('subject_message') == 'After sales services' ? 'selected' : '' }} value="After sales services">After sales services</option>
                                            <option {{ old('subject_message') == 'Online purchases' ? 'selected' : '' }} value="Online purchases">Online purchases</option>
                                            <option {{ old('subject_message') == 'Stores information' ? 'selected' : '' }} value="Stores information">Stores information</option>
                                            <option {{ old('subject_message') == 'About Bangladesh Drip"' ? 'selected' : '' }} value="About Bangladesh Drip">About Bangladesh Drip</option>
                                            <option {{ old('subject_message') == 'Careers' ? 'selected' : '' }} value="Careers">Careers</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-col">
                                <label for="email" class="fieldLabel">Insert your order number</label>
                                <div class="inputColumn">
                                    <div class="inputColumnTable">
                                        <div class="inputColumnRow">
                                            <input  maxlength="50" value="{{ old('old_number') }}"  name="old_number"  type="number" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-line">
                                <label for="message"></label>
                                <textarea  id="message"  maxlength="1000" name="message" rows="6">{{ old('message') }}</textarea>
                                <div class="maxLength" id="" tabindex="-1">
                                    (1000 characters max)
                                </div>
                            </div>
                        </div>
                        <div class="send-email-btn">
                            <button id="sendMail" class="submitButton functional-link tagClick" data-urlsubmit="" type="submit" name="submit">
                                Send your email
                            </button>
                        </div>
                    </form>

                    <div class="email-use-page-footer" style="font-size: 13px;display: none">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $('#country').change(function () {
                var countryId = $(this).val();
                $("#phone_code").val(countryId);
            });
            $('#country').trigger("change");
        })
    </script>
@endsection
