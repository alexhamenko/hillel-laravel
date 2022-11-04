<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

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

    public function create()
    {
        $tag = new Tag();
        $posts = Post::all();

        return view('tag/form', compact('tag', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'slug' => [
                'required',
                'min:3',
                'alpha_num',
            ],
            'posts' => [
                'required',
                'exists:App\Models\Post,id'
            ]
        ]);

        $tag = Tag::create($request->all());
        $tag->posts()->attach($request->input('posts'));

        return redirect()->route('admin.tag');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        $posts = Post::all();
        return view('tag/form-edit', compact('tag', 'posts'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tag = Tag::find($id);
        $request->validate([
            'title' => ['required', 'min:3'],
            'slug' => [
                'required',
                'min:3',
                'alpha_num',
            ],
            'posts' => [
                'required',
                'exists:App\Models\Post,id'
            ]
        ]);

        $tag->update($request->all());
        $tag->posts()->sync($request->input('posts'));

        return redirect()->route('admin.tag');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tag');
    }
}
