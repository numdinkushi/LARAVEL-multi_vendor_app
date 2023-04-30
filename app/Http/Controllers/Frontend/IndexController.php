<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {   
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id')->limit('5')->get();

        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id')->limit('20')->get();

        return view('frontend.layouts.index', compact(['banners', 'categories']));
    }

    public function productCategory($slug)
    {
       $categories = Category::with('products')->where('slug', $slug)->first();
    
       return view('frontend.pages.product.product-category', compact(['categories']));
    }

    public function productDetails($slug)
    {

       $product = Product::with('related_products')->where('slug', $slug)->first();

        if($product){
              return view('frontend.pages.product.product-details', compact(['product']));
        } else {
            return 'Product details not found';
        }
    }

    public function userAuth()
    {
        return view('frontend.auth.auth');
    }
}
