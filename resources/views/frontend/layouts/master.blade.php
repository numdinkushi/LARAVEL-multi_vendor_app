<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Qaynum Online Shopping</title>

    <!-- Favicon  -->
  @include('frontend.layouts.head')

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
        @include('frontend.layouts.header')
    </header>
        <!-- Header Area End -->

    <!-- Welcome Slides Area -->
    <div class="container"> 
      <div class="row">
          <div class="col-md-12"> 
              @include('backend.layouts.notification')
          </div>
      </div>
    </div>
  @yield('content')
    <!-- Special Featured Area -->

    <!-- Footer Area -->
   @include('frontend.layouts.footer')
    <!-- Footer Area -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
   @include('frontend.layouts.script')

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

</body>

</html>
