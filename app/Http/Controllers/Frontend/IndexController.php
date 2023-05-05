<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function home()
    {        
        $user = Auth::user();

        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id')->limit('5')->get();

        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id')->limit('20')->get();

        return view('frontend.layouts.index', compact(['banners', 'categories', 'user']));
    }

    public function productCategory(Request $request, $slug)
    {
       $categories = Category::with('products')->where('slug', $slug)->first();

       $sort = '';

       if($request->sort != null){

           $sort = $request->sort;
       }


       if($categories == null){

        return view('errors.404');

       }else{

            if($sort == 'priceAsc'){

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(12);

            }elseif($sort == 'priceDsc'){

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->orderBy('offer_price', 'desc')->paginate(12);

            }elseif($sort == 'discAsc'){

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);

            }elseif($sort == 'discDsc'){

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->orderBy('price', 'desc')->paginate(12);

            }elseif($sort == 'titleAsc'){

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->orderBy('title', 'ASC')->paginate(12);

            }elseif($sort == 'titleDsc'){

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->orderBy('title', 'DESC')->paginate(12);

            }else{

                $products = Product::where(['status' => 'active', 'category_id' => $categories->id])->paginate(12);

            }
       }

       $route = 'product-category';

       if($request->ajax()){

            $view = view('frontend.layouts.single-product', compatc(['products']))->render();

            return response()->json(['html' => $view]);

       }

       return view('frontend.pages.product.product-category', compact(['categories', 'route', 'products']));
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

    public function loginSubmit(Request $request)
    {
            $this->validate($request, [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:4'
            ]);

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])){

                Session::put('user', $request->email);

                if(Session::get('url.intended')){

                    return Redirect::to(Session::get('url.intended'));

                }else{

                    return redirect()->route('home')->with('success', 'succesfully logged in.');
                }
            }else{
                return back()->with('error', 'Invalid Credentials');
            }
    }
    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'username' => 'nullable|string',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:4|required|confirmed',

        ]);

        $data = $request->all();

        $check = $this->create($data);

        Session::put($data['email']);

        Auth::login($check);

        if($check){
            return redirect()->route('home')->with('success', 'Successfully logged in');

        }else{

            return back()->with('error', 'Invalid Credentials');
        }
    }

    private function create(array $data)
    {
       return User::create([
        'full_name' => $data['full_name'],
        'username' =>  $data['username'],
        'email' =>  $data['email'],
        'password' => Hash::make($data['password']),
       ]);
    }

    public function userDashboard(){

        $user = Auth::user();

        return view('frontend.user.dashboard', compact(['user']));
    }

    public function userOrder()
    {

        $user = Auth::user();

        return view('frontend.user.order', compact(['user']));
    }

    public function userAddress()
    {

        $user = Auth::user();

        return view('frontend.user.address', compact(['user']));
    }
    
    public function userAccount()
    {
        $user = Auth::user();

        return view('frontend.user.account', compact(['user']));
    }

    public function billingAddress(Request $request, $id)
    {
        return $id;
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->route('home')->with('success', 'Successfully logged out');

    }

}
