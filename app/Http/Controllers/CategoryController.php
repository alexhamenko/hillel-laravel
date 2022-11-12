<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController
{

    public function index()
    {
        $categories = Category::paginate(5);

        return view('category/index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('category/show', compact('category'));
    }
}
