<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display listing of posts.
     *
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::with(['tags', 'category', 'user'])->paginate(10);

        return view('admin/post/index', compact('posts'));
    }

    /**
     * Display post with specified id.
     *
     * @param int $id
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(int $id): View
    {
        $post = Post::find($id);
        $this->authorize('view', $post);
        return view('admin/post/show', compact('post'));
    }

    /**
     * Display form for creating new post
     *
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', Post::class);
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin/post/form', compact('post', 'categories', 'tags'));
    }

    /**
     * Validate the request to create post with specified id. Create the post in storage if validation was successful
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Post::class);
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

    /**
     * Display form for updating post with specified id
     *
     * @param int $id
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(int $id): View
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin/post/form-edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Validate the request to update post with specified id. Update the post in storage if validation was successful
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $post = Post::find($id);
        $this->authorize('update', $post);
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

    /**
     * Remove post with specified id from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->tags()->detach();
        $post->delete();
        return redirect()->back();
    }
}
