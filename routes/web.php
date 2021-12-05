<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [PostController::class, 'index'])->name('posts');

Route::get('/posts/show/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/', [PostController::class, 'store']);
Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/{post}', [CommentController::class, 'index'])->name('comments');
Route::post('/posts{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/{comment}/', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::patch('/posts/{id}', [PostController::class, 'edit'])->name('post.edit');

Route::post('/users', [PostController::class, 'storeAvatar'])->name('post.avatar');

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/register/child', [RegisterController::class, 'index_child'])->name('register.child');
Route::get('/register/parent', [RegisterController::class, 'index_parent'])->name('register.parent');
Route::post('/register/parent', [RegisterController::class, 'store'])->name('register.parent_account');
Route::post('/register/child', [RegisterController::class, 'store_child'])->name('register.child_account');

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback');

