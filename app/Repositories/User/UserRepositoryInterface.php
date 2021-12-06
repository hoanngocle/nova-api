<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all user
     * @param $sortBy
     * @param $perPage
     */
    public function getAllUsers($sortBy, $perPage);

    /**
     * Get user info
     * @param $id
     */
    public function getUserInfo($id);
}
