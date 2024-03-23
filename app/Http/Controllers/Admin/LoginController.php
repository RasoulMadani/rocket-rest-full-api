<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\Facades\ApiResponse;
use App\Http\ApiRequests\Admin\Auth\LoginApiRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(LoginApiRequest $request){
        if(!auth()->attempt($request->validated()))
            // __('auth.failed') این قسمت می ره از فایل های زبان لاراول متن مربوط به این قسمت را می آورد
            return ApiResponse::withMessage(__('auth.failed'))->withStatus(401)->build()->response2();
        $user = auth()->user();
        $token = $user->createToken('API TOKEN')->plainTextToken;

        return ApiResponse::withAppends([
            'name'=> $user->full_name,
            'token' => $token
        ])->build()->response2();
    }
}
