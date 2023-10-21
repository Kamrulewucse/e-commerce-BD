@extends('layouts.admin')

@section('title')
    Pending Orders
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive-sm">
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
                <!-- /.card-body -->
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
                ajax: '{{ route('order.pending_datatable') }}',
                columns: [
                    {data: 'order_no', name: 'order_no',},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'customer_info', name: 'customer_info'},
                    {data: 'product_info', name: 'product_info'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[ 1, "desc" ]],
            });

            $('#modal-pay-type').change(function (){
                var paymentType = $(this).val();
                if(paymentType == 1)
                    $('#transaction_id_area').hide();
                else
                    $('#transaction_id_area').show();
            });

            $('#modal-pay-type').trigger("change");


            $('#modal-btn-pay').click(function () {

                var formData = new FormData($('#modal-form')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('order.approved.post') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#modal-pay').modal('hide');
                            Swal.fire(
                                'Approved!',
                                response.message,
                                'success'
                            ).then((result) => {
                                //location.reload();
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    }
                });
            });


            $('body').on('click', '.btn-approved', function (e) {
                e.preventDefault();
                var orderId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approved it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "Post",
                            url: "{{ route('order.approved.post') }}",
                            data: { orderId: orderId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'Approved!',
                                    response.message,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                    //window.location.href = response.redirect_url;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        });

                    }
                })

            });

            $('body').on('click', '.btn-cancel', function (e) {
                e.preventDefault();
                var orderId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "Post",
                            url: "{{ route('order.cancel.post') }}",
                            data: { orderId: orderId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'Canceled!',
                                    response.message,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                    //window.location.href = response.redirect_url;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        });

                    }
                })

            });

        })
    </script>
@endsection
