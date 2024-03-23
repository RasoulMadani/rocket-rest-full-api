<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->user()->currentAccessToken()->delete();
        return ApiResponse::withMessage('logout successfully')->build()->response2();
    }
}
