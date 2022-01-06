<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $login = $this->userService->processLogin($request);
        if ($login) {
            $profile = $this->userService->getProfile();
            $data = new UserResource($profile);

            return $this->handleResponse($data, 'User logged-in!');
        } else {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function logout(): JsonResponse
    {
        $response = $this->userService->logout();
        if ($response) {
            return $this->handleResponse($response, 'User logged out!');
        } else {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function profile(): JsonResponse
    {
        $response = $this->userService->getProfile();
        if ($response) {
            return $this->handleResponse($response, 'User logged out!');
        } else {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] = $user->name;

        return $this->handleResponse($success, 'User successfully registered!');
    }
}
