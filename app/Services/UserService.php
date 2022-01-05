<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Exception;

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
        return auth()->attempt($credentials);
    }

    /**
     * Destroy all sessions for the current logged-in user
     */
    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }

    public function getProfile()
    {
        return auth()->user();
    }
}
