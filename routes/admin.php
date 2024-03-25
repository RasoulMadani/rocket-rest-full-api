<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AssignRolesToUserController;
use App\Http\Controllers\Admin\GetCurrentUserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login', LoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('current-user',GetCurrentUserController::class);
    Route::delete('logout',LogoutController::class);
    
    Route::apiResource('user', UserController::class);
    Route::post('user/{user}/assign-roles',AssignRolesToUserController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('article', ArticleController::class)->only('index');
});
