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
                                    {{ $user->address }} <br>
                                    {{ $user->city }} <br>
                                    {{ $user->postcode}} <br>
                                    {{  $user->state }} <br>
                                    {{ $user->country}} <br>
                                </address>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editAddress" class="btn btn-primary btn-sm">Edit Address</a>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    <address>
                                        {{ $user->shipping_address }} <br>
                                        {{ $user->shipping_city }} <br>
                                        {{ $user->shipping_postcode}} <br>
                                        {{  $user->shipping_state }} <br>
                                        {{ $user->shipping_country}} <br>
                                    </address>
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
                    <form action="{{route('billing.address', $user->id)}}" method="POST">
                        @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="20" rows="2" placeholder="12 Alingo Str." value = "{{ $user->address }}" required>{{ $user?->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" value="{{ $user?->country}}" placeholder="Canada" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="postcode">Post code</label>
                                    <input type="number" class="form-control" name="postcode" id="postcode" placeholder="1231123" value="{{ $user?->postcode}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="Alaska" value="{{ $user?->state}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Jos" value="{{ $user?->city}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                 <form action="{{ route('shipping.address', $user->id) }}" method="POST">
                    @csrf
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                <label for="country">Shipping Address</label>
                                 <textarea name="shipping_address" class="form-control" id="shipping_address" cols="20" rows="2" placeholder="2B St. Peter's square' *" value="{{$user->shipping_address}}" required>{{ $user?->address }}</textarea>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="country">Shipping Country</label>
                                 <input type="text" class="form-control" name="shipping_country" id="shipping_country" placeholder="Japan" value="{{ $user?->shipping_country}}" required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="shipping_postcode">Shipping Post code</label>
                                 <input type="text" class="form-control" name="shipping_postcode" id="shipping_postcode" placeholder="1231" value="{{ $user?->shipping_postcode}}" required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="shipping_state">Shipping State</label>
                                 <input type="text" class="form-control" name="shipping_state" id="shipping_state" placeholder="Alaska" value={{ $user?->shipping_state}} required>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="shipping_city">Shipping City</label>
                                 <input type="text" class="form-control" name="shipping_city" id="shipping_city" placeholder="Jos" value={{ $user?->shipping_city}} required>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Update Shipping Address</button>
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
