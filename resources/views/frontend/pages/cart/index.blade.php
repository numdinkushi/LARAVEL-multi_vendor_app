@extends('frontend.layouts.master')

@section('content')
<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Cart</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Cart Area -->
<div class="cart_area section_padding_100_70 clearfix">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="cart-table">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-30">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="icofont-ui-delete"></i></th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $cart_item)
                                @php
                                $associated_product = \App\Models\Product::where('id', $cart_item->id)
                                @endphp
                                <tr>
                                    <th scope="row">
                                        <i class="icofont-close cart_delete" data-id={{ $cart_item->rowId }}></i>
                                    </th>
                                    <td>
                                        <img src="{{$associated_product->value('photo') }}" class="cart-thumb" alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('product.details', $associated_product->value('slug')) }}">{{ $cart_item->name }}</a>
                                    </td>
                                    <td>{{ number_format($cart_item->price, 2) }}</td>
                                    <td>
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty2" step="1" min="1" max="99" name="quantity" value="{{ $cart_item->qty }}">
                                        </div>
                                    </td>
                                    <td>{{ $cart_item->subtotal() }}</td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="cart-apply-coupon mb-30">
                    <h6>Have a Coupon?</h6>
                    <p>Enter your coupon code here &amp; get awesome discounts!</p>
                    <!-- Form -->
                    <div class="coupon-form">
                        <form action="#">
                            <input type="text" class="form-control" placeholder="Enter Your Coupon Code">
                            <button type="submit" class="btn btn-primary">Apply Coupon</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="cart-total-area mb-30">
                    <h5 class="mb-3">Cart Totals</h5>
                    <div class="table-responsive">
                        <table class="table mb-3">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>$56.00</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>$10.00</td>
                                </tr>
                                <tr>
                                    <td>VAT (10%)</td>
                                    <td>$5.60</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>$71.60</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="checkout-1.html" class="btn btn-primary d-block">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->
@endsection

@section('scripts')
<script >
    $(document).on('click', '.cart_delete', function(e){
       e.preventDefault();
       let cart_id = $(this).data('id');

       let token = "{{ csrf_token() }}";
       let path = "{{route('cart.delete')}}";  

       $.ajax({
           url: path,
           type: 'POST',
           dataType: "JSON",
           data: {
               cart_id : cart_id,
               "_token": token,
           },

           success : function(data){

               $('body #header-ajax').html(data['header']);

               if(data['status']){
                    swal({
                   title: "Good job!",
                   text: data['message'],
                   icon: "success",
                   button: "Ok",
                   });
               }
           },

           error : function(err){
               console.log(err);
           }
       });

   })
  </script>
@endsection