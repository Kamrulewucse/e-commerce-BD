@extends('layouts.admin')
@section('title','Edit Color')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Color Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="{{ route('color.edit',['color'=>$color->id]) }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $color->name }}" name="name" class="form-control" id="name" placeholder="Enter Name">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('color_type') ? 'has-error' :'' }}">
                            <label for="color_type" class="col-sm-2 col-form-label">Color Type <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="color_type" id="color_type" class="form-control">
                                    <option value="">Select Color Type</option>
                                    <option value="1" {{ old('color_type',$color->color_type) == 1 ? 'selected' : '' }}>Single</option>
                                    <option value="2" {{ old('color_type',$color->color_type) == 2 ? 'selected' : '' }}>Double</option>
                                </select>
                                @error('color_type')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('color_code') ? 'has-error' :'' }}">
                            <label for="color_code" class="col-sm-2 col-form-label">Color Code <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group my-colorpicker2">

                                    <input type="text" value="{{ $color->code }}" name="color_code" class="form-control my-colorpicker2" id="color_code">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                                @error('color_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div style="display: none" id="color_code_area_2" class="form-group row {{ $errors->has('color_code_2') ? 'has-error' :'' }}">
                            <label for="color_code_2" class="col-sm-2 col-form-label">Color Code 2 <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group my-colorpicker3">
                                    <input type="text" autocomplete="off" value="{{ old('color_code_2',$color->code2) }}" name="color_code_2" class="form-control my-colorpicker3" id="color_code_2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                                @error('color_code_2')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label for="sort" class="col-sm-2 col-form-label">Sort <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('sort',$color->sort) }}" name="sort" class="form-control" id="sort" placeholder="Enter Sort">

                                @error('sort')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($color->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($color->status == '0' ? 'checked' : '')) :
                                            (old('status') == '0' ? 'checked' : '') }}>
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
                        <a href="{{ route('color') }}" class="btn btn-default btn-flat float-right">Cancel</a>
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
            $("#color_type").change(function (){
                let colorType = $(this).val();
                if(colorType !== ''){
                    if(colorType == 1){
                        $("#color_code_area_2").hide()
                    }else{
                        $("#color_code_area_2").show();
                    }
                }
            })
            $("#color_type").trigger("change");
        })
    </script>
@endsection
