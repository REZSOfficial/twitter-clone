<?php

use App\Http\Controllers\FollowController;
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

//Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/followed', [HomeController::class, 'followed'])->name('homeFollowed');

//Posts
Route::get('/posts/create', [PostController::class, 'create'])->name('createPost');
Route::post('/posts/save', [PostController::class, 'save'])->name('savePost');
Route::post('/posts/delete/{id}', [PostController::class, 'delete'])->name('deletePost');

//Users
Route::get('/user/{id}', [UserController::class, 'view'])->name('viewUser');
Route::post('/user/upadteProfilePicture/{id}', [UserController::class, 'updateProfilePicture'])->name('updateProfilePicture');

//Follow
Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
