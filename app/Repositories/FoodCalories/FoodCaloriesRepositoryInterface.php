<?php

namespace App\Repositories\FoodCalories;

use App\Repositories\Base\BaseRepositoryInterface;

interface FoodCaloriesRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $params
     */
    public function listSearch($params);

    /**
     * @param $params
     */
    public function createFoodCalories($params);

    /**
     * @param $id
     * @param $params
     */
    public function updateFoodCalories($id, $params);

    /**
     * @param $id
     */
    public function deleteFoodCalories($id);
}
