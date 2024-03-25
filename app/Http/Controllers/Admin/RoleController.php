<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\Facades\ApiResponse;
use App\Http\ApiRequests\Admin\Role\RoleStoreApiRequest;
use App\Http\ApiRequests\Admin\Role\RoleUpdateApiRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(public RoleService $roleService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreApiRequest $request)
    {
        $result = $this->roleService->addNewRole($request->validated());


        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();

        return ApiResponse::withMessage('Role created successfully')->withData($result->data)->build()->response2();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateApiRequest $request, Role $role)
    {
        $result = $this->roleService->updateRole($request->validated(),$role);


        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();

        return ApiResponse::withMessage('Role updated successfully')->withData($result->data)->build()->response2();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
