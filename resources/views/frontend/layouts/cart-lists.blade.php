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
                    <input type="number" class="qty-text" data-id="{{ $cart_item->rowId }}" id="qty-input-{{ $cart_item->rowId }}" step="1" min="1" max="99" name="quantity" value="{{ $cart_item->qty }}">
                    <input type="hidden" data-id="{{ $cart_item->rowId }}" data-product-quantity="{{ $associated_product->value('stock') }}" id="update-cart-{{ $cart_item->rowId }}" />
                </div>
            </td>
            <td>{{ $cart_item->subtotal() }}</td>
        </tr>
        @endforeach

    </tbody>
</table>
