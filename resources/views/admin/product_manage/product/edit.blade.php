@extends('layouts.admin')
@section('title','Edit Product')
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
                    <h3 class="card-title">Product Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" id="product_save" class="form-horizontal" method="post">
                    <div class="card-body">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
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

                        <div class="form-group row {{ $errors->has('unit') ? 'has-error' :'' }}">
                            <label for="unit" class="col-sm-2 col-form-label">Unit <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="unit" name="unit" class="form-control select2">
                                    <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option {{ $product->unit_id == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('product_weight') ? 'has-error' :'' }}">
                            <label for="product_weight" class="col-sm-2 col-form-label">Product Weight <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input required max="255" type="text" name="product_weight" value="{{ $product->product_weight }}" class="form-control" id="product_weight" placeholder="Enter product weight">
                                @error('product_weight')
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
                        <div class="form-group row {{ $errors->has('short_description') ? 'has-error' :'' }}">
                            <label for="short_description" class="col-sm-2 col-form-label">Short Description <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea rows="10" name="short_description" class="form-control" id="short_description">{{ $product->short_description }}</textarea>
                                @error('short_description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="image-uploads-container">
                            @if($product->colors)
                             <?php $getCounter = 0; ?>
                            @foreach($product->colors->sortBy('id') as $key => $colorItem)

                            <div class="image-upload-item">
                                <div class="row">
                                    <label for="brand"  class="col-sm-2 col-form-label">Color & Type <span class="text-danger">*</span>
                                        <button type="button" class="btn btn-danger btn-sm btn-remove">X</button>
                                    </label>
                                    <div class="col-md-10">
                                        <div class="card card-default image-card">
                                            <div class="card-header">
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <input type="hidden" class="color" name="color[]" value="{{ $colorItem->id }}">
                                                      <input type="text" readonly class="form-control" value="{{ getColor($colorItem->id)->name ?? '' }}">
                                                  </div>
                                                  <div class="col-md-6">
                                                      <input type="hidden" class="type" name="type[]" value="{{ $product->types[$key]->id }}">
                                                      <input type="text" readonly class="form-control" value="{{ getTypeName($product->types[$key]->id)->name ?? '' }}">
                                                  </div>
                                              </div>
                                                <div class="mt-2 form-group row">
                                                    <label class="col-sm-12">Video</label>
                                                    <div class="col-sm-12">
                                                        <input type="hidden" name="old_video_id[{{ $colorItem->id.'-'.$product->types[$key]->id }}]" value="{{ colorTypeVideo($product->id,$colorItem->id,$product->types[$key]->id)->id ?? '' }}">
                                                        <input accept=".mp4,.mov" type="file"  name="video[]" class="form-control video">
                                                        <video style="display: {{ colorTypeVideo($product->id,$colorItem->id,$product->types[$key]->id) ? 'block' : 'none' }};margin-top: 15px;" class="video_preview" playsinline webkit-playsinline muted autoplay loop  width="500px" height="auto">
                                                            <source  src="{{ asset(colorTypeVideo($product->id,$colorItem->id,$product->types[$key]->id)->video_path ?? '') }}">
                                                        </video>
                                                    </div>
                                                </div>
                                                <div class="mt-2 form-group row {{ $errors->has('features') ? 'has-error' :'' }}">
                                                    <label for="features" class="col-sm-12">Product Color & Type Details</label>
                                                    <div class="col-sm-12">
                                                <textarea rows="4" name="features[]" class="form-control features"
                                                         placeholder="Enter Product Color & Type Details">{{ json_decode($product->features, true)[$colorItem->id.'-'.$product->types[$key]->id] ?? '' }}</textarea>
                                                     @error('features')
                                                    <span class="help-block">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body image-inner-container">
                                                @if(colorTypeImages($product->id,$colorItem->id,$product->types[$key]->id))
                                                    <?php $subCounter = 0 ?>
                                                    @foreach(colorTypeImages($product->id,$colorItem->id,$product->types[$key]->id) as $image)

                                                        <div class="image-inner-list">
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="old_image_id[{{ $image->color_id.'-'.$image->type_id }}][]" value="{{ $image->id }}">
                                                                <input accept="image/*" type="file" name="images[{{ $image->color_id.'-'.$image->type_id }}][]" {{ $image->thumbs ? '' : 'required' }}>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <img height="80px" width="100px" class="product-image-thumb" src="{{ asset($image->thumbs) }}" alt="">
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                <button type="button" class="btn btn-danger btn-sm inner-btn-remove">X</button>
                                                            </div>
                                                        </div>
                                                       </div>
                                                            <?php $subCounter++ ?>
                                                    @endforeach
                                                @else
                                                    <div class="image-inner-list">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input accept="image/*" type="file" name="images[][]" required>
                                                            </div>
                                                            <div class="col-md-2 text-center"><button type="button" class="btn btn-danger btn-sm inner-btn-remove">X</button></div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-primary btn-sm add-inner-image"><i class="fa fa-plus-square"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <?php $getCounter++ ?>
                            @endforeach
                            @else
                                <div class="image-upload-item">
                                    <div class="row">
                                        <label for="brand"  class="col-sm-2 col-form-label">Color & Type <span class="text-danger">*</span>
                                            <button type="button" class="btn btn-danger btn-sm btn-remove">X</button>
                                        </label>
                                        <div class="col-md-10">
                                            <div class="card card-default image-card">
                                                <div class="card-header">
                                                   <div class="row">
                                                       <div class="col-md-6">
                                                           <select name="color[]" class="form-control select2 color" required>
                                                               <option value="">Select Color</option>
                                                               @foreach($colors as $color)
                                                                   <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                               @endforeach
                                                           </select>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <select name="type[]" class="form-control select2 type" required>
                                                               <option value="">Select Type</option>
                                                               @foreach($types as $type)
                                                                   <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                               @endforeach
                                                           </select>
                                                       </div>
                                                   </div>
                                                    <div class="mt-2 form-group row">
                                                        <label class="col-sm-12">Video</label>
                                                        <div class="col-sm-12">
                                                            <input accept=".mp4,.mov" type="file"  name="video[]" class="form-control video">
                                                            <video style="display: none;margin-top: 15px;" class="video_preview" playsinline webkit-playsinline muted autoplay loop  width="500px" height="auto">
                                                                <source  src="" type="video/mp4">
                                                                <source  src="" type="video/mov">
                                                            </video>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 form-group row {{ $errors->has('features') ? 'has-error' :'' }}">
                                                        <label for="features" class="col-sm-12">Product Color & Type Details</label>
                                                        <div class="col-sm-12">
                                                            <textarea rows="4" name="features[]" class="form-control features"
                                                            placeholder="Enter Product Color & Type Details"></textarea>

                                                            @error('features')
                                                            <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                </div>
                                                <div class="card-body image-inner-container">
                                                    <div class="image-inner-list">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input accept="image/*" type="file" name="images[][]" required>
                                                            </div>
                                                            <div class="col-md-2 text-center"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="button" class="btn btn-primary btn-sm add-inner-image"><i class="fa fa-plus-square"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="btn-add-color" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i></button>
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
                    <div class="card card-default image-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="color[]" class="form-control select2 color" required>
                                        <option value="">Select Color</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="type[]" class="form-control select2 type" required>
                                        <option value="">Select Type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2 form-group row">
                                <label class="col-sm-12">Video</label>
                                <div class="col-sm-12">
                                    <input accept=".mp4" type="file"  name="video[]" class="form-control video">
                                    <video style="display: none;margin-top: 15px;" class="video_preview" playsinline webkit-playsinline muted autoplay loop  width="500px" height="auto">
                                        <source  src="" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <div class="mt-2 form-group row {{ $errors->has('features') ? 'has-error' :'' }}">
                                <label for="features" class="col-sm-12">Product Color & Type Details</label>
                                <div class="col-sm-12">
                                       <textarea rows="4" name="features[]" class="form-control features"
                                                 placeholder="Enter Product Color & Type Details"></textarea>

                                    @error('features')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-body image-inner-container">
                            <div class="image-inner-list">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input accept="image/*" type="file" name="images[][]" required>
                                    </div>
                                    <div class="col-md-2 text-center"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-sm add-inner-image"><i class="fa fa-plus-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <template id="image-template">
        <div class="image-inner-list">
            <div class="row">
                <div class="col-md-10">
                    <input accept="image/*" type="file" name="images[][]" required>
                </div>
                <div class="col-md-2 text-center"><button type="button" class="btn btn-danger btn-sm inner-btn-remove">X</button></div>
            </div>
        </div>
    </template>
@endsection
@section('script')

    <script>

        $(function () {

            //$('#features').summernote();
            $('#short_description').summernote();

            $(document).on("change", ".video", function(evt) {
                var $source = $(this).closest('div').find('.video_preview');
                $source[0].src = URL.createObjectURL(this.files[0]);
                $(this).closest('div').find('.video_preview').show();
                //$source.parent()[0].load();

            });

            $('form').submit(function () {
                $("#ajax-loading").show();
                $('body').css('overflow','hidden');

                $('.image-upload-item').each(function(index, obj) {
                    var colorId = $('.image-upload-item:eq('+index+')').closest('div').find(".color").val();
                    var typeId = $('.image-upload-item:eq('+index+')').closest('div').find(".type").val();
                    var testHtml = $('.image-upload-item:eq('+index+')').find('.image-inner-list');

                    //testHtml.closest('div').find('input:text').attr('name','old_image_id['+colorId+'-'+typeId+'][]')
                    //testHtml.closest('div').find('input:text').attr('name','old_video_id['+colorId+'-'+typeId+']')
                    testHtml.closest('div').find('input:file').attr('name','images['+colorId+'-'+typeId+'][]')
                    var colorDetails = $('.image-upload-item:eq('+index+')').closest('div').find(".features");
                    var colorTypeVideoDetails = $('.image-upload-item:eq('+index+')').closest('div').find(".video");
                    colorDetails.closest('div').find('textarea').attr('name','features['+colorId+'-'+typeId+']');
                    colorTypeVideoDetails.closest('div').find('.video').attr('name','video['+colorId+'-'+typeId+']');

                });

                var productSave = new FormData($('#product_save')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.update') }}",
                    data: productSave,
                    processData: false,
                    contentType: false,
                }).done(function (response) {
                    if (response.success) {
                        $("#ajax-loading").hide();
                        $('body').css('overflow','auto');
                        location.href = '{{ route('product') }}';
                    }else{
                        $("#ajax-loading").show();
                        $('body').css('overflow','hidden');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                });

                return false;
            });

            $('body').on('click', '.add-inner-image', function() {


                var html2 = $('#image-template').html();
                var item2 = $(html2);

                $(this).closest('.image-upload-item').find('.image-inner-container').append(item2);

                var innerClosest = $(this).closest('.image-upload-item').find('.image-inner-container');

            });
            $('body').on('click', '.inner-btn-remove', function () {
                $(this).closest('.image-inner-list').remove();

            });


            $('#btn-add-color').click(function () {
                var html = $('#color-template').html();
                var item = $(html);

                $('#image-uploads-container').append(item);

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
                        url: "{{ route('admin.get_sub_sub_category') }}",
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
        function initProduct() {
            $('.select2').select2();
        }
    </script>
@endsection
