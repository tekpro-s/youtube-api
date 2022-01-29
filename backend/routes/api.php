<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GenresController;

Route::prefix('v1')->group(function () {
    Route::post('/users/registration', [RegistrationController::class, 'post']);
    Route::post('/users/login', [LoginController::class, 'post']);
    Route::post('/users/logout', [LogoutController::class, 'post']);

    Route::get('/users/{user_id}', [UsersController::class, 'get']);

    Route::get('/videos', [VideosController::class, 'index']);
    Route::post('/videos', [VideosController::class, 'post']);
    Route::get('/videos/{video_id}', [VideosController::class, 'get']);
    Route::put('/videos/{video_id}', [VideosController::class, 'put']);

    Route::get('/likes', [LikesController::class, 'index']);
    Route::put('/videos/{video_id}/likes', [LikesController::class, 'put']);
    Route::delete('/videos/{video_id}/likes', [LikesController::class, 'delete']);
    Route::get('/users/{user_id}/likes', [LikesController::class, 'get']);

    Route::get('/genres', [GenresController::class, 'index']);

    Route::post('/videos/{video_id}/comments', [CommentsController::class, 'post']);
    Route::put('/videos/{video_id}/comments', [CommentsController::class, 'put']);
    Route::delete('/videos/{video_id}/comments', [CommentsController::class, 'delete']);
    Route::get('/comments/{video_id}', [CommentsController::class, 'get']);
});
