@extends('layouts.app',['category_dir'=>$subSubCategory->category->name])
@section('style')
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('themes/frontend/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/frontend/owlcarousel/assets/owl.theme.default.min.css') }}">
    <style>
        .page-top-description {
            padding: 30px 0;
        }

        h2.page-title {
            font-weight: bolder;
        }

        .product-plate-single-item {
            width: 23%;
            margin-right: 5px;

        }

        .side-navigation-inner {
            padding: 0 0 0 22px !important;
        }

        .product-other-thumbs-color {
            height: 77px;
        }

        .product-plate-content h3 {
            font-size: 11px;
            padding: 7px 0;
        }

        .side-navigation-wrapper {
        }

        .slide-bar-pate-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: auto;
            text-align: center;
            background: #fff;
            box-shadow: 0 -4px 8px 0 rgb(0 0 0 / 4%), 0 -8px 16px 0 rgb(0 0 0 / 4%);
            left: 0;
            padding: 24px 0;
        }

        .slide-bar-pate-footer a {
            background: #000;
            width: 88%;
            margin: 0 auto;
            color: #fff;
            padding: 11px 0;
        }

        ul.size-plate-list li {
            float: left;
            width: 23%;
            border: 1px solid #ddd;
            margin-right: 8px;
            text-align: center;
            margin-top: 13px;
            min-height: 45px;
            line-height: 45px;
        }

        .single-color-plate-active {
            border: 1px solid #000 !important;
        }

        .owl-carousel .owl-item img {
            height: 400px !important;
        }

        .owl-dots {
            display: none;
        }

        /*@media screen and (max-width: 400px) {*/
        /*    .product-other-thumbs-color {*/
        /*        height: 55px;*/
        /*    }*/
        /*    .wish-list.wishlist-btn {*/
        /*        margin-top: 20px;*/
        /*    }*/
        /*    ul.color-plate-img {*/
        /*        margin-right: 10px;*/
        /*    }*/
        /*}*/
        .post-title {
            font-size: 1.4rem !important;
            margin-top: -11px !important;
            text-align: left !important;
        }

        .post-media .image {
            height: 408.16px;
        }

        .post-media .image img {
            height: 100%;
        }

        @media (min-width: 300px) and (max-width: 900px) {
            p.page-description {
                margin-top: 50px;
            }
        }

        @media (min-width: 320px) and (max-width: 450px) {
            .post-media .image {
                /*height: 229px;*/
            }

            .post-media .image img {
                /*height: 229px;*/
            }
        }

        .page-content-inner {
            background: #ffffff;
        }
    </style>
    <style>
        /* The container */
        .container-modal {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container-modal input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: transparent;
            border: 2px solid #000;
        }

        /* On mouse-over, add a grey background color */
        .container-modal:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container-modal input:checked ~ .checkmark {
            background-color: #000;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container-modal input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container-modal .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .container-modal {
            font-size: 15px;
            color: #000;
            font-weight: 600;
        }
        .product-item-plate-container ul {
            padding: 15px 0;
        }
        .post-media .image {
            height: auto;
        }

    </style>
@endsection
@section('content')
    <div class="page-top-description">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">{{ $subSubCategory->name }}</h2>
                    <p class="page-description">
                        {!! $subSubCategory->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-area">
        <div class="container-fluid">
            <div class="row">
                <ul class="filter-list">
                    <li class="d-none d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">
                        FILTERS:
                    </li>
                    <li class="d-sm-none d-lg-none d-xl-none">View by look</li>
                    @if (count($collections) > 0)
                        <?php
                        $selectedCollections = explode(',', request()->get('collection'))
                        ?>
                            <li><a id="color-plate" href="#color-plate-box">Collections</a></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
    <!-- Main Content Wrapper Start -->
    <div id="content" class="main-content-wrapper body-height-full">
        <div class="page-content-inner">
            <div class="container-fluid">
                <div class="row pt--80 pt-md--60 pt-sm--50">
                    @foreach($products as $product)
                        <div class="col-sm-6 col-12 col-lg-3 mb--40 mb-md--30 mb-sm--25">
                            <article class="post">
                                <div class="post-media">
                                    <div class="image">
                                        <img src="{{ asset($product->view_thumb) }}" alt="">
                                        <a href="{{ route('page.view_by_look_product_details',['slug'=>$product->slug]) }}"
                                           class="link-overlay">Blog</a>
                                    </div>
                                </div>
                                <div class="post-info">
                                    <h3 class="post-title">
                                        <a style="font-size: 15px; font-weight: 550;" href="{{ route('page.view_by_look_product_details',['slug'=>$product->slug]) }}">{{ $product->name }}</a>
                                    </h3>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <nav class="pagination-wrap">
                    {{ $products->appends($appends)->links('layouts.partial.pagination') }}
                </nav>
            </div>
        </div>
    </div>
    <!-- Main Content Wrapper Start -->

    @if (count($collections) > 0)
    <aside class="side-navigation side-navigation--left" id="color-plate-box">
        <div class="side-navigation-wrapper">
            <div class="slide-bar-login-area">
                <h3>Collections ({{ count($collections) }})</h3>
            </div>
            <div class="side-navigation-inner">
                <div class="product-item-plate-container">

                    <ul>
                        @foreach($collections as $collection)
                            <li>
                                <label class="container-modal">{{ $collection->name }}
                                    <input {{ in_array($collection->id, $selectedCollections) ? 'checked' : '' }} data-id="{{ $collection->id }}" class="btn-collection {{ in_array($collection->id, $selectedCollections) ? 'active' : '' }}" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="slide-bar-pate-footer">
                <a href="#" class="btn-show-product">Show {{ $products->count() }} Products</a>
            </div>
        </div>
    </aside>
    @endif
    <aside class="side-navigation side-navigation--left" id="size-plate-box">
        <div class="side-navigation-wrapper">
            <div class="slide-bar-login-area">
                <h3>SIZES</h3>
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            </div>
            <div class="side-navigation-inner">
                <div class="product-item-plate-container">

                </div>
            </div>
            <div class="slide-bar-pate-footer">
                <a href="#" class="btn-show-product">Show Products</a>
            </div>
        </div>
    </aside>

@endsection
@section('script')
    <script src="{{ asset('themes/frontend/owlcarousel/owl.carousel.js') }}"></script>
    <script>
        var colorIdArray = [];
        $(function () {
            $(".btn-close").click(function () {
                // $('body').removeClass('ai-global-overlay overlay-open');
            })

            $('body').on('click', '#color-plate', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var target = $(this).attr('href');
                // var prevTarget = $('.toolbar-btn').attr('href');
                var prevTarget = $(this).parent().siblings().children('#color-plate').attr('href');
                $(target).addClass('open');
                $(prevTarget).removeClass('open');
                if (!$(this).is('.search-btn')) {
                    $('.ai-global-overlay').addClass('overlay-open');
                }
                $('.main-navigation').removeClass('open-mobile-menu');
                $('.dl-menu').removeClass('dl-menuopen');
                $('.menu-btn').removeClass('open');
            });

            $('body').on('click', '#size-plate', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var target = $(this).attr('href');
                // var prevTarget = $('.toolbar-btn').attr('href');
                var prevTarget = $(this).parent().siblings().children('#size-plate').attr('href');
                $(target).addClass('open');
                $(prevTarget).removeClass('open');
                if (!$(this).is('.search-btn')) {
                    $('.ai-global-overlay').addClass('overlay-open');
                }
                $('.main-navigation').removeClass('open-mobile-menu');
                $('.dl-menu').removeClass('dl-menuopen');
                $('.menu-btn').removeClass('open');
            });

            $('.btn-collection').click(function () {
                var id = $(this).data('id');
                var collectionId = '{{ request()->get('collection') }}';

                if ($(this).hasClass('active')) {
                    var collectionId = collectionId.replace(id, "");

                    if (collectionId.charAt(0) == ',')
                        collectionId = collectionId.substr(1);

                    if (collectionId.substr(collectionId.length - 1) == ',')
                        collectionId = collectionId.substring(',', collectionId.length - 1);
                } else {
                    if (collectionId == '')
                        collectionId = id;
                    else
                        collectionId += ',' + id;
                }

                var url = new URL('{{ route('page.view_by_look_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}');

                url.searchParams.set('collection', collectionId);
                window.location.href = url.href;
            });


            $('body').on('click', '.size-plate-single-checked', function () {
                var sizeCheckedId = $(this).data('id');

                if ($(".product-plate-single-color-item-select-" + sizeCheckedId).hasClass('single-color-plate-active')) {
                    $(".product-plate-single-color-item-select-" + sizeCheckedId).removeClass('single-color-plate-active');
                } else {
                    $(".product-plate-single-color-item-select-" + sizeCheckedId).addClass('single-color-plate-active');

                }
                var colorId = '{{ request()->get('color') }}';
                var sizeId = '{{ request()->get('size') }}';

                if ($(".product-plate-single-color-item-select-" + sizeCheckedId).hasClass('size-url-active')) {
                    var sizeId = sizeId.replace(sizeCheckedId, "");

                    if (sizeId.charAt(0) == ',')
                        sizeId = sizeId.substr(1);

                    if (sizeId.substr(sizeId.length - 1) == ',')
                        sizeId = sizeId.substring(',', sizeId.length - 1);
                } else {
                    if (sizeId == '')
                        sizeId = sizeCheckedId;
                    else
                        sizeId += ',' + sizeCheckedId;
                }

                var url = new URL('{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}');
                url.searchParams.set('color', colorId);
                url.searchParams.set('size', sizeId);
                window.location.href = url.href;
            })

        })


        function productDetails(url) {
            window.location.href = url;
        }

        function sliderActive(className, product, color) {
            $('.' + className).closest('.color-plate-img_' + product).find('li').removeClass('color-palate-active')

            //$('.lds_ring_'+product).css('display','block');

            $('.color_single_plate_' + product + '_' + color).addClass('color-palate-active');

            //$('.lds_ring_'+product).css('display','none');

            $('.color-image-slider_' + product + '_' + color).closest('.single-product-area').find('.product-image-owl').removeClass('color-slide-active')
            $('.color-image-slider_' + product + '_' + color).addClass('color-slide-active');

        }

        if (window.matchMedia('(max-width: 400px)').matches) {
            $('.product-image-owl').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                autoplayTimeout: 1000,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        }
        $('.product-image-owl').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
@endsection
