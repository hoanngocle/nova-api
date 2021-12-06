<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\BaseEloquentRepository;
use Exception;

class UserEloquentRepository extends BaseEloquentRepository implements UserRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Get all user by role
     *
     * @param $sortBy
     * @param $perPage
     * @param $accountType
     * @return bool|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllUsers($sortBy, $perPage)
    {
        try {
            $query = $this->_model
                ->orderBy($sortBy, 'ASC')
                ->paginate($perPage);

            return $query;
        } catch (Exception $e) {
            logger(__METHOD__ . __LINE__ . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all user by role
     *
     * @param $sortBy
     * @param $perPage
     * @param $accountType
     * @return bool|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserInfo($id)
    {
        try {
            $query = $this->_model
                ->with()
                ->get();

            return $query;
        } catch (Exception $e) {
            logger(__METHOD__ . __LINE__ . $e->getMessage());
            return false;
        }
    }
}
