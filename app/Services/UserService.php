<?php

namespace App\Services;

use App\Enums\UserType;
use App\Helpers\ServiceHelper;
use App\Http\Resources\User\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    /**
     * AuthServices constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $credentials
     * @return array
     */
    public function processLogin($credentials): array
    {
        $loginAttempt = auth()->attempt($credentials);
        if (!$loginAttempt) {
            return ServiceHelper::authFailed();
        }

        $token = auth()->user()->createToken(config('constant.BASE_TEXT_TOKEN'), [UserType::from(auth()->user()->role)->ability()])->plainTextToken;
        return ServiceHelper::auth($token);
    }

    /**
     * Destroy all sessions for the current logged-in user
     */
    public function logout(): array
    {
        $response = auth()->user()->tokens()->delete();
        if ($response) {
            return ServiceHelper::message(__('auth.logout.success'));
        } else {
            return ServiceHelper::failed(Response::HTTP_BAD_REQUEST, __('auth.logout.error'));
        }
    }

    /**
     * Get profile of user
     *
     */
    public function getProfile()
    {
        if (auth()->user()) {
            return ServiceHelper::data(new UserResource(auth()->user()));
        } else {
            return ServiceHelper::failed(Response::HTTP_BAD_REQUEST, __('auth.profile.error'));
        }
    }

    /**
     * Validate provider (facebook, google, github)
     *
     * @param $provider
     * @return JsonResponse|null
     */
    public function validateProvider($provider): ?JsonResponse
    {
        if (!in_array($provider, config("constant.SOCIAL_ARRAY"))) {
            return response()->json(
                ['error' => __("auth.provider.error")],
                config("constant.HTTP_CODE.UNPROCESSABLE")
            );
        }

        return null;
    }

    /**
     * Get user or create if not found
     *
     * @param $provider
     * @param $user
     * @return mixed
     */
    public function firstOrCreateUser($provider, $user): mixed
    {
        return $this->userRepository->firstOrCreateUser($provider, $user);
    }

    /**
     * Create new user
     *
     * @param $request
     * @return mixed
     */
    public function registerUser($request): mixed
    {
        $input = $request->all();
        $input['password'] = bcrypt($request['password']);

        return $this->userRepository->create($input);
    }

    /**
     * Get Ability of user
     *
     * @return string
     */
    private function getAbility(): string
    {
        return match (auth()->user()->role) {
            UserType::SUPER_ADMIN->value   => 'super-admin-access',
            UserType::ADMIN->value         => 'admin-access',
            UserType::MEMBER->value        => 'member-access',
        };
    }
}
