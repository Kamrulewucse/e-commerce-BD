@extends('layouts.admin')
@section('title','Add Video/Photo')
@section('style')
    <style>
        img#image_preview {
            width: auto;
            margin-top: 15px;
            height: 400px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Video/Photo Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('video.add') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('title') ? 'has-error' :'' }}">
                            <label for="title" class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="title" placeholder="Enter Title">
                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sub_title') ? 'has-error' :'' }}">
                            <label for="sub_title" class="col-sm-2 col-form-label">Sub Title</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('sub_title') }}" name="sub_title" class="form-control" id="sub_title" placeholder="Enter Sub Title">
                                @error('sub_title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('url_link') ? 'has-error' :'' }}">
                            <label for="url_link" class="col-sm-2 col-form-label">Url Link</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('url_link') }}" name="url_link" class="form-control" id="url_link" placeholder="Enter Url Link">
                                @error('url_link')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label for="sort" class="col-sm-2 col-form-label">Sort <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('sort',$maxSort) }}" name="sort" class="form-control" id="sort" placeholder="Enter Sort">
                                @error('sort')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('video') ? 'has-error' :'' }}">
                            <label for="video" class="col-sm-2 col-form-label">Video/Photo <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input accept=".mp4,.jpg,.png,.jpeg" type="file"  name="video" class="form-control" id="video">
                                @error('video')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                                <video style="display: none;margin-top: 15px;" id="video_preview" playsinline webkit-playsinline muted autoplay loop  width="500px" height="auto">
                                    <source  src="" type="video/mp4">
                                </video>
                                <img style="display: none;" id="image_preview" alt="">
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                    <label for="inactive">
                                        Inactive
                                    </label>
                                </div>

                                @error('status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                        <a href="{{ route('video') }}" class="btn btn-default btn-flat float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
@endsection
@section('script')
    <script>
        $(function (){

            $('#video').change(function(){

                var file = $(this).val().split('.').pop();


                let reader = new FileReader();

                reader.onload = (e) => {
                    if(file == 'mp4'){
                        $('#video_preview').attr('src', e.target.result);
                        $("#image_preview").hide();
                        $("#video_preview").show();
                    }else{
                        $('#image_preview').attr('src', e.target.result);
                        $("#image_preview").show();
                        $("#video_preview").hide();
                    }

                }
                reader.readAsDataURL(this.files[0]);

            });
        })
    </script>
@endsection
