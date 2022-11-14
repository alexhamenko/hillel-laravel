<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController
{
    /**
     * Display listing of categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::with(['posts.tags', 'posts' => function ($query) {
            $query->latest()->limit(2);
        }])->paginate(5);

        return view('category/index', compact('categories'));
    }

    /**
     * Display category with specified id.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $category = Category::find($id);

        return view('category/show', compact('category'));
    }
}
