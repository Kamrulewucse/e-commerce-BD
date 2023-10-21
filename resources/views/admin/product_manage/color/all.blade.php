@extends('layouts.admin')
@section('title','Colors')
@section('style')
    <style>
        .color-plate {
            width: 118px;
            height: 46px;
            border: 1px solid #ddd;
            display: block;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('color.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Color</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Color 2</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($colors as $color)
                        <tr>
                            <td>{{ $color->sort }}</td>
                            <td>
                                @if($color->color_type == 1)
                                    <span class="badge badge-success">single</span>
                                @else
                                    <span class="badge badge-yellow">single</span>
                                @endif
                            </td>
                            <td>{{ $color->name }}</td>
                            <td>
                                <span class="color-plate" style="background: {{ $color->code }}"></span>
                            </td>
                            <td>
                                @if($color->color_type == 2)
                                <span class="color-plate" style="background: {{ $color->code2 }}"></span>
                                @endif
                            </td>
                            <td>
                                @if($color->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('color.edit',['color'=>$color->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>S/L</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Color 2</th>
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
