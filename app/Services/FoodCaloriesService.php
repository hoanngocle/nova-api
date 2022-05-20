<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\FoodCalories\FoodCaloriesDetailResource;
use App\Http\Resources\FoodCalories\FoodCaloriesResource;
use App\Repositories\FoodCalories\FoodCaloriesRepositoryInterface;

class FoodCaloriesService
{
    protected FoodCaloriesRepositoryInterface $foodCaloriesRepository;

    /**
     * @param FoodCaloriesRepositoryInterface $foodCaloriesRepository
     */
    public function __construct(FoodCaloriesRepositoryInterface $foodCaloriesRepository)
    {
        $this->foodCaloriesRepository = $foodCaloriesRepository;
    }

    /**
     * Get list foodCalories
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->foodCaloriesRepository->listSearch($params);

            return ServiceHelper::paginatedData(FoodCaloriesResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get foodCalories or create if not found
     *
     * @param $id
     * @return array
     */
    public function getFoodCalories($id): array
    {
        try {
            $response = $this->foodCaloriesRepository->find($id);

            return ServiceHelper::data(FoodCaloriesDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function create($params): array
    {
        try {
            $response = $this->foodCaloriesRepository->createFoodCalories($params);

            return ServiceHelper::createdWithData('FoodCalories', $response);
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $id
     * @param $params
     * @return array
     */
    public function update($id, $params): array
    {
        try {
            $response = $this->foodCaloriesRepository->updateFoodCalories($id, $params);

            return ServiceHelper::updatedWithData('FoodCalories', $response);
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        try {
            $response = $this->foodCaloriesRepository->deleteFoodCalories($id);

            if ($response) {
                return ServiceHelper::deleted('FoodCalories');
            } else {
                return ServiceHelper::deleteConflict('FoodCalories');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
