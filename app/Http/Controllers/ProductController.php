<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('backend.product.index', compact('products'));
    }

    public function productStatus(Request $request)
    {
      if($request->mode == 'true'){
        DB::table('products')->where('id', $request->id)->update(['status' => 'active']);
    } else {
        DB::table('products')->where('id', $request->id)->update(['status' => 'inactive']);
    }
    return response()->json(['msg' => 'successfully updated', 'status' => true]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {                
        // return $request->all();
        $this->validate($request, [
            'title' => 'required|string',
            'summary' =>  'required|string',
            'description' => 'required',
            'stock' => 'nullable|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required|exists:categories,id',
            'child_category_id' => 'nullable|exists:categories,id',
            'size' => 'nullable',
            'conditions' => 'nullable',
            'status' => 'nullable|exists:active,inactive',
        ]);

        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slugCount = Product::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug .= time() . '_' . $slug;
        }

        $data['slug'] = $slug;

        $data['offer_price'] = ($request->price - (($request->price * $request->discount)/100));
       
        $status = Product::create($data);

        if ($status) {
            return redirect() ->route('product.index') ->with('success', 'Product succesfully created');
        } else {
            return back()->with('error', 'Something went wrong');
        }

        // return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            return view( 'backend.product.view', compact(['product']) );
        } else {
            return back()->with('error', 'Product not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            return view( 'backend.product.edit', compact(['product']) );
        } else {
            return back()->with('error', 'Product not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $this->validate($request, [
            'title' => 'required|string',
            'summary' =>  'required|string',
            'description' => 'string|nullable',
            'stock' => 'nullable|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'required',
            'category_id' => 'required|exists:categories,id',
            'child_category_id' => 'nullable|exists:categories,id',
            'size' => 'nullable',
            'conditions' => 'nullable',
            'status' => 'nullable|exists:active,inactive',
            ]);
            
            $data = $request->all();
            
            $data['offer_price'] = ($request->price - (($request->price * $request->discount)/100));
            
            $status = $product->fill($data)->save();

            if ($status) {
                return redirect() ->route('product.index') ->with('success', 'Product succesfully updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
         }else {
            return back()->with('error', 'Product not found');
     }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $status = $product->delete();

            if ($status) {
                return redirect()
                    ->route('product.index')
                    ->with('success', 'Product succesfully deleted');
            } else {
                return back()->with('error', 'oops, something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
