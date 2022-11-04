<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::get('/', HomeController::class)->name('home');
//Route::get('/category/{category}', CategoryController::class)->name('posts.by_category');
//Route::get('/tag/{tag}', TagController::class)->name('posts.by_tag');
//Route::get('/author/{author}/category/{category}/tag/{tag}', [AuthorController::class, 'showCategoryTag'])->name('posts.by_author.by_category.by_tag');
//Route::get('/author/{author}/category/{category}', [AuthorController::class, 'showCategory'])->name('posts.by_author.by_category');
Route::get('/author/{id}/', [AuthorController::class, 'show'])->name('admin.author.show');

Route::get('/post', [PostController::class, 'index'])->name('admin.post');
Route::get('/post/{id}/show', [PostController::class, 'show'])->name('admin.post.show');
Route::get('/post/create', [PostController::class, 'create'])->name('admin.post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('admin.post.store');
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
Route::post('/post/update', [PostController::class, 'update'])->name('admin.post.update');
Route::get('/post/{id}/delete', [PostController::class, 'destroy'])->name('admin.post.delete');

Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/category/{id}/show', [CategoryController::class, 'show'])->name('admin.category.show');
Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::post('/category/update', [CategoryController::class, 'update'])->name('admin.category.update');
Route::get('/category/{id}/detachpost/{post_id}', [CategoryController::class, 'detachpost'])->name('admin.category.detachpost');
Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');

Route::get('/tag', [TagController::class, 'index'])->name('admin.tag');
Route::get('/tag/{id}/show', [TagController::class, 'show'])->name('admin.tag.show');
Route::get('/tag/create', [TagController::class, 'create'])->name('admin.tag.create');
Route::post('/tag/store', [TagController::class, 'store'])->name('admin.tag.store');
Route::get('/tag/{id}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
Route::post('/tag/update', [TagController::class, 'update'])->name('admin.tag.update');
Route::get('/tag/{id}/delete', [TagController::class, 'destroy'])->name('admin.tag.delete');
