<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\Hero\HeroDetailResource;
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
            $response = $this->heroRepository->listSearch($params);

            return ServiceHelper::paginatedData(HeroResource::collection($response));
        } catch (\Exception $e) {
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get hero or create if not found
     *
     * @param $id
     * @return array
     */
    public function getDetail($id): array
    {
        try {
            $response = $this->heroRepository->getHero($id);

            return ServiceHelper::data(HeroDetailResource::make($response));
        } catch (\Exception $e) {
            return ServiceHelper::serverError($e);
        }
    }
}
