<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title> {{ __('common_text.title') }}</title>
    <!-- ************************* CSS Files ************************* -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/bootstrap.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/assets/css/font-awesome.min.css') }}">

    <style>
        .navigation-bar {
            background-color: #fff;
            padding: 2rem 3rem;
            align-items: stretch;
            border-bottom: 1px solid #e1dfd8;
        }
        .navigation-bar-2 {
            background: #f6f5f3;
            padding: 2rem 3rem;
        }
        .nav-text h3 {
            font-weight: 700;
            font-size: 15px;
            margin-top: 14px;
        }
        h3.region-title {
            text-align: left;
            font-size: 15px;
            font-weight: 600;
        }

        .country-list {
            background: #f6f5f3;
            border-bottom: 1px solid #e1dfd8;
        }

        html {
            height: 100%;
        }

        body {
            height: 100%;
        }
        ul.county-names li {
            list-style: none;
            font-size: 15px;
        }

        ul.county-names {
            margin: 0;
            padding-left: 0;
        }

        ul.county-names li a {
            color: #000;
            margin: 15px 0;
            display: block;
        }
        ul.county-names li a i {
            color: gray;
        }
        .border-column {
            border-right: 1px solid #e1dfd8;
        }
        h3.region-title {
            padding-top: 40px;
        }
        p.default-language {
            font-size: 13px;
            color: #000;
            font-weight: bold;
        }

        p.default-language a {
            font-weight: normal;
            color: #000;
            font-size: 14px;
        }
        a.locale {
            cursor: pointer;
        }
        .form-control {
            color: #000;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            border: 1px solid #ddd;
        }

        label {
            color: #000;
            font-size: 15px;
            font-weight: bold;
        }
        .form-control:focus {
            color: #000;
            background-color: #fff;
            border-color: #ddd;
            outline: 0;
            box-shadow: none;
        }
        .language-currency-title-area {
            background: #F6F5F3;
            padding: 16px 0;
        }

        .language-currency-title h3 {
            font-size: 19px;
            color: #000;
        }
        .language-footer-area {
            height: 24vh;
        }

        .language-footer-text h4 {
            font-size: 20px;
            font-weight: 600;
        }

        .language-footer-text p {
            color: #000;
        }
        .language-footer-text h4 img {
            height: 50px;
        }
        SELECT {
            background: url("data:image/svg+xml,<svg height='10px' width='10px' viewBox='0 0 16 16' fill='%23000000' xmlns='http://www.w3.org/2000/svg'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>") no-repeat;
            background-position: calc(100% - 0.75rem) center !important;
            -moz-appearance:none !important;
            -webkit-appearance: none !important;
            appearance: none !important;
            padding-right: 2rem !important;
        }
        p.locale {
            color: #000;
            font-size: 15px;
            cursor: pointer;
        }
        p.locale:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="navigation-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="logo-area">
                        <a href="{{ route('home') }}">
                            <img height="50px" src="{{ asset('img/logo.png') }}" alt="Logo" />
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="language-currency-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="language-currency-title text-center">
                        <h3>CHOOSE <br> LANGUAGE & CURRENCY</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="language-or-currency-change-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 pt-5 col-md-4 text-center">
                    <div class="single-language-area">
                        <div class="form-group">
                            <label for="americas">AMERICAS</label>
                            <p class="locale" data-id="en_usd"><img width="25px" src="{{ asset('img/usa.png') }}" alt=""> ENGLISH/USD</p>
                        </div>
                        <div class="form-group">
                            <label for="middle_east">MIDDLE EAST</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <p data-id="aed_aed" class="locale"> <img width="25px" src="{{ asset('img/aed.png') }}" alt=""> AED/ عرب </p>
                                </div>
                                <div class="col-md-6">
                                    <p data-id="en_aed" class="locale"><img width="25px" src="{{ asset('img/aed.png') }}" alt=""> ENGLISH/AED</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asia">ASIA</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="locale" data-id="bn_bdt"><img width="25px" src="{{ asset('img/bn.png') }}" alt=""> বাংলা/BDT</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="locale" data-id="en_bdt"><img width="25px" src="{{ asset('img/bn.png') }}" alt=""> ENGLISH/BDT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="language-footer-area d-flex align-items-end">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="language-footer-text">
                        <h4><img src="{{ asset('img/shipping_worldwide.png') }}" alt=""> NOW SHIPPING WORLDWIDE</h4>
                        <p>{{ date('Y') }} BD</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery JS -->
    <script src="{{ asset('themes/frontend/assets/js/vendor/jquery.min.js') }}"></script>

    <script>
        $(function (){
            $('body').on('click', '.locale', function(){
                var lang = $(this).data('id');
                if (lang != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('change_language') }}",
                        data: {lang: lang }
                    }).done(function(response) {
                        location.replace('{{ route('home') }}');
                    });
                }
            })
        })

    </script>
</body>
</html>
