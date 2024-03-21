<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\ApiResponseBuilder;
use App\Controlresponse\Facades\ApiResponse;
use App\Controlresponse\Response1;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UsersDetailsApiResource;
use App\Http\Resources\Admin\User\UsersListApiResource;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersQuery = User::query();
        if (request()->has('email'))
            $usersQuery = $usersQuery->whereEmail(request()->email);

        $users = $usersQuery->paginate();
        return UsersListApiResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'first_name' => ['required', 'string', 'min:1', 'max:255'],
                    'last_name' => ['required', 'string', 'min:1', 'max:255'],
                    'email' => ['required', 'email', 'unique:users,email'],
                    'password' => ['required', 'string', 'min:8', 'max:255'],
                ]
            );
            if ($validator->fails())
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);

            $inputs = $validator->validated();
            $inputs['password'] = Hash::make($inputs['password']);


            $user = User::create(
                $inputs
            );
        } catch (\Throwable $th) {
            // دریافت خطا در تلسکوپ
            app()[ExceptionHandler::class]->report($th);

            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();   
        }
        return ApiResponse::withMessage('User created successfully')->withData($user)->build()->response2();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UsersDetailsApiResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'first_name' => ['required', 'string', 'min:1', 'max:255'],
                    'last_name' => ['required', 'string', 'min:1', 'max:255'],
                    // در اینجا می گوییم که برای به روزرسانی یکتا بودن کاربر فعلی رو بررسی نکن
                    'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                    'password' => ['nullable', 'string', 'min:8', 'max:255'],
                ]
            );
            if ($validator->fails())
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);

            $inputs = $validator->validated();
            if (isset($inputs['password']))
                $inputs['password'] = Hash::make($inputs['password']);


            $user->update($inputs);
        } catch (\Throwable $th) {
            // دریافت خطا در تلسکوپ
            app()[ExceptionHandler::class]->report($th);

            return response()->json([
                'message' => 'something went wrong'
            ], 500);
        }


        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Throwable $th) {
            // دریافت خطا در تلسکوپ
            app()[ExceptionHandler::class]->report($th);

            return response()->json([
                'message' => 'something went wrong'
            ], 500);
        }


        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
   
}
