@extends('layouts.app')
@section('content')
    @include('frontend.partial.other_page_nav')
    <div class="other-page-content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="contact-page-title">Opening Hours</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="other-page-box">
                        <div class="outlet-list">
                            <h1 class="other-box-title">Dhaka</h1>
                            <p>(43) 7203 800 86</p>

                            <p>Monday to Saturday: 9:30am - 6pm</p>
                            <p>Sunday: 10am - 5pm</p>
                            <p> (Vienna Time)</p>
                        </div>
                        <div class="outlet-list">
                            <h1 class="other-box-title">London</h1>
                            <p>(43) 7203 800 86</p>

                            <p>Monday to Saturday: 9:30am - 6pm</p>
                            <p>Sunday: 10am - 5pm</p>
                            <p> (Vienna Time)</p>
                        </div>
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
