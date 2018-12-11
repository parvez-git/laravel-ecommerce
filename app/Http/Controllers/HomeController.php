<?php

namespace App\Http\Controllers;

use App\Order;
use App\Shipping;
use App\OrderItem;
use Illuminate\Http\Request;

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
    
    public function orderDetails($orderid)
    {
        $orderdetails = OrderItem::select('order_items.*', 'shippings.*', 'products.name', 'products.image')
                        ->join('products', 'order_items.product_id', '=', 'products.id')
                        ->join('shippings', 'order_items.order_id', '=', 'shippings.order_id')
                        ->where('order_items.order_id',$orderid)
                        ->get();

        return view('orderdetails', compact('orderdetails'));
    }
}
