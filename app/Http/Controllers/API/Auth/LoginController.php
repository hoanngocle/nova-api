<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
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
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $result = $this->userService->processLogin($request->validated());

        return response()->json($result, $result['code']);
    }
}
