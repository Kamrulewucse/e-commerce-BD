<div class="purchase-bar__infos">
    <div class="stick-product-img">
        <img src="{{ asset(colorTypeImages($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id)[0]->thumbs ?? '') }}" alt="">
    </div>
    <div class="sticky-product-name">
        <h2>{{ $product->name }}</h2>
    </div>
</div>
<div class="bd-product-purchase-bar__actions">
    <div class="sticky-product-price">
        <p>{{ getPriceCurrency($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) }}</p>
    </div>
    <div class="sticky-product-add-btn">

        @if(getProductStock($product->id,$selectFirstAttributes->color_id,$selectFirstAttributes->type_id,$selectFirstAttributes->size_id) > 0)
            <button id="add-to-cart-sticky" class="btn-cart-sticky">Place in Cart</button>
        @else
            <button disabled  class="btn-cart-sticky stock-out-btn">Stock out</button>
        @endif
    </div>
</div>
