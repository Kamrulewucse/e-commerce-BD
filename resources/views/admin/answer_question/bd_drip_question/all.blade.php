@extends('layouts.admin')
@section('title','BD Drip Question & Answer')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('nike_and_bd_drip_question.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Question & Answer</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->sort }}</td>
                            <td>{{ $question->question }}</td>
                            <td>{!! $question->answer !!}</td>
                            <td>
                                @if($question->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('nike_and_bd_drip_question.edit',['questionAnswer'=>$question->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>S/L</th>
                        <th>Question</th>
                        <th>Answer</th>
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
