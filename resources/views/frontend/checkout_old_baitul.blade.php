@extends('layouts.app')
@section('style')
    <style>
        .page-top-description {
            padding: 30px 0;
        }

        h2.page-title {
            font-weight: bolder;
        }

        h1.product-title-d {
            font-size: 25px;
            margin-top: 35px;
        }

        .product-price {
            font-weight: bold;
            font-size: 16px;
            margin: 13px 0;
            color: #19110b;
        }

        label.product_attribute_label {
            color: #19110b;
            font-size: 18px;
        }

        .product_attribute {
            border: 1px solid #ecebe7;
        }

        input.form-control.product_quantity {
            margin-top: 30px;
            height: 47px;
            border-radius: 0;
            text-align: center;
        }

        .product_attribute {
            border-radius: 0;
            height: 40px;
        }

        .cart-area {
            margin-top: 30px;
        }
    </style>
@endsection
@section('content')
    <div class="page-content-inner">

        <form action="{{ route('checkout') }}" method="post">
            @csrf
            <div class="container" style="padding: 0;">
                <div class="row pt--80 pt-md--60 pt-sm--40">
                    <div class="col-12">
                        <form action="{{ route('checkout') }}" method="post" class="payment-form">
                        @csrf
                        <!-- User Action Start -->
                            <div class="user-actions user-actions__coupon">
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="alert alert-danger">{{$error}}</li>
                                        @endforeach
                                    </ul>

                                @endif
                            </div>
                            <!-- User Action End -->
                <div class="row pb--80 pb-md--60 pb-sm--40">
                    <!-- Checkout Area Start -->
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="checkout-title mt--10">
                                    <h2>Billing Details</h2>
                                </div>
                                <div class="checkout-form">

                                    <div class="row mb--30">
                                        <div class="form__group col-md-12 mb-sm--30">
                                            <label for="name" class="form__label form__label--2">Name
                                                <span class="required">*</span></label>
                                            <input type="text" name="name" value="{{ empty(old('name')) ? ($errors->has('name') ? '' : $user->name ?? '') : old('name') }}"
                                                    required autocomplete="name" placeholder="Name" id="name"
                                                    class="form__input form__input--2">
                                            @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="mobile_no" class="form__label form__label--2">Mobile No <span
                                                    class="required">*</span></label>
                                            <input value="{{ empty(old('mobile_no')) ? ($errors->has('mobile_no') ? '' : (($lastOrder) ? $lastOrder->mobile_no : $user->mobile_no ?? '')) : old('mobile_no') }}"
                                                   required autocomplete="mobile_no" placeholder="Mobile No" type="text" name="mobile_no" id="mobile_no"
                                                   class="form__input form__input--2">
                                            @error('mobile_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="alternative_mobile_no" class="form__label form__label--2">Alternative Mobile No</label>
                                            <input value="{{ empty(old('alternative_mobile_no')) ? ($errors->has('alternative_mobile_no') ? '' : (($lastOrder) ? $lastOrder->alternative_mobile : '')) : old('alternative_mobile_no') }}"
                                                   autocomplete="alternative_mobile_no" placeholder="Alternative Mobile No" type="text" name="alternative_mobile_no" id="alternative_mobile_no"
                                                   class="form__input form__input--2">
                                            @error('alternative_mobile_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="city" class="form__label form__label--2">City
                                                <span class="required">*</span></label>
                                            <select id="city" name="city"
                                                    class="form__input form__input--2 nice-select">
                                                <option value="">Select a city…</option>
                                                @foreach($cities as $city)
                                                    <option {{ empty(old('city')) ? ($errors->has('city') ? '' : (($lastOrder) ? ($lastOrder->city_id == $city->id ? 'selected' : '') : '')) :
                                            (old('city') == $city->id ? 'selected' : '') }} value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="city" class="form__label form__label--2">Area
                                                <span class="required">*</span></label>
                                            <select id="area" name="area"
                                                    class="form__input form__input--2 nice-select">
                                                <option value="">Select a area…</option>
                                            </select>
                                            @error('area')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="address" class="form__label form__label--2">
                                                Address <span class="required">*</span></label>

                                            <input value="{{ empty(old('address')) ? ($errors->has('address') ? '' : (($lastOrder) ? ($lastOrder->shipping_address) : '')) :
                                            (old('city') == $city->id ? 'selected' : '') }}" type="text" required name="address" id="address"
                                                   class="form__input form__input--2 mb--30"
                                                   placeholder="Address">
                                            @error('address')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row" style="display: none">
                                        <div class="form__group col-12">
                                            <div class="custom-checkbox mb--20">
                                                <input {{ old('ship_different_address') == 1 ? 'checked' : '' }} type="checkbox" name="ship_different_address" value="1" id="shipdifferetads"
                                                       class="form__checkbox">

                                                <label for="shipdifferetads"
                                                       class="form__label form__label--2 shipping-label">Ship To A
                                                    Different Address?</label>
                                            </div>
                                            <div class="ship-box-info hide-in-default mt--30">
                                                <div class="row mb--30">
                                                    <div class="form__group col-md-12 mb-sm--30">
                                                        <label for="shipping_name"
                                                               class="form__label form__label--2">Name <span
                                                                class="required">*</span></label>
                                                        <input type="text" name="shipping_name" id="shipping_name"
                                                               class="form__input form__input--2">
                                                        @error('shipping_name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="shipping_mobile_no" class="form__label form__label--2">Mobile No</label>
                                                        <input value="{{ old('shipping_mobile_no') }}"
                                                               autocomplete="shipping_mobile_no" placeholder="Mobile No" type="text" name="shipping_mobile_no" id="shipping_mobile_no"
                                                               class="form__input form__input--2">
                                                        @error('shipping_mobile_no')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="shipping_city"
                                                               class="form__label form__label--2">City <span
                                                                class="required">*</span></label>
                                                        <select id="shipping_city" name="shipping_city"
                                                                class="form__input form__input--2 nice-select">
                                                            <option value="">Select a city…</option>
                                                            @foreach($cities as $city)
                                                                <option {{ old('shipping_city') == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('shipping_city')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="shipping_area"
                                                               class="form__label form__label--2">Area <span
                                                                class="required">*</span></label>
                                                        <select id="shipping_area" name="shipping_area"
                                                                class="form__input form__input--2 nice-select">
                                                            <option value="">Select a area…</option>
                                                        </select>
                                                        @error('shipping_area')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="shipping_address"
                                                               class="form__label form__label--2">Address <span
                                                                class="required">*</span></label>

                                                        <input type="text" name="shipping_address"
                                                               id="shipping_address"
                                                               class="form__input form__input--2 mb--30"
                                                               placeholder="Address">
                                                        @error('shipping_address')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form__group col-12">
                                            <label for="notes" class="form__label form__label--2">Order
                                                Notes</label>
                                            <textarea class="form__input form__input--2 form__input--textarea"
                                                      id="notes" name="notes"
                                                      placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            @error('notes')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 mt-md--40">
                       <div class="card">
                           <div class="card-body">
                               <div class="order-details">
                                   <div class="checkout-title mt--10">
                                       <h2>Your Order</h2>
                                   </div>
                                   <div class="table-content table-responsive mb--30">
                                       <table class="table order-table order-table-2">
                                           <thead>
                                           <tr>
                                               <th>Product</th>
                                               <th class="text-end">Total</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @foreach($products as $product)
                                               <tr>
                                                   <th>{{ $product->name }}
                                                       <strong><span>&#10005;</span>{{ $product->quantity }}</strong>
                                                   </th>
                                                   <td class="text-end">{{ convertCurrencySign($product->price) }}</td>
                                               </tr>
                                           @endforeach
                                           </tbody>
                                           <tfoot>
                                           <tr class="cart-subtotal">
                                               <th>Subtotal</th>
                                               <td class="text-end">{{ convertCurrencySign($subTotal) }}</td>
                                           </tr>
                                           <tr class="shipping">
                                               <th>Shipping</th>
                                               <td class="text-end">
                                                   <span>{{ convertCurrencySign($shippingCost) }}</span>
                                               </td>
                                           </tr>
                                           <tr class="order-total">
                                               <th>Order Total</th>
                                               <td class="text-end"><span class="order-total-ammount">{{ convertCurrencySign($subTotal+$shippingCost) }}</span>
                                               </td>
                                           </tr>
                                           </tfoot>
                                       </table>
                                   </div>
                                   <div class="checkout-payment">
                                       <div class="payment-group mb--10">
                                           <div class="payment-radio">
                                               <input checked type="radio" value="1"  name="payment_method"  id="cash">
                                               <label class="payment-label" for="cash">
                                                   CASH ON DELIVERY
                                               </label>
                                           </div>
                                           <div class="payment-info cash hide-in-default" data-method="cash">
                                               <p>Pay with cash upon delivery.</p>
                                           </div>
                                       </div>
                                       <div class="payment-group mb--10">
                                           <div class="payment-radio">
                                               <input type="radio" value="2" name="payment_method" id="online_payment"
                                               >
                                               <label class="payment-label" for="online_payment">ONLINE PAYMENT</label>
                                           </div>
                                       </div>

                                       <div class="payment-group mt--20">
                                           <p class="mb--15">Your personal data will be used to process your order,
                                               support your experience throughout this website, and for other purposes
                                               described in our privacy policy.</p>
                                           <button class="btn btn-fullwidth btn-style-1">Place
                                               Order</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <!-- Checkout Area End -->
                </div>
            </div>
        </form>

    </div>
@endsection
@section('script')
    <script>
        var obj = {};
        obj.cus_name = $('#customer_name').val();
        obj.cus_phone = $('#mobile').val();
        obj.cus_email = $('#email').val();
        obj.cus_addr1 = $('#address').val();
        obj.amount = $('#total_amount').val();

        $('#sslczPayBtn').prop('postdata', obj);

        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
    <script>
        $(function () {

            var selectedArea = '{{ empty(old('area')) ? ($errors->has('area') ? '' : (($lastOrder) ? ($lastOrder->area_id) : '')) : old('area') }}';
            var selectedShippingArea = '{{ empty(old('shipping_area')) ? ($errors->has('shipping_area') ? '' : (($lastOrder) ? ($lastOrder->shipping_area_id) : '')) : old('shipping_area') }}';

            $('#city').change(function () {
                var cityId = $(this).val();

                $('#area').html('<option value="">Select a area…</option>');

                if (cityId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_area') }}",
                        data: { cityId: cityId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (selectedArea == item.id)
                                $('#area').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#area').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                        $('#area').niceSelect('destroy'); //destroy the plugin
                        $('#area').niceSelect(); //apply again
                    });
                }
            });
            $('#shipping_city').change(function () {
                var shippingCityId = $(this).val();

                $('#shipping_area').html('<option value="">Select a area…</option>');

                if (shippingCityId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_area') }}",
                        data: { cityId: shippingCityId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (selectedShippingArea == item.id)
                                $('#shipping_area').append('<option value="'+item.id+'" selected>'+item.bn_name+'</option>');
                            else
                                $('#shipping_area').append('<option value="'+item.id+'">'+item.bn_name+'</option>');
                        });
                        $('#shipping_area').niceSelect('destroy'); //destroy the plugin
                        $('#shipping_area').niceSelect(); //apply again
                    });
                }
            });

            $('#city').trigger('change');
            $('#shipping_city').trigger('change');

        });
    </script>
@endsection
