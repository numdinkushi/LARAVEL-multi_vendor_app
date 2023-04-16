@extends('backend.layouts.master')

@section('content')
     <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-8 col-sm-12 d-flex justify-content-between">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Banner</h2>
                        <ul class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Library</li>
                        </ul>
                        <a href="{{route('banner.create')}}" class="btn btn-outline-secondary"><i class="icon-plus mr-2"></i>Create Banner</a>
                        <p class="float-right">Total Banners: {{\App\Models\Banner::count()}}</p>
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
                            <h2><strong>Banner</strong> List</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Photo</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $banner->title }}</td>
                                                <td>{!! html_entity_decode($banner->description) !!}</td>
                                                <td class="d-flex justify-content-center"> <img src="{{ $banner->photo }}" alt="" height="50" width="50"> </td>
                                                <td>
                                                    @if ($banner->condition == 'banner')
                                                        <span class="badge badge-success"> {{ $banner->condition }}</span>
                                                    @else
                                                        <span class="badge badge-primary"> {{ $banner->condition }}</span>
                                                    @endif
                                                </td>
                                                <td> <input type="checkbox" name="toggle" value="{{$banner->id}}" data-toggle="switchbutton" {{$banner->status == 'active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-onstyle="success" data-size="sm" data-offstyle="danger"> </td>
                                                <td >
                                                    <div class="d-flex justify-content-around gap-2 space-md-2">   
                                                        <a href="{{route('banner.edit', $banner->id)}}" data-toggle="tool-tip" title='edit' data-placement="bottom" class="btn btn-sm btn-outline-warning" ><span class="fa fa-edit"></span></a>
                                                        <form action="{{route('banner.destroy', $banner->id)}}" method="post" class="ml-md-2">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="" data-toggle="tool-tip" title='delete' data-id="{{$banner->id}}" data-placement="bottom" class="btn dltBtn btn-sm btn-outline-danger" ><span class="fa fa-trash"></span></a>
                                                        </form>
                                                    </div>
                                                </td>
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
        console.log(3323424)
      
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
                url: "{{route('banner.status')}}",
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