@foreach ($products as $category_product)
<div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="single-product-area mb-30">
        <div class="product_image">
            <!-- Product Image -->
            @php
                $photo = explode(',',$category_product->photo)
            @endphp
            <img class="normal_img" src="{{$photo[0]}}" alt="">
            <!-- Product Badge -->
            <div class="product_badge">
                <span>{{$category_product->conditions}}</span>
            </div>

            <!-- Wishlist -->
            <div class="product_wishlist">
                <a href="javascript:void(0)" class="add_to_wishlist" data-wishlist-quantity="1" data-id={{$category_product->id}} id="add_to_wishlist_{{ $category_product->id }}"><i class="icofont-heart"></i></a>
            </div>

            <!-- Compare -->
            <div class="product_compare">
                <a href="compare.html"><i class="icofont-exchange"></i></a>
            </div>
        </div>

        <!-- Product Description -->
        <div class="product_description">
            <!-- Add to cart -->
            <div class="product_add_to_cart">
                <a href="#" data-quantity="1" data-product-id="{{ $category_product->id}}" class="add_to_cart" id="add_to_cart{{$category_product->id}}"><i class="icofont-shopping-cart"></i> Add to Cart</a>
            </div>

            <!-- Quick View -->
            <div class="product_quick_view">
                <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
            </div>

            <p class="brand_name">{{\App\Models\Brand::where('id', $category_product->brand_id)->value('title')}}</p>
            <a href="{{route('product.details', $category_product->slug)}}">{{$category_product->title}}</a>
            <h6 class="product-price"><small><del class="text-danger">{{number_format($category_product->price), 2}}  </del> </small> {{number_format($category_product->offer_price), 2}} </h6>
        </div>
    </div>
</div>
@endforeach

