<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\Hero\HeroResource;
use App\Repositories\Hero\HeroRepositoryInterface;

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
}
