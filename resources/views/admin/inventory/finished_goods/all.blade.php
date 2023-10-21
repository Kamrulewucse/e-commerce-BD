@extends('layouts.admin')
@section('title','Finished Goods Log')
@section('style')
    <style>
        table.table-bordered.dataTable th, table.table-bordered.dataTable td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('finished_goods.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Finished Goods</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Warehouse</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>SubSubCategory</th>
                            <th>Product</th>
                            <th>Unit</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Cost Unit Price</th>
                            <th>Cost Total</th>
                            <th>Sale Unit Price</th>
                            <th>Sale Total</th>
                            <th>Action</th>
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
            $("#table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('finished_goods.datatable') }}',
                    columns: [
                        {data: 'date', name: 'date'},
                        {data: 'warehouse', name: 'warehouse.name'},
                        {data: 'category', name: 'product.category.name'},
                        {data: 'sub_category', name: 'product.subCategory.name'},
                        {data: 'sub_sub_category', name: 'product.subSubCategory.name'},
                        {data: 'product', name: 'product.name'},
                        {data: 'unit', name: 'product.unit.name'},
                        {data: 'color', name: 'color.name'},
                        {data: 'size', name: 'size.name'},
                        {data: 'type', name: 'type.name'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'cost_unit_price', name: 'cost_unit_price'},
                        {data: 'cost_total', name: 'cost_total',orderable: false},
                        {data: 'selling_unit_price', name: 'selling_unit_price'},
                        {data: 'sale_total', name: 'sale_total',orderable: false},
                        {data: 'action', name: 'action', orderable: false},
                    ],
                "responsive": true, "autoWidth": false,
                "order": [[ 0, 'desc' ]]
                });
        });
    </script>
@endsection
