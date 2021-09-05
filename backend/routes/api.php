<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});
