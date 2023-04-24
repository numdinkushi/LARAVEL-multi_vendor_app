<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $parent_cats = Category::where('is_parent', 1) ->orderBy('title', 'ASC') ->get();
        return view('backend.category.create', compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slugCount = Category::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug .= time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        if ($request->is_parent == 1) {
            $data['parent_id'] = null;
        } 
        $data['is_parent'] = $request->input('parent_id', 0);
        $status = Category::create($data);

        if ($status) {
            return redirect() ->route('category.index') ->with('success', 'Category succesfully created');
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

    public function edit($id)
    {
        $parent_cats = Category::where('is_parent', 1) ->orderBy('title', 'ASC') ->get();
        $category = Category::find($id);

        if ($category) {
            return view( 'backend.category.edit', compact(['category', 'parent_cats']) );
        } else {
            return back()->with('error', 'Category not found');
        }
    }

    public function categoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('categories')
                ->where('id', $request->id)
                ->update(['status' => 'active']);
        } else {
            DB::table('categories')
                ->where('id', $request->id)
                ->update(['status' => 'inactive']);
        }
        return response()->json([
            'msg' => 'successfully updated',
            'status' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // return $request->all();

        $category = Category::find($id);

        if ($category) {
            $this->validate($request, [
                'title' => 'string|required',
                'summary' => 'string|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable|exists:categories,id',
                'status' => 'nullable|in:active,inactive',
            ]);
            
            $data = $request->all();
            
            if ($request->is_parent == 1) {
                $data['parent_id'] = null;
            }
            else{

                // $data['parent_id'] = $request->input('parent_id', 0);
                $data['is_parent'] = 0;

            }
            
            $status = $category->fill($data)->save();

            if ($status) {
                return redirect() ->route('category.index') ->with('success', 'Category succesfully updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
         }else {
            return back()->with('error', 'Category not found');
     }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $category = Category::find($id);

        $child_category_id = Category::where( 'parent_id', $id,)->pluck('id');

        if ($category) {
            $status = $category->delete();

            if ($status) {
                if($child_category_id->count() > 0){
                    Category::shiftChild($child_category_id);
                }
                return redirect()
                    ->route('category.index')
                    ->with('success', 'Category succesfully deleted');
            } else {
                return back()->with('error', 'oops, something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}