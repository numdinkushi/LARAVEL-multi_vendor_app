@extends('frontend.layouts.master')

@section('content')
        <!-- Breadcumb Area -->
        <div class="breadcumb_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <h5>Checkout</h5>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                <form action={{ route('checkout2.store')}} method="POST"> 
                    @csrf
                <div class="col-12">
                    <div class="checkout_details_area clearfix">
                        <h5 class="mb-4">Shipping Method</h5>

                        <div class="shipping_method">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Address</th>
                                            <th scope="col">Delivery Time</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Choose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($shippings->count() > 0)
                                            @foreach ($shippings as $key => $shipping_item)
                                                <tr>
                                                    <th scope="row">{{$shipping_item->shipping_address}}</th>
                                                    <td>{{ $shipping_item->delivery_time }}</td>
                                                    <td>{{ number_format($shipping_item->delivery_charge, 2) }}</td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="customRadio{{$key}}" name="delivery_charge" value="{{ $shipping_item->delivery_charge }}" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio{{$key}}"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr class="colspan-3">
                                            <td>No shipping method found!!</td>
                                         </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="checkout_pagination mt-3 d-flex justify-content-end clearfix">
                        <a href="{{ route('checkout1') }}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                        <button type="submit" class="btn btn-primary mt-2 ml-2">Continue</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Checkout Area End -->
@endsection
