<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController
{
    public function __invoke($category_id)
    {
        $category = Category::find($category_id);

        return view('category/show', compact('category'));
    }
}
