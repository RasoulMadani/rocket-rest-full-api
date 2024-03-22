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
use App\Http\Resources\UsersListApiResourceCollection;
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
        return ApiResponse::withData(new UsersListApiResourceCollection($result->data))->build()->response2();
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
        $result = $this->service->getUserInfo($user);


        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();
        /**
         * اگر 
         * ->resource
         * را بعد از کالکشن بزنیم باعث می شود داده های مربوط به صفحه بندی را هم برگرداند
         */
        return ApiResponse::withData(new UsersDetailsApiResource($result->data))->build()->response2();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateApiRequest $request, User $user)
    {
        $result = $this->service->updateUser($request->validated(), $user);


        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();

        return ApiResponse::withMessage('User updated successfully')->withData($result->data)->build()->response2();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result = $this->service->deleteUser($user);

        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();

        return ApiResponse::withMessage('User deleted successfully')->build()->response2();
    }
}
