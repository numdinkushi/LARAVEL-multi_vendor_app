@extends('frontend.layouts.master')

@section('content')
  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>My Account</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- My Account Area -->
<section class="my-account-area section_padding_100_50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="my-account-navigation mb-50">
                    @include('frontend.user.sidebar')
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="my-account-content mb-50">
                    <h5 class="mb-3">Account Details</h5>

                    <form action="{{ route('update.account', $user?->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="full_name">First Name *</label>
                                    <input type="text" value="{{ $user->full_name }}"  class="form-control" name="full_name" id="full_name"  placeholder="Sam karl">
                                    @error('full_name')
                                        <p class="text-danger" >{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username </label>
                                    <input type="text" value="{{ $user->username }}"  class="form-control" id="username" name="username" placeholder="sammy">
                                    @error('username')
                                    <p class="text-danger" >{{$message}}</p>
                                @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{ $user->email }}"  class="form-control" name="email" id="email"  placeholder="samkarak@gmail.com" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Phone </label>
                                    <input type="number" value="{{ $user->phone }}"  class="form-control" id="phone" name="phone" placeholder="0812313xxxx">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="currentPass">Current Password (Leave both passwords blank to leave unchanged)</label>
                                    <input type="password" class="form-control" id="currentPass" name="old_password">
                                    @error('old_password')
                                    <p class="text-danger" >{{$message}}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="newPass">New Password (Leave both passwords blank to leave unchanged)</label>
                                    <input type="password" class="form-control" id="newPass" name="new_password">
                                </div>
                                @error('new_password')
                                <p class="text-danger" >{{$message}}</p>
                            @enderror
                            </div>
                        
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account Area -->
@endsection