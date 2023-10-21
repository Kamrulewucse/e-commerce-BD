@extends('layouts.admin')
@section('title','Edit Magazine')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Magazine Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="{{ route('magazine.edit',['magazine'=>$magazine->id]) }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('category') ? 'has-error' :'' }}">
                            <label for="category" class="col-sm-2 col-form-label"> Category <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control select2" id="category">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category',$magazine->magazine_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('title') ? 'has-error' :'' }}">
                            <label for="title" class="col-sm-2 col-form-label"> Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('title',$magazine->title) }}" name="title" class="form-control" id="title" placeholder="Enter Title">
                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sub_title') ? 'has-error' :'' }}">
                            <label for="sub_title" class="col-sm-2 col-form-label"> Sub Title</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('sub_title',$magazine->sub_title) }}" name="sub_title" class="form-control" id="sub_title" placeholder="Enter Sub Title">
                                @error('sub_title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label for="description" class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea rows="3"  name="description" class="form-control" id="description" placeholder="Enter Description">{{ old('description',$magazine->description) }}</textarea>
                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('image') ? 'has-error' :'' }}">
                            <label for="image" class="col-sm-2 col-form-label"> Image</label>
                            <div class="col-sm-10">
                                <input type="file"  name="image" class="form-control" id="image">
                                <p class="text-danger">Image Size:1080px X 1080px</p>
                                <img height="100px" src="{{ asset($magazine->image) }}" alt="">
                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('home_featured') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Home Featured</label>

                            <div class="col-sm-10">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" value="1" name="home_featured" {{ old('home_featured',$magazine->home_featured) == 1 ? 'checked' : '' }} id="home_featured">
                                    <label for="home_featured">
                                    </label>
                                </div>
                                @error('home_featured')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('category_featured') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Category Featured</label>

                            <div class="col-sm-10">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" value="1" name="category_featured" {{ old('category_featured',$magazine->category_featured) == 1 ? 'checked' : '' }} id="category_featured">
                                    <label for="category_featured">
                                    </label>
                                </div>
                                @error('category_featured')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($magazine->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($magazine->status == '0' ? 'checked' : '')) :
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
                        <a href="{{ route('magazine') }}" class="btn btn-default btn-flat float-right">Cancel</a>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#description').summernote({
                height: 350,
            });
        });

    </script>
@endsection
