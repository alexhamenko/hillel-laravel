<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin/post/index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('admin/post/show', compact('post'));
    }

    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin/post/form', compact('post', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'min:3',
                'unique:posts,title',
            ],
            'body' => ['required'],
            'category_id' => [
                'required',
                'exists:App\Models\Category,id'
            ],
            'tags' => [
                'required',
                'exists:App\Models\Tag,id'
            ]
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $post = Post::create($data);
        $post->tags()->attach($request->input('tags'));

        return redirect()->route('admin.post');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin/post/form-edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $post = Post::find($id);
        $request->validate([
            'title' => [
                'required',
                'min:3',
                Rule::unique('posts', 'title')->ignore($post->id),
            ],
            'body' => ['required'],
            'category_id' => [
                'required',
                'exists:App\Models\Category,id'
            ],
            'tags' => [
                'required',
                'exists:App\Models\Tag,id'
            ]
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $post->update($data);
        $post->tags()->sync($request->input('tags'));

        return redirect()->route('admin.post');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.post');
    }
}