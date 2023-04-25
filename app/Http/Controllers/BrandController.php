<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands  = Brand::orderBy('id', 'DESC')->get();
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    public function brandStatus(Request $request)
    {
        if($request->mode == 'true'){
            DB::table('brands')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('brands')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'successfully updated', 'status' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'nullable|string',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive'
        ]);

        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slugCount = Brand::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug .= time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status =  Brand::create($data);

        if($status){
            return redirect()->route('brand.index')->with('success', 'Brand succesfully created');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);

       if($brand){
            return view('backend.brand.edit', compact('brand'));
       }else{
            return back()->with('error', 'Data not found');
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        if($brand){
            $this->validate($request, [
                'title' => 'nullable',
                'photo' => 'required',
                'status' => 'nullable|in:active,inactive',
            ]);
            
            $data = $request->all();
    
            $status = $brand->fill($data)->save();
    
            if ($status) {
                return redirect()->route('brand.index')->with('success', 'Brand succesfully updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }else{
             return back()->with('error', 'Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if($brand){
           $status = $brand->delete();
 
           if($status){
             return redirect()->route('brand.index')->with('success', 'Brand succesfully deleted');
           }else{
             return back()->with('error', 'oops, something went wrong');
           }
        }else{
             return back()->with('error', 'Data not found');
        }
    }
}
