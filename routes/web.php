<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/language/{locale}', LocalizationController::class);
Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function() {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/auth/login', [AuthController::class, 'handleLogin'])->name('auth.handle.login');
});

Route::get('/author/{author}/category/{category}/tag/{tag}', [AuthorController::class, 'showCategoryTag'])->name('author.category.tag.show');
Route::get('/author/{author}/category/{category}', [AuthorController::class, 'showCategory'])->name('author.category.show');
Route::get('/author/{id}/', [AuthorController::class, 'show'])->name('author.show');
Route::get('/author', [AuthorController::class, 'index'])->name('author');

Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/{id}/show', [CategoryController::class, 'show'])->name('category.show');

Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::get('/tag/{id}/show', [TagController::class, 'show'])->name('tag.show');

Route::middleware('auth')->group(function() {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/admin', [PanelController::class, 'index'])->name('admin.panel');

    Route::get('/admin/post', [AdminPostController::class, 'index'])->name('admin.post');
    Route::get('/admin/post/{id}/show', [AdminPostController::class, 'show'])->name('admin.post.show');
    Route::get('/admin/post/create', [AdminPostController::class, 'create'])->name('admin.post.create');
    Route::post('/admin/post/store', [AdminPostController::class, 'store'])->name('admin.post.store');
    Route::get('/admin/post/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
    Route::post('/admin/post/update', [AdminPostController::class, 'update'])->name('admin.post.update');
    Route::get('/admin/post/{id}/delete', [AdminPostController::class, 'destroy'])->name('admin.post.delete');

    Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/{id}/show', [AdminCategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/update', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/admin/category/{id}/detachpost/{post_id}', [AdminCategoryController::class, 'detachpost'])->name('admin.category.detachpost');
    Route::get('/admin/category/{id}/delete', [AdminCategoryController::class, 'destroy'])->name('admin.category.delete');

    Route::get('/admin/tag', [AdminTagController::class, 'index'])->name('admin.tag');
    Route::get('/admin/tag/{id}/show', [AdminTagController::class, 'show'])->name('admin.tag.show');
    Route::get('/admin/tag/create', [AdminTagController::class, 'create'])->name('admin.tag.create');
    Route::post('/admin/tag/store', [AdminTagController::class, 'store'])->name('admin.tag.store');
    Route::get('/admin/tag/{id}/edit', [AdminTagController::class, 'edit'])->name('admin.tag.edit');
    Route::post('/admin/tag/update', [AdminTagController::class, 'update'])->name('admin.tag.update');
    Route::get('/admin/tag/{id}/delete', [AdminTagController::class, 'destroy'])->name('admin.tag.delete');
});
