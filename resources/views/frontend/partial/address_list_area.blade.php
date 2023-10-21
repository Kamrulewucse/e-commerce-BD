@foreach($addresses as $key => $address)
<div class="single-delivery-option-nav">
    <input {{ $key == 0 ? 'checked' : '' }} type="radio" value="{{ $address->id }}"
           class="delivery_option_input_data form-check-input"
           name="delivery_options_data" id="delivery_option1">
    <label for="delivery_option1" class="row">
        <span class="col-8 col-md-7 offset-md-1">
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
        </span>

        <span class="col-4">
            <span class="delivery-option-status-data">
                <a href="javascript:void(0);" role="button" class="edit-details-data"  onclick="customerAddress({{ $address->id }})">Edit</a>
            </span>
        </span>
    </label>
</div>
@endforeach
