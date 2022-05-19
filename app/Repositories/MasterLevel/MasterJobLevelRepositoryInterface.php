<?php

namespace App\Repositories\MasterJobLevel;

use App\Repositories\Base\BaseRepositoryInterface;

interface MasterJobLevelRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);
}
