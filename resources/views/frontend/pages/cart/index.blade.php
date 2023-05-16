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
                    <div class="table-responsive" id="cart_list">
                        @include('frontend.layouts.cart-lists')
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="cart-apply-coupon mb-30">
                    <h6>Have a Coupon?</h6>
                    <p>Enter your coupon code here &amp; get awesome discounts!</p>
                    <!-- Form -->
                    <div class="coupon-form">
                        <form action="{{ route('coupon.add') }}" id="coupon-form" method="POST">
                            @csrf
                            <input type="text" class="form-control" name="code" placeholder="Enter Your Coupon Code">
                            <button type="submit" class="coupon-btn btn btn-primary">Apply Coupon</button>
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
<script>
    $(document).on('click', '.coupon-btn', function(e){
          e.preventDefault();

          let code = $('input[name=code]').val();
          $('.coupon-btn').html('<i class="fa fa-spinner fa-spin"> </i> Applying...');
          $('#coupon-form').submit();
    })
</script>
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

  <script>
    $(document).on('click', '.qty-text', function(e){
        let id = $(this).data('id');
        let spinner = $(this),input = spinner.closest("div.quantity").find('input[type="number"]');

        if(input.val() == 1) return false;

        if(input.val() != 1){
            let newVal = parseFloat(input.val());

            $('#qty-input-'+id).val(newVal);
        }

        let productQuantity = $("#update-cart-"+id).data('product-quantity');
        update_cart(id, productQuantity);
    })

    function update_cart(id, productQuantity){
        var rowId = id;
        let product_qty = $("#qty-input-"+rowId).val();
        let token = "{{ csrf_token() }}";
        let path = "{{route('cart.update')}}";

        $.ajax({
           url: path,
           type: 'POST',
           dataType: "JSON",
           data: {
               "_token": token,
               rowId : rowId,
               productQuantity: productQuantity,
               product_qty : product_qty,
           },

           success : function(data){
                    console.log(data);

                    if(data['status']){

                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    $('body #cart_list').html(data['cart_list']);

                    swal({
                   title: "Good job!",
                   text: data['message'],
                   icon: "success",
                   button: "Ok",
                   });
               }else{
                swal({
                   title: "Good job!",
                   text: data['message'],
                   icon: "success",
                   button: "Ok",
                   });
               }
            },
        });
    }
  </script>
@endsection
