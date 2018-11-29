<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function index()
    {
        $products = Cart::content();

        if(Cart::count()) {

            return view('cart', compact('products'));

        } else {

            return redirect('/');
        }

    }


    public function store(Request $request)
    {
        Cart::add([
            'id'        => $request->input('id'), 
            'name'      => $request->input('name'), 
            'qty'       => $request->input('qty'), 
            'price'     => $request->input('price'), 
            'options'   => ['image' => $request->input('image')]
        ]);

        return back();
    }


    public function update(Request $request, $id)
    {
        Cart::update($id, $request->qty);

        return back();
    }


    public function destroy($id)
    {
        Cart::remove($id);

        return back();
    }   


    public function deleteAll()
    {
        Cart::destroy();

        return back();
    }

    public function show($id){}

}
