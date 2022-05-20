<?php

namespace App\Repositories\FoodCalories;

use App\Models\FoodCalories;
use App\Repositories\Base\BaseEloquentRepository;

class FoodCaloriesEloquentRepository extends BaseEloquentRepository implements FoodCaloriesRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return FoodCalories::class;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function listSearch($params): mixed
    {
        $params = $this->transferData($params);
        return $this->_model->when(isNotEmptyInArray($params, 'keyword') ,function ($subQuery) use ($params) {
            $subQuery->where('id', 'like', "%{$params['keyword']}%")
                ->orWhere('name', 'like', "%{$params['keyword']}%");
            })->with('attribute')
            ->orderBy($params['sort_by'], $params['sort_order'])
            ->paginate($params['per_page']);
    }


    /**
     * @param $params
     * @return string
     */
    public function createFoodCalories($params) {
        // Create attribute

        // Create foodCalories

        // Create foodCalories image
        return 'created';
    }

    /**
     * @param $id
     * @param $params
     * @return string
     */
    public function updateFoodCalories($id, $params) {
        // Create attribute

        // Create foodCalories

        // Create foodCalories image
        return 'updated';
    }

    /**
     * @param $id
     * @return string
     */
    public function deleteFoodCalories($id) {
        // Delete foodCalories image

        // Delete foodCalories

        // Delete attribute


        return 'deleted';
    }
}
