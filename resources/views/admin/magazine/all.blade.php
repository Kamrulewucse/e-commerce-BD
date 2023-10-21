@extends('layouts.admin')
@section('title','Magazines')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('magazine.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Magazine</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($magazines as $magazine)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $magazine->category->name ?? '' }}</td>
                            <td>{{ $magazine->title }}</td>
                            <td>{{ $magazine->sub_title }}</td>
                            <td><img height="100px" src="{{ asset($magazine->image) }}" alt=""></td>
                            <td>
                                @if($magazine->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('magazine.edit',['magazine'=>$magazine->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>S/L</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Sub Title</th>
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
