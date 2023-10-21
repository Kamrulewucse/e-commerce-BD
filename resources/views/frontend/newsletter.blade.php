@extends('layouts.app')
@section('style')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .left-form {
            background-color: #f5f5f5;

        }

        .form-field {
            margin-left: 50px;
            margin-right: 50px;
            background-color: white;
            padding: 22px 40px;
            margin-bottom: 33px;
        }

        .form-header {
            margin-left: 50px;
            margin-right: 50px;
        }

        .form-header h1 {
            font-weight: bold;
            font-size: 26px;
            margin-top: 22px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            border-bottom: 1px solid silver;
            padding-bottom: 15px;
            margin-bottom: 7px;
        }

        .input-button {
            margin-top: 50px;
            margin-bottom:20px;
        }

        .input-full {
            background: white;
            color: black;
            border: 1px solid black;
        }
        .mandatory-field {
            font-weight: 500;
            font-size: 1.rem;
            line-height: 1.7142857142857142;
            letter-spacing: .4px;
            margin-bottom: 1rem;
            text-align: right;
            margin-right: 52px;
        }
        .account-button{
            background: white;
            color: black;
            border: 1px solid black
        }
        .d-grid{
            border: 1.5px solid black;
        }

        .account-button:hover {
            background-color: #eae8e4;
            box-shadow: inset 0 0 0 1px #eae8e4;
            color: #19110b;
        }
        .account-area{
            padding: 0px 17px 0px 10px;
        }

        /* Model For Privecy Policy*/
        .cart-main-title{
            padding-left: 50px;
            color: #000;
            font-weight: bold;
            font-size: 22px;
            text-transform: uppercase;
        }
        .cart-modal-header{
            display: block;
            padding: 10px 0px;
            font-weight: normal;
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
            font-weight: normal !important;
        }
        button.close-modal-btn {
            background: transparent;
            border: none;
            padding-right: 20px;
        }
        .cart-modal-dialog {
            position: fixed;
            bottom: 0px;
            top: 0px;
            left: 479px;
            width: 962px;
        }
        @media (min-width: 300px) and (max-width: 900px){
            .cart-modal-dialog {
                position: fixed;
                bottom: 0px;
                top: 0px;
                left: 60px;
                width: 277px;
            }
        }
        @media (min-width: 320px) and (max-width: 400px){
            .cart-modal-dialog {
                position: fixed;
                bottom: 0px;
                top: 0px;
                left: 60px;
                width: 277px;
            }
        }

        /*@media screen and (min-width: 1366px) and (min-width: 768px) {*/
        /*    .cart-modal-dialog {*/
        /*        position: fixed;*/
        /*        bottom: 0px;*/
        /*        top: 0px;*/
        /*        left: 200px; */
        /*        width: 850px;*/
        /*    } */
        /*}*/

        /*@media screen and (min-width: 1920px) and (min-width: 1080px) {*/
        /*    .cart-modal-dialog {*/
        /*        position: fixed;*/
        /*        bottom: 0px;*/
        /*        top: 0px;*/
        /*        left: 120px; */
        /*        width: 850px;*/
        /*    } */
        /*}*/
        /* @media screen and (min-width: 751px) and (max-width: 768px) {
            .cart-modal-dialog {
                position: fixed;
                bottom: 0px;
                top: 0px;
                left: 110px;
                width: 850px;
            }
        } */

        /* @media only screen and (min-width:801px)  {
            .cart-modal-dialog {
                position: fixed;
                bottom: 0px;
                top: 0px;
                left: 200px;
                width: 850px;
            }
        } */

        /* @media (max-width:1281px) {
            .cart-modal-dialog {
                position: fixed;
                bottom: 0px;
                top: 0px;
                left: 120px;
                width: 850px;
            }
        } */

        /* @media only screen and (min-width: 1025px) {
            .cart-modal-dialog {
                position: fixed;
                bottom: 0px;
                top: 0px;
                left: 120px;
                width: 850px;
            }
        } */

        .modal-sub-body{
            padding: 60px 40px 40px 40px;
        }
        .modal-sub-body h4{
            font-weight: bold;
            font-size: 18px;
        }
        .modal-sub-body .section2{
            font-weight: bold;
            font-size: 15px;
            color: #000;
            padding-top: 25px;
            padding-bottom: 10px;
        }
        .modal-sub-body .section3{
            font-size: 13px;
            color: #8A8683;
            padding-bottom: 20px;
            line-height: 2.2;
        }
        .modal-sub-body .section4{
            font-size: 13px;
            color: #8A8683;
            padding-bottom: 20px;
            line-height: 2.2;
        }
        .modal-sub-body .section5{
            font-size: 13px;
            color: #8A8683;
            padding-bottom: 20px;
            line-height: 2.2;
        }
        .modal-sub-body .section6{
            font-weight: bold;
            font-size: 15px;
            color: #000;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .modal-sub-body .section7{
            font-size: 13px;
            color: #8A8683;
            padding-bottom: 20px;
            line-height: 2.2;
        }
        .modal-sub-body .section8{
            font-size: 13px;
            color: #8A8683;
            padding-bottom: 20px;
            line-height: 2.2;
        }
        .modal-sub-body .section9{
            font-size: 13px;
            color: #8A8683;
            padding-bottom: 20px;
            line-height: 2.2;
        }
    </style>
@endsection

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-8 left-form">
                <div class="form-header">
                    <h1>RECEIVE BANGLADESH DRIP COMMUNICATIONS</h1>
                </div>
                <div class="mandatory-field">
                    <b><span>Mandatory fields<exp> <span class="text-danger">*</span> </exp></span></b>
                </div>
                <div class="form-field subscription-title">
                    <p>Enjoy added benefits and a richer experience by creating a personal account.</p>
                </div>
                <div class="form-field">
                    <form action="{{ route('newsletter') }}" method="post">
                        @csrf
                        <div class="mb-5 {{ $errors->has('sub_name') ? 'has-error' :'' }}">
                            <label for="sub_name" class="form-label">Title <span class="text-danger">*</span></label>
                            <select required class="form-select font-bold" id="sub_name" name="sub_name"  aria-label="Default select example">
                                <option selected value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Mx">Mx</option>
                                <option value="">Prefer not say</option>
                            </select>
                            @error('sub_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 {{ $errors->has('first_name') ? 'has-error' :'' }}">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input required type="text" class="form-control font-bold" id="first_name" name="first_name" value="{{old('first_name')}}">
                            @error('first_name')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 {{ $errors->has('last_name') ? 'has-error' :'' }}">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input required type="text" class="form-control font-bold" id="last_name" name="last_name" value="{{old('last_name')}}">
                            @error('last_name')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 {{ $errors->has('country') ? 'has-error' :'' }}">
                            <label for="country" class="form-label">Country/Region <span class="text-danger">*</span></label>
                            <select required class="form-select font-bold" id="country"  name="country">
                                <option value ="">Please select your country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{old('country') == $country->id ? 'selected' :''}}>{{$country->name}}({{$country->sortname}})</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 {{ $errors->has('email') ? 'has-error' :'' }}">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input required type="email" class="form-control font-bold" id="email" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 {{ $errors->has('verification_email') ? 'has-error' :'' }}">
                            <label for="verification_email" class="form-label font-bold">Email verification <span class="text-danger">*</span></label>
                            <input required type="email" class="form-control font-bold" name="verification_email" id="verification_email" value="{{old('verification_email')}}">
                            @error('verification_email')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check mb-5 {{ $errors->has('privacy_policy') ? 'has-error' :'' }}">
                            <label class="form-check-label">
                                <input required class="form-check-input" type="checkbox" {{ old('privacy_policy')?'checked':'' }}
                                       name="privacy_policy"> <span class="text-danger">*</span> Uncheck the box if you
                                prefer to not receive emails. By subscribing you agree to our <a style="text-decoration: underline" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Privacy Policy</a>
                            </label>
                            @error('privacy_policy')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Proceed</button>
                    </form>
                </div>
                <div class="left-form">
                    <div class="form-header">
                        <h1>UNSUBSCRIBE FROM THE NEWSLETTER</h1>
                    </div>
                    <div id="div1" class="form-field" style="color: #000;">
                        <div class="mb-5">
                            <label for="formGroupExampleInput" class="form-label">Please enter your email to unsubscribe from BD's digital communications.</label>
                        </div>
                        <div class="mb-5">
                            <label for="formGroupExampleInput2" class="form-label">Email</label>
                            <input type="email" class="form-control font-bold" name="unsubscribe_email" value="{{old('unsubscribe_email')}}" id="">

                            @error('unsubscribe_email')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="account-area">
                    <div class="input-button">
                        <div class="d-grid">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-block account-button" style="text-transform:none;">I have an existing account</a>
                        </div>
                    </div>
                    <div class="right-image">
                        <img src="{{ asset('img/previwer.JPG') }}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/frontend/owlcarousel/owl.carousel.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
          $("button").click(function(){
            var email = $("input[name=unsubscribe_email]").val();
            // alert(email);
            $.ajax({type:"POST", url: "{{ route('newsletter_unsubscribe_email') }}",
                data:{email:email},
                // contentType: false,
                // processData: false,
                success: function(result){
            //   $("#div1").html(result.notification_message);
            $("#div1").html(
                    `<p>${result.notification_message}</p>
                    <a href="{{ route('home') }}" type="button" style="background:#000; color:#fff; padding: 7px 10px; border: 2px solid #000; margin-top:10px;" class="btn-next">Back to Homepage</a>`
              );
            // alert(result.notification_message);
            }});
          });
        });
    </script>


@endsection
