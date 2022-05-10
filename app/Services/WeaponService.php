<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\Weapon\WeaponResource;
use App\Repositories\Weapon\WeaponRepositoryInterface;

class WeaponService
{
    protected WeaponRepositoryInterface $weaponRepository;

    /**
     * AuthServices constructor.
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
            if (isset($params['keyword'])) {
                $response = $this->weaponRepository->listSearch($params);
            } else {
                $response = $this->weaponRepository->paginate($params);
            }

            return ServiceHelper::paginatedData(WeaponResource::collection($response));
        } catch (\Exception $e) {
            return ServiceHelper::serverError($e);
        }
    }


    /**
     * Get weapon or create if not found
     *
     * @param $provider
     * @param $weapon
     * @return mixed
     */
    public function firstOrCreateWeapon($provider, $weapon): mixed
    {
        return $this->weaponRepository->firstOrCreateWeapon($provider, $weapon);
    }
}
