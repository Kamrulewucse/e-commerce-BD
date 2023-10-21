@extends('layouts.app')
@section('style')
    <style>

        @media screen and (min-width: 48rem) {
            .bd-world-title {
                margin: 3.5rem 0 4rem;
            }
            p.bd-world-title {
                margin-top: 34px;
            }
        }

        @media screen and (min-width: 0rem) {
            .bd-world-title {
                margin: 1.5rem 0 2.5rem;
            }
            p.bd-world-title {
                margin-top: 30px;
            }

            .bd-world-title {
                margin: 0.67em 0;
            }
        }

        @media screen and (min-width: 48rem) {
            .bd-world-title {
                font-size: 2rem;
                letter-spacing: 0;
                line-height: 8rem;
                color: #19110b;
                font-weight: 500;
            }
            p.bd-world-title {
                margin-top: 30px;
            }
        }

        ul.bd-world-menu-list li {
            display: inline;
        }

        ul.bd-world-menu-list li a {
            display: inline-block;
            padding: 0;
            margin: 5px 5px;
            color: #19110b;
        }

        .bd-world-sticky {
            border-bottom-color: #eae8e4;
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 4%), 0 12px 20px 0 rgb(0 0 0 / 8%);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999999999;
            transition: all 0.5s ease;
        }
        section.bd-world-nav-area {
            background: #fff;
            padding: 24px 0;
            transition: all 0.5s ease;
        }

        .bd-world-category-title {
            font-size: 4.5rem;
            letter-spacing: 0;
            line-height: 4rem;
            color: #19110b;
            font-weight: 400;
        }

        a.explorer-btn {
            background: #19110b;
            color: #fff;
            min-width: 25rem;
            display: inline-block;
            padding: 15px 0;
            margin: 25px 0;
            transition: border .3s cubic-bezier(.39,.575,.565,1),box-shadow .3s cubic-bezier(.39,.575,.565,1),color .3s cubic-bezier(.39,.575,.565,1),background .3s cubic-bezier(.39,.575,.565,1),box-shadow .3s cubic-bezier(.39,.575,.565,1);
        }

        a.explorer-btn:hover {
            color: #19110b;
            background: #EAE8E4;
        }
        section.bd-world-category-wise-content {
            padding: 40px 0;
        }

        section.bd-world-category-wise-content {
            padding: 40px 0;
        }

        span.bd-world-cate-content-sub-title {
            display: block;
            color: #19110b;
            font-size: 15px;
            text-transform: uppercase;
            font-weight: 500;
            margin-top: -20px;
            margin-bottom: 6px;
        }

        span.bd-world-cat-content {
        }


        span.bd-world-cate-content-title {
            font-size: 20px;
            color: #19110b;
            font-weight: 600;
            padding: 8px 0;
            display: block;
            text-transform: uppercase;
            line-height: 22px;
        }

        span.bd-world-cat-content {
            display: block;
            padding: 20px 0;
        }

        h1.bd-world-category-title {
            font-weight: 600;
        }
        p.category-sub-title {
            display: block;
            font-size: 16px;
            padding: 7px 0;
            margin-bottom: 12px;
            color: #19110b;
        }
        section.bd-world-footer {
            background: #F6F5F3;
            padding: 60px 0;
        }

        ul.bd-world-social-list li {
            display: inline;
        }

        ul.bd-world-social-list li a {
            display: inline-block;
            text-decoration: underline;
            margin: 2px 7px;
            color: #19110B;
        }
        h1.bd-world-category-title.bd-world-fotter-title {
            font-size: 3rem;
            margin-top: 30px;
        }
        ul.bd-world-menu-list li a.active {font-weight: 700;position: relative;}

        ul.bd-world-menu-list li a.active:before {
            position: absolute;
            content: "";
            left: 0;
            bottom: -28px;
            width: 100%;
            height: 1px;
            background: #19110b;
        }
        .first-img-bd-world-area{
            display: block;
            max-height: 500px;
            overflow: hidden;
        }
        span.bd-world-cat-content.first-img-bd-world-content span.bd-world-cate-content-title {
            font-size: 30px;
            line-height: 30px;
        }
        section.bd-world-category-wise-content.bd-world-category-wise-content-first {
            padding: 0;
        }
        @media (max-width: 61.94em){
            section.bd-world-title-area {
                padding-top: 114px;
            }
        }
        a.magazine-link {
            width: 100%;
        }

        span.bd-world-cat-img {
            width: 100%;
            display: block;
        }
        span.bd-world-cat-img img {
            height: 244px;
            object-fit: cover;
            width: 100%;
        }
        .title-layout{
            margin-top: -45px;
            margin-bottom: -50px;
        }
        ul.bd-world-menu-list li a.active:before {
            bottom: 0px;
        }
        section.bd-world-nav-area {
            margin-bottom: -23px;
        }
        span.bd-world-cate-content-title {
            padding: 0px 0;
            margin-top: -14px;
        }
        span.bd-world-cat-content.first-img-bd-world-content span.bd-world-cate-content-title {
            font-size: 20px;
        }
        section.bd-world-category-wise-content {
            padding: 0px 0;
        }
        .bd-world-category-title {
            font-size: 2.5rem;
        }
        .bd-world-category-title{
            margin-top: -32px;
        }
        span.bd-world-cat-img img {
            height: 300px!important;
        }
        span.bd-world-cate-content-title {
            font-size: 18px;
        }
        /*p.bd-world-title {*/
        /*    margin-top: 23px;*/
        /*}*/
    </style>
@endsection
@section('content')
    <section class="bd-world-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title-layout">
                    <p class="bd-world-title">World of Bangladesh Drip</p>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.partial.bd_world_nav')
    @if($magazine)
    <section class="bd-world-category-wise-content bd-world-category-wise-content-first">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 text-center">
                    <a href="{{ route('magazine_details',['slug'=>$magazine->slug]) }}">
                        <span class="bd-world-cat-img first-img-bd-world-area">
                            <img src="{{ asset($magazine->image) }}" alt="">
                        </span>
                        <span class="bd-world-cat-content first-img-bd-world-content">
                            <span class="bd-world-cate-content-sub-title">{{ $magazine->sub_title }}</span>
                            <span class="bd-world-cate-content-title">{{ $magazine->title }}</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    @foreach($categories as $category)
        @if($category->magazines->count() > 0)
            <section class="bd-world-category-wise-content">
                <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="bd-world-category-title">{{ $category->name }}</h1>
{{--                    <p class="category-sub-title">{{ $category->description }}</p>--}}
                </div>
            </div>
            <div class="row ">
                @foreach($category->magazines->take(6) as $magazine)
                   @if($category->magazines->count() == 1 || $category->magazines->count() == 2)
                        <div class="col-12 col-md-6">
                            <a class="magazine-link" href="{{ route('magazine_details',['slug'=>$magazine->slug]) }}">
                        <span  class="bd-world-cat-img">
                            <img src="{{ asset($magazine->image) }}" alt="">
                        </span>
                                <span class="bd-world-cat-content">
                            <span class="bd-world-cate-content-sub-title">{{ $magazine->sub_title }}</span>
                            <span class="bd-world-cate-content-title">{{ $magazine->title }}</span>
                        </span>
                            </a>
                        </div>
                    @else
                        <div class="col-12 col-md-4">
                            <a class="magazine-link" href="{{ route('magazine_details',['slug'=>$magazine->slug]) }}">
                                <span class="bd-world-cat-img">
                                    <img src="{{ asset($magazine->image) }}" alt="">
                                </span>
                                <span class="bd-world-cat-content">
                            <span class="bd-world-cate-content-sub-title">{{ $magazine->sub_title }}</span>
                            <span class="bd-world-cate-content-title">{{ $magazine->title }}</span>
                        </span>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
           @if($category->magazines->take(6)->count() > 6)
            <div class="row">
                <div class="col-12 text-center">
                    <a href="{{ route('category_details_magazine',['slug'=>$category->slug]) }}" class="explorer-btn">Explore
                        {{ $category->name }}</a>
                </div>
            </div>
            @endif
        </div>
            </section>
      @endif
    @endforeach

    <section class="bd-world-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4 style="color: #19110B">NEWSLETTER</h4>
                    <h1 class="bd-world-category-title bd-world-fotter-title">
                        THE LATEST NEWS FROM THE <br> WORLD OF BANGLADESH DRIP
                    </h1>
                    <a href="{{ route('newsletter') }}" class="explorer-btn">Subscribe</a>
                    <p style="color: #19110B" class="footer-bd-world-small-text">Be the first to know. Follow us on</p>
                    <ul class="bd-world-social-list">
                        <li><a target="_blank" href="https://instagram.com/worldofbdclothing">Instagram</a></li>
                        <li><a target="_blank" href="https://www.facebook.com/worldofbdclothing">Facebook</a></li>
                        <li><a target="_blank" href="https://www.twitter.com/worldofbda">Twitter</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCmwPxY_yThhlsAQ9uznyGKQ/">Youtube</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                if ($(document).scrollTop() > 200) {
                    $('#bd-world-nav').fadeIn('slow');
                    $('#bd-world-nav').addClass('bd-world-sticky')
                } else {
                    $('#bd-world-nav').removeClass('bd-world-sticky')
                }
            });
        });
    </script>
@endsection
