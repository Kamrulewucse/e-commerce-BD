@extends('layouts.admin')
@section('title','Edit VIew By Look Product')
@section('style')
    <style>
        .image-inner-list {
            margin: 25px 0;
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
                    <h3 class="card-title">View By Look Product Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="{{ route('view_by_look_product.edit',['product'=>$product->id]) }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('category') ? 'has-error' :'' }}">
                            <label for="category" class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="category" name="category" class="form-control select2">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sub_category') ? 'has-error' :'' }}">
                            <label for="sub_category" class="col-sm-2 col-form-label">Sub Category <span class="text-danger">*</span></label>
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
                            <label for="sub_sub_category" class="col-sm-2 col-form-label">Sub Sub Category <span class="text-danger">*</span></label>
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
                            <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $product->name }}" name="name" class="form-control" id="name" placeholder="Enter Name">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('features') ? 'has-error' :'' }}">
                            <label for="features" class="col-sm-2 col-form-label">Detailed Features <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea  rows="10" name="features" class="form-control" id="features"
                                          placeholder="Enter Features">{{ $product->features }}</textarea>

                                @error('features')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('collection') ? 'has-error' :'' }}">
                            <label for="collection" class="col-sm-2 col-form-label">Collection</label>
                            <div class="col-sm-10">
                                <select multiple data-placeholder="Select Collections" id="collection" name="collection[]" class="form-control select2">
                                    @foreach($collections as $collection)
                                        <option {{ empty(old('collection')) ? ($errors->has('collection') ? '' : (in_array($collection->id, $product->collections()->pluck('id')->toArray()) ? 'selected' : '')) :
                                            (in_array($collection->id, old('collection')) ? 'selected' : '') }} value="{{ $collection->id }}">{{ $collection->name }}</option>
                                    @endforeach
                                </select>
                                @error('collection')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('include_products') ? 'has-error' :'' }}">
                            <label for="include_products" class="col-sm-2 col-form-label">Include Products</label>
                            <div class="col-sm-10">
                                <select data-placeholder="Select Include Products" name="include_products[]" multiple id="include_products" class="form-control select2">
                                    @foreach($products as $productItem)
                                        <option {{in_array($productItem->product_id.'-'.$productItem->color_id.'-'.$productItem->type_id, old("include_products",json_decode($product->include_products)) ?: []) ? "selected": ""}} value="{{ $productItem->product_id.'-'.$productItem->color_id.'-'.$productItem->type_id }}">{{ $productItem->product->name ?? '' }}-{{ $productItem->color->name ?? '' }}{{ $productItem->type->id != 1 ? (' - '.$productItem->type->name) : '' }}</option>
                                    @endforeach
                                </select>
                                @error('include_products')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('image') ? 'has-error' :'' }}">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input  type="file" name="image" class="form-control" id="image">
                                @if($product->view_image)
                                    <img height="200px" src="{{ asset($product->view_image) }}" alt="">
                                @endif
                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('video') ? 'has-error' :'' }}">
                            <label for="video" class="col-sm-2 col-form-label">Video</label>
                            <div class="col-sm-10">
                                <input accept="application/mp4" type="file"  name="video" class="form-control" id="video">
                                @error('video')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                                <video style="margin-top: 15px; {{ $fileExtension == 'mp4' ? 'display:block': 'display:none' }} " id="video_preview" playsinline webkit-playsinline muted autoplay loop  width="500px" height="auto">
                                    <source  src="{{ asset($product->video_url) }}" type="video/mp4">
                                </video>

                                <img style="{{ $fileExtension != 'mp4' ? 'display:block': 'display:none' }}"  src="{{ asset($product->video_url) }}" id="image_preview" alt="">

                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($product->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($product->status == '0' ? 'checked' : '')) :
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
                        <a href="{{ route('view_by_look_product') }}" class="btn btn-default btn-flat float-right">Cancel</a>
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

        $(function () {

            $('#features').summernote();




            var subCategorySelected = '{{ $product->sub_category_id }}';
            var subSubCategorySelected = '{{ $product->sub_sub_category_id }}';

            $('#category').change(function () {
                var categoryId = $(this).val();

                $('#sub_category').html('<option value="">Select Sub Category</option>');

                if (categoryId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('admin.get_sub_category') }}",
                        data: { categoryId: categoryId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (subCategorySelected == item.id)
                                $('#sub_category').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#sub_category').append('<option value="'+item.id+'">'+item.name+'</option>');
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
                        url: "{{ route('admin.get_view_by_look_sub_sub_category') }}",
                        data: { subCategoryId: subCategoryId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (subSubCategorySelected == item.id)
                                $('#sub_sub_category').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#sub_sub_category').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#category').trigger('change');
            $('#sub_category').trigger('change');
        });
    </script>
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
