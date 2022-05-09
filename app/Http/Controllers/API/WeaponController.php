<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Services\WeaponService;

class WeaponController extends Controller
{
    protected WeaponService $weaponService;

    /**
     * @param WeaponService $weaponService
     */
    public function __construct(WeaponService $weaponService)
    {
        $this->weaponService = $weaponService;
    }

    /**
     * Get list of weapon
     *
     * @param CommonListRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CommonListRequest $request)
    {
        $result = $this->weaponService->getList($request->validated());

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
