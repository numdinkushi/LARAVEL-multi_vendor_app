<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    public function couponStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('coupons')
                ->where('id', $request->id)
                ->update(['status' => 'active']);
        } else {
            DB::table('coupons')
                ->where('id', $request->id)
                ->update(['status' => 'inactive']);
        }
        return response()->json([
            'msg' => 'successfully updated',
            'status' => true,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|min:2',
            'type' => 'required|in:fixed,percent',
            'status' => 'required|in:active,inactive',
            'value' => 'required|numeric'
        ]);

        $data = $request->all();

        $status = Coupon::create($data);

        if ($status) {
            return redirect() ->route('coupon.index') ->with('success', 'Coupon succesfully created');
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
        $coupon = Coupon::find($id);

        if ($coupon) {
            return view( 'backend.coupon.edit', compact(['coupon']) );
        } else {
            return back()->with('error', 'Coupon not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->all();

        $coupon = Coupon::find($id);

        if ($coupon) {
            $this->validate($request, [
                'code' => 'required|min:2',
                'type' => 'required|in:fixed,percent',
                'status' => 'required|in:active,inactive',
                'value' => 'required|numeric'
            ]);
            
            $data = $request->all();
            
            $status = $coupon->fill($data)->save();

            if ($status) {
                return redirect()->route('coupon.index') ->with('success', 'Coupon succesfully updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
         }else {
            return back()->with('error', 'Coupon not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);

        if ($coupon) {
            $status = $coupon->delete();

            if ($status) {
                return redirect()
                    ->route('coupon.index')
                    ->with('success', 'Coupon succesfully deleted');
            } else {
                return back()->with('error', 'oops, something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
