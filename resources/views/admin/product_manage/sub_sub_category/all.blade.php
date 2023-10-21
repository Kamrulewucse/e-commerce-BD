@extends('layouts.admin')
@section('title','Sub Sub Categories')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('sub_sub_category.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Sub Sub Category</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Topic</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subSubCategories as $subSubCategory)
                        <tr>
                            <td>{{ $subSubCategory->sort }}</td>
                            <td>{{ $subSubCategory->category->name }}</td>
                            <td>{{ $subSubCategory->subCategory->name }}</td>
                            <td>{{ $subSubCategory->by_style == 1 ? 'BY STYLE'  : '' }}</td>
                            <td>{{ $subSubCategory->name }}</td>
                            <td><img height="100px" src="{{ asset($subSubCategory->thumbs) }}" alt=""></td>
                            <td>
                                @if($subSubCategory->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sub_sub_category.edit',['subSubCategory'=>$subSubCategory->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>S/L</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Topic</th>
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
