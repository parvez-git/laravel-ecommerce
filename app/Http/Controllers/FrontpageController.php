<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontpageController extends Controller
{
    public function index()
    {
    	$products = Product::all();

    	return view('products',compact('products'));
    }

}
