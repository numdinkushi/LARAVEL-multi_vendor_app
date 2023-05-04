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

                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">First Name *</label>
                                    <input type="text" value="{{ $user->full_name }}"  class="form-control" name="full_name" id="firstName"  placeholder="Sam karl">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="lastName">Username </label>
                                    <input type="text" value="{{ $user->username }}"  class="form-control" id="lastName" name="username" placeholder="sammy">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">Email</label>
                                    <input type="text" value="{{ $user->email }}"  class="form-control" name="email" id="firstName"  placeholder="samkarak@gmail.com" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="lastName">Phone </label>
                                    <input type="text" value="{{ $user->phone }}"  class="form-control" id="phone" name="phone" placeholder="0812313xxxx">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="currentPass">Current Password (Leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" id="currentPass">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="newPass">New Password (Leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" id="newPass">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="confirmPass">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirmPass">
                                </div>
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