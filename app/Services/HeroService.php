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
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get hero or create if not found
     *
     * @param $id
     * @return array
     */
    public function getHero($id): array
    {
        try {
            $response = $this->heroRepository->find($id);

            return ServiceHelper::data(HeroDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function create($params): array
    {
        try {
            $response = $this->heroRepository->createHero($params);

            return ServiceHelper::createdWithData('Hero', $response);
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $id
     * @param $params
     * @return array
     */
    public function update($id, $params): array
    {
        try {
            $response = $this->heroRepository->updateHero($id, $params);

            return ServiceHelper::updatedWithData('Hero', $response);
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        try {
            $response = $this->heroRepository->deleteHero($id);

            if ($response) {
                return ServiceHelper::deleted('Hero');
            } else {
                return ServiceHelper::deleteConflict('Hero');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
