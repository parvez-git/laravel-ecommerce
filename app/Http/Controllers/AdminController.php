<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        $orders = Order::latest()->get();

        return view('admin', compact('orders'));
    }

    public function paymentStatusUpdate($orderid)
    {
        $order = Order::where('order_id', $orderid)->first();

        $order->update(['payment_status' => 1]);

        return back();
    }
}
