<?php

namespace App\Repositories\MasterLevel;

use App\Repositories\Base\BaseRepositoryInterface;

interface MasterLevelRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);
}
