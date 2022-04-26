<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

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
     * @param $request
     * @return bool
     * @throws Exception
     */
    public function processLogin($request): bool
    {
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        $loginAttempt = auth()->attempt($credentials);
        $token = $loginAttempt->createToken(config('constant.BASE_TEXT_TOKEN'), [$ability])->plainTextToken;

        return $token;
    }

    /**
     * Destroy all sessions for the current logged-in user
     */
    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }

    /**
     * Get profile of user
     *
     */
    public function getProfile()
    {
        $idUser = auth()->user();
        return $this->userRepository->find($idUser);
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
}
