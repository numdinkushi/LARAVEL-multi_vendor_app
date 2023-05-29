@extends('frontend.layouts.master')

@section('content')
<div>
{/* <!-- Breadcumb Area --> */}
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

 <!-- Checkout Area -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order_complated_area clearfix">
                    <h5>Thank You For Your Order.</h5>
                    <p>You will receive an email of your order details</p>
                    <p class="orderid mb-0">Your Order id {{ $order }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
