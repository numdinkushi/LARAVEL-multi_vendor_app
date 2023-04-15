@extends('backend.layouts.master')

@section('content')
     <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Library</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Library</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
                                data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                            <span>Visitors</span>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
                                data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                            <span>Visits</span>
                        </div>
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
                                                <td>{{ $banner->description }}</td>
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
                                                    <div class="d-flex justify-content-around">   
                                                        <a href="{{route('banner.edit', $banner->id)}}" data-toggle="tool-tip" title='edit' data-placement="bottom" class="btn btn-sm btn-outline-warning" ><span class="fa fa-edit"></span></a>
                                                        <form action="{{route('banner.destroy', $banner->id)}}" method="POST">
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