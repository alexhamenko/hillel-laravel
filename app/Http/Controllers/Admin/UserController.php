<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController
{
    /**
     * Display admin panel
     *
     * @return View
     */
    public function show(): View
    {
        $user = Auth::user();
        $posts = $user->posts()->with(['category', 'tags'])->paginate(3, ['*'], 'posts');
        $comments = $user->comments()->with(['commentable'])->paginate(3, ['*'], 'comments');
        return view('admin/user/show', compact('user', 'posts', 'comments'));
    }
}
