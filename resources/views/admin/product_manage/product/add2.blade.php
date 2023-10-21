@extends('layouts.admin')
@section('title','Add Product')
@section('style')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link type="text/css" rel="stylesheet" href="{{ asset('themes/backend/file_uploader_plugins/image-uploader.css') }}">
@endsection
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form enctype="multipart/form-data" action="{{ route('product.add') }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('category') ? 'has-error' :'' }}">
                            <label for="category" class="col-sm-2 col-form-label">Category <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="category" name="category" class="form-control select2">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option
                                            {{ old('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sub_category') ? 'has-error' :'' }}">
                            <label for="sub_category" class="col-sm-2 col-form-label">Sub Category <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="sub_category" name="sub_category" class="form-control select2">
                                    <option value="">Select Sub Category</option>
                                </select>
                                @error('sub_category')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sub_sub_category') ? 'has-error' :'' }}">
                            <label for="sub_sub_category" class="col-sm-2 col-form-label">Sub Sub Category <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="sub_sub_category" name="sub_sub_category" class="form-control select2">
                                    <option value="">Select Sub Sub Category</option>
                                </select>
                                @error('sub_sub_category')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 col-form-label">Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"
                                       placeholder="Enter Name">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('brand') ? 'has-error' :'' }}">
                            <label for="brand" class="col-sm-2 col-form-label">Brand <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="brand" name="brand" class="form-control select2">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option
                                            {{ old('brand') == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('unit') ? 'has-error' :'' }}">
                            <label for="unit" class="col-sm-2 col-form-label">Unit <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="unit" name="unit" class="form-control select2">
                                    <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option
                                            {{ old('unit') == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div id="image-uploads-container">
                            <div class="image-upload-item">
                                <div class="row">
                                    <label for="brand"  class="col-sm-2 col-form-label">Color <span class="text-danger">*</span>
                                        <button type="button" class="btn btn-danger btn-sm btn-remove">X</button>
                                    </label>
                                    <div class="col-md-10">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <select name="color[]" class="form-control select2">
                                                    <option value="">Select Color</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="card-body">
                                                <div class="input-field">
                                                    <label class="active">Select or Drag and Drop Images</label>
                                                    <div class="input-images-0" style="padding-top: .5rem;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="btn-add-color" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i></button>
                        </div>

                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status"
                                           value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status"
                                           value="0" {{ old('status') == '0' ? 'checked' : '' }}>
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
                        <a href="{{ route('product') }}" class="btn btn-default btn-flat float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <template id="color-template">
        <div class="image-upload-item">
            <div class="row">
                <label for="brand"  class="col-sm-2 col-form-label">Color <span class="text-danger">*</span>
                    <button type="button" class="btn btn-danger btn-sm btn-remove">X</button>
                </label>
                <div class="col-md-10">
                    <div class="card card-default">
                        <div class="card-header">
                            <select name="color[]" class="form-control select2">
                                <option value="">Select Color</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="input-field">
                                <label class="active">Select or Drag and Drop Images</label>
                                <div class="image-upload-change" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
@endsection
@section('script')
    <script src="{{ asset('themes/backend/file_uploader_plugins/image-uploader.js') }}"></script>
    <script>


        $('.input-images-0').imageUploader({
            imagesInputName: 'images[0][]',
        });



        $(function () {


            $('#btn-add-color').click(function () {
                var html = $('#color-template').html();
                var item = $(html);

                $('#image-uploads-container').append(item);

                var classNumber = $('#image-uploads-container').children().length;

                var lastItem = $('.image-upload-item').last();

                lastItem.closest('.image-upload-item').find('.image-upload-change').addClass('input-images-'+classNumber);

                $('.input-images-'+classNumber).imageUploader({
                    imagesInputName: 'images['+parseFloat(classNumber - 1)+'][]',
                });
                initProduct();

                if ($('.image-upload-item').length >= 1 ) {
                    $('.btn-remove').show();
                }
            });

            $('body').on('click', '.btn-remove', function () {
                $(this).closest('.image-upload-item').remove();

                if ($('.image-upload-item').length <= 1 ) {
                    $('.btn-remove').hide();
                }
            });

            if ($('.image-upload-item').length <= 1 ) {
                $('.btn-remove').hide();
            } else {
                $('.btn-remove').show();
            }

            var subCategorySelected = '{{ old('sub_category') }}';
            var subSubCategorySelected = '{{ old('sub_sub_category') }}';

            $('#category').change(function () {
                var categoryId = $(this).val();

                $('#sub_category').html('<option value="">Select Sub Category</option>');

                if (categoryId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('admin.get_sub_category') }}",
                        data: {categoryId: categoryId}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            if (subCategorySelected == item.id)
                                $('#sub_category').append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                            else
                                $('#sub_category').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                        $('#sub_category').trigger('change');
                    });
                }
            });
            $('#sub_category').change(function () {
                var subCategoryId = $(this).val();

                $('#sub_sub_category').html('<option value="">Select Sub Sub Category</option>');

                if (subCategoryId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('admin.get_sub_sub_category') }}",
                        data: {subCategoryId: subCategoryId}
                    }).done(function (data) {
                        $.each(data, function (index, item) {
                            if (subSubCategorySelected == item.id)
                                $('#sub_sub_category').append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                            else
                                $('#sub_sub_category').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    });
                }
            });

            $('#category').trigger('change');
            $('#sub_category').trigger('change');
        });
        function initProduct() {
            $('.select2').select2();
        }
    </script>
@endsection
