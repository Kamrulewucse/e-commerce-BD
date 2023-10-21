@extends('layouts.app')
@section('style')
    <style>
        .notification-back-btn:hover{
            color: #000;
        }
        .social-main{
            padding: 30px 30px 30px 30px;
        }
        .social-title{

        }
        .socials-links li{
            display: inline-block;
            padding-right: 10px;
            padding-top: 20px;
        }
        .tnx-part{
            margin-top: 25px;
            color: #000;
            font-weight: 500;
        }
        .tnx-part-description{
            padding-top: 25px;
            padding-bottom: 20px;
        }
        .card-description{
            padding: 20px 10px;
        }
        
        @media (min-width: 300px) and (max-width: 900px){
            .bottom-mobile a{
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
                float: none;
            }
        }
        @media (min-width: 320px) and (max-width: 400px){
            .bottom-mobile a{
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
                float: none;
            }
        }

        .bottom-mobile{
            /* float: right; */
        }
        
    </style>
@endsection
@section('content')
    <div class="container-fluid body-height-full" style="background: #F6F5F3">
        <div class="row pt-md--45 pt-sm--25">
            <div class="col-12 col-sm-12 col-md-8 pt--80">
                <div class="card">
                    {{-- <div class="card-header" style="background: #fff">
                        <div class="card-title">
                            <h3><a class="notification-back-btn" href="{{ route('home') }}"><i class="fa fa-long-arrow-left"></i> Back to home</a></h3>
                        </div>
                    </div> --}}
                    <div class="card-body" style="min-height: 150px">
                        <div class="card-description">
                            <p style="color: #000;font-size: 16px">
                                {{ session('user_name') }}
                            </p>
                            <p style="color: #000;font-size: 16px">
                                {{ session('notification_message') }}
                            </p>
                            <p class="tnx-part">Thank You</p>
                            <p class="tnx-part-description">You can provide an account to manage you Newsletter subscription in MyBD</p>
                        </div>
                    </div>
                </div>
                <div class="row pt--30">
                    <div class="col-md-12">
                        <div class="buttons-group bottom-mobile">
                            <a href="{{ route('home') }}" type="button" style="background:#fff; color:#000; padding: 7px 10px; border: 2px solid #000;" class="btn-next"><i class="fa fa-angle-left"></i>&nbsp; Back to Homepage</a>
                            <a href="{{ route('register') }}" type="button" style="background:#000; color:#fff; padding: 7px 10px; border: 2px solid #000;" class="btn-next">Create My BD Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <div class="newslatter-side-boxs vh-100" style="height: 100%;">
                    <div class="card vh-100" style="height: 100%;">
                        <div class="card-body social-main vh-100" style="height: 100%;">
                            <h4 class="social-title"><strong>Follow Us</strong></h4>
                            <ul class="socials-links">
                                <li><a href="https://www.instagram.com/Bangladeshdrip/"><i class="fa fa-instagram" style="color: #000;font-size: x-large"></i></a></li>
                                <li><a href="https://www.facebook.com/Bangladeshdrip/"><i class="fa fa-facebook" style="color: #000;font-size: x-large"></i></a></li>
                                <li><a href="https://www.Twitter.com/bangladeshdrip/"><i class="fa fa-twitter" style="color: #000;font-size: x-large"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCmwPxY_yThhlsAQ9uznyGKQ/"><i class="fa fa-youtube-play" style="color: #000;font-size: x-large"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
