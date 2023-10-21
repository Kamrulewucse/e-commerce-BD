@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-cart-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Sale</span>
                    <span class="info-box-number">৳{{ format_price($totalSale) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-dollar-sign"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Pending</span>
                    <span class="info-box-number">৳{{ format_price($totalPending) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-cart-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Completed Order</span>
                    <span class="info-box-number">{{ format_price($completedOrder) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-dollar-sign"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today Order Amount</span>
                    <span class="info-box-number">৳{{ format_price($todayOrderAmount) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Latest Orders</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body" style="">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Area</th>
                                <th>Total</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('order.view', ['order' => $order->id]) }}">{{ $order->order_no }}</a>
                                    </td>
                                    <td>{{ $order->country->name ?? ''.', '.$order->city }}</td>
                                    <td>৳{{ format_price($order->total) }}</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Recently Added Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($recentlyAddedProducts as $product)
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset($product->colorImages[0]->thumbs ?? '') }}" alt="{{ $product->name }}">
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-title">{{ $product->name }} </a>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="card-footer text-center">
                    <a href="{{ route('product') }}" class="uppercase">View All Products</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Top Selling Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body no-padding">
                    <ul class="users-list clearfix">
                        @foreach($bestSellingProducts as $product)
                            <li>
                                <img src="{{ asset($product->colorImages[0]->thumbs ?? '') }}" alt="{{ $product->name }}" width="100px">
                                <a class="users-list-name" href="#" title="{{ $product->name }}">{{ $product->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="card-footer text-center">
                    <a href="{{ route('product') }}" class="uppercase">View All Products</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Order Count by Month</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body" style="">
                    <canvas id="chart-order-count" width="100%" height="50"></canvas>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Product Uploaded by Month</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body" style="">
                    <canvas id="chart-product-uploaded" width="100%" height="50"></canvas>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Order Count By Area</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body" style="">
                    <div id="map" style="width: 100%; height: 400px; background-color: grey"></div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/backend/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnKKbnZogxI9jte1w5VhVfg0CyyZyJTzw&callback=initMap">
    </script>
    <script>
        var orderCountLabel = <?php echo $orderCountLabel; ?>;
        var orderCount = <?php echo $orderCount; ?>;
        var uploadCount = <?php echo $uploadCount; ?>;
        var salesByAreas = <?php echo $salesByAreas; ?>;


        var ctx = document.getElementById('chart-order-count');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: orderCountLabel,
                datasets: [{
                    label: 'Order',
                    data: orderCount,
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor:  'rgba(60,141,188,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                tooltips: {
                    displayColors: false
                }
            }
        });

        var ctx2 = document.getElementById("chart-product-uploaded").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: orderCountLabel,
                datasets: [{
                    data: uploadCount,
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor:  'rgba(60,141,188,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                tooltips: {
                    displayColors: false
                }
            }
        });

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: 23.810332, lng: 90.412518}
            });

            $.each(salesByAreas, function( index, item ) {
                var myLatLng = {lat: parseFloat(item.lat), lng: parseFloat(item.long)};

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    label: item.order_count + '',
                    title: item.bn_name + ' ,' + item.city
                });
            });
        }
    </script>
@endsection

