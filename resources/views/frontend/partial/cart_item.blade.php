<div class="side-navigation-wrapper scrollable">
    <div class="slide-bar-login-area">
        <h3>YOUR SHOPPING BAG <span class="shopping-quantity">({{ count($cartItems) }})</span></h3>
        <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
    </div>
    <div class="side-navigation-inner">
        <div class="slide-bar-prodect-details">
            @foreach($cartItems as $cartItem)
                <div class="hero-sub">
                    <div class="col-style">
                        <img style="width:100px;" src="{{ asset(colorImages($cartItem->id,$cartItem->attributes->color_id)[0]->thumbs ?? '') }}" alt="">
                    </div>
                    <div class="product-style">
                        <p class="nav-product-name">{{ $cartItem->name }} <span>({{ $cartItem->quantity }})</span> <br>
                            <span class="nav-product-price">{{ convertCurrencySign(convertCurrency($cartItem->associatedModel->id,$cartItem->attributes->color_id,$cartItem->attributes->size_id) * $cartItem->quantity) }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="register-slide-area">
            <div class="row shopping-footer-price">
                <div class="col-sm-6">
                    <p class="shopping-total-price">TOTAL</p>
                </div>
                <div class="col-sm-6">
                    <p class="float-end shopping-total-count">{{ convertCurrencySign($subTotal) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid">
                        <a href="{{ route('cart') }}" class="btn-login-side">View your Shopping Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
