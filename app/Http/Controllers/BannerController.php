<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('backend.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slugCount = Banner::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug .= time() . '_' . $slug;
        }
        $data['slug'] = $slug;
        $status = Banner::create($data);

        if ($status) {
            return redirect()->route('banner.index')->with('success', 'Banner succesfully created');
        } else {
            return back()->with('error', 'Something went wrong');
        }

    }

    /**
     * Display the specified resource.
     */
    public function bannerStatus(Request $request)
    {
        if($request->mode == 'true'){
            DB::table('banners')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('banners')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'successfully updated', 'status' => true]);
    }
     public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $banner = Banner::find($id);

       if($banner){
            return view('backend.banners.edit', compact('banner'));
       }else{
            return back()->with('error', 'Data not found');
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);

        if($banner){
            $this->validate($request, [
                'title' => 'string|required',
                'description' => 'string|nullable',
                'photo' => 'required',
                'condition' => 'nullable|in:banner,promo',
                'status' => 'nullable|in:active,inactive',
            ]);
            $data = $request->all();
    
            $status = $banner->fill($data)->save();
    
            if ($status) {
                return redirect()->route('banner.index')->with('success', 'Banner succesfully updated');
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
        $banner = Banner::find($id);

       if($banner){
          $status = $banner->delete();

          if($status){
            return redirect()->route('banner.index')->with('success', 'Banner succesfully deleted');
          }else{
            return back()->with('error', 'oops, something went wrong');
          }
       }else{
            return back()->with('error', 'Data not found');
       }
    }
}
