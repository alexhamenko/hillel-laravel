<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController
{
    public function index()
    {
        $tags = Tag::paginate(5);

        return view('tag/index', compact('tags'));
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tag/show', compact('tag'));
    }
}
