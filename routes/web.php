<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/removeOld', [PostController::class, 'removeOldPosts']);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route::get('/posts/{post}/comment', [commentController::class, 'create'])->name('comments.create');
Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comments.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
