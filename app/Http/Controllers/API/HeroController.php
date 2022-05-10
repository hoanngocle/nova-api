<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonListRequest;
use App\Http\Requests\Hero\HeroListRequest;
use App\Services\HeroService;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    protected HeroService $heroService;

    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }

    public function index(CommonListRequest $request)
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
