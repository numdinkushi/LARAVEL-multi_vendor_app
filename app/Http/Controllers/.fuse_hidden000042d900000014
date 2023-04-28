<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'username' => 'required|nullable',
            'email' => 'required|email|unique:users,email',
            'phone' => 'string|nullable',
            'password' => 'required|min:4',
            'photo' => 'required',
            'address' => 'nullable|string',
            'role' => 'required|in:admin,customer,vendor',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        $status = User::create($data);

        if ($status) {
            return redirect() ->route('user.index') ->with('success', 'User succesfully created');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function userStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('users')
                ->where('id', $request->id)
                ->update(['status' => 'active']);
        } else {
            DB::table('users')
                ->where('id', $request->id)
                ->update(['status' => 'inactive']);
        }
        return response()->json([
            'msg' => 'successfully updated',
            'status' => true,
        ]);
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
        $user = User::find($id);

        if ($user) {
            return view( 'backend.user.edit', compact(['user']) );
        } else {
            return back()->with('error', 'User not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($user) {
            $this->validate($request, [
            'full_name' => 'required|string',
            'username' => 'required|nullable',
            'email' => 'required|email|exists:users,email',
            'phone' => 'string|nullable',
            'photo' => 'required',
            'address' => 'nullable|string',
            'role' => 'required|in:admin,customer,vendor',
            'status' => 'required|in:active,inactive'
            ]);
            
            $data = $request->all();
                
            $status = $user->fill($data)->save();

            if ($status) {
                return redirect() ->route('user.index') ->with('success', 'User succesfully updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
         }else {
            return back()->with('error', 'User not found');
     }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {

            $status = $user->delete();

            if ($status) {
                return redirect()
                    ->route('user.index')
                    ->with('success', 'User succesfully deleted');
            } else {
                return back()->with('error', 'oops, something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
