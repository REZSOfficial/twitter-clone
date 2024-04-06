<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Posts
Route::get('/posts/{id}', [PostController::class, 'view'])->name('viewPost');
Route::get('/posts/create', [PostController::class, 'create'])->name('createPost');
Route::post('/posts/save', [PostController::class, 'save'])->name('savePost');
