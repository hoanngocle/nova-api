<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Services\MasterJobLevelService;
use Illuminate\Http\JsonResponse;

class MasterJobLevelController extends Controller
{
    /**
     * @var MasterJobLevelService
     */
    protected MasterJobLevelService $masterJobLevelService;

    /**
     * @param MasterJobLevelService $masterJobLevelService
     */
    public function __construct(MasterJobLevelService $masterJobLevelService)
    {
        $this->masterJobLevelService = $masterJobLevelService;
    }

    /**
     * Get list of masterJobLevel
     *
     * @param CommonListRequest $request
     * @return JsonResponse
     */
    public function index(CommonListRequest $request): JsonResponse
    {
        $result = $this->masterJobLevelService->getList($request->validated());

        return response()->json($result, $result['code']);
    }

    /**
     * Get detail of masterJobLevel
     *
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $result = $this->masterJobLevelService->getMasterJobLevel($id);

        return response()->json($result, $result['code']);
    }
}
