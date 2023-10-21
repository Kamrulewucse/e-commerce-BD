@extends('layouts.admin')

@section('title')
    Returned Orders
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date & Time</th>
                                <th>Customer Info</th>
                                <th>Product Info</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th>৳{{ number_format($total,2) }}</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            var selectedId;

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('order.returned_datatable') }}',
                columns: [
                    {data: 'order_no', name: 'order_no',},
                    {data: 'return_at', name: 'return_at'},
                    {data: 'customer_info', name: 'customer_info'},
                    {data: 'product_info', name: 'product_info'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[ 1, "desc" ]],
            });

        })
    </script>
@endsection
