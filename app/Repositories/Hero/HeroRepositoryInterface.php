<?php

namespace App\Repositories\Hero;

use App\Repositories\Base\BaseRepositoryInterface;

interface HeroRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);

    public function getHero($id);
}
