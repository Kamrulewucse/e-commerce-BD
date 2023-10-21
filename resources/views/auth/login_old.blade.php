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
            margin: 8px 0;
            height: 42px;
        }

        h1.user-card-title {
            padding: 8px 0;
        }
        .form__input--3 {
            height: 5rem;
            line-height: 6.8rem;
        }
        label.form__label.form__label--2 {
            font-size: 16px;
        }
        h1.contact-page-title {
            font-weight: bold;
            font-size: 32px;
            border-bottom: #eae8e4 1px solid;
            margin-bottom: 25px;
            padding-bottom: 17px;
        }
        .page-content-inner {
            padding: 50px 0;
        }
    </style>
@endsection
@section('content')
    <div class="page-content-inner">
        <div class="container">
            <div class="padding-spacing"></div>
            <div class="row ">
                <div class="col-md-6 offset-md-3">
                    <h1 class="contact-page-title">Welcome to Bangladesh Drip</h1>
                    <h1 class="user-card-title">Login</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="register-box">

                                @if($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <form class="form form--login" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="email">Email/Username<span
                                                class="required">*</span></label>
                                        <input value="{{ old('email') }}" type="text" required class="form__input form__input--3" id="email" name="email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="password">Password <span
                                                class="required">*</span></label>
                                        <input type="password" class="form__input form__input--3" id="password" name="password"
                                               required autocomplete="new-password">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="remember">
                                            <input type="checkbox" class="" id="remember" name="remember">
                                            Remember Me</label>

                                    </div>
                                    <input type="hidden" name="redirect" value="{{ request()->get('redirect') }}">

                                    <p class="privacy-text mb--20">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    </p>
                                    <div class="form__group">
                                        <input type="submit" value="Login" class="btn btn-submit btn-style-1"> OR
                                        <a href="{{ route('register') }}" class="btn btn-submit btn-style-1">Sign Up</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
