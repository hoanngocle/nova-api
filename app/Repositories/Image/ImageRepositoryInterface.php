<?php

namespace App\Repositories\Image;

use App\Repositories\Base\BaseRepositoryInterface;

interface ImageRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);
}
