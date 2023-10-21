@extends('layouts.admin')
@section('title','Delivery Option')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('delivery_option.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Delivery Option</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Delivery Fee</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deliveryOptions as $deliveryOption)
                        <tr>
                            <td>{{ $deliveryOption->sort }}</td>
                            <td>{{ $deliveryOption->name }}</td>
                            <td>{{ $deliveryOption->delivery_duration }}</td>
                            <td>{{ $deliveryOption->delivery_fee }}</td>
                            <td>
                                @if($deliveryOption->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('delivery_option.edit',['deliveryOption'=>$deliveryOption->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>S/L</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Delivery Fee</th>
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
