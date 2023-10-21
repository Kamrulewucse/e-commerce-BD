@extends('layouts.admin')
@section('title')
    Inventory Details {{ $product->name }}
@endsection
@section('style')
    <style>
        table.table-bordered.dataTable th, table.table-bordered.dataTable td {
            vertical-align: middle;
            text-align: center;
        }
        .input-group {
            flex-direction: column;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                   <div class="row">
                       <div class="col-md-4">
                           <div class="form-group">
                               <label>Date Range</label>
                               <div class="input-group">
                                   <input type="hidden" id="to_date">
                                   <input type="hidden" id="from_date">
                                   <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                       <i class="far fa-calendar-alt"></i> Date range picker
                                       <i class="fas fa-caret-down"></i>
                                   </button>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <label for="warehouse">Warehouse</label>
                               <select id="warehouse" class="form-control select2">
                                   <option value="">All Warehouse</option>
                                   @foreach($warehouses as $warehouse)
                                   <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <label for="type">Type</label>
                               <select class="form-control select2" id="type">
                                   <option value="">All Type</option>
                                   <option value="1">Finished Goods In</option>
                                   <option value="2">Out</option>
                                   <option value="3">Sales Return</option>
                                   <option value="4">Purchase Return</option>
                               </select>
                           </div>
                       </div>

                   </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Warehouse</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>SubSubCategory</th>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Brand</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                            </thead>
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

            var table = $("#table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('inventory_log.datatable') }}",
                    data: function (d) {
                        d.warehouse_id = $('#warehouse').val()
                        d.type = $('#type').val()
                        d.to_date = $('#to_date').val();
                        d.from_date = $('#from_date').val();
                        d.product_id = {{ $product->id }}
                    }
                },
                columns: [
                    {data: 'date', name: 'date'},
                    {data: 'warehouse', name: 'warehouse.name'},
                    {data: 'type', name: 'type'},
                    {data: 'category', name: 'product.category.name'},
                    {data: 'sub_category', name: 'product.subCategory.name'},
                    {data: 'sub_sub_category', name: 'product.subSubCategory.name'},
                    {data: 'product', name: 'product.name'},
                    {data: 'unit', name: 'product.unit.name'},
                    {data: 'brand', name: 'product.brand.name'},
                    {data: 'color', name: 'color.name'},
                    {data: 'size', name: 'size.name'},
                    {data: 'type_name', name: 'type.name'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'unit_price', name: 'unit_price'},
                ],
                "order": [[ 0, 'desc' ]]
            });
            //Date range picker

            $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
                $("#to_date").val(picker.startDate.format('YYYY-MM-DD'));
                $("#from_date").val(picker.endDate.format('YYYY-MM-DD'));
                $('#daterange-btn').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
                table.ajax.reload();
            });

            $('#daterange-btn').on('cancel.daterangepicker', function(ev, picker) {
                $("#from_date").val('');
                $("#to_date").val('');
                $('#daterange-btn').html('<i class="far fa-calendar-alt"></i> Date range picker <i class="fas fa-caret-down"></i>');
                table.ajax.reload();
            });
            $('#daterange-btn, #type,#warehouse').change(function () {
                table.ajax.reload();
            });
        });
    </script>
@endsection
