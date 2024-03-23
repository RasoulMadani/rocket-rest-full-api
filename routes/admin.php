<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GetCurrentUserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login', LoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('current-user',GetCurrentUserController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('article', ArticleController::class)->only('index');
});
