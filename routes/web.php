<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index'])->name('feed');
Route::resource('posts', PostsController::class)->except('index');

Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/{user}/profile', [UsersController::class, 'show'])->middleware('auth')->name('users.show');
Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');


Route::get('/login', function () {
    return view('Pages.login');
})->middleware('guest');

Route::get('/signup', function () {
    return view('Pages.sign-up');
})->middleware('guest');


Route::post('/register', [AuthController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
