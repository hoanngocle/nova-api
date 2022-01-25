<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllUsers($sortBy, $perPage);

    public function getUserInfo($id);

    public function firstOrCreateUser($provider, $user);
}
