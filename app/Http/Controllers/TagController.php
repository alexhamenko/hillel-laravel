<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $tag = Tag::find($id);
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id();
        $tag->comments()->save($comment);

        return redirect()->route('tag.show', ['id' => $tag->id]);
    }
}
