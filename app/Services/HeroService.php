<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\Hero\HeroResource;
use App\Repositories\Hero\HeroRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HeroService
{
    protected HeroRepositoryInterface $heroRepository;

    /**
     * AuthServices constructor.
     * @param HeroRepositoryInterface $heroRepository
     */
    public function __construct(HeroRepositoryInterface $heroRepository)
    {
        $this->heroRepository = $heroRepository;
    }

    /**
     * Get list hero
     *
     */
    public function getList($params): array
    {
        try {
            if (isset($params['keyword'])) {
                $response = $this->heroRepository->listSearch($params);
            } else {
                $response = $this->heroRepository->paginate($params);
            }

            return ServiceHelper::paginatedData(HeroResource::collection($response));
        } catch (\Exception $e) {
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Validate provider (facebook, google, github)
     *
     * @param $provider
     * @return JsonResponse|null
     */
    public function validateProvider($provider): ?JsonResponse
    {
        if (!in_array($provider, config("constant.SOCIAL_ARRAY"))) {
            return response()->json(
                ['error' => __("auth.provider.error")],
                config("constant.HTTP_CODE.UNPROCESSABLE")
            );
        }

        return null;
    }

    /**
     * Get hero or create if not found
     *
     * @param $provider
     * @param $hero
     * @return mixed
     */
    public function firstOrCreateHero($provider, $hero): mixed
    {
        return $this->heroRepository->firstOrCreateHero($provider, $hero);
    }

    /**
     * Create new hero
     *
     * @param $request
     * @return mixed
     */
    public function registerHero($request): mixed
    {
        $input = $request->all();
        $input['password'] = bcrypt($request['password']);

        return $this->heroRepository->create($input);
    }
}
