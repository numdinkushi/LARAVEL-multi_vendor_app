<table class="table table-bordered mb-30">
    <thead>
        <tr>
            <th scope="col"><i class="icofont-ui-delete"></i></th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Unit Price</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content()->count() > 0)
        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $wishlist_item)
            <tr>
                <th scope="row">
                    <i class="icofont-close delete_wishlist" data-id="{{ $wishlist_item->rowId }}"></i>
                </th>
                <td>
                    <img src="{{ $wishlist_item->model->photo }}" alt="Product">
                </td>
                <td>
                    <a href="{{ route('product.details', $wishlist_item->model->slug) }}">{{ $wishlist_item->name }}</a>
                </td>
                <td>{{  number_format($wishlist_item->price, 2) }}</td>
                <td><a href="javascript:void(0);" data-id="{{ $wishlist_item->rowId }}" class="move-to-cart btn btn-primary btn-sm">Add to Cart</a></td>
            </tr>
        @endforeach
        @else
            <tr>
               <td colspan="5" class="text-center">
                   You don't have any wishlist product!
               </td>
            </tr>
        @endif
    </tbody>
</table>