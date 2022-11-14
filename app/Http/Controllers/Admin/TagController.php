<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $tags = Tag::with(['posts'])->paginate(10);

        return view('admin/tag/index', compact('tags'));
    }

    /**
     * Display tag with specified id.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $tag = Tag::find($id);
        return view('admin/tag/show', compact('tag'));
    }

    /**
     * Display form for creating new tag
     *
     * @return View
     */
    public function create(): View
    {
        $tag = new Tag();
        $posts = Post::all();

        return view('admin/tag/form', compact('tag', 'posts'));
    }

    /**
     * Validate the request to create tag with specified id. Create the tag in storage if validation was successful
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

    /**
     * Display form for updating tag with specified id
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $tag = Tag::find($id);
        $posts = Post::all();
        return view('admin/tag/form-edit', compact('tag', 'posts'));
    }

    /**
     * Validate the request to update tag with specified id. Update the tag in storage if validation was successful
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
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

    /**
     * Remove tag with specified id from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tag');
    }
}
