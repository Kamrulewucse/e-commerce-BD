@extends('layouts.admin')
@section('title','Add to Finished Goods')
@section('style')
    <style>
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
            white-space: nowrap;
            text-align: center;
        }
        input.form-control.cost_price {width: 100px;}

        input.form-control.sale_price {width: 100px;}
        .table-bordered td .form-group {
            margin-bottom: 0;
        }
        input.form-control.quantity {
            width: 100px;
        }
        input.form-control {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add to Finished Goods Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('finished_goods.add') }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('warehouse') ? 'has-error' :'' }}">
                                    <label for="warehouse">Warehouse</label>
                                    <select name="warehouse" id="warehouse" class="form-control select2">
                                        <option value="">Select Warehouse</option>
                                        @foreach($warehouses as $warehouse)
                                        <option {{ old('warehouse') == $warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                    <label for="date">Date</label>
                                    <input type="date" autocomplete="off" id="date" name="date" class="form-control text-left" placeholder="Enter Date">
                                    @error('date')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>SubCategory</th>
                                                <th>SubSubCategory</th>
                                                <th>Product</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Type</th>
                                                <th>Quantity</th>
                                                <th>Cost Unit Price</th>
                                                <th>Sale Unit Price</th>
                                                <th>Total Cost</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-container">
                                        @if (old('category') != null && sizeof(old('category')) > 0)
                                            @foreach(old('category') as $item)
                                                <tr class="product-item">
                                                    <td>
                                                        <div class="form-group {{ $errors->has('category.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2 category" name="category[]" >
                                                                <option value="">Select Category</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ old('category.'.$loop->parent->index) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td >
                                                        <div class="form-group {{ $errors->has('sub_category.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2 sub_category" style="width: 100%;" data-selected-sub-category="{{ old('sub_category.'.$loop->index) }}" name="sub_category[]">
                                                                <option value="">Select Sub Category</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td >
                                                        <div class="form-group {{ $errors->has('sub_sub_category.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2 sub_sub_category" style="width: 100%;" data-selected-sub-sub-category="{{ old('sub_sub_category.'.$loop->index) }}" name="sub_sub_category[]">
                                                                <option value="">Select Sub Sub Category</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group {{ $errors->has('product.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2 product" style="width: 100%;" data-selected-product="{{ old('product.'.$loop->index) }}" name="product[]">
                                                                <option value="">Select Product</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group {{ $errors->has('color.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2 color" name="color[]" data-selected-color="{{ old('color.'.$loop->index) }}">
                                                                <option value="">Select Color</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group {{ $errors->has('size.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2" name="size[]">
                                                                <option value="">Select Size</option>
                                                                @foreach($sizes as $size)
                                                                    <option {{ old('size.'.$loop->parent->index) == $size->id ? 'selected' : '' }} value="{{ $size->id }}">{{ $size->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group {{ $errors->has('type.'.$loop->index) ? 'has-error' :'' }}">
                                                            <select class="form-control select2" name="type[]" data-selected-type="{{ old('type.'.$loop->index) }}">
                                                                <option value="">Select Type</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td >
                                                        <div class="form-group {{ $errors->has('quantity.'.$loop->index) ? 'has-error' :'' }}">
                                                            <input type="number" step="any" class="form-control quantity" name="quantity[]" value="{{ old('quantity.'.$loop->index) }}">
                                                        </div>
                                                    </td>

                                                    <td >
                                                        <div class="form-group {{ $errors->has('cost_price.'.$loop->index) ? 'has-error' :'' }}">
                                                            <input type="text" step="any" class="form-control cost_price" name="cost_price[]" value="{{ old('cost_price.'.$loop->index) }}">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group {{ $errors->has('sale_price.'.$loop->index) ? 'has-error' :'' }}">
                                                            <input type="text" step="any" class="form-control sale_price" name="sale_price[]" value="{{ old('sale_price.'.$loop->index) }}">
                                                        </div>
                                                    </td>

                                                    <td  class="total-cost"><div class="total-cost">0.00</div></td>
                                                    <td  class="text-center">
                                                        <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="product-item">
                                                <td>
                                                    <div class="form-group">
                                                        <select name="category[]" class="form-control select2 category">
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="sub_category[]" class="form-control select2 sub_category">
                                                            <option value="">Select Sub Category</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="sub_sub_category[]" class="form-control select2 sub_sub_category">
                                                            <option value="">Select Sub Sub Category</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="product[]" class="form-control select2 product">
                                                            <option value="">Select Product</option>
                                                        </select>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <select name="color[]" class="form-control select2 color">
                                                            <option value="">Select Color</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="size[]" class="form-control select2 size">
                                                            <option value="">Select Size</option>
                                                            @foreach($sizes as $size)
                                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="type[]" class="form-control select2 type">
                                                            <option value="">Select Type</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="quantity[]" class="form-control quantity">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="cost_price[]" class="form-control cost_price">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="sale_price[]" class="form-control sale_price">
                                                    </div>
                                                </td>
                                                <td><div class="total-cost">0.00</div></td>
                                                <td><a role="button" class="btn btn-danger btn-sm btn-remove">X</a></td>
                                            </tr>
                                        @endif

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-left">
                                                <a role="button" class="btn btn-primary btn-flat btn-sm" id="btn-add-product">Add <i class="fa fa-plus"></i></a>
                                            </th>
                                            <th class="text-right" colspan="6">Sub Total</th>
                                            <th class="text-center"><div id="total-qty">0.00</div></th>
                                            <th class="text-center"></th>
                                            <th class="text-center"></th>
                                            <th class="text-center"><div id="sub-total-cost-price">0.00</div></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                        <a href="{{ route('finished_goods') }}" class="btn btn-default btn-flat float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <template id="product-template">
        <tr class="product-item">
            <td>
                <div class="form-group">
                    <select name="category[]" class="form-control select2 category">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="sub_category[]" class="form-control select2 sub_category">
                        <option value="">Select Sub Category</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="sub_sub_category[]" class="form-control select2 sub_sub_category">
                        <option value="">Select Sub Sub Category</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="product[]" class="form-control select2 product">
                        <option value="">Select Product</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="color[]" class="form-control select2 color">
                        <option value="">Select Color</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="size[]" class="form-control select2 size">
                        <option value="">Select Size</option>
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="type[]" class="form-control select2 type">
                        <option value="">Select Type</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" name="quantity[]" class="form-control quantity">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" name="cost_price[]" class="form-control cost_price">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" name="sale_price[]" class="form-control sale_price">
                </div>
            </td>
            <td><div class="total-cost">0.00</div></td>
            <td><a role="button" class="btn btn-danger btn-sm btn-remove">X</a></td>
        </tr>
    </template>
@endsection
@section('script')
    <script>
        $(function () {
            // select Category
            $('body').on('change','.category', function () {
                var categoryID = $(this).val();
                var itemCategory = $(this);
                itemCategory.closest('tr').find('.sub_category').html('<option value="">Select Sub Category</option>');
                var selected = itemCategory.closest('tr').find('.sub_category').attr("data-selected-sub-category");

                if (categoryID != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_subCategory') }}",
                        data: { categoryID: categoryID }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (selected == item.id)
                                itemCategory.closest('tr').find('.sub_category').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                itemCategory.closest('tr').find('.sub_category').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                        itemCategory.closest('tr').find('.sub_category').trigger('change');
                    });
                }

            });
            // select Sub Category
            $('body').on('change','.sub_category', function () {
                var subcategoryID = $(this).val();
                var itemSubCategory = $(this);
                itemSubCategory.closest('tr').find('.sub_sub_category').html('<option value="">Select Sub Sub Category</option>');
                var subSubCategorySelected = itemSubCategory.closest('tr').find('.sub_sub_category').attr("data-selected-sub-sub-category");

                if (subcategoryID != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_subSubCategory') }}",
                        data: { subCategoryID: subcategoryID }
                    }).done(function( data ) {

                        $.each(data, function( index, item ) {
                            if (subSubCategorySelected == item.id)
                                itemSubCategory.closest('tr').find('.sub_sub_category').append('<option value="'+item.id+'" selected>'+item.name+'</option>');

                            else
                                itemSubCategory.closest('tr').find('.sub_sub_category').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                        itemSubCategory.closest('tr').find('.sub_sub_category').trigger('change');
                    });
                }

            });

            $('body').on('change','.sub_sub_category', function () {
                var subSubCategoryID = $(this).val();
                var itemSubSubCategory = $(this);

                var categoryId = itemSubSubCategory.closest('tr').find('.category').val();
                var subCategoryId = itemSubSubCategory.closest('tr').find('.sub_category').val();


                itemSubSubCategory.closest('tr').find('.product').html('<option value="">Select Product</option>');
                var selected = itemSubSubCategory.closest('tr').find('.product').attr("data-selected-product");

                if (subSubCategoryID != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_product') }}",
                        data: {subSubCategoryID: subSubCategoryID }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (selected == item.id)
                                itemSubSubCategory.closest('tr').find('.product').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                itemSubSubCategory.closest('tr').find('.product').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                        itemSubSubCategory.closest('tr').find('.product').trigger('change');

                    });

                }


            });
            $('body').on('change','.product', function () {
                var itemProduct = $(this);
                var productId = $(this).val();

                itemProduct.closest('tr').find('.brand').html('');
                itemProduct.closest('tr').find('.color').html('<option value="">Select Color</option>');
                itemProduct.closest('tr').find('.type').html('<option value="">Select Type</option>');
                var colorSelected = itemProduct.closest('tr').find('.color').attr("data-selected-color");
                var typeSelected = itemProduct.closest('tr').find('.type').attr("data-selected-type");

                if (productId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_colors') }}",
                        data: {productId:productId}
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (colorSelected == item.id)
                                itemProduct.closest('tr').find('.color').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                itemProduct.closest('tr').find('.color').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });

                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_types') }}",
                        data: {productId:productId}
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (typeSelected == item.id)
                                itemProduct.closest('tr').find('.type').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                itemProduct.closest('tr').find('.type').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }

            });

            $('.category').trigger('change');
            $('.subcategory').trigger('change');
            $('.sub_sub_category').trigger('change');
            $('.product').trigger('change');


            $('#btn-add-product').click(function () {
                var html = $('#product-template').html();
                var item = $(html);

                $('#product-container').append(item);

                initProduct();

                //Date picker
                $('.date-picker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

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

            $('body').on('keyup','.quantity,.cost_price,.sale_price', function () {
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
            var subTotalCostPrice = 0;
            var subTotalQuantity = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = $('.quantity:eq('+i+')').val();
                var costPrice = $('.cost_price:eq('+i+')').val();
                var salePrice = $('.sale_price:eq('+i+')').val();

                if (quantity == '' || quantity < 0 || !$.isNumeric(quantity))
                    quantity = 0;

                if (costPrice == '' || costPrice < 0 || !$.isNumeric(costPrice))
                    costPrice = 0;

                if (salePrice == '' || salePrice < 0 || !$.isNumeric(salePrice))
                    salePrice = 0;

                $('.total-cost:eq('+i+')').html((quantity * costPrice).toFixed(2) );

                subTotalCostPrice += quantity * costPrice;
                subTotalQuantity += parseFloat(quantity);
            });

            $('#sub-total-cost-price').html(subTotalCostPrice.toFixed(2));
            $('#total-qty').html(subTotalQuantity);
        }

        function initProduct() {
            $('.select2').select2();
        }

        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

    </script>
@endsection
