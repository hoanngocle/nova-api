<?php

namespace App\Repositories\Weapon;

use App\Repositories\Base\BaseRepositoryInterface;

interface WeaponRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);

    /**
     * @param $params
     */
    public function createWeapon($params);

    /**
     * @param $id
     * @param $params
     */
    public function updateWeapon($id, $params);

    /**
     * @param $id
     */
    public function deleteWeapon($id);
}
