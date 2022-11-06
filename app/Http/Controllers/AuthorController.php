<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class AuthorController
{
    public function show($id)
    {
        $author = User::find($id);
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

    public function showCategoryTag($author_id, $category_id, $tag_id)
    {
        $author = User::find($author_id);
        $category = Category::find($category_id);
        $tag = Tag::find($tag_id);

        $posts = Post::whereHas('user', function (Builder $query) use ($author_id) {
            $query->where('user_id', $author_id);
        })->whereHas('category', function (Builder $query) use ($category_id) {
            $query->where('category_id', $category_id);
        })->whereHas('tags', function (Builder $query) use ($tag_id) {
            $query->where('tag_id', $tag_id);
        })->get();

        return view('author/show-category-tag', compact('author', 'category','tag', 'posts'));
    }
}

