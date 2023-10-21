@extends('frontend.mail.layouts')

@section('content')
    <!-- Body content -->
    <tr>
        <td style="box-sizing: border-box;">
            Dear <strong>{{ $order->customer->name ?? '' }}</strong>, <br><br>

            Thank you for your Order. <br><br>

            It was great having you shop at <a target="_blank" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <br><br>

            Your order will be processed after completing necessary formalities <br><br>

            The details of your order are given below:
        </td>
    </tr>

    <tr>
        <td style="padding-top: 10px">
            <table style="width: 100%; border: 1px solid grey; background-color: #ececec; text-align: left; font-size: 12px">
                <tr>
                    <th>Order Number</th>
                    <td>: {{ $order->order_no }}</td>
                </tr>
                <tr>
                    <th>Order Date & Time</th>
                    <td>: {{ date("j F, Y h:i A", strtotime($order->created_at)) }}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    @if($order->payment_method == 1)
                    <td> Online Payment</td>
                    @else
                    <td> Cash on Delivery</td>
                    @endif
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding-top: 10px">
            <table class="product_table" style="width: 100%; font-size: 10px; border: 1px solid grey; border-collapse: collapse;">
                <tr style="background-color: #ececec;">
                    <th style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left; background-color: #ccc; padding: 5px;">S.N.</th>
                    <th style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left; background-color: #ccc; padding: 5px;">Product Name</th>
                    <th style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left; background-color: #ccc; padding: 5px;">Variant</th>
                    <th style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left; background-color: #ccc; padding: 5px;">Unit Price</th>
                    <th style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left; background-color: #ccc; padding: 5px;">Quantity</th>
                    <th style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left; background-color: #ccc; padding: 5px;">Total Cost</th>
                </tr>

                @foreach($order->products as $product)
                    <tr style="background-color: #ececec;">
                        <td style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left;">{{ $loop->iteration }}</td>
                        <td style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left;">{{ $product->product_name }}</td>
                        <td style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left;">
                            @if($product->color)
                                Color: {{ $product->color }}

                                @if($product->size)
                                    <br>
                                @endif
                            @endif

                            @if($product->size && checkSizeType($product->size_id)->type == 1)
                                Size: {{ $product->size }}
                            @endif
                        </td>
                        <td style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left;">{{ convertCurrencySign($product->unit_price) }}</td>
                        <td style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left;">{{ $product->quantity }}</td>
                        <td style="border: 1px solid grey; border-collapse: collapse; padding: 5px; text-align: left;">{{ convertCurrencySign($product->total) }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding-top: 10px">
            <table style="width: 100%; border: 1px solid grey; background-color: #ececec; text-align: left; font-size: 12px">
                <tr>
                    <th>Subtotal</th>
                    <td>{{ convertCurrencySign($order->subtotal) }}</td>
                </tr>
                <tr>
                    <th>Shipping Cost</th>
                    <td>{{ convertCurrencySign($order->shipping_cost) }}</td>
                </tr>

                <tr>
                    <th>Total Amount</th>
                    <td>{{ convertCurrencySign($order->total) }}</td>
                </tr>
                <tr>
                    <th>Amount Paid</th>
                    <td>{{ convertCurrencySign($order->paid) }}</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding-top: 10px">
            <strong>Shipping Address</strong><br>
            <p style="white-space: pre-line; margin: 0px">{{ $order->shipping_address }}, {{ $order->country->name ?? '' }}, {{ $order->city }}</p>
            Mobile: {{ $order->mobile_no }} <br>
            Email: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
        </td>
    </tr>

    <tr>
        <td style="padding-top: 15px">
            We request you to make note of this information for future reference. <br><br>

            We are excited about your purchase at <a target="_blank" href="{{ route('home') }}">{{ config('app.name') }}</a> and look forward to your continued patronage.
            See you again at <a target="_blank" href="{{ route('home') }}">{{ config('app.name') }}</a>. <br><br>

            For any order related queries, please call <strong>16469</strong> or email us at <strong><a href="mailto:contact@bangladeshdrip.com">Bangladeshdrip.com</a></strong>
            <br><br>

            We assure you of best services at all times. <br><br>

            Warm Regards,<br>
            <strong><a target="_blank" href="{{ route('home') }}">{{ config('app.name') }}</a> Team </strong><br><br>

            <strong>Note: </strong>You can track the status of your order in <strong>My Account</strong> section on <a target="_blank" href="{{ route('over_view') }}">{{ config('app.name') }}</a>
        </td>
    </tr>
@endsection
