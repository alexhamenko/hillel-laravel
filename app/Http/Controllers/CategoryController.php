<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $category = Category::with(['posts.tags', 'comments.user'])->find($id);

        return view('category/show', compact('category'));
    }

    /**
     * Process the comment added to the tag
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function addComment(Request $request, int $id)
    {
        $request->validate([
            'body' => [
                'required',
                'min:5'
            ],
        ]);

        $category = Category::find($id);
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id();
        $category->comments()->save($comment);

        return redirect()->route('category.show', ['id' => $category->id]);
    }
}
