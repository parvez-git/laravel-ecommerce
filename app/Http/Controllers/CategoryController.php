<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::get();

        return view('admin.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255|unique:categories'
        ]);

        $name = $request->name;
        $slug = str_slug($name);

        Category::create([
            'name' => $name,
            'slug' => $slug
        ]);

        return back();
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('admin.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('category.index');
    }


    public function destroy(Category $category)
    {
        //
    }
}
