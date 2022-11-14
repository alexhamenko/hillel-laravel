<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class TagController
{
    /**
     * Display listing of tags.
     *
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::with(['posts.category', 'posts.tags', 'posts.user', 'posts' => function ($query) {
            $query->latest()->limit(3);
        }])->paginate(5);

        return view('tag/index', compact('tags'));
    }

    /**
     * Display tag with specified id.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $tag = Tag::with(['posts.category', 'posts.tags', 'posts.user'])->find($id);
        return view('tag/show', compact('tag'));
    }
}
