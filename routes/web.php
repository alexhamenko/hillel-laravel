<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Paid\FunctionalityController as PaidFunctionalityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController;
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
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/login', [AuthController::class, 'handleLogin'])->name('auth.handle.login');
    });
});

Route::prefix('author')->group(function () {
    Route::get('/{author}/category/{category}/tag/{tag}', [AuthorController::class, 'showCategoryTag'])->name('author.category.tag.show');
    Route::get('/{author}/category/{category}', [AuthorController::class, 'showCategory'])->name('author.category.show');
    Route::get('/{id}/', [AuthorController::class, 'show'])->name('author.show');
    Route::get('/', [AuthorController::class, 'index'])->name('author');
});

Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::get('/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::post('/comment/{id}', [PostController::class, 'addComment'])->name('post.add.comment');
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category');
    Route::get('/{id}/show', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/comment/{id}', [CategoryController::class, 'addComment'])->name('category.add.comment');
});

Route::prefix('tag')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('tag');
    Route::get('/{id}/show', [TagController::class, 'show'])->name('tag.show');
    Route::post('/comment/{id}', [TagController::class, 'addComment'])->name('tag.add.comment');
});

Route::middleware('auth')->group(function() {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('admin')->middleware('can:access-admin-panel')->group(function () {
        Route::get('/', PanelController::class)->name('admin.panel');

        Route::get('/user/{id}/show', [UserController::class, 'show'])->name('admin.user.show');

        Route::prefix('comment')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('admin.comment');
            Route::get('/{id}/delete', [CommentController::class, 'destroy'])->name('admin.comment.delete');
        });
        Route::prefix('post')->group(function () {
            Route::get('/', [AdminPostController::class, 'index'])->name('admin.post');
            Route::get('/{id}/show', [AdminPostController::class, 'show'])->name('admin.post.show');
            Route::get('/create', [AdminPostController::class, 'create'])->name('admin.post.create');
            Route::post('/store', [AdminPostController::class, 'store'])->name('admin.post.store');
            Route::get('/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
            Route::post('/update', [AdminPostController::class, 'update'])->name('admin.post.update');
            Route::get('/{id}/delete', [AdminPostController::class, 'destroy'])->name('admin.post.delete');
        });

        Route::prefix('category')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
            Route::get('/{id}/show', [AdminCategoryController::class, 'show'])->name('admin.category.show');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
            Route::post('/update', [AdminCategoryController::class, 'update'])->name('admin.category.update');
            Route::get('/{id}/detachpost/{post_id}', [AdminCategoryController::class, 'detachpost'])->name('admin.category.detachpost');
            Route::get('/{id}/delete', [AdminCategoryController::class, 'destroy'])->name('admin.category.delete');
        });

        Route::prefix('tag')->group(function () {
            Route::get('/', [AdminTagController::class, 'index'])->name('admin.tag');
            Route::get('/{id}/show', [AdminTagController::class, 'show'])->name('admin.tag.show');
            Route::get('/create', [AdminTagController::class, 'create'])->name('admin.tag.create');
            Route::post('/store', [AdminTagController::class, 'store'])->name('admin.tag.store');
            Route::get('/{id}/edit', [AdminTagController::class, 'edit'])->name('admin.tag.edit');
            Route::post('/update', [AdminTagController::class, 'update'])->name('admin.tag.update');
            Route::get('/{id}/delete', [AdminTagController::class, 'destroy'])->name('admin.tag.delete');
        });
    });


    Route::prefix('paid')->middleware('can:access-paid-functionality')->group(function () {
        Route::get('/', PaidFunctionalityController::class)->name('paid.functionality');
    });
});
