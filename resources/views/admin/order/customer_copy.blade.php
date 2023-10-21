<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ $order->order_no }}</title>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/backend/dist/css/adminlte.min.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-12">
                <img src="{{ asset('img/logo.png') }}" height="100px">
            </div>
        </div>

        <div class="row" style="margin-bottom: 20px">
            <div class="col-6">
                <strong>{{ $order->customer->name ?? '' }}</strong>

                <p style="white-space: pre-line; margin: 0px">{{ $order->shipping_address }}, {{ $order->city }},  {{ $order->country ? $order->country->name : ''}}</p>
                Mobile: {{ $order->mobile_no }} <br>
                Email: {{ $order->customer->email }}
            </div>

            <div class="col-6 text-right">
                <h3>Shipment #{{ $order->order_no }}</h3>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="text-center">S.N.</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Variant</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total Cost</th>
                        </tr>

                        @foreach($order->products as $product)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
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
            <div class="offset-6 col-6">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-right">Subtotal</th>
                        <td class="text-right">: ৳{{ number_format($order->subtotal,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Shipping Cost</th>
                        <td class="text-right">: ৳{{ number_format($order->shipping_cost,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Total Amount</th>
                        <td class="text-right">: ৳{{ number_format($order->total,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Cash To Collect</th>
                        <td class="text-right">: ৳{{ number_format($order->due,2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Thank you for ordering from {{ config('app.name') }}. If you have any complaint about this order, please call us 16754 or email us at contact@bangladeshdrip.com.</p>
            </div>
        </div>
    </div>


    <script>
        window.print();
        window.onafterprint = function(){ window.close()};
    </script>
</body>
</html>
