@extends('layouts.app')
@section('style')
    <style>
        .other-page-box {
            min-height: 189px;
        }
    </style>
@endsection
@section('content')
    @include('frontend.partial.other_page_nav')
    <div class="other-page-content-area body-height-full" style="padding: 21px 0px 20px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="contact-page-title">START THE JOURNEY</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="other-page-box">
                        <h1 class="other-box-title">CALL US</h1>
                        <p style="font-size: 15px;padding: 8px 0;" id="phone-number-show">+8801608911692</p>
                        <div class="other-select-country-list">
                            <select id="phone-number-select">
                                <option hidden="hidden">Choose your country</option>
                                <option selected="selected" value="+8801608911692">Bangladesh</option>
                                <option value="+971 58 695 1997" class="functional-link">UAE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="other-page-box">
                        <h1 class="other-box-title">EMAIL US</h1>
                        <p style="font-size: 15px">Our advisors will be delighted to answer your questions</p>
                        <a class="send-and-email" href="{{ route('email.us') }}">Send an email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function (){
            $("#phone-number-select").change(function (){
                let number = $(this).val();

                if(number != ''){
                    $("#phone-number-show").html(number);
                }

            })
            $("#phone-number-select").trigger("change");
        })
    </script>
@endsection
