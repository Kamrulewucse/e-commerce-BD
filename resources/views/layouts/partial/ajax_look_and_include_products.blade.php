@if($getLook)
<div class="container">
    <div class="row">
        <div class="col-12 col-md-12 text-center">
            <h1 class="product-title-d customer-likes-p-title">GET THE LOOK</h1>
        </div>
    </div>
</div>
<div class="get-look-area" style="background: #f6f5f3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 text-center">
                    <div class="get-look-image">
                        <img src="{{ asset($getLook->view_thumb) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="get-look-area-products">
    <div class="container">
        <div class="row justify-content-center">
                @foreach(json_decode($getLook->include_products) as $key => $itemProduct)
                    <?php
                    $colorTypeProduct = getIncludeProducts($itemProduct);
                    ?>
                    <div class="col-md-4 col-12 mb-4">
                        <a href="{{ route('page.product_details',['slug'=>$colorTypeProduct->product->slug]) }}?color_id={{ $colorTypeProduct->color_id }}&type_id={{ $colorTypeProduct->type_id }}&size_id={{ $colorTypeProduct->size_id }}" class="get-look-product">
                            <div class="row thumbs-bg-hover">
                                <div class="col-6 col-md-4">
                                    <div class="product-other-thumbs-img get-look-product-img">
                                        <img style="height: 113px;"
                                             src="{{ asset(colorTypeImages($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id)[0]->thumbs ?? '') }}"
                                             alt="">
                                    </div>
                                </div>
                                <div class="col-6 col-md-8">
                                    <div class="wishlist-second-area wishlist-btn get-look-product-wishlist" data-id="{{ $colorTypeProduct->product_id }}" data-color="{{ $colorTypeProduct->color_id }}" data-type="{{ $colorTypeProduct->type_id }}" data-color="{{ $colorTypeProduct->size_id }}">
                                        @if (Auth::check() && Auth::user()->role == \App\Enumeration\Role::$BUYER)
                                            <i class="fa fa-heart{{ wishlistCheck($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id,$colorTypeProduct->size_id) ? ' ' : '-o' }}"></i>
                                        @else
                                            <i class="fa fa-heart-o"></i>
                                        @endif
                                    </div>
                                    <div class="text-area">
                                        <h2 style="font-size: 19px">{{$colorTypeProduct->product->name ?? ''}}{{ $colorTypeProduct->type->id != 1 ? (' - '.$colorTypeProduct->type->name) : '' }}</h2>
                                        <p>{{ getPriceCurrency($colorTypeProduct->product_id,$colorTypeProduct->color_id,$colorTypeProduct->type_id,$colorTypeProduct->size_id) }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col-md-12 text-center">
                    <a  href="{{ route('page.view_by_look_product_details',['slug'=>$getLook->slug]) }}" class="btn-cart-sticky" style="margin-top: 33px">Shop The Look</a>
                </div>
        </div>
    </div>
</div>
@endif
