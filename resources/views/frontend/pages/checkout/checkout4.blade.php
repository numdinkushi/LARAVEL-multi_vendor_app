@extends('frontend.layouts.master')

@section('content')
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
    <a class="complated" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
    <a class="complated" href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
    <a class="complated" href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
    <a class="complated" href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
</div>
<!-- Checkout Step Area -->

<!-- Checkout Area -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checkout_details_area clearfix">
                    <h5 class="mb-30">Review Your Order</h5>

                    <div class="cart-table">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-30">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (  \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $shopping_item )
                                        <tr>
                                            <td>
                                                <img src="{{ $shopping_item->model->photo }}" alt="Product">
                                            </td>
                                            <td>
                                                <a href="{{ route('product.details', $shopping_item->model->slug) }}">{{ $shopping_item->name }}</a>
                                            </td>
                                            <td>{{  number_format($shopping_item->price, 2) }}</td>
                                            <td>
                                                {{ $shopping_item->qty}}
                                            </td>
                                            <td>{{ $shopping_item->subtotal}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7 ml-auto">
                <div class="cart-total-area">
                    <h5 class="mb-3">Cart Totals</h5>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>{{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>$
                                        {{ number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2) }}
                                    </td>
                                </tr>
                                @if(\Illuminate\Support\Facades\Session::has('coupon'))
                                <tr>
                                    <td>Coupon</td>
                                    <td>{{ number_format(\Illuminate\Support\Facades\Session::get('coupon')['value'], 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Total</td>
                                    {{-- @php
                                        $has_coupon =  \Illuminate\Support\Facades\Session::has('coupon');
                                        $coupon_value = number_format(\Illuminate\Support\Facades\Session::get('coupon')['value'], 2);
                                        $delivery_charge_value = number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2);
                                        $sub_total = number_format( (float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()), 2);
                                    @endphp --}}
                                      {{-- @if($has_coupon && !$delivery_charge_value)
                                      <td>{{ $sub_total - $coupon_value  }}</td>
                                     @elseif(!$has_coupon &&  $delivery_charge_value)
                                     <td>{{ $sub_total  + $delivery_charge_value}}</td>
                                     @elseif($has_coupon && $delivery_charge_value)
                                     <td>$  {{ $sub_total + $delivery_charge_value  - $coupon_value}}</td>
                                     @else
                                     <td>$   {{ $sub_total }}</td>
                                     @endif --}}
                                    @if(\Illuminate\Support\Facades\Session::has('coupon') && !number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2))
                                     <td>{{ number_format( (float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) - number_format(\Illuminate\Support\Facades\Session::get('coupon')['value']), 2 ) }}</td>
                                    @elseif(!\Illuminate\Support\Facades\Session::has('coupon') && number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2))
                                    <td>{{ number_format( (float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) + number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2), 2) }}</td>
                                    @elseif(  number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2) &&  \Illuminate\Support\Facades\Session::has('coupon'))
                                    <td>$  {{ number_format( (float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) + number_format( \Illuminate\Support\Facades\Session::get('checkout')[0]['delivery_charge'], 2) - number_format(\Illuminate\Support\Facades\Session::get('coupon')['value']), 2 )}}</td>
                                    @else
                                    <td>$   {{ number_format( (float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()), 2)}}</td>
                                    @endif
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="checkout_pagination d-flex justify-content-end mt-3">
                        <a href="checkout-4.html" class="btn btn-primary mt-2 ml-2 d-none d-sm-inline-block">Go Back</a>
                        <a href="{{ route('checkout.store') }}" class="btn btn-primary mt-2 ml-2">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Checkout Area End -->
