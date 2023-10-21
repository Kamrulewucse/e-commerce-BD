@extends('layouts.admin')
@section('title','Videos/Photo')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('video.add') }}" class="btn btn-primary btn-flat bg-gradient-primary">Add Video/Photo</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Video/Photo</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Url Link</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td>{{ $video->sort }}</td>
                            <td><a role="button" data-video_url="{{ asset($video->video_url) }}" data-id="{{ $video->id }}" class="video-show"> <i class="fa fa-eye"></i></a></td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->sub_title }}</td>
                            <td>
                                @if($video->url_link)
                                    <a href="{{ $video->url_link }}">Url Link</a>
                                @endif
                            </td>
                            <td>
                                @if($video->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('video.edit',['video'=>$video->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a role="button" data-id="{{ $video->id }}" class="btn btn-outline-danger btn-sm btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Video</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Url Link</th>
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
<div class="modal fade" id="modal-video-preview">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">Video/Photo Preview</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <video id="video_preview" style="display: none;" playsinline webkit-playsinline muted autoplay loop  width="100%" height="auto">
                    <source type="video/mp4">
                </video>
                <img style="display: none;width: 100%;" id="image_preview" alt="">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('script')
    <script>
        $(function () {
            $("#table").DataTable({
                "responsive": true, "autoWidth": false,
            });

            $('body').on('click','.video-show', function () {

                var videoUrl = $(this).data('video_url');

                var file = videoUrl.split('.').pop();

                if(file == 'mp4'){
                    $('#video_preview').attr('src',videoUrl);
                    $('#video_preview').show();
                    $('#image_preview').hide();
                }else{
                    $('#image_preview').attr('src',videoUrl);
                    $('#video_preview').hide();
                    $('#image_preview').show();
                }

                $("#modal-video-preview").modal('show');

            });

            $('body').on('click','.btn-delete', function () {

                var videoId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "Post",
                            url: "{{ route('video.delete') }}",
                            data: { videoId: videoId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        });

                    }
                })

            });

        });
    </script>
@endsection
