<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Services\MasterLevelService;
use Illuminate\Http\JsonResponse;

class MasterLevelController extends Controller
{
    /**
     * @var MasterLevelService
     */
    protected MasterLevelService $masterLevelService;

    /**
     * @param MasterLevelService $masterLevelService
     */
    public function __construct(MasterLevelService $masterLevelService)
    {
        $this->masterLevelService = $masterLevelService;
    }

    /**
     * Get list of masterLevel
     *
     * @param CommonListRequest $request
     * @return JsonResponse
     */
    public function index(CommonListRequest $request): JsonResponse
    {
        $result = $this->masterLevelService->getList($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Get detail of masterLevel
     *
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $result = $this->masterLevelService->getMasterLevel($id);

        return response()->json($result, $result['code']);
    }
}
