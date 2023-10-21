@extends('layouts.landing')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{--@php--}}
{{--dd(app()->getLocale());--}}
{{--@endphp--}}

@section('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <style>
        video{
            object-fit: cover;
            height: 100%;
            margin-bottom: -8px;
        }

        section.home-video-section {height: 100vh !important;}

        .video-area {height: 100%;}

        section.home-video-section {position: relative;}

        .video-content-area {position: absolute;left: 0;bottom: 41px;width: 100%;}

        h1.video-title {
            color: #fff;
            font-weight: bold;
            font-size: 3.375rem;
            line-height: 2.375rem;
            text-transform: uppercase;
            margin-bottom: 25px;
            font-family: 'Source Sans Pro', sans-serif;
        }

        a.video-link {background: #fff;text-align: center;color: #000;padding: 12px 50px;font-size: 14px;}

        a.video-link:hover {background: #ddd;}
        button.btn-video-play {color: #fff;background: #000;border-radius: 50%;width: 40px;height: 40px;border: 1px solid #fff;font-size: 9px;}
        button.btn-video-sound {
            background: transparent;
            color: #fff;
            border: none;
            font-size: 16px;
            margin-right: 20px;
            margin-top: 10px;
            width: 40px;
            height: 40px;
        }
        .video-control-area {
            margin-top: 46px;
        }
        section.video-section {
            position: relative;
        }
        img.landing-image {
            width: 100%;
            height: 100%;
        }
        section.service-area {
            padding: 70px 0;
        }
        h1.service-title {
            font-weight: 500;
            font-size: 30px;
            margin-bottom: 25px;
        }

        h1.service-link-1 {
            font-size: 15px;
            color: #000;
            font-weight: bold;
            margin-bottom: 3px;
            margin-top: 15px;
        }

        h3.service-link-2 {
            font-size: 15px;
            text-decoration: underline;
            font-weight: 500;
        }
        .service-img img {
            height: 665px;
        }
    </style>
    <style>
        section.service-area {
            padding: 35px 0;
        }
        .service-img img {
            height: 350px;
        }
    </style>
@endsection
@section('content')
{{--    @php--}}
{{--        dd(session()->get('language_currency'));--}}
{{--    @endphp--}}
    <section class="home-video-section">
         <div class="video-area">
             <video playsinline="" webkit-playsinline="" muted autoplay loop="loop" tabindex="-1" id="video-1" width="100%" height="300px">
                 <source src="{{ asset($videoFirst ? $videoFirst->video_url : 'img/02.mp4') }}" type="video/mp4">
             </video>
             <script>
                 document.getElementById('video-1').play();
             </script>
         </div>
        <div class="video-content-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-6 col-md-6">
                        <h1 class="video-title">{{ $videoFirst->title }}</h1>
                        <div class="video-link-area">
                            <a class="video-link"  href="{{ $videoFirst ? $videoFirst->url_link : '#' }}">{{ __('common_text.discover_collection_btn_title') }}</a>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" style="text-align: right">
                        <div class="video-control-area">
                            <button class="btn-video-sound" id="sound-btn-1" onclick="toggleMute(1)"><i class="fa fa-volume-off"></i></button>
                            <button class="btn-video-play" id="playBtn-1" onclick="myFunction(1)"><i class="fa fa-pause"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $counter = 2;
    @endphp
    @foreach($videos as $video)
        <?php
            $ext     = explode('.', $video->video_url); // Explode the string
            $fileExtension  = end($ext);
        ?>
    <section class="video-section">
        <div class="video-area">
            @if($fileExtension == 'mp4')
            <video playsinline="" webkit-playsinline="" muted autoplay loop="loop"  id="video-{{ $counter }}" width="100%" height="300px">
                <source src="{{ asset($video ? $video->video_url : 'img/02.mp4') }}" type="video/mp4">
            </video>
                <script>
                    document.getElementById('video-'+'{{ $counter }}').play();
                </script>
            @else
            <img class="landing-image" src="{{ asset($video->video_url) }}" alt="">
            @endif
        </div>
        <div class="video-content-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-6 col-md-6">
                        <h1 class="video-title">{{ $video->title }}</h1>
                        <div class="video-link-area">
                        <a class="video-link"  href="{{ $video ? $video->url_link : '#' }}">{{ __('common_text.discover_collection_btn_title') }}</a>
                        </div>
                    </div>
                    <div class="col-4 col-md-4" style="text-align: right">
                        <div class="video-control-area">
                            <button style="{{ $fileExtension == 'mp4' ? 'display:inline-block' : 'display:none' }}" class="btn-video-sound" id="sound-btn-2" onclick="toggleMute(2)"><i class="fa fa-volume-off"></i></button>
                            <button style="{{ $fileExtension == 'mp4' ? 'display:inline-block' : 'display:none' }}" class="btn-video-play" id="playBtn-2" onclick="myFunction(2)"><i class="fa fa-pause"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $counter++;
    @endphp
    @endforeach


    <section class="service-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="service-title"> {{ __('common_text.service_title') }}</h1>
                </div>
            </div>
            <div class="row service-text-center">
                <div class="col-md-4 offset-md-1">
                    <a href="{{ route('stores') }}" class="service-area-link">
                        <div class="service-img">
                            <img src="{{ asset('img/personal.jpeg') }}" alt="">
                        </div>
                        <div class="service-details">
                            <h1 class="service-link-1">{{ __('common_text.service_appointment') }}</h1>
                            <p>{{ __('common_text.service_short_description') }}</p>
                            <h3 class="service-link-2">{{ __('common_text.service_book_an_appointment') }}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 offset-md-2">
                    <a href="{{ route('start_the_journey') }}" class="service-area-link">
                        <div class="service-img">
                            <img src="{{ asset('img/contact_us.jpeg') }}" alt="">
                        </div>
                        <div class="service-details">
                            <h1 class="service-link-1">{{ __('common_text.service_contact_us') }}</h1>
                            <p>{{ __('common_text.contact_short_description') }}</p>
                            <h3 class="service-link-2">{{ __('common_text.contact_ask_our_advisors') }}</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        let options = {
            root: null,
            rootMargin: '0px',
            threshold: 1.0,
        };
        let callback = (entries,observer) =>{
            entries.forEach(entry =>{
                if(entry.target.id == 'video-2'){
                    //alert('hello');
                    if(entry.isIntersecting){
                       // entry.target.play();
                    }else{
                       // entry.target.pause();
                    }
                }
            });
        }
        let observer = new IntersectionObserver(callback,options)
        observer.observe(document.querySelector('#video-2'));
    </script>
    <script>
        function myFunction($number) {
            var video = $("#video-"+$number).get(0);

            if (video.paused) {
                video.play();
                $("#playBtn-"+$number).html('<i class="fa fa-pause"></i>');
            } else {
                video.pause();
                $("#playBtn-"+$number).html('<i class="fa fa-play"></i>');
            }
        }
        function toggleMute($number){
            if( $("#video-"+$number).prop('muted') ) {
                $("#video-"+$number).prop('muted', false);
                $("#sound-btn-"+$number).html('<i class="fa fa-volume-up"></i>');
            } else {
                $("#video-"+$number).prop('muted', true);
                $("#sound-btn-"+$number).html('<i class="fa fa-volume-off"></i>');
            }

        }
    </script>
@endsection
