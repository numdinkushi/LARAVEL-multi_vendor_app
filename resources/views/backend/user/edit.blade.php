@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Edit User</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">{{ __('User') }}</li>
                            <li class="breadcrumb-item active">{{ __('Edit User') }}</li>
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
                            <form action="{{route('user.update', $user->id)}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="{{ $user->full_name}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" class="form-control" placeholder="User Name" name="username" value="{{ $user->username }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" placeholder="abc@gmail.com" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="number" class="form-control" placeholder="number" name="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Editress</label>
                                            <input type="text" class="form-control" placeholder="address" name="address" value="{{ $user->address }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control show-tick">
                                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }} >Active</option>
                                            <option value="active" {{ $user->status == 'inactive' ? 'selected' : '' }} >Inctive</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-control show-tick">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}> Vendor</option>
                                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
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
                                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Update</button>
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
