@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add Product</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">{{ __('Product') }}</li>
                            <li class="breadcrumb-item active">{{ __('Add Product') }}</li>
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
                            <form action="{{route('product.store')}}" method="POST">
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
                                        <label for="">Condition</label>
                                        <select name="conditions" class="form-control show-tick">
                                            <option value="new" {{ old('conditions') == 'new' ? 'selected' : '' }}> New</option>
                                            <option value="popular" {{ old('conditions') == 'popular' ? 'selected' : '' }}> Popular</option>
                                            <option value="winter" {{ old('conditions') == 'winter' ? 'selected' : '' }}> Winter</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Seller</label>
                                        <select name="vendor_id" class="form-control show-tick">
                                            <option value="">Seller</option>
                                            @foreach (\App\Models\User::where('role', 'seller')->get() as $seller)
                                            <option value="{{$seller->id}}" {{ old('seller') == $seller->id ? 'selected' : '' }}>{{$seller->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Summary<span class="text-danger">*</span></label>
                                     {{-- <input type="text" class="form-control" placeholder="some text..." id="summary" name="summary"  value="{{old('summary')}}"/> --}}
                                     <textarea rows="4" columns='19' class="form-control" id="summary" name="summary"
                                     placeholder="Some text...">{{ old('summary') }}</textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Stock<span class="text-danger">*</span></label>
                                     <input type="number" class="form-control" placeholder="" id="stock" name="stock"  value="{{ old('stock') }}"/>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Price<span class="text-danger">*</span></label>
                                     <input type="number" step="any" class="form-control" placeholder="23.28" id="price" name="price"  value="{{ old('price') }}"/>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Discount(%)<span class="text-danger">*</span></label>
                                     <input type="number" min="0" max="100" step="any" class="form-control" placeholder="23.28" id="discount" name="discount"  value="{{ old('discount') }}"/>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Brands</label>
                                        <select name="brand_id" class="form-control show-tick">
                                            <option value="">Select brand</option>
                                            @foreach (\App\Models\Brand::get() as $brand)
                                            <option value="{{$brand->id}} {{ old('brand_id') == $brand->id ? 'selected' : '' }}" >{{$brand->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Category</label>
                                        <select id="category_id" name="category_id" class="form-control show-tick">
                                            <option value="">Select Category</option>
                                            @foreach (\App\Models\Category::where('is_parent', 1)->get() as $category)
                                            <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix ">
                                    <div class="col-lg-6 col-md-12 d-none" id="child_category_div">
                                        <label for="">Child Category</label>
                                        <select id="child_category_id" name="child_category_id" class="form-control show-tick">
                                            <option value="">Select Child Category</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Size</label>
                                        <select name="size" class="form-control show-tick">
                                            <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}> Small</option>
                                            <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}> Medium</option>
                                            <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}> Large</option>
                                            <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}> Extra Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Status<span class="text-danger">*</span></label>
                                        <select  class="form-control show-tick">
                                            <option value="active" >Active</option>
                                            <option value="inactive" > Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group mt-3">
                                            <label for="">Description</label>
                                            <textarea rows="4" columns='19' class="form-control" id="description" name="description"
                                                placeholder="Description">{{ old('description') }}</textarea>
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
            $('#description').summernote();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>

     <script>

        $('#category_id').change(function() {
            const category_id = $(this).val();

        if(category_id != null){
            $.ajax({
                type: "POST",
                url: "{{route('get.child-category', "category_id")}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    category_id: category_id,
                },
                success: function(response) {
                    console.log(response)
                    let html_option = "<option value=''>Select Child Category</option>";

                   if(response.status){

                        $('#child_category_div').removeClass('d-none');

                        $.each(response.data, function(id, title){
                            html_option += "<option value="+id+" > "+title+" </option>"
                     })
                   }else{
                    $('#child_category_div').addClass('d-none');
                   }
                   $('#child_category_id').html(html_option);
                }
            })
        }
        });
        if(child_category_id != null){
            $('#category_id').change();
        }
    </script>
@endsection
