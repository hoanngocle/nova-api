<?php

namespace App\Http\Controllers\API;

use App\Enums\UserStatus;
use App\Helpers\ServiceHelper;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Services\UserService;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @return array
     * @throws Exception
     */
    public function login(LoginRequest $request): array
    {
        $user = $this->userService->processLogin($request);

        if ($user) {
            return ServiceHelper::auth($token);
        } else {
            return ServiceHelper::authFailed();
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
            return $this->handleResponse($response, __('auth.profile.success'));
        } else {
            return $this->handleError(__('auth.profile.error'), ['error' => __('auth.profile.error')]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->registerUser($request);
        if ($user) {
            $data = new UserResource($user);
            return $this->handleResponse($data, __('auth.profile.success'));
        } else {
            return $this->handleError(__('auth.profile.error'), ['error' => __('auth.profile.error')]);
        }
    }

    /**
     * Login with social network
     *
     * @param $provider
     * @return JsonResponse|RedirectResponse
     */
    public function loginSocial($provider): JsonResponse|RedirectResponse
    {
        $validated = $this->userService->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Handle when another page callback
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleSocialCallback($provider): JsonResponse
    {
        $validated = $this->userService->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
            return $this->handleUser($provider, $user);
        } catch (ClientException $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return $this->handleError(__('auth.provider.invalid'), ['error' => __('auth.provider.invalid')]);
        }
    }

    public function handleUser($provider, $user): JsonResponse
    {
        $userCreated = $this->userService->firstOrCreateUser($provider, $user);
        if ($userCreated) {
            $data = new UserResource($userCreated);

            return $this->handleResponse($data, __('auth.login.success'));
        } else {
            return $this->handleError(__('auth.login.failed'), ['error' => __('auth.login.failed')]);
        }
    }
}
