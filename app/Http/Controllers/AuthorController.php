<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class AuthorController
{
    public function show($author_id)
    {
        $author = User::find($author_id);

        return view('author/show', compact('author'));
    }

    public function showCategory($author_id, $category_id)
    {
        $author = User::find($author_id);
        $category = Category::find($category_id);

        $posts = Post::whereHas('user', function (Builder $query) use ($author_id) {
            $query->where('user_id', $author_id);
        })->whereHas('category', function (Builder $query) use ($category_id) {
            $query->where('category_id', $category_id);
        })->get();

        return view('author/show-category', compact('author', 'category', 'posts'));
    }
}
