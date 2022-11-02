<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', HomeController::class)->name('posts');
Route::get('/category/{category}', CategoryController::class)->name('posts.by_category');
Route::get('/tag/{tag}', TagController::class)->name('posts.by_tag');
Route::get('/author/{author}/category/{category}/tag/{tag}', [AuthorController::class, 'showCategoryTag'])->name('posts.by_author.by_category.by_tag');
Route::get('/author/{author}/category/{category}', [AuthorController::class, 'showCategory'])->name('posts.by_author.by_category');
Route::get('/author/{author}', [AuthorController::class, 'show'])->name('posts.by_author');
