<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {   
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id')->limit('5')->get();

        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id')->limit('3')->get();

        return view('frontend.layouts.index', compact(['banners', 'categories']));
    }

    public function productCategory($slug)
    {
       $category = Category::with('products')->where('slug', $slug)->first();
       return $category;
    }
}
