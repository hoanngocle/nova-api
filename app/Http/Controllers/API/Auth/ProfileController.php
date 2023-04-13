<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    protected UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        $result = $this->userService->getProfile();

        return response()->json($result, $result['code']);
    }
}
