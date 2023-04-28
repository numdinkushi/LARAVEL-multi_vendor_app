@extends('backend.layouts.master')

@section('content')
     <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-8 col-sm-12 d-flex justify-content-between">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>User</h2>
                        <ul class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Library</li>
                        </ul>
                        <a href="{{route('user.create')}}" class="btn btn-outline-secondary"><i class="icon-plus mr-2"></i>Create User</a>
                        <p class="float-right">Total Users: {{\App\Models\User::count()}}</p>
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
                            <h2><strong>User</strong> List</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Full Name</th>
                                            <th>Photo</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="d-flex justify-content-center"> <img src="{{ $user->photo }}" alt="" height="50" width="50" style="border-radius: 50% "> </td>
                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td> <input type="checkbox" name="toggle" value="{{$user->id}}" data-toggle="switchbutton" {{$user->status == 'active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-onstyle="success" data-size="sm" data-offstyle="danger"> </td>
                                                <td >
                                                    <div class="d-flex justify-content-around gap-2 space-md-2">   
                                                        <a  href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#userId{{$user->id}}" data-toggle="tool-tip" title='show' data-placement="bottom" class="btn btn-sm btn-outline-secondary" ><span class="fa fa-eye"></span></a>
                                                        <a href="{{route('user.edit', $user->id)}}" data-toggle="tool-tip" title='edit' data-placement="bottom" class="btn btn-sm btn-outline-warning" ><span class="fa fa-edit"></span></a>
                                                        <form action="{{route('user.destroy', $user->id)}}" method="post" class="ml-md-2">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="" data-toggle="tool-tip" title='delete' data-id="{{$user->id}}" data-placement="bottom" class="btn dltBtn btn-sm btn-outline-danger" ><span class="fa fa-trash"></span></a>
                                                        </form>
                                                    </div>
                                                </td>
                                                {{-- Modal --}}
                                                <div class="modal fade" id="userId{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        @php
                                                            $user = \App\Models\User::where('id', $user->id)->first();
                                                        @endphp
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="container-fluid">
                                                                <div class="d-flex justify-content-between text-center">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLa bel align-self-center  text-uppercase">{{$user->full_name}} </h1>
                                                                    <img src="{{ $user->photo }}" alt="" height="60" width="60" style="border-radius: 50% ">
                                                                </div>
                                                            </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="d-flex flex-column gap-2">
                                                                        <div class="row">
                                                                            <div  class="col-md-6"> 
                                                                                <b> User Name: </b>    
                                                                                <div> {{$user->user_name}} </div>    
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div  class="col-md-6"> 
                                                                                <b>Email: </b>    
                                                                                <div class="">{{ $user->email}}</div>    
                                                                            </div>
                                                                            <div  class="col-md-6"> 
                                                                                <b>Phone No.: </b>    
                                                                                <div class="">{{ $user->phone}}</div>    
                                                                            </div> 
                                                                        </div>
                                                                    <div class="row">
                                                                        <div  class="col-md-6"> 
                                                                            <b>{{__('Address:')}} </b>    
                                                                            <div>{{ $user->address}}</div>    
                                                                        </div>
                                                                        <div  class="col-md-6"> 
                                                                            <b>{{__('Role')}}: </b>    
                                                                            <div>{{ $user->role}}</div>    
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
                url: "{{route('user.status')}}",
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