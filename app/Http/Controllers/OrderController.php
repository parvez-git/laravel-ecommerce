<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\Shipping;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{

    public function shippinginfoStore(Request $request)
    {
        $request->validate([
            "firstname"   => "required|min:3",
            "lastname"    => "required|min:3",
            "email"       => "required|min:3|email",
            "phone"       => "required",
            "address"     => "required",
            "address2"    => "nullable",
            "country"     => "required",
            "state"       => "required",
            "zip"         => "required"
        ]);


        $shippinginfo = Shipping::create([
            "firstname"   => $request->firstname,
            "lastname"    => $request->lastname,
            "email"       => $request->email,
            "phone"       => $request->phone,
            "address"     => $request->address,
            "address2"    => $request->address2,
            "country"     => $request->country,
            "state"       => $request->state,
            "zip"         => $request->zip
        ]);

        if ($shippinginfo) {

            $request->session()->put('shipping_id', $shippinginfo->id);

            return redirect()->route('payment.process');

        } else {
            return back();
        }

    }

    public function paymentProcess()
    {
        if(request()->session()->get('shipping_id')){

            return view('payment');

        } else {

            return back();
        }

    }


    public function checkout()
    {
        if(Cart::count()) {

            return view('checkout');

        } else {

            return redirect('/');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            "payment_type"      => "required",
            "payment_key"       => "nullable",
            "order_details"     => "nullable",
        ]);

        if ($request->session()->get('shipping_id')) {

            $shipping_id = $request->session()->get('shipping_id');
            $order_id    = rand(100,1000) .''. $shipping_id;

            $order = Order::create([
                "order_id"          => (int)$order_id,
                "shipping_id"       => $shipping_id,
                "payment_type"      => $request->payment_type,
                "payment_status"    => $request->payment_status,
                "payment_key"       => $request->payment_key,
                "order_details"     => $request->order_details,
                "customer_id"       => Auth::id()
            ]);

            if ($order) {

                Shipping::where('id', $shipping_id)->update([ 'order_id' => (int)$order_id]);

                $request->session()->forget('shipping_id');
                Cart::destroy();

                return redirect('/');

            } else {

                return back();
            }

        } else {

            return back();
        }

    }
}
