@extends('layouts.admin')

@section('title')
    Order Details #{{ $order->order_no }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a target="_blank" href="{{ route('order.customer_copy',['order'=>$order->id]) }}" class="btn btn-primary pull-right"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Order Number</th>
                                    <td>{{ $order->order_no }}</td>
                                </tr>
                                <tr>
                                    <th>Order Date & Time</th>
                                    <td>{{ date("j F, Y h:i A", strtotime($order->updated_at)) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        @if ($order->payment_option == 2)
                                            Port Wallet
                                        @else
                                            Online Payment
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($order->status == \App\Enumeration\OrderStatus::$PENDING)
                                            Pending
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$PROCESSING)
                                            Processing
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$APPROVED)
                                            Approved
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$ON_SHIPPING)
                                            On Shipping
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$SHIPPED)
                                            Shipped
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$DELIVERED)
                                            Delivered
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$CANCELLED)
                                            Cancelled
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$RETURNED_INIT)
                                            Return Initiate
                                        @elseif($order->status == \App\Enumeration\OrderStatus::$RETURNED)
                                            Returned
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Delivery Type(Duration)</th>
                                    <td>{{$order->delivery_duration}}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $order->customer->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $order->country->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $order->state->name }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping Address</th>
                                    <td style="white-space: pre-line">{{ $order->shipping_address }}</td>
                                </tr>
                                <tr>
                                    <th>Billing Address</th>
                                    <td style="white-space: pre-line">{{ $order->billing_address }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td>{{ $order->mobile_no }}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ $order->customer->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Product Name</th>
                                        <th>Variant</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total Cost</th>
                                    </tr>

                                    @foreach($order->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>
                                                @if($product->color)
                                                    Color: {{ $product->color }}

                                                    @if($product->size)
                                                        <br>
                                                    @endif
                                                @endif
                                                    @if(checkCustomType($product->type_id)->id != 1)
                                                    Type: {{ $product->type }}
                                                    @endif
                                                    @if($product->size && checkSizeType($product->size_id)->type == 1))
                                                    Size: {{ $product->size }}
                                                    @endif
                                            </td>
                                            <td class="text-right">৳{{  number_format($product->unit_price,2) }}</td>
                                            <td class="text-right">{{ $product->quantity }}</td>
                                            <td class="text-right">৳{{ number_format($product->total,2) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="offset-md-8 col-md-4">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-right">Subtotal</th>
                                    <td class="text-right">৳ {{ number_format($order->subtotal,2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Shipping Cost</th>
                                    <td class="text-right">৳ {{ number_format($order->shipping_cost,2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Total</th>
                                    <td class="text-right">৳ {{ number_format($order->total,2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid</th>
                                    <td class="text-right">৳ {{ number_format($order->paid,2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Due</th>
                                    <td class="text-right">৳ {{ number_format($order->due,2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    @if ($order->notes)
                        <div class="row">
                            <div class="col-md-12">
                                <p style="white-space: pre-line"><strong>Note: </strong>{{ $order->notes }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($order->gift_message)
                        <div class="row">
                            <div class="col-md-12">
                                <p style="white-space: pre-line"><strong>Gift Message: </strong>{{ $order->gift_message }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
