@extends('backend.layouts.master')

@section('content')
     <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-8 col-sm-12 d-flex justify-content-between">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Product</h2>
                        <ul class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Library</li>
                        </ul>
                        <a href="{{route('product.create')}}" class="btn btn-outline-secondary"><i class="icon-plus mr-2"></i>Create Product</a>
                        <p class="float-right">Total Products: {{\App\Models\Product::count()}}</p>
                    </div>            
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Product</strong> List</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>size</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-uppercase">{{ $product->title }}</td>
                                                <td class="d-flex justify-content-center"> <img src="{{ $product->photo }}" alt="" height="50" width="50"> </td>
                                                <td>${{number_format($product->price, 2)}}</td>
                                                <td>{{number_format($product->discount, 2)}}%</td>
                                                <td>{{$product->size}}</td>
                                                <td>
                                                    @if ($product->conditions == 'new')
                                                        <span class="badge badge-success"> {{ $product->conditions }}</span>
                                                    @elseif($product->conditions == 'popular')
                                                    <span class="badge badge-warning"> {{ $product->conditions }}</span>
                                                    @else
                                                        <span class="badge badge-primary"> {{ $product->conditions }}</span>
                                                    @endif
                                                </td>
                                                <td> <input type="checkbox" name="toggle" value="{{$product->id}}" data-toggle="switchbutton" {{$product->status == 'active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-onstyle="success" data-size="sm" data-offstyle="danger"> </td>
                                                <td >
                                                    <div class="d-flex justify-content-around gap-2 space-md-2">   
                                                        <a  href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#productId{{$product->id}}" data-toggle="tool-tip" title='show' data-placement="bottom" class="btn btn-sm btn-outline-secondary" ><span class="fa fa-eye"></span></a>
                                                        <a href="{{route('product.edit', $product->id)}}" data-toggle="tool-tip" title='edit' data-placement="bottom" class="btn btn-sm btn-outline-warning" ><span class="fa fa-edit"></span></a>
                                                        <form action="{{route('product.destroy', $product->id)}}" method="post" class="ml-md-2">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="" data-toggle="tool-tip" title='delete' data-id="{{$product->id}}" data-placement="bottom" class="btn dltBtn btn-sm btn-outline-danger" ><span class="fa fa-trash"></span></a>
                                                        </form>
                                                    </div>
                                                </td>
                                                {{-- modal --}}
                                                <div class="modal fade" id="productId{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    @php
                                                        $product = \App\Models\Product::where('id', $product->id)->first();
                                                    @endphp
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{$product->title}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="d-flex flex-column gap-2">
                                                                    <div  class=""> 
                                                                        <b> Summary: </b>    
                                                                        <div> {!!html_entity_decode($product->summary)!!} </div>    
                                                                    </div>
                                                                    <div class="row">
                                                                        <div  class="col-md-6 "> 
                                                                            <b> Price: </b>    
                                                                            <div> ${{number_format($product->price, 2)}} </div>    
                                                                        </div>
                                                                        <div  class="col-md-6 "> 
                                                                            <b> Discount: </b>    
                                                                            <div> {{number_format($product->discount, 2)}} %</div>    
                                                                        </div>
                                                                    </div>
                                                                  <div class="row">
                                                                    <div  class="col-md-6"> 
                                                                        <b> Offer Price: </b>    
                                                                        <div> ${{number_format($product->offer_price, 2)}} </div>    
                                                                    </div>
                                                                    <div  class="col-md-6"> 
                                                                        <b> Category: </b>    
                                                                        <div>{{\App\Models\Category::where('id', $product->category_id)->value('title') }}</div>    
                                                                    </div>
                                                                  </div>
                                                                    <div class="row">
                                                                        <div  class="col-md-6"> 
                                                                            <b>Child Category: </b>    
                                                                            <div>{{\App\Models\Category::where('id', $product->child_category_id)->value('title') }}</div>    
                                                                        </div>
                                                                        <div  class="col-md-6"> 
                                                                            <b>Brand: </b>    
                                                                            <div>{{\App\Models\Brand::where('id', $product->brand_id)->value('title') }}</div>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div  class="col-md-6"> 
                                                                            <b>Size: </b>    
                                                                            <div class="badge badge-success">{{ $product->size}}</div>    
                                                                        </div>
                                                                        <div  class="col-md-6"> 
                                                                            <b>Status: </b>    
                                                                            <div class="badge badge-warning">{{ $product->status}}</div>    
                                                                        </div> 
                                                                    </div>
                                                                <div class="row">
                                                                    <div  class="col-md-6"> 
                                                                        <b>Condition: </b>    
                                                                        <div>{{ $product->conditions}}</div>    
                                                                    </div>
                                                                </div>
                                                                </div> 
                                                             </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            'headers': {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('.dltBtn').click(function(e){
        const form = $(this).closest('form');
        const dataID = $(this).data('id');
        e.preventDefault();
              
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            form.submit();
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
            });
        } else {
            swal("Your imaginary file is safe!");
        }
        });
    
    });
    </script>       
    <script>
        $('input[name=toggle]').change(function(){
            const mode = $(this).prop('checked');
            const id = $(this).val();
            
            $.ajax({ 
                url: "{{route('product.status')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    mode: mode,
                    id: id
                },
                success: function(response) {
                   if(response.status){
                    alert(response.msg)
                     }else{
                        alert('please try again');
                   }
                }
            })
        })
    </script>
@endsection