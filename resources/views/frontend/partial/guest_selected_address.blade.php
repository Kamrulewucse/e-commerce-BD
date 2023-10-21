<input type="hidden" name="address_book_id" value="">
    <h3>Shipping Method:</h3>
    <p>Standard Home Delivery - Delivered in Gift box | 1 to 3 business days</p>
    <div style="display: block;background-color: #F6F5F3;padding: 15px;color: #000"><i class="fa fa-info-circle"></i> Delivery time may take up to 10 additional days for this product.</div>
    <h3 style="color:#000;text-transform: uppercase;margin-top: 10px">Delivery Address</h3>
    <div class="row">
        <div class="col-10">
            <span class="delivery-option-name">{{ $data['description'] }}</span><br>
            <span class="delivery-option-description">{{ $data['first_name'].' '.$data['last_name'] }}</span><br>
            <span class="delivery-option-description">{{ $data['delivery_address']}}</span><br>
            <span class="delivery-option-description">{{ $data['apartment_details']}}</span><br>
            <span class="delivery-option-description">{{ \App\Models\State::find($data['city'])->name ?? '' }}</span><br>
            <span class="delivery-option-description">{{ $data['area'] }}</span><br>
            <span class="delivery-option-description">{{ \App\Models\Country::find($data['country'])->name ?? '' }}</span><br>
            @if($data['mobile_no_type_1'] ?? false)
                <span   class="delivery-option-description">{{ $data['mobile_no_type_1'] }}: (+{{ $data['mobile_no_code_1'] }}) {{ $data['mobile_no_1'] }}</span><br>
            @endif

            @if($data['mobile_no_type_2'] ?? false)
                <span   class="delivery-option-description">{{ $data['mobile_no_type_2'] }}: (+{{ $data['mobile_no_code_2'] }}) {{ $data['mobile_no_2'] }}</span><br>
            @endif
            @if($data['mobile_no_type_3'] ?? false)
                <span   class="delivery-option-description">{{ $data['mobile_no_type_3'] }}: (+{{ $data['mobile_no_code_3']}}) {{ $data['mobile_no_3'] }}</span><br>
            @endif
        </div>
        <div class="col-1">
            <a href="#delivery_address" class="edit-details-data"  onclick="customerAddress({{ 0 }})"><b><u>Edit</u></b></a>
        </div>
    </div>

