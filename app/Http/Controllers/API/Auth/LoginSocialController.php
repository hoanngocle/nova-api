<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function logout(): JsonResponse
    {
        $result = $this->userService->logout();

        return response()->json($result, $result['code']);
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
     * @return \App\Services\JsonResponse|JsonResponse
     */
    public function handleSocialCallback($provider)
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
