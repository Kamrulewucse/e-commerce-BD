@extends('layouts.app')

@section('content')
    <div class="checkout-page body-height-full">
        <div class="container-fluid text-center">
            @if(Session::has('payment_success'))
                <h1 class="text-success">{{ Session::get('payment_success') }}</h1>
            @endif

            <h1 class="other-box-title" style="font-weight: 600">Thank you, your order has been placed.</h1>

            <p class="text-muted" style="font-size: 18px">
                An email has been sent to you
            </p>

            <p style="font-size: 18px">
                <b>Your Order Number is: </b>
                <a class="text-success" href="{{ route('order_details',['order'=>$order->id]) }}">{{ $order->order_no }}</a>&nbsp;
            </p>

            <p class="mt-20" style="font-size: 18px">We will proceed with your order soon. <br> You can further track this order from the <a class="text-success" href="{{ route('account_details') }}">My Account</a> section.</p>
        </div>
    </div>

@endsection
