<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetCurrentUserController extends Controller
{
    public function __invoke()
    {
        return ApiResponse::withAppends([
            'token' => auth()->user()->currentAccessToken()
        ])->build()->response2();
    }
    
}
