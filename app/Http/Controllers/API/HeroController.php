<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Services\HeroService;
use Illuminate\Http\JsonResponse;

class HeroController extends Controller
{
    /**
     * @var HeroService
     */
    protected HeroService $heroService;

    /**
     * @param HeroService $heroService
     */
    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }

    /**
     * Get list of hero
     *
     * @param CommonListRequest $request
     * @return JsonResponse
     */
    public function index(CommonListRequest $request): JsonResponse
    {
        $result = $this->heroService->getList($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Get detail of hero
     *
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $result = $this->heroService->getDetail($id);

        return response()->json($result, $result['code']);
    }

    /**
     * Create new hero
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $result = $this->heroService->create();

        return response()->json($result, $result['code']);
    }

    /**
     * Update a hero
     *
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $result = $this->heroService->update();

        return response()->json($result, $result['code']);
    }

    /**
     * Delete a hero
     *
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        $result = $this->heroService->delete();

        return response()->json($result, $result['code']);
    }
}
