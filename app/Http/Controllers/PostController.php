<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $posts = Post::with(['tags', 'category'])->paginate(10);

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
        $post = Post::with(['comments', 'comments.user'])->find($id);

        return view('post/show', compact('post'));
    }

    /**
     * Process the comment added to the post
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

        $post = Post::find($id);
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id();
        $post->comments()->save($comment);

        return redirect()->route('post.show', ['id' => $post->id]);
    }
}
