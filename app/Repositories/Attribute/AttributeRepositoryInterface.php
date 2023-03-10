<?php

namespace App\Repositories\Attribute;

use App\Repositories\Base\BaseRepositoryInterface;

interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);

    /**
     * @param $params
     */
    public function createAttribute($params);

    /**
     * @param $id
     * @param $params
     */
    public function updateAttribute($id, $params);

    /**
     * @param $id
     */
    public function deleteAttribute($id);
}
