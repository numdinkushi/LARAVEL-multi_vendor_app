@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    MD NAZRUL ISLAM <br>
                                    Madhabdi, Narsingdi <br>
                                    Madhabdi <br>
                                    Narsingdi <br>
                                    1600
                                </address>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editAddress" class="btn btn-primary btn-sm">Edit Address</a>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    You have not set up this type of address yet.
                                </address>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#shippingAddress" class="btn btn-primary btn-sm">Edit Shipping Address</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="address" class="form-control" id="address" cols="20" rows="2" placeholder="2B St. Peter's square' *" required>{{ $user?->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" placeholder="{{ $user?->country}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="postcode">Post code</label>
                                    <input type="text" class="form-control" name="postcode" id="postcode" placeholder="12314TE" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="Alaska" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Jos" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="postcode">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your E-mail" required>
                                </div>
                            </div>
                          

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary w-100">Send Message</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

         <!-- Edit Shipping Address Modal -->
      <div class="modal fade" id="shippingAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <form action="{{route('billing.address', $user->id)}}" method="POST">
                    @csrf
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                <label for="country">Shipping Address</label>
                                 <textarea name="address" class="form-control" id="address" cols="20" rows="2" placeholder="2B St. Peter's square' *" required>{{ $user?->address }}</textarea>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="country">Shipping Country</label>
                                 <input type="text" class="form-control" name="country" id="country" placeholder="{{ $user?->country}}" required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="postcode">Shipping Post code</label>
                                 <input type="text" class="form-control" name="postcode" id="postcode" placeholder="12314TE" required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="state">Shipping State</label>
                                 <input type="text" class="form-control" name="state" id="state" placeholder="Alaska" required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="city">Shipping City</label>
                                 <input type="text" class="form-control" name="city" id="city" placeholder="Jos" required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="postcode">Shipping Email</label>
                                 <input type="email" class="form-control" name="email" id="email" placeholder="Your E-mail" required>
                             </div>
                         </div>
                    
                         <div class="col-12 text-center">
                             <button type="submit" class="btn btn-primary w-100">Send Message</button>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Understood</button>
                 </div>
             </form>
             </div>
         </div>
      </div>
    </section>
    <!-- My Account Area -->
@endsection
{{--
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection --}}
