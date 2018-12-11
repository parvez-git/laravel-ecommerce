<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->get(); 

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::get();

        return view('admin.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:3|max:255|unique:products',
            'price'         => 'required',
            'image'         => 'required|image',
            'category_id'   => 'required|numeric',
            'description'   => 'required'
        ]);

        $name = $request->name;
        $slug = str_slug($name);

        if ($request->hasFile('image')) {
            $imageName = 'product-'.time().uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }

        Product::create([
            'name'          => $name,
            'slug'          => $slug,
            'image'         => $imageName,
            'price'         => $request->price,
            'category_id'   => $request->category_id,
            'description'   => $request->description
        ]);

        return redirect()->route('product.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::get();

        return view('admin.products.edit', compact('product','categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|min:3|max:255',
            'price'         => 'required',
            'image'         => 'image',
            'category_id'   => 'required|numeric',
            'description'   => 'required'
        ]);

        $name = $request->name;
        $slug = str_slug($name);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if(file_exists(public_path('images/') . $product->image)){
                unlink(public_path('images/') . $product->image);
            }
            $imageName = 'product-'.time().uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = $product->image;
        }

        $product->update([
            'name'          => $name,
            'slug'          => $slug,
            'image'         => $imageName,
            'price'         => $request->price,
            'category_id'   => $request->category_id,
            'description'   => $request->description
        ]);

        return redirect()->route('product.index');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if(file_exists(public_path('images/') . $product->image)){
            unlink(public_path('images/') . $product->image);
        }

        $product->delete(); 

        return back();
    }
}
