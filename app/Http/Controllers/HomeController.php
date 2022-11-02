<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController
{
    public function __invoke()
    {
        $posts = Post::paginate(10);

        return view('post/index', compact('posts'));
    }
}
