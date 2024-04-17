<?php

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostlikeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Posts
Route::get('/posts/create', [PostController::class, 'create'])->name('createPost');
Route::post('/posts/save', [PostController::class, 'save'])->name('savePost');

//Users
Route::get('/user/{id}', [UserController::class, 'view'])->name('viewUser');
