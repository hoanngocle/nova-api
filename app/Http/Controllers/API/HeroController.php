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
     * @param CommonListRequest $request
     * @return JsonResponse
     */
    public function index(CommonListRequest $request): JsonResponse
    {
        $result = $this->heroService->getList($request->validated());

        return response()->json($result, $result['code']);
    }

    public function detail()
    {
        return 'detail';
    }

    public function store()
    {
        return 'add';
    }

    public function delete()
    {

    }
}
