<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $user = Auth::user();

        return view('frontend.pages.checkout.checkout1', compact('user'));
    }

    public function checkout1Store(Request $request)
    {
        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'note' => $request->note,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_state' => $request->shipping_state,
            'shipping_postcode' => $request->shipping_postcode,
        ]);

        $shippings = Shipping::where('status', 'active')->orderBy('shipping_address', 'ASC')->get();

        return view('frontend.pages.checkout.checkout2', compact('shippings'));
    }

    public function checkout2Store(Request $request)
    {
        Session::push('checkout', [
            'delivery_charge' => $request->delivery_charge
        ]);

        return view('frontend.pages.checkout.checkout3');
    }

    public function checkout3Store(Request $request)
    {
        Session::push('checkout', [
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
        ]);

        return view('frontend.pages.checkout.checkout4');
    }
    
}
