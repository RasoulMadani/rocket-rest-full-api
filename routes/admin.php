<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login',LoginController::class);
Route::apiResource('user',UserController::class);
Route::apiResource('article',ArticleController::class)->only('index');