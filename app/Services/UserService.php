<?php 

namespace App\Services;

use App\Base\ServiceResult;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function registerUser(array $inputs):ServiceResult
    {
        try {
            $inputs['password'] = Hash::make($inputs['password']);

            $user = User::create($inputs);

        } catch (\Throwable $th) {
             // دریافت خطا در تلسکوپ
             app()[ExceptionHandler::class]->report($th);

             return new ServiceResult(false,$th->getMessage());
        }

        return new ServiceResult(false,$user);
    }
}