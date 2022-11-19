<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController
{
    /**
     * Display listing of comments.
     *
     * @return View
     */
    public function index(): View
    {
        $comments = Comment::with(['user', 'commentable'])->paginate(10);

        return view('admin/comment/index', compact('comments'));
    }

    /**
     * Remove comments with specified id from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Comment::find($id);
        $category->delete();
        return redirect()->route('admin.comment');
    }
}
