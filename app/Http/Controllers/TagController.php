<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController
{
    public function __invoke($tag_id)
    {
        $tag = Tag::find($tag_id);
        return view('tag/show', compact('tag'));
    }
}
