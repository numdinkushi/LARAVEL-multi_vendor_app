<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.banners.index');
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
        $slug = str::slug($request->input('slug'));
        $slug_count = Banner::where('slug', $slug)->count();

        if($slug_count > 0){
            $slug .= time().'-'.$slug;
        }
        
        $data['slug'] = $slug;
        
        $status = Banner::create($data);

        if($status){
            return redirect()->route('banner.index')->with('success', 'banner successfully createed');
        } else {
            return back()->with('error', 'something went wrong!');  
        }

        return $data;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
