<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('post/show', compact('post'));
    }
}
