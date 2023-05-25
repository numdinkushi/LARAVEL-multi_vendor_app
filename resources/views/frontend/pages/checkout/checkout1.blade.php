@extends('frontend.layouts.master')

@section('content')
        <!-- Breadcumb Area -->
        <div class="breadcumb_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <h5>Checkout</h5>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb Area -->

        <!-- Checkout Step Area -->
        <div class="checkout_steps_area">
            <a class="active" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
            <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
            <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
            <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
        </div>

        <!-- Checkout Area -->
        <div class="checkout_area section_padding_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="checkout_details_area clearfix">
                            <h5 class="mb-4">Billing Details</h5>
                            <form action="#" method="post">
                                <div class="row">
                                    @php
                                        $full_name = explode(' ',$user->full_name);
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" placeholder="First Name" value="{{ $full_name[0]}}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" value="{{ $full_name[1] }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="phone" min="0" name="phone" value="{{  $user->phone }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" placeholder="Nigeria" name="country" value="{{ $user->country }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="street_address">Street address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Street Address" value="{{ $user->address }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City</label>
                                        <input type="text" class="form-control" id="city" placeholder="Town/City" name="city" value="{{ $user->city}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{ $user->state}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode/Zip</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode / Zip" value="{{ $user->postcode}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="order-notes">Order Notes</label>
                                        <textarea class="form-control" id="order-notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>

                                <!-- Different Shipping Address -->
                                <div class="different-address mt-50">
                                    <div class="ship-different-title mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Ship to same address?</label>
                                        </div>
                                    </div>
                                    <div class="row shipping_input_field">
                                        <div class="col-md-6 mb-3">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="shipping_first_name" placeholder="First Name" name="shipping_first_name" value="{{ $full_name[0]}}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="shipping_last_name" placeholder="Last Name" name="shipping_last_name" value="{{ $full_name[1] }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email_address">Email Address</label>
                                            <input type="email" class="form-control" id="shipping_email_address" placeholder="Email Address" name="shipping_email" value="{{ $user->email }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="number" class="form-control" id="shipping_phone" min="0" name="shipping_phone" value="{{  $user->phone }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="shipping_country" placeholder="Nigeria" name="shipping_country" value="{{ $user->shipping_country }}">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="street_address">Street address</label>
                                            <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Street Address" value="{{ $user->shipping_address }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="city">Town/City</label>
                                            <input type="text" class="form-control" id="shipping_city" placeholder="Town/City" name="shipping_city" value="{{ $user->shipping_city}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="shipping_state" placeholder="State" name="shipping_state" value="{{ $user->shipping_state}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="postcode">Postcode/Zip</label>
                                            <input type="text" class="form-control" id="shipping_postcode" name="shipping_postcode" placeholder="Postcode / Zip" value="{{ $user->shipping_postcode}}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="checkout_pagination d-flex justify-content-end mt-50">
                            <a href="checkout-1.html" class="btn btn-primary mt-2 ml-2">Go Back</a>
                            <a href="checkout-3.html" class="btn btn-primary mt-2 ml-2">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout Area -->
@endsection

@section('scripts')
    <script>
        $('#customCheck1').on('change', function(e){
            e.preventDefault();
            if(this.checked ){
                $('#shipping_first_name').val($('#first_name').val());
                $('#shipping_last_name').val($('#last_name').val());
                $('#shipping_phone').val($('#phone').val());
                $('#shipping_email').val($('#email').val());
                $('#shipping_country').val($('#country').val());
                $('#shipping_city').val($('#city').val());
                $('#shipping_postcode').val($('#postcode').val());
                $('#shipping_state').val($('#state').val());
                $('#shipping_address').val($('#address').val());
            }else{
                $('#shipping_phone').val("");
                $('#shipping_last_name').val("");
                $('#shipping_email').val("");
                $('#shipping_phone').val("");
                $('#shipping_email').val("");
                $('#shipping_country').val("");
                $('#shipping_city').val("");
                $('#shipping_postcode').val("");
                $('#shipping_state').val("");
                $('#shipping_address').val("");

            }
        });
    </script>
@endsection