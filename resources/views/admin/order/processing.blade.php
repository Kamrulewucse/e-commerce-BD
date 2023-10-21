@extends('layouts.admin')
@section('style')
    <style>
        .bd-example-modal-lg .modal-dialog{
            display: table;
            position: relative;
            margin: 0 auto;
            top: calc(50% - 24px);
        }

        .bd-example-modal-lg .modal-dialog .modal-content {
            background-color: transparent;
            border: none;
            box-shadow: none;
            border-radius: 0;
            color: #007BFF;
        }
        .bd-example-modal-lg .modal-dialog{
            display: table;
            position: relative;
            margin: 0 auto;
            top: calc(50% - 24px);
        }

        div#modal-preload {
            background: #00000042;
            z-index: 1055;
        }

    </style>
@endsection
@section('title')
    Processing Orders
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
                                <th>Delivery Duration</th>
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

    <div class="modal fade" id="pathao" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="pathao" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pathao Order Delivery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pathao-modal-form" enctype="multipart/form-data" name="pathao-modal-form">
                        <div class="row">
                            <input type="hidden" id="pathao_order_id" name="order_id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pathao_store">Store <span class="text-danger">*</span></label>
                                    <select id="pathao_store" class="form-control select2" name="store">
                                        <option value="">Select Store</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pathao_city">City <span class="text-danger">*</span></label>
                                    <select id="pathao_city" class="form-control select2" name="city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pathao_zone">Zone <span class="text-danger">*</span></label>
                                    <select id="pathao_zone" class="form-control select2" name="zone">
                                        <option value="">Select Zone</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pathao_area">Area <span class="text-danger">*</span></label>
                                    <select id="pathao_area" class="form-control select2" name="area">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-pathao-delivery" class="btn btn-primary">Delivery</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ecourier" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="ecourier" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">E-Courier Order Delivery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ecourier-modal-form" enctype="multipart/form-data" name="ecourier-modal-form">
                        <div class="row">
                            <input type="hidden" id="ecourier_order_id" name="order_id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ecourier_city">City <span class="text-danger">*</span></label>
                                    <select id="ecourier_city" class="form-control select2" name="city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ecourier_thana">Thana <span class="text-danger">*</span></label>
                                    <select id="ecourier_thana" class="form-control select2" name="thana">
                                        <option value="">Select Thana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ecourier_postcode">Postcode <span class="text-danger">*</span></label>
                                    <select id="ecourier_postcode" class="form-control select2" name="postcode">
                                        <option value="">Select Postcode</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ecourier_area">Area <span class="text-danger">*</span></label>
                                    <select id="ecourier_area" class="form-control select2" name="area">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="ecourier_package">Package <span class="text-danger">*</span></label>--}}
{{--                                    <select id="ecourier_package" class="form-control select2" name="package">--}}
{{--                                        <option value="">Select Package</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-ecourier-delivery" class="btn btn-primary">Delivery</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modal-preload" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('order.processing_datatable') }}',
                columns: [
                    {data: 'order_no', name: 'order_no',},
                    {data: 'processed_at', name: 'processed_at'},
                    {data: 'customer_info', name: 'customer_info'},
                    {data: 'product_info', name: 'product_info'},
                    {data: 'delivery_duration', name: 'delivery_duration'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[ 1, "desc" ]],
            });

            $('body').on('click', '.btn-pathao', function (e) {
                e.preventDefault();
                $("#pathao_order_id").val($(this).data('id'));
                $('#pathao').modal('show');
            });
            $('body').on('click', '.btn-ecourier', function (e) {
                e.preventDefault();
                $("#ecourier_order_id").val($(this).data('id'));
                $('#ecourier').modal('show');
            });

            $('#btn-pathao-delivery').click(function () {
                var pathaoFormData = new FormData($('#pathao-modal-form')[0]);
                $("#modal-preload").modal('show');
                $.ajax({
                    type: "POST",
                    url: "{{ route('pathao_delivery_order_request') }}",
                    data: pathaoFormData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $("#modal-preload").modal('hide');
                            $('#pathao').modal('hide');
                            Swal.fire(
                                'Pathao Delivery Order Request!',
                                response.message,
                                'success'
                            ).then((result) => {
                                location.reload();
                                //window.location.href = response.redirect_url;
                            });
                        } else {
                            $("#modal-preload").modal('hide');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    }
                });
            });
            $('#btn-ecourier-delivery').click(function () {
                var ecourierFormData = new FormData($('#ecourier-modal-form')[0]);
                $("#modal-preload").modal('show');
                $.ajax({
                    type: "POST",
                    url: "{{ route('ecourier_delivery_order_request') }}",
                    data: ecourierFormData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $("#modal-preload").modal('hide');
                            $('#ecourier').modal('hide');
                            Swal.fire(
                                'E-Courier Delivery Order Request!',
                                response.message,
                                'success'
                            ).then((result) => {
                                location.reload();
                                //window.location.href = response.redirect_url;
                            });
                        } else {
                            $("#modal-preload").modal('hide');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    }
                });
            });

            $.ajax({
                method: "GET",
                url: "{{ route('get_ecourier_api_package') }}",
            }).done(function (data) {
                $.each(data, function (index, item) {
                    $('#ecourier_package').append('<option value="' + item.package_code + '">' + item.package_name + '('+item.delivery_time+')</option>');
                });
            });
            $.ajax({
                method: "GET",
                url: "{{ route('get_ecourier_api_city') }}",
            }).done(function (data) {
                $.each(data, function (index, item) {
                    $('#ecourier_city').append('<option value="' + item.name + '">' + item.name +'</option>');
                });
            });

            $('#ecourier_city').change(function () {
                var ecourierCityName = $(this).val();
                $('#ecourier_thana').html('<option value="">Select Thana</option>');
                if (ecourierCityName != '') {
                    //$("#modal-preload").modal('show');
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_ecourier_api_thana') }}",
                        data: {cityName: ecourierCityName}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            $('#ecourier_thana').append('<option value="' + item.name + '">' + item.name + '</option>');
                        });
                        //$("#modal-preload").modal('hide');
                        $("#ecourier_thana").trigger("change");
                    });
                }
            });
            $("#ecourier_city").trigger("change");

            $('#ecourier_thana').change(function () {
                var ecourierThanaName = $(this).val();
                var ecourierCityName = $('#ecourier_city').val();
                $('#ecourier_postcode').html('<option value="">Select Postcode</option>');
                $('#ecourier_area').html('<option value="">Select Area</option>');
                if (ecourierCityName != '') {
                    //$("#modal-preload").modal('show');
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_ecourier_api_postcode') }}",
                        data: {cityName: ecourierCityName,thanaName:ecourierThanaName}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            console.log(item);
                            $('#ecourier_postcode').append('<option value="' + item.name + '">' + item.name + '</option>');
                        });
                        //$("#modal-preload").modal('hide');
                        $("#ecourier_postcode").trigger("change");
                    });
                }
            });
            $("#ecourier_thana").trigger("change");

            $('#ecourier_postcode').change(function () {
                var ecourierPostcode = $(this).val();
                $('#ecourier_area').html('<option value="">Select Area</option>');
                if (ecourierPostcode != '') {
                    //$("#modal-preload").modal('show');
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_ecourier_api_area') }}",
                        data: {postcode:ecourierPostcode}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            $('#ecourier_area').append('<option value="' + item.name + '">' + item.name + '</option>');
                        });
                        //$("#modal-preload").modal('hide');
                    });
                }
            });
            $("#ecourier_postcode").trigger("change");

            $.ajax({
                method: "GET",
                url: "{{ route('get_pathao_api_city') }}",
            }).done(function (data) {
                $.each(data, function (index, item) {
                    $('#pathao_city').append('<option value="' + item.city_id + '">' + item.city_name + '</option>');
                });
            });
            $.ajax({
                method: "GET",
                url: "{{ route('get_pathao_api_stores') }}",
            }).done(function (data) {
                $.each(data, function (index, item) {
                    $('#pathao_store').append('<option value="' + item.store_id + '">' + item.store_name + '</option>');
                });
            });
            $('#pathao_city').change(function () {
                var pathaoCityId = $(this).val();
                $('#pathao_zone').html('<option value="">Select Zone</option>');
                $('#pathao_area').html('<option value="">Select Area</option>');

                if (pathaoCityId != '') {
                    $("#modal-preload").modal('show');
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_pathao_api_zone') }}",
                        data: {cityId: pathaoCityId}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            $('#pathao_zone').append('<option value="' + item.zone_id + '">' + item.zone_name + '</option>');
                        });
                        $("#modal-preload").modal('hide');
                        $("#pathao_zone").trigger("change");
                    });
                }
            });
            $("#pathao_city").trigger("change");
            $('#pathao_zone').change(function () {
                var pathaoZoneId = $(this).val();
                $('#pathao_area').html('<option value="">Select Area</option>');

                if (pathaoZoneId != '') {
                    $("#modal-preload").modal('show');
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_pathao_api_area') }}",
                        data: {zoneId: pathaoZoneId}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            $('#pathao_area').append('<option value="' + item.area_id + '">' + item.area_name + '</option>');
                        });
                        $("#modal-preload").modal('hide');
                        $("#pathao_area").trigger("change");
                    });
                }
            });
            $("#pathao_area").trigger("change");

            $('body').on('click', '.btn-shipped', function (e) {
                e.preventDefault();
                var orderId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, shipped it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "Post",
                            url: "{{ route('order.shipped.post') }}",
                            data: { orderId: orderId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'shipped!',
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
