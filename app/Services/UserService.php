<?php 

namespace App\Services;

use App\Base\ServiceResult;
use App\Base\ServiceWrapper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers(array $inputs=null):ServiceResult
    {
        return app(ServiceWrapper::class)(function() use($inputs){
            return User::paginate();
        });
    }
    public function registerUser(array $inputs):ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['password'] = Hash::make($inputs['password']);
            return User::create($inputs);
        });
      

    }
}