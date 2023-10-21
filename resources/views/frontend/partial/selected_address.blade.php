<input type="hidden" name="address_book_id" value="{{ $address->id }}">
{{--<input type="hidden" name="delivery_option_id" value="{{ $deliveryOption->id }}">--}}
{{--    <h3>Shipping Method:</h3>--}}
{{--    <p>{{ $deliveryOption->name }} - {{ $deliveryOption->delivery_duration }}</p>--}}
    <div style="display: block;background-color: #F6F5F3;padding: 15px;color: #000"><i class="fa fa-info-circle"></i> Delivery time may take up to 10 additional days for this product.</div>
    <h3 style="color:#000;text-transform: uppercase;margin-top: 10px">Delivery Address</h3>
    <div class="row">
        <div class="col-10">
            <span class="delivery-option-name">{{ $address->description }}</span><br>
            <span class="delivery-option-description">{{ $address->first_name.' '.$address->last_name }}</span><br>
            <span class="delivery-option-description">{{ $address->delivery_address}}</span><br>
            <span class="delivery-option-description">{{ $address->apartment_details}}</span><br>
            <span class="delivery-option-description">{{ $address->state->name ?? ''}}</span><br>
            <span class="delivery-option-description">{{ $address->area }}</span><br>
            <span class="delivery-option-description">{{ $address->country->name ?? '' }}</span><br>
            @if($address->mobile_no_type_1)
                <span   class="delivery-option-description">{{ $address->mobile_no_type_1 }}: (+{{ $address->mobile_no_code_1 }}) {{ $address->mobile_no_1 }}</span><br>
            @endif

            @if($address->mobile_no_type_2)
                <span   class="delivery-option-description">{{ $address->mobile_no_type_2 }}: (+{{ $address->mobile_no_code_2 }}) {{ $address->mobile_no_2 }}</span><br>
            @endif
            @if($address->mobile_no_type_3)
                <span   class="delivery-option-description">{{ $address->mobile_no_type_3 }}: (+{{ $address->mobile_no_code_3}}) {{ $address->mobile_no_3 }}</span><br>
            @endif
        </div>
        <div class="col-1">
            <a href="#delivery_address" class="edit-details-data"  onclick="customerAddress({{ $address->id }})"><b><u>Edit</u></b></a>
        </div>
    </div>

