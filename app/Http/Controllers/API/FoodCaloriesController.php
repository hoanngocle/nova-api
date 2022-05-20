<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Services\FoodCaloriesService;
use Illuminate\Http\JsonResponse;

class FoodCaloriesController extends Controller
{
    /**
     * @var FoodCaloriesService
     */
    protected FoodCaloriesService $foodCaloriesService;

    /**
     * @param FoodCaloriesService $foodCaloriesService
     */
    public function __construct(FoodCaloriesService $foodCaloriesService)
    {
        $this->foodCaloriesService = $foodCaloriesService;
    }

    /**
     * Get list of foodCalories
     *
     * @param CommonListRequest $request
     * @return JsonResponse
     */
    public function index(CommonListRequest $request): JsonResponse
    {
        $result = $this->foodCaloriesService->getList($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Get detail of foodCalories
     *
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $result = $this->foodCaloriesService->getFoodCalories($id);

        return response()->json($result, $result['code']);
    }
}
