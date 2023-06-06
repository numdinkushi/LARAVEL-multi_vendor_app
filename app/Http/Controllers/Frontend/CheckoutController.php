<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $user = Auth::user();

        return view('frontend.pages.checkout.checkout1', compact('user'));
    }

    public function checkout1Store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|exists:users,email',
            'phone' =>  'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'nullable',
            'postcode' => 'numeric|nullable',
            'sub_total' => 'required',
            'total_amount' => 'required',

        ]);
        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'street' => $request->street,
            'country' => $request->country,
            'postcode' => $request->postcode,
            'note' => $request->note,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_country' => $request->shipping_country,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_street' => $request->shipping_street,
            'shipping_state' => $request->shipping_state,
            'shipping_postcode' => $request->shipping_postcode,
            'sub_total' => $request->sub_total,
            'total_amount' => $request->total_amount,
        ]);

        $shippings = Shipping::where('status', 'active')->orderBy('shipping_address', 'ASC')->get();

        return view('frontend.pages.checkout.checkout2', compact('shippings'));
    }

    public function checkout2Store(Request $request)
    {
        $this->validate($request, [
            'delivery_charge' => 'required|numeric'
        ]);

        Session::push('checkout', [
            'delivery_charge' => $request->delivery_charge
        ]);

        return view('frontend.pages.checkout.checkout3');
    }

    public function checkout3Store(Request $request)
    {
        $this->validate($request, [
            'payment_method' => 'required|string',
            'payment_status' => 'in:paid,unpaid'
        ]);

        Session::push('checkout', [
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
        ]);

        return view('frontend.pages.checkout.checkout4');
    }

    public function checkoutStore()
    {
        $order = new Order();

        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD-'.Str::random(4));
        $order['sub_total'] = Session::get('checkout')['sub_total'];
        if(Session()->has('coupon')){
            $order['coupon'] = Session::get('coupon')['value'];
            $total_amount1 =   number_format( (float) str_replace(',','',Session::get('checkout')['sub_total']) + (Session::get('checkout')[0]['delivery_charge']) - number_format(Session::get('coupon')['value']), 2);
        }else{
            $order['coupon'] = 0;
            $total_amount1 =   number_format( (float) str_replace(',','',Session::get('checkout')['sub_total']) + (Session::get('checkout')[0]['delivery_charge']), 2);
        }
        $order['total_amount'] = $total_amount1;
        $order['payment_method'] = Session::get('checkout')[1]['payment_method'];
        $order['payment_status'] = (Session::get('checkout')[1]['payment_status']);
        $order['condition'] = 'pending';
        $order['delivery_charge'] = (Session::get('checkout')[0]['delivery_charge']);

        $order['first_name'] = (Session::get('checkout')['first_name']);
        $order['last_name'] = (Session::get('checkout')['last_name']);
        $order['email'] = (Session::get('checkout')['email']);
        $order['phone'] = (Session::get('checkout')['phone']);
        $order['country'] = (Session::get('checkout')['country']);
        $order['address'] = (Session::get('checkout')['address']);
        $order['street'] = (Session::get('checkout')['street']);
        $order['city'] = (Session::get('checkout')['city']);
        $order['state'] = (Session::get('checkout')['state']);
        $order['postcode'] = (Session::get('checkout')['postcode']);
        $order['note'] = (Session::get('checkout')['note']);

        $order['shipping_first_name'] = (Session::get('checkout')['shipping_first_name']);
        $order['shipping_last_name'] = (Session::get('checkout')['shipping_last_name']);
        $order['shipping_email'] = (Session::get('checkout')['shipping_email']);
        $order['shipping_phone'] = (Session::get('checkout')['shipping_phone']);
        $order['shipping_country'] = (Session::get('checkout')['shipping_country']);
        $order['shipping_address'] = (Session::get('checkout')['shipping_address']);
        $order['shipping_city'] = (Session::get('checkout')['shipping_city']);
        $order['shipping_street'] = (Session::get('checkout')['street']);
        $order['shipping_state'] = (Session::get('checkout')['shipping_state']);
        $order['shipping_postcode'] = (Session::get('checkout')['shipping_postcode']);
        
        Mail::to($order['email'])->bcc($order['shipping_email'])->cc('numdinkushi@gmail.com')->send(new OrderMail($order));
        dd('mail is sent');

        $status = $order->save();

        if($status){
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');

            return redirect()->route('complete', $order['order_number']);
        }else{

            return redirect()->route('checkout1')->with('error', 'Something went wrong, Try again');
        }
    }

    public function complete($order)
    {
        $order = $order;

        return view('frontend.pages.checkout.complete', compact('order'));
    }
}
