<?php

namespace App\Repositories\Weapon;

use App\Repositories\Base\BaseRepositoryInterface;

interface WeaponRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);
}
