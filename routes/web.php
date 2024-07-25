<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Pages.feed');
})->name('feed');

Route::get('/foryou', function () {
    return view('Pages.foryou');
})->name('foryou');

Route::get('/terms', function () {
    return view('Pages.terms');
})->name('terms');

Route::get('/settings', function () {
    return view('Pages.settings');
})->name('settings');


Route::resource('posts', PostsController::class)->only('show');

Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/users/{user}', [UsersController::class, 'show'])->middleware('auth')->name('users.show');
Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::patch('/users/{user}', [UsersController::class, 'update'])->name('users.update');

Route::post('/users/{user}/follow', [UsersController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::delete('/users/{user}/unfollow', [UsersController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::get('/login', function () {
    return view('Pages.login');
})->middleware('guest')->name('login');

Route::get('/signup', function () {
    return view('Pages.sign-up');
})->middleware('guest')->name('signup');


Route::post('/register', [AuthController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
