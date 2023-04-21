@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add Category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">{{ __('Category') }}</li>
                            <li class="breadcrumb-item active">{{ __('Add Category') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <ul>
                                <li>{{$error}}</li>
                            </ul>
                        @endforeach
                    @endif
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('category.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" class="form-control" placeholder="Title" name="title"
                                                value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Select File</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text" name="photo">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Status<span class="text-danger">*</span></label>
                                        <select name="status"  class="form-control show-tick">
                                            <option value="active" >Active</option>
                                            <option value="inactive" > Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mt-3">
                                            <label for="">Is Parent:  <i  class="text-danger">*</i></label>
                                            <input id="is_parent" type="checkbox" name="is_parent" value="1" checked> Yes
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 d-none" id="parent_category_div">
                                        <label for="">Parent Category<span class="text-danger">*</span></label>
                                        <select name="parent_id" class="form-control show-tick">
                                            @foreach ($parent_cats as $parent_category)
                                            {{-- {{dd($parent_category)}} --}}
                                             <option value="{{$parent_category->id}}" >{{$parent_category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group mt-3">
                                            <label for="">Summary</label>
                                            <textarea rows="4" columns='19' class="form-control" id="summary" name="summary"
                                                placeholder="Summary">{{ old('summary') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/assets/summernote-0.8.18-dist/summernote.js') }}"></script>

    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>
    
    <script>
        $('#is_parent').change(function(e) {
           e.preventDefault();
           const isChecked = $('#is_parent').prop('checked');
        if(isChecked){
            $('#parent_category_div').addClass('d-none');
        } else{
            $('#parent_category_div').removeClass('d-none');
            $('#parent_category_div').val('');
        }
        });
    </script>
@endsection
