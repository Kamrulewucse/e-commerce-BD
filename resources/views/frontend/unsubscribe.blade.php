@extends('layouts.app')
@section('style')
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .left-form {
            background-color: #f5f5f5;

        }

        .form-field {
            margin-left: 20px;
            margin-right: 50px;
            background-color: white;
            padding: 40px;
            margin-bottom: 0px;
        }

        .form-header {
            margin-left: 50px;
            margin-right: 50px;
        }

        .form-header h1 {
            font-weight: bold;
            font-size: 33px;
            margin-top: 50px;
            font-family:  "Helvetica Neue", Helvetica, Arial, sans-serif;
            border-bottom: 1px solid silver;
            padding-bottom: 20px;
            margin-bottom: 14px;
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
            border: none;
        }

        .account-button:hover {
            background-color: #eae8e4;
            box-shadow: inset 0 0 0 1px #eae8e4;
            color: #19110b;
        }
        .account-area{
            padding: 0px 17px 0px 10px;
        }

        @media (min-width: 300px) and (max-width: 900px){
            .left-form{
                text-align: center;    
            }
            .left-form a{
                width: 365px;
                border: 2px solid #000;
                text-align: center;
                margin: 0px;
                padding: 0px;
            }
            .account-button {
                background: white;
                color: black;
                border: 1px solid black;
                text-align: center;
                width: 100%;
            }
            .account-button {
                margin-left: 4px;
            }
        }
        @media (min-width: 320px) and (max-width: 400px){
            .left-form{
                text-align: center;
            }
            .left-form a{
                width: 365px;
                border: 2px solid #000;
                text-align: center;
                margin: 0px;
                padding: 0px;
            }
            .account-button {
                background: white;
                color: black;
                border: 1px solid black;
                text-align: center;
                width: 100%;
            }
            .account-button {
                margin-left: 4px;
            }
        }
        @media (min-width: 360px) and (max-width: 400px){
            .left-form{
                text-align: center;
            }
            .left-form a{
                width: 350px;
                border: 2px solid #000;
                text-align: center;
                margin: 0px;
                padding: 0px;
            }
            .account-button {
                background: white;
                color: black;
                border: 1px solid black;
                text-align: center;
                width: 100%;
            }
            .account-button {
                margin-left: 4px;
            }
        }
        @media (min-width: 1080px) and (max-width: 1920px){
            .left-form a{
                margin: 0px 0px 80px 60px;
            }
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
                                prefer to not receive emails. By subscribing you agree to our Privacy Policy.
                            </label>
                            @error('privacy_policy')
                            <span class="help-block" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="left-form">
                    <div class="form-header">
                        <h1>UNSUBSCRIBE FROM THE NEWSLETTER</h1>
                    </div>
                    <div class="form-field" style="background: #F5F5F5;">
                        <p style="color: #000;font-size: 16px">
                            {{ session('notification_message') }}
                        </p>
                        {{-- <a href="{{ route('home') }}" type="button" style="background:#000;; color:#fff; padding: 7px 10px; border: 2px solid #000;" class="btn-next">Back to Homepage</a> --}}
                    </div>
                    <a href="{{ route('home') }}" type="button" style="background:#000;; color:#fff; padding: 7px 10px; border: 2px solid #000;" class="btn-next">Back to Homepage</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="account-area">
                    <div class="input-button">
                        <div class="d-grid">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-block input-full account-button">I Already have an
                                account</a>
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

    <script>
        $(document).ready(function(){
            $('#showImg').on('click', function(){
                $('#viewItem').show();
            });
            $('#viewItem').on('click', function(){
                $('#viewItem').hide();
            });
        });
    </script>
@endsection