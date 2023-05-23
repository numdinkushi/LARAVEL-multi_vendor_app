<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist()
    {
        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request)
    {
         $product_id = $request->input('product_id');
         $product_quantity = $request->input('product_quantity');
         $product = Product::getProductByCart($product_id);
         $price = $product[0]['price'];
         $wishlist_array = [];

         foreach(Cart::instance('wishlist')->content() as $wishlist_item){
            $wishlist_array[] = $wishlist_item->id;
         }

         if(in_array($product_id, $wishlist_array)){

            $response['present'] = true;
            $response['message'] = 'Item has been saved to wishlist';

         }else{
            $result = Cart::instance('wishlist')->add($product_id, $product[0]['title'], $product_quantity,$price)->associate('App\Models\Product');

            if($result){
                $response['status'] = true;
                $response['message'] = 'Item has been saved to wishlist';
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
         }
        return json_encode($response);
    }

    public function moveToCart(Request $request)
    {
       $wishlist_item = Cart::instance('wishlist')->get($request->rowId);

       Cart::instance('wishlist')->remove($request->rowId);

       $result =  Cart::instance('shopping')->add($wishlist_item->id, $wishlist_item->name, 1,  $wishlist_item->price)->associate('App\Models\Product');

       if($result){
            $response['status'] = true;
            $response['message'] = 'Item has been added to cart successfully';
            $response['cart_count'] = Cart::instance('shopping')->count();
       }

       if($request->ajax()){
            $wishlist = view('frontend.layouts.wishlist')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
       }

       return $response;
    }

    public function wishlistDelete(Request $request){
      $id = $request->input('rowId');
      Cart::instance('wishlist')->remove($id);

      if($request->ajax()){
        $response['status'] = true;
        $response['message'] = 'Item has been removed from your wishlist successfully';
        $response['cart_count'] = Cart::instance('shopping')->count();
        
        $wishlist = view('frontend.layouts.wishlist')->render();
        $header = view('frontend.layouts.header')->render();
        $response['wishlist_list'] = $wishlist;
        $response['header'] = $header;
     }

     return json_encode($response);
    }
}
