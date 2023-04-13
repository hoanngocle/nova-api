<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
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
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $result = $this->userService->registerUser($request);

        return response()->json($result, $result['code']);
    }
}
