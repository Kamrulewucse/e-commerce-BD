@foreach($colors as $color)
    <div data-id="{{ $color->id }}" class="product-plate-single-item color-plate-single-checked product-plate-single-item-select-{{ $color->id }}">
        <div class="product-other-thumbs-img">
            <img src="{{ asset(colorImages($product->id,$color->id)[0]->thumbs ?? '') }}" alt="">
        </div>
        <div class="product-plate-content">
            <h3>{{ $color->name }}</h3>
        </div>
    </div>
@endforeach
