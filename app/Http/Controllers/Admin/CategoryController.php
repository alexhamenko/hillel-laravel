<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController
{
    /**
     * Display listing of categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::with(['posts'])->paginate(10);
        $defaultCategoryId = Category::getDefaultCategoryId();

        return view('admin/category/index', compact('categories', 'defaultCategoryId'));
    }

    /**
     * Display category with specified id.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $category = Category::find($id);

        return view('admin/category/show', compact('category'));
    }

    /**
     * Display form for creating new category
     *
     * @return View
     */
    public function create(): View
    {
        $category = new Category();
        $posts = Post::all();

        return view('admin/category/form', compact('category', 'posts'));
    }

    /**
     * Validate the request to create category with specified id. Create the category in storage if validation was successful
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

        $category = Category::create($request->all());

        foreach ($request->input('posts') as $post_id) {
            $post = Post::find($post_id);
            $post->category_id = $category->id;
            $post->save();
        }

        return redirect()->route('admin.category');
    }

    /**
     * Display form for updating category with specified id
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $category = Category::find($id);
        $posts = Post::all();
        return view('admin/category/form-edit', compact('category', 'posts'));
    }

    /**
     * Validate the request to update category with specified id. Update the category in storage if validation was successful
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
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

    /**
     * Detach category with specified id from post with specified post_id.
     *
     * @param int $id
     * @param int $post_id
     * @return RedirectResponse
     */
    public function detachpost(int $id, int $post_id): RedirectResponse
    {
        $category = Category::find($id);
        $defaultCategoryId = Category::getDefaultCategoryId();
        $category->posts()->where('id', $post_id)->update(['category_id' => $defaultCategoryId]);
        return redirect()->route('admin.category');
    }

    /**
     * Remove category with specified id from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category');
    }
}
