<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Shipping;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$orders = Order::latest()->where('customer_id', auth()->id())->get();

        return view('home', compact('orders'));
    }

    public function shippingInfo()
    {
    	$shippinginfo = Shipping::latest()->where('email', auth()->user()->email)->first();

        return view('shipping-info-home', compact('shippinginfo'));
    }



    // ADMIN AREA ================================

    public function admin()
    {
        $orders = Order::latest()->where('customer_id', auth()->id())->get();

        return view('admin', compact('orders'));
    }
}
