<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\ApiResponseBuilder;
use App\Controlresponse\Facades\ApiResponse;
use App\Controlresponse\Response1;
use App\Http\ApiRequests\Admin\User\UserStoreApiRequest;
use App\Http\ApiRequests\Admin\User\UserUpdateApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UsersDetailsApiResource;
use App\Http\Resources\Admin\User\UsersListApiResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    private UserService $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = $this->service->getAllUsers($request->all);


        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();
        /**
         * اگر 
         * ->resource
         * را بعد از کالکشن بزنیم باعث می شود داده های مربوط به صفحه بندی را هم برگرداند
         */
        return ApiResponse::withData(UsersListApiResource::collection($result->data)->resource)->build()->response2();
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreApiRequest $request)
    {

        $result = $this->service->registerUser($request->validated());


        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();

        return ApiResponse::withMessage('User created successfully')->withData($result->data)->build()->response2();
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
    public function update(UserUpdateApiRequest $request, User $user)
    {
        try {

            $inputs = $request->validated();
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
