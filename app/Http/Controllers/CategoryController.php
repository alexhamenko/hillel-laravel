<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController
{

    public function index()
    {
        $categories = Category::paginate(5);

        return view('category/index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('category/show', compact('category'));
    }

    public function create()
    {
        $category = new Category();
        $posts = Post::all();

        return view('category/form', compact('category', 'posts'));
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

        $category = Category::create($request->all());

        foreach ($request->input('posts') as $post_id) {
            $post = Post::find($post_id);
            $post->category_id = $category->id;
            $post->save();
        }

        return redirect()->route('admin.category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $posts = Post::all();
        return view('category/form-edit', compact('category', 'posts'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $category = Category::find($id);

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

        $category->update($request->all());
        foreach ($request->input('posts') as $post_id) {
            $post = Post::find($post_id);
            $post->category_id = $category->id;
            $post->save();
        }

        return redirect()->route('admin.category');
    }

    public function detachpost($id, $post_id)
    {
        $category = Category::find($id);
        $category->posts()->where('id', $post_id)->update(['category_id' => 1]);
        return redirect()->route('admin.category');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category');
    }
}
