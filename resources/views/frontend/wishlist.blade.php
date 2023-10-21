@extends('layouts.app')
@section('style')
    <style>
        .page-top-description {
            padding: 30px 0;
        }
        h2.page-title {
            font-weight: bolder;
        }
        @media screen and (max-width: 400px){
            ul.filter-list li {
                font-size: 11px;
            }
        }
        img.product-color-image-list {
            background: #F1F0F0;
            height: 501px;
        }
        a.product-name {
            color: #000;
            font-size: 15px;
            font-weight: 500;
        }
        .single-product-area {
            background: #F4F4F4;
            text-align: center;
        }
        .btn-next {
            text-align: center;
            color: #fff;
            line-height: 50px;
        }

        .btn-next {
            background: #19110B;
            color: #fff;
            border: none;
            width: 124px;
            height: 50px;
            margin-top: 30px;
        }
        .btn-next:hover {
            background: #F6F5F3;
            color: #000;
        }
        .btn-next {
            margin: 6px 0;
        }
        .wish-list-save-area {
            text-align: right;
        }

        @media (max-width: 61.94em) {
            .page-top-description {
                padding-top: 102px;
            }
        }
    </style>
@endsection
@section('content')
    @if(auth()->check() && auth()->user()->role == \App\Enumeration\Role::$BUYER)
        @include('layouts.partial.user_nav')
    @endif
    <div class="page-top-description">
        <div class="container">
            <div class="row">
                @if ($products)
                    @if(count($products) <= 0)
                        <!--<p style="font-size: 20px; color: #000; font-weight: 500; text-align:center;">Your wishlist is empty</p>-->
                    @else
                        <div class="col-6 col-md-6">
                            <h2 class="page-title">Wishlist Items <sup>(<span id="wish-list-count">{{ count($products) }}</span>)</sup></h2>
                        </div>
                    @endif
                    @if(!Auth::check() && count($products) > 0)
                    <div class="col-6 col-md-6">
                    <div class="wish-list-save-area">
                        <a class="btn-next" href="{{ route('login') }}?wish-list-save=save-product"><i class="fa fa-heart"></i> Save</a>
                    </div>
                    </div>
                    @elseif(Auth::check() && Auth::user()->role != \App\Enumeration\Role::$BUYER && count($products) > 0)
                        <div class="col-6 col-md-6">
                            <div class="wish-list-save-area">
                                <a class="btn-next" href="{{ route('login') }}?wish-list-save=save-product"><i class="fa fa-heart"></i> Save</a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>


    <div class="shop-page-wrapper body-height-full">
        <div class="container-fluid">
            <div class="row pt--45 pt-md--35 pt-sm--20 pb--60 pb-md--50 pb-sm--40">
                <div class="col-12">
                    <div class="shop-products pt-sm--80">
                        @if(count($products) > 0)
                            <div class="row grid-space-30">
                                @foreach($products as $product)
                                    @if($product->product_type === 1)
                                        <div id="product_select_{{ $product->id }}" class="col-xl-4 col-md-6 mb--40 mb-md--30">
                                            <div  class="single-product-area">
                                                <div class="wish-list wishlist-btn-">
                                                    <i  onclick="wishlistRemove('{{ $product->id }}')" class="fa fa-heart active-wishlist"></i>
                                                </div>
                                                <img onclick="productDetails('{{ route('page.product_details',['slug'=>$product->slug]) }}?color_id={{ $product->attributes->color_id }}&type_id={{ $product->attributes->type_id }}&size_id={{ $product->attributes->size_id }}')" class="product-color-image-list" src="{{ asset(colorTypeImages($product->attributes->product_id,$product->attributes->color_id,$product->attributes->type_id)[0]->thumbs ?? '') }}" alt="">
                                            </div>
                                            <div class="product-details">
                                                <div class="row">
                                                    <div class="col-12" onclick="productDetails('{{ route('page.product_details',['slug'=>$product->slug]) }}?color_id={{ $product->attributes->color_id }}&type_id={{ $product->attributes->type_id }}&size_id={{ $product->attributes->size_id }}')">
                                                        <a href="{{ route('page.product_details',['slug'=>$product->slug]) }}?color_id={{ $product->attributes->color_id }}&type_id={{ $product->attributes->type_id }}&size_id={{ $product->attributes->size_id }}" class="product-name">
                                                            {{ $product->name }} {{ getTypeName($product->attributes->type_id)->id != 1 ? ('- '.getTypeName($product->attributes->type_id)->name) : '' }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="product_select_{{ $product->id }}" class="col-xl-4 col-md-6 mb--40 mb-md--30">
                                            <div  class="single-product-area">
                                                <div class="wish-list wishlist-btn-">
                                                    <i  onclick="wishlistRemove('{{ $product->id }}')" class="fa fa-heart active-wishlist"></i>
                                                </div>
                                                <img onclick="productDetails('{{ route('page.view_by_look_product_details',['slug'=>$product->slug]) }}')" class="product-color-image-list" src="{{ asset($product->view_thumb) }}" alt="">
                                            </div>
                                            <div class="product-details">
                                                <div class="row">
                                                    <div class="col-12" onclick="productDetails('{{ route('page.view_by_look_product_details',['slug'=>$product->slug]) }}')">
                                                        <a href="{{ route('page.view_by_look_product_details',['slug'=>$product->slug]) }}" class="product-name">{{ $product->name }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        @else
                            <p style="font-size: 20px; color: #000; font-weight: 500; text-align:center;">Your wishlist is empty</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        function productDetails(url){
            window.location.href = url;
        }
       function wishlistRemove(productIndex){

           let wishlistCount = $("#wish-list-count").text();
           if(confirm('Are you sure?')){
               if(wishlistCount.length > 0)
                    $("#wish-list-count").text(wishlistCount - 1);
                    $("#wishlist-count").text(wishlistCount - 1);

               if (productIndex != '') {
                   $("#product_select_"+productIndex).remove();
                   $.ajax({
                       method: "POST",
                       url: "{{ route('remove_to_wishlist') }}",
                       data: {productIndex: productIndex}
                   }).done(function (data) {

                   });
               }


           }
       }

    </script>
@endsection
