@foreach($cards as $key => $card)
<div class="single-delivery-option-nav">
    <input onclick="cardSelect({{ $card->id }})" {{ $key == 0 ? 'checked' : '' }} type="radio" value="{{ $card->id }}"
           class="delivery_option_input_data form-check-input"
           name="credit_card_modal_id" id="delivery_option1">
    <label for="delivery_option1" class="row">
    <span class="col-8 col-md-7 offset-md-1">
        <span class="delivery-option-name">Card Holder name: {{ $card->card_holder }}</span><br>
        <span class="delivery-option-description">Card Number: ({{ $card->card_number }})</span><br>
        <span class="delivery-option-description">Expiration Date: {{ $card->card_expiry  }}</span><br>
        <span class="delivery-option-description">Security Code: {{ $card->card_cvc  }}</span><br>
    </span>
        <span class="col-4">
            <span class="delivery-option-status-data"
                                   style="width:100%;">
                <a  style="width:100%;" href="#" class="edit-details-data" id="deleteCard"
                    onClick="deleteCard({{ $card->id }})">Delete</a>
            </span>
        </span>
    </label>
</div>
@endforeach
