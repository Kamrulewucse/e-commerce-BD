@extends('layouts.vendor')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Processing Orders
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date & Time</th>
                            <th>Mobile</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_no }}</td>
                                <td>{{ date("j F, Y h:i A", strtotime($order->created_at)) }}</td>
                                <td>{{ $order->customer->mobile }}</td>
                                <td>৳{{ number_format($order->total,2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn-approve" data-id="{{ $order->id }}">Approve</button>
                                    <button type="button" class="btn btn-danger btn-sm btn-cancel" data-id="{{ $order->id }}">Cancel</button>
                                    <a href="{{ route('vendor.order.view', ['order' => $order->id]) }}" class="btn btn-info btn-sm">View</a>
                                    <a target="_blank" href="{{ route('vendor.order.customer_copy', ['order' => $order->id]) }}" class="btn btn-warning btn-sm">Print Customer Copy</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>৳{{ number_format($orders->sum('total'),2) }}</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" id="modal-cancel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cancel Order</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to cancel?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline" id="modalBtnCancel">Cancel Order</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            var selectedId;

            $('#table').DataTable({
                "order": [[ 1, "desc" ]]
            });

            $('.btn-approve').click(function () {
                var orderId = $(this).data('id');

                $.ajax({
                    method: "POST",
                    url: "{{ route('vendor.order.approve.post') }}",
                    data: { orderId: orderId }
                }).done(function( msg ) {
                    location.reload();
                });
            });

            $('.btn-cancel').click(function () {
                $('#modal-cancel').modal('show');
                selectedId = $(this).data('id');
            });

            $('#modalBtnCancel').click(function () {
                $.ajax({
                    method: "POST",
                    url: "{{ route('vendor.order.cancel.post') }}",
                    data: { id: selectedId }
                }).done(function( msg ) {
                    location.reload();
                });
            });
        })
    </script>
@endsection
