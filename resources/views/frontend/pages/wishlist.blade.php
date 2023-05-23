@extends('frontend.layouts.master')

@section('content')
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Wishlist</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Wishlist Table Area -->
<div class="wishlist-table section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table wishlist-table">
                    <div class="table-responsive" id="wishlist_list">
                        @include('frontend.layouts.wishlist')
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('.move-to-cart').on('click', function(e){
            e.preventDefault();
            let rowId = $(this).data('id');
            let path = "{{route('wishlist.move.cart')}}";
            let token = "{{ csrf_token() }}";

            $.ajax({
            url: path,
            type: 'POST',
            dataType: "JSON",
            data: {
                rowId : rowId,
                "_token": token,
            },

            beforeSend : function (){
                $(this).html('<i class="fa fa-spinner fa-spin"></i>Moving to cart...');
            },

            success : function(data){
                if(data['status']){
                    $('body #cart_counter').html(data['cart_count']);
                    $('body #header').html(data['header']);
                    $('body #wishlist_list').html(data['wishlist_list']);
                    
                     swal({
                    title: "Good job!",
                    text: data['message'],
                    icon: "success",
                    button: "Ok",
                    });
                }else{
                    swal({
                    title: "Oops!",
                    text: 'Something went wrong',
                    icon: "warning",
                    button: "Ok",
                    });
                }
            },

            error : function(err){
                swal({
                    title: "Oops!",
                    text: 'Something went wrong',
                    icon: "error",
                    button: "Ok",
                    });
            }
         })
      })
    </script>

<script>
    $('.delete_wishlist').on('click', function(e){
        e.preventDefault();
        let rowId = $(this).data('id');
        let path = "{{route('wishlist.delete')}}";
        let token = "{{ csrf_token() }}";

        $.ajax({
        url: path,
        type: 'POST',
        dataType: "JSON",
        data: {
            rowId : rowId,
            "_token": token,
        },

        success : function(data){
            if(data['status']){
                $('body #cart_counter').html(data['cart_count']);
                $('body #header').html(data['header']);
                $('body #wishlist_list').html(data['wishlist_list']);
                
                 swal({
                title: "Good job!",
                text: data['message'],
                icon: "success",
                button: "Ok",
                });
            }else{
                swal({
                title: "Oops!",
                text: 'Something went wrong',
                icon: "warning",
                button: "Ok",
                });
            }
        },

        error : function(err){
            swal({
                title: "Oops!",
                text: 'Something went wrong',
                icon: "error",
                button: "Ok",
                });
        }
     })
  })
</script>
@endsection
