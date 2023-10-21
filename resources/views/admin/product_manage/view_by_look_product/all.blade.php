@extends('layouts.admin')
@section('title','View By Look Products')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('view_by_look_product.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add View By Look Product</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Sub Sub Category</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->subCategory->name }}</td>
                                <td>{{ $product->subSubCategory->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img height="100px" src="{{ asset($product->view_thumb) }}" alt="">
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('view_by_look_product.edit',['product'=>$product->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Sub Sub Category</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
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
            $("#table").DataTable({
                "responsive": true, "autoWidth": false,
            });
        });
    </script>
@endsection
