<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController
{
    /**
     * Display listing of posts.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::paginate(10);

        return view('post.index', compact('posts'));
    }

    /**
     * Display post with specified id.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $post = Post::find($id);

        return view('post/show', compact('post'));
    }
}
