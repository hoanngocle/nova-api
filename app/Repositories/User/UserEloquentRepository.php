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
    public function getModel(): string
    {
        return User::class;
    }

    public function getAllUsers($sortBy, $perPage)
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
                ->get();
        } catch (Exception $e) {
            logger(__METHOD__ . __LINE__ . $e->getMessage());
            return false;
        }
    }

    public function firstOrCreateUser($provider, $user)
    {
        try {
            $userCreated = User::firstOrCreate(
                [
                    'email' => $user->getEmail()
                ],
                [
                    'email_verified_at' => now(),
                    'username' => $user->getName(),
                ]
            );

            $userCreated->providers()->updateOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $user->getId(),
                ],
                [
                    'avatar' => $user->getAvatar()
                ]
            );

            return $userCreated;
        } catch (Exception $e) {
            logger(__METHOD__ . __LINE__ . $e->getMessage());
            return false;
        }
    }
}
