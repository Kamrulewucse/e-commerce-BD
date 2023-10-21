<input type="hidden" name="credit_card_id" value="">

    <h3 style="color:#000;text-transform: uppercase;margin-top: 10px">Payment Information</h3>
    <div class="row">
        <div class="col-10">
            <span class="delivery-option-name">Card Holder: {{ $data['card_holder'] }}</span><br>
            <span class="delivery-option-description">Card Number: {{ $data['card_number'] }}</span><br>
            <span class="delivery-option-description">Card Expiry: {{ $data['card_expiry']}}</span><br>
            <span class="delivery-option-description">Security Code: {{ $data['security_code']}}</span><br>
        </div>
        <div class="col-1">
            <a href="#payment_details" class="edit-details-data" onclick="customerCreditCard(0)"><b><u>Edit</u></b></a>
        </div>
    </div>

