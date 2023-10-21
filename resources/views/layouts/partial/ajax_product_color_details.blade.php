<div class="col-12 col-md-7">
    <h3 class="product-details-title">Product details</h3>
    <hr>
    <div class="product-description product-details-list">
        {{ json_decode($product->features,true)[$selectFirstAttributes->color_id.'-'.$selectFirstAttributes->type_id] ?? '' }}
    </div>
</div>
