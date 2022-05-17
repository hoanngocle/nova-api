<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\Weapon\WeaponDetailResource;
use App\Http\Resources\Weapon\WeaponResource;
use App\Repositories\Weapon\WeaponRepositoryInterface;

class WeaponService
{
    protected WeaponRepositoryInterface $weaponRepository;

    /**
     * @param WeaponRepositoryInterface $weaponRepository
     */
    public function __construct(WeaponRepositoryInterface $weaponRepository)
    {
        $this->weaponRepository = $weaponRepository;
    }

    /**
     * Get list weapon
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->weaponRepository->listSearch($params);

            return ServiceHelper::paginatedData(WeaponResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get weapon or create if not found
     *
     * @param $id
     * @return array
     */
    public function getWeapon($id): array
    {
        try {
            $response = $this->weaponRepository->find($id);

            return ServiceHelper::data(WeaponDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function create($params): array
    {
        try {
            $response = $this->weaponRepository->createWeapon($params);

            return ServiceHelper::createdWithData('Weapon', $response);
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $id
     * @param $params
     * @return array
     */
    public function update($id, $params): array
    {
        try {
            $response = $this->weaponRepository->updateWeapon($id, $params);

            return ServiceHelper::updatedWithData('Weapon', $response);
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        try {
            $response = $this->weaponRepository->deleteWeapon($id);

            if ($response) {
                return ServiceHelper::deleted('Weapon');
            } else {
                return ServiceHelper::deleteConflict('Weapon');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
