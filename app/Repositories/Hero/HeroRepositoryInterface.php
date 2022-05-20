<?php

namespace App\Repositories\Hero;

use App\Repositories\Base\BaseRepositoryInterface;

interface HeroRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);

    /**
     * @param $id
     * @param $params
     */
    public function updateHero($id, $params);

    /**
     * @param $id
     */
    public function deleteHero($id);
}
