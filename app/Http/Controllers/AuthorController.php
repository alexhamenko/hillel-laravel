<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class AuthorController
{
    /**
     * Display listing of authors.
     *
     * @return View
     */
    public function index(): View
    {
        $authors = User::with(['posts.category', 'posts.tags', 'posts' => function ($query) {
            $query->latest()->limit(3);
        }])->paginate(5);
        return view('author/index', compact('authors'));
    }

    /**
     * Display author with specified id.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $author = User::find($id);
        return view('author/show', compact('author'));
    }

    /**
     * Display posts belongs to author and category with specified id's.
     *
     * @param int $author_id
     * @param int $category_id
     * @return View
     */
    public function showCategory(int $author_id, int $category_id): View
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

    /**
     * Display posts belongs to author, category and tag with specified id's.
     *
     * @param int $author_id
     * @param int $category_id
     * @param int $tag_id
     * @return View
     */
    public function showCategoryTag(int $author_id, int $category_id, int $tag_id): View
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

        return view('author/show-category-tag', compact('author', 'category', 'tag', 'posts'));
    }
}

