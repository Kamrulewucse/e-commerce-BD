@extends('layouts.app')
@section('style')
    <style>
        .page-content-inner {
            padding: 14px 0;
        }

        h1.user-card-title {
            font-size: 18px;
            font-weight: bold;
        }

        h1.account-page-title {
            font-weight: bold;
        }

        label.col-form-label {
            text-align: right;
        }

        input.form-control {
            margin: 8px 0;
            height: 42px;
        }

        h1.user-card-title {
            padding: 8px 0;
        }
        button.btn.btn-danger.btn-cancel {
            background: #bb2d3b;
            border-color: #bb2d3b;
        }
        h1.other-box-title {
            margin: 25px 0;
        }
        .table tbody td{
            text-transform: uppercase;
            padding: 1.3rem;
            letter-spacing: 1px;
            font-size: 13px;
            border: 1px solid #f3f3f3;
            vertical-align: middle;
            color: #000;
            font-weight: 500;
        }

        .other-page-box.order-page-box {
            margin-bottom: 15px;
            padding: 0;
            border-color: transparent;
            box-shadow: 0 0 2px 0 #d3c4c4;

        }
        .single-order-product-details img {height: 116px;width: auto;}

        .single-order-product-details-area {
            width: 100%;
        }

        .single-order-product-details {
            width: 25%;
            float: left;
            text-align: center;
        }
        .modal-dialog {
            max-width: 500px;
            margin: 75px auto;
        }
        button.close-modal-btn {
            background: transparent;
            border: none;
        }

        button.close-modal-btn i {
            color: #000;
            font-size: 23px;
            font-weight: normal !important;
        }
        .single-order-product-details h3 {font-size: 12px;color: #000;text-transform: uppercase;font-weight: 600;}
        .btn-modal-order-cancel {
            padding: 9px 23px;
            background: #000;
            color: #fff;
        }
        .btn-modal-order-cancel:hover {
            color: #fff;
        }
        .swal2-styled.swal2-confirm {
            border: 0;
            border-radius: 0.25em;
            background: initial;
            background-color: black;
            color: #fff;
            font-size: 1.0625em;
        }
        /*.payment-issue-part-view-page img {*/
        /*    position: absolute;*/
        /*    height: 78px;*/
        /*    left: 0;*/
        /*    top: 8px;*/
        /*}*/
        /*.product-details .pro-content {*/
        /*    padding-left: 68px;*/
        /*}*/
    </style>
@endsection
@section('content')

    @include('layouts.partial.user_nav')
    <div id="content" class="main-content-wrapper body-height-full">
        <div class="page-content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="other-box-title">MY ORDERS</h1>
                        <hr>

                        <h1 class="other-box-title">ON GOING ({{ $onGoingOrders->count() }})</h1>

                            @if(count($onGoingOrders) <= 0)
                            <div class="other-page-box">
                                <p class="email-text">NO CURRENT ORDERS AVAILABLE</p>
                            </div>
                            @else
                                <div class="order-list-area">
                                    @foreach($onGoingOrders as $onGoingOrder)
                                    <div class="other-page-box order-page-box">
                                        <div class="single-order" style="overflow: auto">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td><b>P{{ $onGoingOrder->order_no }}</b></td>
                                                    <td>{{ $onGoingOrder->created_at->format('Y-m-d') }}</td>
                                                    <td></td>
                                                    <td>{{ count($onGoingOrder->products) }} items</td>
                                                    <td>{{ number_format($onGoingOrder->total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        @foreach($onGoingOrder->products as $product)
                                                        <div class="single-order-product-details-area">
                                                            <div class="single-order-product-details">
                                                                <img src="{{ asset(colorImages($product->product_id,$product->color_id)[0]->thumbs ?? '') }}" alt="">
                                                                <h3>{{ $product->product_name }}</h3>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">
                                                        <b>Status:
                                                            @if($onGoingOrder->status == \App\Enumeration\OrderStatus::$PENDING)
                                                                <span class="text-warning">Pending</span>
                                                            @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$PROCESSING)
                                                                <span class="text-warning">Processing</span>
                                                            @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$APPROVED)
                                                                <span class="text-info">Approved</span>
                                                            @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$ON_SHIPPING)
                                                                <span class="text-info">On Shipping</span>
                                                            @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$SHIPPED)
                                                                <span class="text-info">Shipped</span>
                                                            @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$DELIVERED)
                                                                Delivered
                                                            @elseif($onGoingOrder->status == \App\Enumeration\OrderStatus::$CANCELLED)
                                                                <span class="text-danger">Cancelled</span>
                                                            @endif

                                                        </b>
                                                        @if(\App\Enumeration\OrderStatus::$PENDING == $onGoingOrder->status)
                                                        |  <b><a data-id="{{ $onGoingOrder->id }}" role="button" class="text-danger btn-cancel">Cancel</a></b>
                                                        @endif
                                                    </td>
                                                    <td colspan="3" style="text-align: right;">
                                                        <a href="{{ route('order_details',['order'=>$onGoingOrder->id]) }}">More Details</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif

                        <h1 class="other-box-title">MY PURCHASE HISTORY</h1>
                        @if(count($orderHistories) <= 0)
                        <div class="other-page-box">
                            <p class="email-text">NO HISTORIC ORDERS AVAILABLE</p>
                        </div>
                        @else
                            <div class="order-list-area">
                                @foreach($orderHistories as $orderHistory)
                                    <div class="other-page-box order-page-box">
                                        <div class="single-order" style="overflow: auto">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td><b>{{ $orderHistory->order_no }}</b></td>
                                                    <td>{{ $orderHistory->created_at->format('Y-m-d') }}</td>
                                                    <td></td>
                                                    <td>{{ count($orderHistory->products) }} items</td>
                                                    <td>{{ number_format($orderHistory->total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        @foreach($orderHistory->products as $product)
                                                            <div class="single-order-product-details-area">
                                                                <div class="single-order-product-details">
                                                                    <img src="{{ asset(colorImages($product->product_id,$product->color_id)[0]->thumbs ?? '') }}" alt="">
                                                                    <h3>{{ $product->product_name }}</h3>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">
                                                        <b>Status:
                                                            @if($orderHistory->status == \App\Enumeration\OrderStatus::$PENDING)
                                                                <span class="text-warning">Pending</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$PROCESSING)
                                                                <span class="text-info">Processing</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$APPROVED)
                                                                <span class="text-info">Approved</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$ON_SHIPPING)
                                                                <span class="text-info">On Shipping</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$SHIPPED)
                                                                <span class="text-info">Shipped</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$DELIVERED)
                                                                <span class="text-success">Delivered</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$CANCELLED)
                                                                <span class="text-danger">Cancelled</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$RETURNED_INIT)
                                                                <span class="text-warning">Return Initiate</span>
                                                            @elseif($orderHistory->status == \App\Enumeration\OrderStatus::$RETURNED)
                                                                <span class="text-danger">Returned</span>
                                                            @endif
                                                        </b>
                                                    </td>
                                                    <td colspan="3" style="text-align: right;">
                                                        <a href="{{ route('order_details',['order'=>$orderHistory->id]) }}">More Details</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                                    {{ $orderHistories->links('layouts.partial.pagination') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="product-return-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">PRODUCT RETURN</h1>
                    <button type="button" class="close-modal-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-form-order-return" name="modal-form-order-return">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-danger pull-right">Mandatory fields *</span>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="return_order_id" id="return_order_id">

                                <div class="form-group">
                                    <label for="return_cause">Return Cause <span class="text-danger">*</span></label>
                                    <select name="return_cause" class="form-control register-input" id="return_cause">
                                        <option value="">Select Return Cause</option>
                                        <option value="Product is damaged">Product is damaged</option>
                                        <option value="Product is defective">Product is defective</option>
                                        <option value="Product is incorrect or incomplete">Product is incorrect or incomplete</option>
                                    </select>
                                    <span class="text-danger" id="return_cause_error"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea rows="4" id="remarks" class="form-control register-input" name="remarks"></textarea>
                                    <span class="text-danger" id="return_remarks_error"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a role="button" id="return-cause-submit" class="btn btn-secondary btn-modal-custom">Submit</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order-cancel-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog cancel-modal-diolog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel"></h1>
                    <button type="button" class="close-modal-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form action="" id="modal-form-order-cancel">
                        <input type="hidden" id="cancel_order_id" name="cancel_order_id">
                    </form>
                    <h1 class="text-danger">Are you sure?</h1>
                </div>
                <div class="modal-footer">
                    <a role="button" id="cancel-cause-submit" class="btn-modal-order-cancel">Yes</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(function () {

            $('.btn-cancel').click(function () {

                var orderId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'black',
                    cancelButtonColor: 'black',
                    // confirmButtonText: 'OK',
                    // confirmButtonColor: 'black',
                    confirmButtonText: 'Yes, Cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "Post",
                            url: "{{ route('cancel_order') }}",
                            data: { orderId: orderId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    {
                                        //title: "Canceled!"+response.message,
                                        text: "Canceled!",
                                        type: "warning",
                                        confirmButtonColor: "#000",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                        closeOnCancel: false,
                                        customClass: "Custom_Cancel"
                                    },

                                ).then((result) => {
                                    location.reload();
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

            {{--$(".btn-return").click(function (){--}}
            {{--    var orderId = $(this).data('id');--}}
            {{--    $("#return_order_id").val(orderId);--}}
            {{--    $("#product-return-modal").modal('show');--}}
            {{--})--}}
            {{--$('#return-cause-submit').click(function () {--}}
            {{--    var formDataReturn = new FormData($('#modal-form-order-return')[0]);--}}

            {{--    $.ajax({--}}
            {{--        type: "POST",--}}
            {{--        url: "{{ route('return_order') }}",--}}
            {{--        data: formDataReturn,--}}
            {{--        processData: false,--}}
            {{--        contentType: false,--}}
            {{--        success: function(response) {--}}
            {{--            if (response.success) {--}}
            {{--                $('#product-return-modal').modal('hide');--}}
            {{--                Swal.fire(--}}
            {{--                    'Success!',--}}
            {{--                    response.message,--}}
            {{--                    'success'--}}
            {{--                ).then((result) => {--}}
            {{--                    location.reload();--}}
            {{--                });--}}
            {{--            } else {--}}
            {{--                if(response.errors.return_cause){--}}
            {{--                    $("#return_cause_error").html(response.errors.return_cause);--}}
            {{--                }else{--}}
            {{--                    $("#return_cause_error").html(' ');--}}
            {{--                }--}}
            {{--                if(response.errors.remarks){--}}
            {{--                    $("#return_remarks_error").html(response.errors.remarks);--}}
            {{--                }else{--}}
            {{--                    $("#return_remarks_error").html(' ');--}}
            {{--                }--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@endsection
