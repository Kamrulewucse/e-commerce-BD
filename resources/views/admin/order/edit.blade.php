@extends('layouts.vendor')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/css/fm.selectator.jquery.css') }}">

@endsection

@section('title')
    Sales Order Edit
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
                <div class="box-header with-border">
                    <h3 class="box-title">Order Edit Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('vendor.order_edit',['order'=>$order->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('customer_name') ? 'has-error' :'' }}">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" name="customer_name" value="{{ $order->customer->name }}" class="form-control" placeholder="Customer Name">
                                    @error('customer_name')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('mobile') ? 'has-error' :'' }}">
                                    <label>Mobile No. <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" value="{{ $order->customer->mobile }}" class="form-control" placeholder="Mobile No.">
                                    @error('mobile')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $order->customer->email }}" class="form-control" placeholder="Email">
                                    @error('email')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('district') ? 'has-error' :'' }}">
                                    <label>District <span class="text-danger">*</span></label>
                                    <select name="district" id="district" class="form-control select2">
                                        <option value="">Select District</option>
                                        @foreach($cities as $city)
                                            <option {{ $order->city_id == $city->id ? 'selected' : ''  }} value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('district')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('area') ? 'has-error' :'' }}">
                                    <label>Area <span class="text-danger">*</span></label>
                                    <select name="area" id="area" class="form-control select2">
                                        <option value="">Select Area</option>
                                    </select>

                                    @error('area')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('shipping_address') ? 'has-error' :'' }}">
                                    <label>Shipping Address <span class="text-danger">*</span>

                                    </label>
                                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Shipping Address" value="{{ $order->customer->shipping_address }}">
                                    @error('shipping_address')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('billing_address') ? 'has-error' :'' }}">
                                    <label>Billing Address
                                        <input {{ old('same_address') == '1' ? 'checked' : '' }} id="same_address" name="same_address" value="1" type="checkbox">Same as Shipping
                                    </label>
                                    <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Billing Address" value="{{ $order->customer->billing_address }}">
                                    @error('billing_address')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('notes') ? 'has-error' :'' }}">
                                    <label>Notes</label>
                                    <input type="text" class="form-control" name="notes" placeholder="Notes" value="{{ $order->notes }}">
                                    @error('notes')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Product Name <span class="text-danger">*</span></th>
                                    <th width="15%">Size</th>
                                    <th width="15%">Color</th>
                                    <th width="15%">Quantity</th>
                                    <th width="15%">Unit Price <span class="text-danger">*</span></th>
                                    <th>Total Cost</th>
                                    <th width="4%"></th>
                                </tr>
                                </thead>

                                <tbody id="product-container">
                                @if (old('product') != null && sizeof(old('product')) > 0)
                                    @foreach(old('product') as $item)
                                        <tr class="product-item">
                                            <td>
                                                <div class="form-group {{ $errors->has('product.'.$loop->index) ? 'has-error' :'' }}">
                                                    <select class="form-control product" style="width: 100%;" name="product[]" required>
                                                        <option value="">Select Product</option>
                                                        @foreach($products as $product)
                                                            <option data-left="{{asset( $product->thumbs ? $product->thumbs : 'img/no_image.png') }}" {{ old('product.'.$loop->parent->index) == $product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                                        @endforeach
                                                        @foreach($packages as $package)
                                                            <option data-left="{{ asset($package->thumbs ? $package->thumbs : 'img/no_image.png') }}" {{ old('product.'.$loop->parent->index) == $package->package_id ? 'selected' : '' }} value="{{ $package->package_id }}">{{ $package->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td >
                                                <div class="form-group {{ $errors->has('size.'.$loop->index) ? 'has-error' :'' }}">
                                                    <select class="form-control size select2"  data-selected-size="{{ old('size.'.$loop->index) }}" name="size[]">
                                                        <option value="">Select Size</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td >
                                                <div class="form-group {{ $errors->has('color.'.$loop->index) ? 'has-error' :'' }}">
                                                    <select class="form-control color select2" data-selected-color="{{ old('color.'.$loop->index) }}" name="color[]">
                                                        <option value="">Select Color</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group {{ $errors->has('quantity.'.$loop->index) ? 'has-error' :'' }}">
                                                    <input type="number" step="any" class="form-control quantity" name="quantity[]" value="{{ old('quantity.'.$loop->index) }}">
                                                    <span class="unit_name"></span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group {{ $errors->has('unit_price.'.$loop->index) ? 'has-error' :'' }}">
                                                    <input type="text" class="form-control unit_price" name="unit_price[]" value="{{ old('unit_price.'.$loop->index) }}">
                                                </div>
                                            </td>

                                            <td class="total-cost">৳ 0.00</td>
                                            <td class="text-center">
                                                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($order->products as $orderProduct)
                                    <tr class="product-item">
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control product" style="width: 100%;" name="product[]" required>
                                                    <option value="">Select Product</option>
                                                    @foreach($packages as $package)
                                                        <option {{ $orderProduct->custom_product_id == $package->package_id ? 'selected' : '' }} value="{{ $package->package_id }}"  data-left="{{ asset($package->thumbs ? $package->thumbs : 'img/no_image.png') }}">{{ $package->name }}</option>
                                                    @endforeach
                                                    @foreach($products as $product)
                                                        <option {{ $orderProduct->custom_product_id == $product->id ? 'selected' : '' }} data-left="{{asset( $product->thumbs ? $product->thumbs : 'img/no_image.png') }}" value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2 size" name="size[]" data-selected-size="{{ $orderProduct->pivot->size_id}}">
                                                    <option value="">Select Size</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2 color" name="color[]" data-selected-color="{{ $orderProduct->pivot->color_id}}">
                                                    <option value="">Select Color</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number"  step="any" class="form-control quantity" name="quantity[]" value="{{ $orderProduct->pivot->quantity }}">
                                                <span class="unit_name"></span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text"  class="form-control unit_price" name="unit_price[]" value="{{ $orderProduct->pivot->unit_price }}">
                                            </div>
                                        </td>

                                        <td class="total-cost">৳ 0.00</td>
                                        <td class="text-center">
                                            <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td>
                                        <a role="button" class="btn btn-info btn-sm" id="btn-add-product">Add More</a>

                                    </td>
                                    <th colspan="4" class="text-center">Total Amount</th>
                                    <th id="total-amount">৳ 0.00</th>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Type</label>
                                    <select class="form-control" id="payment_type" name="payment_type">
                                        <option value="1" {{ $order->payment_method == '1' ? 'selected' : '' }}>Cash</option>
                                        <option value="2" {{ $order->payment_method == '2' ? 'selected' : '' }}>bKash</option>
                                        <option value="3" {{ $order->payment_method == '3' ? 'selected' : '' }}>Rocket</option>
                                        <option value="4" {{ $order->payment_method == '4' ? 'selected' : '' }}>Nogod</option>
                                    </select>
                                </div>
                                <div class="form-group {{ $errors->has('transaction_id') ? 'has-error' :'' }}" id="transaction_id_area">
                                    <label>Transaction ID</label>
                                    <input type="text" value="{{ $order->transaction_id }}" id="transaction_id" name="transaction_id" class="form-control" placeholder="Transaction ID">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="4" class="text-right">Sub Total</th>
                                        <th id="product-sub-total">৳0.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Shipping Cost</th>
                                        <td>
                                            <div class="form-group {{ $errors->has('shipping_cost') ? 'has-error' :'' }}">
                                                <input type="text" class="form-control" name="shipping_cost" id="shipping_cost" value="{{ $order->shipping_cost }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hidden">
                                        <th colspan="4" class="text-right">VAT (%)</th>
                                        <td>
                                            <div class="form-group {{ $errors->has('vat') ? 'has-error' :'' }}">
                                                <input type="text" class="form-control" name="vat" id="vat" value="{{ $order->tax_percengate }}">
                                                <span id="vat_total">৳0.00</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Discount</th>
                                        <td>
                                            <div class="form-group {{ $errors->has('discount') ? 'has-error' :'' }}">
                                                <input type="text" class="form-control" name="discount" id="discount" value="{{ $order->discount }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Total</th>
                                        <th id="final-amount">৳0.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Paid</th>
                                        <td>
                                            <div class="form-group {{ $errors->has('paid') ? 'has-error' :'' }}">
                                                <input type="text" class="form-control" name="paid" id="paid" value="{{ $order->paid }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Due</th>
                                        <th id="due">৳0.00</th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="template-product">
        <tr class="product-item">
            <td>
                <div class="form-group">
                    <select class="form-control product" style="width: 100%;" name="product[]"  required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option data-left="{{asset( $product->thumbs ? $product->thumbs : 'img/no_image.png') }}" value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                        @foreach($packages as $package)
                            <option data-left="{{ asset($package->thumbs ? $package->thumbs : 'img/no_image.png') }}" value="{{ $package->package_id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select class="form-control select2 size" name="size[]">
                        <option value="">Select Size</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select class="form-control select2 color" name="color[]">
                        <option value="">Select Color</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" step="any" class="form-control quantity" name="quantity[]">
                    <span class="unit_name"></span>
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" class="form-control unit_price" name="unit_price[]">
                </div>
            </td>

            <td class="total-cost">৳ 0.00</td>
            <td class="text-center">
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>
        </tr>
    </template>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('themes/backend/js/fm.selectator.jquery.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            $('.product').selectator();
            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('#payment_type').change(function (){
                var paymentType = $(this).val();
                if(paymentType == 1)
                    $('#transaction_id_area').hide();
                else
                    $('#transaction_id_area').show();
            });

            $('#payment_type').trigger("change");

            var selectedArea = '{{ $order->area_id }}';

            $('#district').change(function () {
                var cityId = $(this).val();

                $('#area').html('<option value="">Select Area</option>');

                if (cityId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('vendor_order.get_area') }}",
                        data: { cityId: cityId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (selectedArea == item.id)
                                $('#area').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#area').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#district').trigger('change');

            $("#same_address").change(function () {
                var shippingAddress = $("#shipping_address").val();

                if ($(this).prop('checked')) {
                    $("#billing_address").prop( "readonly", true );
                    $("#billing_address").val(shippingAddress);
                }else{
                    $("#billing_address").prop( "readonly", false );
                    $("#billing_address").val('');
                }
            });


            $('body').on('change','.product', function () {
                var productId = $(this).val();
                var productItem = $(this);
                productItem.closest('tr').find('.size').html('<option value="">Select Size</option>');
                productItem.closest('tr').find('.color').html('<option value="">Select Color</option>');
                var selectedSize = productItem.closest('tr').find('.size').attr("data-selected-size");
                var selectedColor = productItem.closest('tr').find('.color').attr("data-selected-color");
                productItem.closest('tr').find('.unit_name').html('');
                var checkOldPrice = productItem.closest('tr').find('.unit_price').val();


                $.ajax({
                    method: "GET",
                    url: "{{ route('sale_product.details') }}",
                    data: { productId: productId }
                }).done(function( response ) {
                    if(checkOldPrice == '')
                        productItem.closest('tr').find('.unit_price').val(response.price);

                    productItem.closest('tr').find('.unit_name').html(response.unit.name);

                    $('.unit_price').trigger('keyup');
                    console.log(response.sizes);
                    $.each(response.sizes, function( index, item ) {
                        if (selectedSize == item.id)
                            productItem.closest('tr').find('.size').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                        else
                            productItem.closest('tr').find('.size').append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                    $.each(response.colors, function( index, item ) {
                        if (selectedColor == item.id)
                            productItem.closest('tr').find('.color').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                        else
                            productItem.closest('tr').find('.color').append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                });
            });
            $('.product').trigger('change');

            $('#btn-add-product').click(function () {
                var html = $('#template-product').html();
                var item = $(html);

                $('#product-container').append(item);

                initProduct();

                if ($('.product-item').length >= 1 ) {
                    $('.btn-remove').show();
                }
            });

            $('body').on('click', '.btn-remove', function () {
                $(this).closest('.product-item').remove();
                calculate();

                if ($('.product-item').length <= 1 ) {
                    $('.btn-remove').hide();
                }
            });

            $('body').on('keyup', '.quantity, .unit_price,#shipping_cost,#vat, #discount, #paid', function () {
                calculate();
            });

            if ($('.product-item').length <= 1 ) {
                $('.btn-remove').hide();
            } else {
                $('.btn-remove').show();
            }

            initProduct();
            calculate();
        });

        function calculate() {
            var total = 0;
            var vat = $('#vat').val();
            var discount = $('#discount').val();
            var paid = $('#paid').val();
            var shipping_cost = $('#shipping_cost').val();

            if (shipping_cost == '' || shipping_cost < 0 || !$.isNumeric(shipping_cost))
                shipping_cost = 0;

            if (vat == '' || vat < 0 || !$.isNumeric(vat))
                vat = 0;

            if (discount == '' || discount < 0 || !$.isNumeric(discount))
                discount = 0;

            if (paid == '' || paid < 0 || !$.isNumeric(paid))
                paid = 0;


            $('.product-item').each(function(i, obj) {
                var quantity = $('.quantity:eq('+i+')').val();
                var unit_price = $('.unit_price:eq('+i+')').val();

                if (quantity == '' || quantity < 0 || !$.isNumeric(quantity))
                    quantity = 1;

                if (unit_price == '' || unit_price < 0 || !$.isNumeric(unit_price))
                    unit_price = 0;

                $('.total-cost:eq('+i+')').html('৳ ' + (quantity * unit_price).toFixed(2) );
                total += quantity * unit_price;
            });

            var productTotalVat = (total * vat) / 100;

            var allTotal = parseFloat(total) + parseFloat(shipping_cost) + parseFloat(productTotalVat) - parseFloat(discount);
            var due = parseFloat(allTotal) - parseFloat(paid);


            $('#total-amount').html('৳ ' + total.toFixed(2));
            $('#product-sub-total').html('৳ ' + total.toFixed(2));

            $('#final-amount').html('৳' + allTotal.toFixed(2));
            $('#due').html('৳' + due.toFixed(2));
            $('#vat_total').html('৳' + productTotalVat.toFixed(2));

        }

        function initProduct() {
            $('.color').select2();
            $('.size').select2();
            $('.product').selectator();
        }
    </script>
@endsection
