@extends('layouts.admin')
@section('title','Store List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('store_list.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Store</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/L</th>
                            <th>Store Name</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($storeLists as $storeList)
                            <tr>
                                <td>{{ $storeList->sort }}</td>
                                <td>{{ $storeList->name }}</td>
                                <td>{!! $storeList->address !!}</td>
                                <td>
                                    @if($storeList->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('store_list.edit',['storeList'=>$storeList->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/L</th>
                                <th>Store Name</th>
                                <th>Address</th>
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
