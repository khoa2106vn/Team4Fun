<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [PostController::class, 'index'])->name('posts');
Route::post('/', [PostController::class, 'store']);
Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/{post}/', [CommentController::class, 'index'])->name('comments');
Route::post('/posts/{post}/', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/{comment}/', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

