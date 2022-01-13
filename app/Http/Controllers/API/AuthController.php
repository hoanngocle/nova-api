<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

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

            return $this->handleResponse($data, __('auth.login.success'));
        } else {
            return $this->handleError(__('auth.login.failed'), ['error' => __('auth.login.failed')]);
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
            return $this->handleResponse($response, __('auth.logout.success'));
        } else {
            return $this->handleError(__('auth.logout.error'), ['error' => __('auth.logout.error')]);
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

    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'username' => $user->getName(),
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        $token = $userCreated->createToken('token-name')->plainTextToken;

        return response()->json($userCreated, 200, ['Access-Token' => $token]);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }
}
