@extends('layouts.app')
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
        .product-other-thumbs-color {height: 77px;}

        .product-plate-content h3 {font-size: 11px;padding: 7px 0;}
        .side-navigation-wrapper {}

        .slide-bar-pate-footer {position: absolute;bottom: 0;width: 100%;height: auto;text-align: center;background: #fff;box-shadow: 0 -4px 8px 0 rgb(0 0 0 / 4%), 0 -8px 16px 0 rgb(0 0 0 / 4%);left: 0;padding: 24px 0;}

        .slide-bar-pate-footer a {background: #000;width: 88%;margin: 0 auto;color: #fff;padding: 11px 0;}
        ul.size-plate-list li {
            float: left;width: 23%;
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
        @media (min-width: 300px) and (max-width: 900px){
            p.page-description {
                margin-top: 50px;
            }
        }
        @media (min-width: 320px) and (max-width: 400px){
            .product-image-owl.owl-carousel {
                /*height: 120px;*/
            }
            .owl-carousel .owl-item img {
                height: 150px !important;
            }
            .color-plate-list {
                margin-top: 12px;
                height: 5px;
                width: 5px;
            }
            li.color-palate-active {
                width: 11px !important;
                height: 11px !important;
                border: 1px solid #000;
                /*margin-right: 120px;*/
                /*margin-top: 11px;*/
                /*margin-bottom: -16px;*/
            }
            .product-details{
                margin-top: 26px;
            }
            p.product-name{
                font-size: 10px;
            }
            .owl-dots {
                text-align: center;
                margin-top: -17px;
            }
            .owl-dots button.owl-dot {
                width: 14px;
                height: 1px;
                border-radius: 15px;
                display: inline-block;
                background: #ccc;
                margin: 0 3px;
            }
            .owl-dots button.owl-dot.active {
                background-color: #000;
            }
            .owl-dots button.owl-dot:focus {
                outline: none;
            }
            .owl-dots {
                display: block;
            }
            .wish-list.wishlist-btn {
                width: 9px;
                margin-top: -11px;
            }
            ul.color-plate-img {
                text-align: right;
            }
        }
        .owl-carousel .owl-item img {
            height: 400px !important;
            background: #F1F0F0;
        }
        ul.color-plate-img li {
            border: 1px solid #000;
        }
    </style>
@endsection
@section('content')
    <div class="page-top-description">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title text-center">{{ $products->count() }} RESULTS FOR "{{$searchName}}"</h2>
{{--                    <p class="page-description">--}}
{{--                        {!! $subSubCategory->description !!}--}}
{{--                    </p>--}}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="filter-area ">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <ul class="filter-list">--}}
{{--                    <li>FILTERS:</li>--}}

{{--                    <li><a id="color-plate" href="#color-plate-box">Colors</a></li>--}}
{{--                    @if(count($sizes) > 0)--}}
{{--                        <li><a id="size-plate" href="#size-plate-box">Sizes</a></li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @if(count($products) > 0)
        <div class="filter-area ">
            <div class="container-fluid">
                <div class="row">
                    <ul class="filter-list">
                        <li>FILTERS:</li>

                        <li><a id="color-plate" href="#color-plate-box">Colors</a></li>
{{--                        @if(count($sizes) > 0)--}}
                            <li><a id="size-plate" href="#size-plate-box">Sizes</a></li>
{{--                        @endif--}}
                    </ul>
                </div>
            </div>
        </div>
    <div class="shop-page-wrapper body-height-full">
        <div class="container-fluid">
            <div class="row pt--45 pt-md--35 pt-sm--20 pb--60 pb-md--50 pb-sm--40">
                <div class="col-12">
                    <div class="shop-products">
                        <div class="row grid-space-30">
                            @foreach($products as $product)
                                <div class="col-xl-4 col-12 col-sm-6 col-md-6 mb--40 mb-md--30">
                                    <div  class="single-product-area">
                                        <div style="display: none" class="wish-list wishlist-btn" data-id="{{ $product->id }}"  data-color="{{ $product->inventory->color_id }}" data-type="{{ $product->inventory->type_id }}" data-size="{{ $product->inventory->size_id }}">
                                            @if (Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER)
                                                <i class="{{ wishlistCheck($product->id,0,0,0) ? 'fa fa-heart' : 'fa fa-heart-o' }} {{ wishlistCheck($product->id,0,0,0) ? 'active-wishlist' : '' }}"></i>
                                            @else
                                                <i class="fa fa-heart-o"></i>
                                            @endif
                                        </div>
                                        @foreach(getProductGroupByColors($product->id) as $key => $color)
                                            <div class="product-image-owl owl-carousel {{ $key == 0 ? 'color-slide-active' : '' }} color-image-slider_{{$product->id}}_{{ $color->id }}">
                                                @foreach(colorImages($product->id,$color->id) as $img)
                                                    <img onclick="productDetails('{{ route('page.product_details',['slug'=>$product->slug]) }}/?color_id={{ $color->id }}')" class="product-color-image-list" src="{{ asset($img->thumbs) }}" alt="">
                                                @endforeach
                                            </div>
                                        @endforeach
                                        <div class="product-details">
                                            <div class="row">
                                                <div class="col-8">
                                                    <a href="{{ route('page.product_details',['slug'=>$product->slug]) }}/?color_id={{ getProductGroupByColors($product->id)[0]->id ?? '' }}" class="product-name product_color_href_{{ $product->id }}">{{ $product->name }}</a>
                                                </div>
                                                <div class="col-4">
                                                    <ul class="color-plate-img color-plate-img_{{ $product->id }} text-left">
                                                        @foreach(getProductGroupByColors($product->id) as $key => $color)
                                                            @if($color->color_type == 2)
                                                                <li onclick="sliderActive('color-plate-list','{{$product->id}}','{{$color->id}}')" class="color-plate-list color_single_plate_{{ $product->id }}_{{$color->id}} {{ $key == 0 ? 'color-palate-active' : '' }}" style="  background: linear-gradient(to left, {{ $color->code }} 50%, {{ $color->code2 }} 50%)"></li>
                                                            @else
                                                                <li onclick="sliderActive('color-plate-list','{{$product->id}}','{{$color->id}}')" class="color-plate-list color_single_plate_{{ $product->id }}_{{$color->id}} {{ $key == 0 ? 'color-palate-active' : '' }}" style="  background: {{ $color->code }}"></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="product-price"> {{ getPriceCurrencyProduct($product->id) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
{{--                    <nav class="pagination-wrap">--}}
{{--                        {{ $products->appends($appends)->links('layouts.partial.pagination') }}--}}
{{--                    </nav>--}}
                </div>
            </div>
        </div>
    </div>
    @endif


    <aside class="side-navigation side-navigation--left" id="color-plate-box">
        <div class="side-navigation-wrapper">
            <div class="slide-bar-login-area">
                <h3>COLORS</h3>
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            </div>
            <div class="side-navigation-inner">
                <div class="product-item-plate-container">
                    <?php
                    $selectedColors = explode(',', request()->get('color'))
                    ?>
                    @foreach($colors as $color)
                        <div data-id="{{ $color->id }}" class="product-plate-single-item color-plate-single-checked product-plate-single-item-select-{{ $color->id }} {{ in_array($color->id, $selectedColors) ? 'color-url-active single-plate-active' : '' }}">
                            <div style="background-color: {{ $color->code }}" class="product-other-thumbs-color">
                            </div>
                            <div class="product-plate-content">
                                <h3>{{ $color->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="slide-bar-pate-footer">
                <a href="#" class="btn-show-product">Show {{ $products->count() }} Products</a>
            </div>
        </div>
    </aside>

{{--    <aside class="side-navigation side-navigation--left" id="size-plate-box">--}}
{{--        <div class="side-navigation-wrapper">--}}
{{--            <div class="slide-bar-login-area">--}}
{{--                <h3>SIZES</h3>--}}
{{--                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>--}}
{{--            </div>--}}
{{--            <div class="side-navigation-inner">--}}
{{--                <div class="product-item-plate-container">--}}
{{--                    <?php--}}
{{--                    $selectedSizes = explode(',', request()->get('size'))--}}
{{--                    ?>--}}
{{--                    <ul class="size-plate-list">--}}
{{--                        @foreach($sizes as $size)--}}
{{--                            <li data-id="{{ $size->id }}" data-name="{{ $size->name }}" class="size-plate-single-item size-plate-single-checked product-plate-single-color-item-select-{{ $size->id }} {{ in_array($size->id, $selectedSizes) ? 'size-url-active single-color-plate-active' : '' }}">{{ $size->name }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="slide-bar-pate-footer">--}}
{{--                <a href="#" class="btn-show-product">Show Products</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </aside>--}}
@endsection
@section('script')
    <script src="{{ asset('themes/frontend/owlcarousel/owl.carousel.js') }}"></script>
    <script>
        var colorIdArray = [];
        $(function (){
            $(".btn-close").click(function (){
                // $('body').removeClass('ai-global-overlay overlay-open');
            })

            $('body').on('click', '#color-plate', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var target = $(this).attr('href');
                // var prevTarget = $('.toolbar-btn').attr('href');
                var prevTarget = $(this).parent().siblings().children('#color-plate').attr('href');
                $(target).addClass('open');
                $(prevTarget).removeClass('open');
                if(!$(this).is('.search-btn')){
                    $('.ai-global-overlay').addClass('overlay-open');
                }
                $('.main-navigation').removeClass('open-mobile-menu');
                $('.dl-menu').removeClass('dl-menuopen');
                $('.menu-btn').removeClass('open');
            });

            $('body').on('click', '#size-plate', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var target = $(this).attr('href');
                // var prevTarget = $('.toolbar-btn').attr('href');
                var prevTarget = $(this).parent().siblings().children('#size-plate').attr('href');
                $(target).addClass('open');
                $(prevTarget).removeClass('open');
                if(!$(this).is('.search-btn')){
                    $('.ai-global-overlay').addClass('overlay-open');
                }
                $('.main-navigation').removeClass('open-mobile-menu');
                $('.dl-menu').removeClass('dl-menuopen');
                $('.menu-btn').removeClass('open');
            });

            $('body').on('click', '.color-plate-single-checked', function() {

                var colorCheckedId = $(this).data('id');
                $("#selected-color").val(colorCheckedId);
                var selectSizeId = $("#selected-size").val();

                if($(".product-plate-single-item-select-"+colorCheckedId).hasClass('single-plate-active')){
                    $(".product-plate-single-item-select-"+colorCheckedId).removeClass('single-plate-active');
                }else{
                    $(".product-plate-single-item-select-"+colorCheckedId).addClass('single-plate-active');

                }
                var sizeId = '{{ request()->get('size') }}';
                var colorId = '{{ request()->get('color') }}';

                if ($(".product-plate-single-item-select-"+colorCheckedId).hasClass('color-url-active')) {
                    var colorId = colorId.replace(colorCheckedId, "");

                    if (colorId.charAt(0) == ',')
                        colorId = colorId.substr(1);

                    if (colorId.substr(colorId.length - 1) == ',')
                        colorId = colorId.substring(',', colorId.length - 1);
                } else {
                    if (colorId == '')
                        colorId = colorCheckedId;
                    else
                        colorId += ',' + colorCheckedId;
                }
                {{--var url = new URL('{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}');--}}

                url.searchParams.set('color', colorId);
                url.searchParams.set('size', sizeId);
                window.location.href = url.href;

            })


            $('body').on('click', '.size-plate-single-checked', function() {
                var sizeCheckedId = $(this).data('id');

                if($(".product-plate-single-color-item-select-"+sizeCheckedId).hasClass('single-color-plate-active')){
                    $(".product-plate-single-color-item-select-"+sizeCheckedId).removeClass('single-color-plate-active');
                }else{
                    $(".product-plate-single-color-item-select-"+sizeCheckedId).addClass('single-color-plate-active');

                }
                var colorId = '{{ request()->get('color') }}';
                var sizeId = '{{ request()->get('size') }}';

                if ($(".product-plate-single-color-item-select-"+sizeCheckedId).hasClass('size-url-active')) {
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

                {{--var url = new URL('{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}');--}}
                url.searchParams.set('color', colorId);
                url.searchParams.set('size', sizeId);
                window.location.href = url.href;
            })

        })


        function productDetails(url){
            window.location.href = url;
        }
        function sliderActive(className,product,color){
            $('.'+className).closest('.color-plate-img_'+product).find('li').removeClass('color-palate-active')

            //$('.lds_ring_'+product).css('display','block');

            {{--$('.color_single_plate_'+product+'_'+color).addClass('color-palate-active');--}}
            {{--$('.product_color_href_'+product).attr('href', '{{ route('page.product_details',['slug'=>$product->slug]) }}/?color_id='+color);--}}

            //$('.lds_ring_'+product).css('display','none');

            $('.color-image-slider_'+product+'_'+color).closest('.single-product-area').find('.product-image-owl').removeClass('color-slide-active')
            $('.color-image-slider_'+product+'_'+color).addClass('color-slide-active');

        }
        if (window.matchMedia('(max-width: 400px)').matches)
        {
            $('.product-image-owl').owlCarousel({
                loop:true,
                margin:0,
                nav:false,
                autoplayTimeout: 1000,
                dots:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            })
        }
        $('.product-image-owl').owlCarousel({
            loop:true,
            margin:0,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
@endsection
