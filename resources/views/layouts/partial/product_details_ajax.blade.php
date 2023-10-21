<style>
    .wishlist-area {
        right: 28px;
        top: 3px;
    }
    @media (max-width: 61.94em) {
        .product_details_video {
            margin-bottom: 25px !important;
            margin-top: 0 !important;
        }
        .product-details-area{
            margin-bottom: 25px !important;
        }
        .wishlist-area {
            right: 21px !important;
            top: 1px !important;

        }
    }
</style>

<?php
$isVideo = colorTypeVideo($product->id, $selectFirstAttributes->color_id, $selectFirstAttributes->type_id);
?>
<div class="col-md-7 product-detail-img-mobile">
    <div class="product-image-area">
        <a href="{{ url()->previous() }}" class="back-button"><i class="fa fa-angle-left"></i></a>
        @if(colorTypeVideo($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id))
            <div class="product-first-imag" style="background: #ffffff;height: 424px;">
                <video playsinline webkit-playsinline autoplay muted id="video_1" width="100%"
                       height="100%" src="{{ asset(colorTypeVideo($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)->video_path ?? '') }}" loop="loop" tabindex="-1" aria-hidden="true" ></video>

                <script>
                    document.getElementById('video_1').play();
                </script>
                <div class="video-content-area">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-4 col-md-4" style="text-align: left">
                                <div class="video-control-area">
                                    <button  class="btn-video-play" id="playBtn-1" onclick="myVideoControl(1)"><i class="fa fa-pause"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="product-first-imag" style="height: 400px;">
                <img id="getPicture" onClick="getPicture('{{ $product->id }}','{{ $selectFirstAttributes->color_id }}','{{ $selectFirstAttributes->type_id }}')" src="{{ asset(colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)[0]->thumbs ?? '') }}" alt="">
            </div>
        @endif

    </div>
</div>

<div class="col-md-4">
    <div class="product-details-area {{ $isVideo ? 'product_details_video' : '' }}">
        <div class="wishlist-area wishlist-btn" data-id="{{ $product->id }}" data-color="{{ $selectFirstAttributes->color_id }}" data-type="{{ $selectFirstAttributes->type_id }}" data-size="{{ $selectFirstAttributes->size_id }}">
            <i class="fa fa-heart{{ wishlistCheck($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) ? '' : '-o' }}"></i>
        </div>
        <h1 class="product-title-d">{{ $product->name }}</h1>
        <div class="product-price">{{ getPriceCurrency($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) }}</div>
        <div class="row">
            <div class="col-md-12">
                <div class="color-area">
                    <a href="#color-plate-box" id="color-plate" class="product-color-btn">
                        <span class="color-text"> Colors</span>
                        <input type="hidden" id="selected-color" value="{{ $selectFirstAttributes->color_id }}">
                        <span class="color-name">{{ $selectFirstAttributes->color->name ??'' }}</span>
                        @if($selectFirstAttributes->color->color_type == 1)
                            <span style="background-color: {{ $selectFirstAttributes->color->code ??'' }}" class="color box"></span>
                        @else
                            <span style="background: linear-gradient(to left, {{ $selectFirstAttributes->color->code }} 50%, {{ $selectFirstAttributes->color->code2 }} 50%)" class="color box"></span>
                        @endif
                        <span class="product-attribute-icon"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="color-area">
                    <input type="hidden" id="selected-type" value="{{ $selectFirstAttributes->type_id }}">
                    @if($selectFirstAttributes->type_id != 1)
                    <a href="#type-plate-box" id="type-plate" class="product-color-btn">
                            <span class="type-text"> Types</span>
                            <span class="type-name">{{ $selectFirstAttributes->type->name ?? '' }}</span>
                            <span class="product-attribute-icon"><i class="fa fa-angle-right"></i></span>

                    </a>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="color-area">
                    <input type="hidden" id="selected-size" value="{{ $selectFirstAttributes->size_id }}">
                        @if($selectFirstAttributes->size->type == 1)
                        <a href="#size-plate-box" id="size-plate" class="product-color-btn">
                            <span class="size-text"> Sizes</span>
                            <span class="color-name size-name-show">{{ $selectFirstAttributes->size->name ?? '' }}</span>
                            <span class="product-attribute-icon"><i class="fa fa-angle-right"></i></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="qty" value="1">
                <div class="cart-area">
                    @if(getProductStock($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) > 0)
                        <button id="btn-add-to-cart" class="btn-cart">Place in Cart</button>
                    @else
                        <button disabled class="btn-cart stock-out-btn">Stock Out</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
