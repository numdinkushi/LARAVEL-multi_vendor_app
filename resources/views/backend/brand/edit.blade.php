@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Edit Brand</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">{{ __('Brand') }}</li>
                            <li class="breadcrumb-item active">{{ __('Edit Brand') }}</li>
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
                            <form action="{{route('brand.update', $brand->id)}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" class="form-control" placeholder="Title" name="title"
                                                value="{{ $brand->title}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Select Photo <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Change
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" value="{{$brand->photo}}" type="text" name="photo">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group mt-3">
                                            <label for="">Description</label>
                                            <textarea rows="4" columns='19' class="form-control" value="{{$brand->description}}" id="description" name="description"
                                                placeholder="Description">{{$brand->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
            $('#description').summernote();
        });
    </script>
@endsection
