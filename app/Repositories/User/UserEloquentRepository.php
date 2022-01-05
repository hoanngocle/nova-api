<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\BaseEloquentRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserEloquentRepository extends BaseEloquentRepository implements UserRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * Get all user by role
     *
     * @param $sortBy
     * @param $perPage
     * @return bool|LengthAwarePaginator
     */
    public function getAllUsers($sortBy, $perPage): LengthAwarePaginator|bool
    {
        try {
            return $this->_model
                ->all();
        } catch (Exception $e) {
            logger(__METHOD__ . __LINE__ . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all user by role
     *
     * @param $id
     * @return mixed
     */
    public function getUserInfo($id): mixed
    {
        try {
            return $this->_model
                ->with()
                ->get();
        } catch (Exception $e) {
            logger(__METHOD__ . __LINE__ . $e->getMessage());
            return false;
        }
    }
}
