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
        .product-details-header-log th{
            color: #000;

        }
        .card-body{
            flex: 1 1 auto;
            padding: 0px;
        }
        .table thead th, .table th {
            text-transform: none;
            letter-spacing: 1px;
            font-weight: 400;
            font-size: 11px;
            border: 3px solid #F6F5F3;
            padding: 10px 0px 10px 18px;
        }
        .product-details {
            padding-top: 30px;
            padding-bottom: 20px;
        }
        .product-details .payment-issue-part-view-page-data{
            width: 200px;
        }
        .product-details img{
            padding-left: 30px;
        }
        .product-details .pro-content{
           // padding-left: 30px;
            padding-left: 70px;
        }
        .pro-data button{
            margin-top: 10px;
        }
        .product-details-price p{
            padding-top: 30px;
            padding-right: 30px;
        }
        .payment-issue-part-view-page{
            position: relative;
            padding-bottom: 0px;
            margin-bottom: 0px;
        }
        .table thead .custom-text1{
            font-size: 14px;
        }
        .table thead .custom-text2{
            font-size: 14px;
        }
        .payment-issue-part-view-page img {
            position: absolute;
            height: 75px;
            left: 0;
            top: 8px;
        }
        /*.product-details .pro-content {*/
        /*    padding-left: 63px;*/
        /*}*/
    </style>
@endsection
@section('content')
    @include('layouts.partial.user_nav')
    <div class="page-content-inner">
        <div class="container" style="padding: 0;">
            <div class="row pt--80 pb--80 pt-md--45 pt-sm--25 pb-md--60 pb-sm--40">
                <div class="col-lg-12 mb-md--30">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-content table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                            <tr class="product-details-header-log">
                                                <th width="15%" class="text-start custom-text1"><strong>{{ $order->order_no }}</strong></th>
                                                <th width="10%" class="text-start">{{ $order->created_at->format('d-m-Y') }}</th>
{{--                                                <th width="30%" class="text-start"><strong>Purchased</strong> in store: Bangladesh drip</th>--}}
                                                <th width="30%" class="text-start"><strong>Purchased</strong> Online</th>
                                                <th width="10%" class="text-start"></th>
                                                <th width="10%" class="text-start">{{ count($order->products) }} Items</th>
                                                <th width="15%" class="text-start custom-text2"><strong>{{ convertCurrencySign($order->total) }}</strong></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @foreach($order->products as $item)
                            <div class="row g-0">
                                <div class="col-md-6 product-details">
                                    <div class="row smart-carts-info">
                                        <div class="col-12">
                                            <div class="payment-issue-part-view-page">
                                                <img  src="{{ asset(colorImages($item->product_id,$item->color_id)[0]->thumbs ?? '') }}" alt="">
                                                <div class="details-payment-issue pro-content">
                                                    <h3>{{ $item->product_name }}</h3>
                                                    <p class="pro-data">
                                                        <span>Quantity: {{ $item->quantity }}</span>
                                                        <br><span>Color: {{ $item->color }}</span>
                                                        @if(checkSizeType($item->size_id)->type == 1)
                                                        <br><span>Size: {{ $item->size }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-sm-end product-details-price">
                                    <p>{{ convertCurrencySign($item->total) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
