@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Edit Shipping</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">{{ __('Shipping') }}</li>
                            <li class="breadcrumb-item active">{{ __('Edit Shipping') }}</li>
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
                            <form action="{{route('shipping.update', $shipping->id)}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Shipping Address <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" placeholder="Shipping Address" name="shipping_address" value="{{ $shipping->shipping_address }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Delivery Time <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Delivery Time" name="delivery_time" value="{{ $shipping->delivery_time }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Delivery Charge</label>
                                            <input type="number" step="any" class="form-control" placeholder="Delivery Charge" name="delivery_charge" value="{{ $shipping->delivery_charge }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Status<span class="text-danger">*</span></label>
                                        <select  class="form-control show-tick">
                                            <option value="active" {{ $shipping->status == 'active' ? 'selected' : '' }}> Active</option>
                                            <option value="inactive" {{ $shipping->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
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
