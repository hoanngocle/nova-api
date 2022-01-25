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
            'email' => $request->email,
            'password' => $request->password
        ];
        return auth()->attempt($credentials);
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

    public function firstOrCreateUser($provider, $user)
    {
        return $this->userRepository->firstOrCreateUser($provider, $user);
    }

    public function registerUser($request) {
        $input = $request->all();
        $input['password'] = bcrypt($request['password']);

        return $this->userRepository->create($input);
    }
}
