<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Http\Requests\User\CreateHeroRequest;
use App\Http\Requests\User\UpdateHeroRequest;
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
        $result = $this->heroService->getHero($id);

        return response()->json($result, $result['code']);
    }

    /**
     * Create new hero
     *
     * @param CreateHeroRequest $request
     * @return JsonResponse
     */
    public function store(CreateHeroRequest $request): JsonResponse
    {
        $result = $this->heroService->create($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Update a hero
     *
     * @param $id
     * @param UpdateHeroRequest $request
     * @return JsonResponse
     */
    public function update($id, UpdateHeroRequest $request): JsonResponse
    {
        $result = $this->heroService->update($id, $request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Delete a hero
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $result = $this->heroService->delete($id);

        return response()->json($result, $result['code']);
    }
}
