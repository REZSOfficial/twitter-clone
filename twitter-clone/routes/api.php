<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostlikeController;
use App\Http\Controllers\PostcommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/posts/like/{id}', [PostlikeController::class, 'add_like']);
Route::delete('/posts/removelike/{id}', [PostlikeController::class, 'remove_like']);
Route::post('/posts/comment/{id}', [PostcommentController::class, 'save']);
