@extends('layouts.admin')
@section('title','Edit BD Drip Question & Answer')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">BD Drip Question & Answer Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="{{ route('nike_and_bd_drip_question.edit',['questionAnswer'=>$questionAnswer->id]) }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="card-body">
{{--                        <div class="form-group row {{ $errors->has('question_answer_type') ? 'has-error' :'' }}">--}}
{{--                            <label for="question_answer_type" class="col-sm-2 col-form-label"> Question & Answer Type <span class="text-danger">*</span></label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                <select name="question_answer_type" id="question_answer_type" class="form-control select2">--}}
{{--                                    <option value="">Select Question Answer Type</option>--}}
{{--                                    @foreach($types as $type)--}}
{{--                                        <option {{ old('question_answer_type',$questionAnswer->question_answer_type_id) == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->title }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('question_answer_type')--}}
{{--                                <span class="help-block">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        --}}
                        <div class="form-group row {{ $errors->has('question') ? 'has-error' :'' }}">
                            <label for="question" class="col-sm-2 col-form-label"> Question <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('question',$questionAnswer->question) }}" name="question" class="form-control" id="question" placeholder="Enter Question">

                                @error('question')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('answer') ? 'has-error' :'' }}">
                            <label for="text-editor" class="col-sm-2 col-form-label">Answer <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea required rows="10" name="answer" class="form-control" id="text-editor"
                                          placeholder="Enter Answer">{{ old('answer',$questionAnswer->answer) }}</textarea>

                                @error('answer')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label for="sort" class="col-sm-2 col-form-label">Sort <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('sort',$questionAnswer->sort) }}" name="sort" class="form-control" id="sort" placeholder="Enter Sort">

                                @error('sort')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-10">

                                <div class="icheck-success d-inline">
                                    <input checked type="radio" id="active" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($questionAnswer->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                    <label for="active">
                                        Active
                                    </label>
                                </div>

                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="inactive" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($questionAnswer->status == '0' ? 'checked' : '')) :
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
                        <a href="{{ route('nike_and_bd_drip_question') }}" class="btn btn-default btn-flat float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
@endsection
