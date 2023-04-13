<?php

namespace App\Repositories\Character;

use App\Repositories\Base\BaseRepositoryInterface;

interface CharacterRepositoryInterface extends BaseRepositoryInterface
{
    public function findByUserId($userId);

    /**
     * @param $params
     */
    public function listSearch($params);

    /**
     * @param $id
     * @param $params
     */
    public function updateCharacter($id, $params);

    /**
     * @param $id
     */
    public function deleteCharacter($id);
}
