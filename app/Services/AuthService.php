<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class AuthService
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

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
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function processLogin($request)
    {
        $param = $request;
        $param['scope'] = '';
        $proxy = $request->create('oauth/token', 'POST', $param->all());
        return app()->handle($proxy);
    }

    /**
     * Destroy all sessions for the current logged in user
     */
    public function logout()
    {
        $token = auth()->user()->token();
        return $token->revoke();
    }
}
