<?php

namespace App\Http\Controllers\Admin;

use App\Controlresponse\Facades\ApiResponse;
use App\Http\ApiRequests\Admin\AccessLevel\AssingRolesToUserApiRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AccessLevelService;
use Illuminate\Http\Request;

class AssignRolesToUserController extends Controller
{
    public function __construct(public AccessLevelService $service )
    {
        
    }
    public function __invoke(AssingRolesToUserApiRequest $request,User $user)
    {
        $result = $this->service->assignRolesToUser($user,$request->validated()['roles']);

        if (!$result->ok)
            return ApiResponse::withMessage('something went wrong')->withStatus(500)->build()->response2();

        return ApiResponse::build()->response2();
   
    }
}
