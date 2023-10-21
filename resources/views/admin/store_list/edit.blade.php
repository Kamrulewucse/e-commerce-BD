@extends('layouts.admin')
@section('title','Edit FAQ Store List')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Store List Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="{{ route('store_list.edit',['storeList'=>$storeList->id]) }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 col-form-label"> Store Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('name',$storeList->name) }}" name="name" class="form-control" id="name" placeholder="Enter Store Name">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('latitude') ? 'has-error' :'' }}">
                            <label for="latitude" class="col-sm-2 col-form-label"> Latitude <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('latitude',$storeList->latitude) }}" name="latitude" class="form-control" id="latitude" placeholder="Enter Latitude">
                                @error('latitude')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('longitude') ? 'has-error' :'' }}">
                            <label for="longitude" class="col-sm-2 col-form-label"> Longitude <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('longitude',$storeList->longitude) }}" name="longitude" class="form-control" id="longitude" placeholder="Enter Longitude">
                                @error('longitude')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('address') ? 'has-error' :'' }}">
                            <label for="address" class="col-sm-2 col-form-label">Address <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea  rows="10" name="address" class="form-control" id="address"
                                           placeholder="Enter Address">{{ old('address',$storeList->address) }}</textarea>

                                @error('address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('contact_number') ? 'has-error' :'' }}">
                            <label for="contact_number" class="col-sm-2 col-form-label">Contact Numbers <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea  rows="10" name="contact_number" class="form-control" id="contact_number"
                                           placeholder="Enter Contact Number">{{ old('contact_number',$storeList->contact_number) }}</textarea>

                                @error('contact_number')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('service_detail') ? 'has-error' :'' }}">
                            <label for="service_detail" class="col-sm-2 col-form-label">Service Details <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea  rows="10" name="service_detail" class="form-control" id="contact_number">
                                    {{ old('service_detail',$storeList->service_detail) }}</textarea>

                                @error('service_detail')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('opening_hours') ? 'has-error' :'' }}">
                            <label for="opening_hours" class="col-sm-2 col-form-label">Opening Hours <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea  rows="10" name="opening_hours" class="form-control" id="opening_hours">
                                    {{ old('opening_hours',$storeList->opening_hours) }}</textarea>

                                @error('opening_hours')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('closing_days') ? 'has-error' :'' }}">
                            <label for="closing_days" class="col-sm-2 col-form-label">Closing Days <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea  rows="10" name="closing_days" class="form-control" id="closing_days">
                                    {{ old('closing_days',$storeList->closing_days) }}</textarea>

                                @error('closing_days')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label for="sort" class="col-sm-2 col-form-label">Sort <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('sort',$storeList->sort) }}" name="sort" class="form-control" id="sort" placeholder="Enter Sort">

                                @error('sort')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($storeList->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($storeList->status == '0' ? 'checked' : '')) :
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
                        <a href="{{ route('store_list') }}" class="btn btn-default btn-flat float-right">Cancel</a>
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
            $('#address,#contact_number,#service_detail,#opening_hours,#closing_days').summernote();
        })
    </script>
@endsection
