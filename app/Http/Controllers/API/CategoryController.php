<?php

namespace App\Http\Controllers\API;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function products($id)
    {
        return new CategoryResource(Category::find($id));
    }
}
