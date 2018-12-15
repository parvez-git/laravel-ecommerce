<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth:api','admin:api'])->except('index','show');
    }
    

    public function index()
    {
        return ProductCollection::collection(Product::paginate());
    }


    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name        = $request->name;
        $product->slug        = str_slug($request->name);
        $product->price       = $request->price;
        $product->image       = $request->image;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->save();

        return response([
            'message' => 'Product created successfully.'
        ],201);
    }


    public function show($id)
    {
        return new ProductResource(Product::find($id));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response([
            'message' => 'Product updated successfully.'
        ],201);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response([
            'message' => 'Product deleted successfully.'
        ],204);
    }
}
