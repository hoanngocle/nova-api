<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\MasterJobLevel\MasterJobLevelDetailResource;
use App\Http\Resources\MasterJobLevel\MasterJobLevelResource;
use App\Repositories\MasterJobLevel\MasterJobLevelRepositoryInterface;

class MasterJobLevelService
{
    protected MasterJobLevelRepositoryInterface $masterJobLevelRepository;

    /**
     * @param MasterJobLevelRepositoryInterface $masterJobLevelRepository
     */
    public function __construct(MasterJobLevelRepositoryInterface $masterJobLevelRepository)
    {
        $this->masterJobLevelRepository = $masterJobLevelRepository;
    }

    /**
     * Get list masterJobLevel
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->masterJobLevelRepository->listSearch($params);

            return ServiceHelper::paginatedData(MasterJobLevelResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get masterJobLevel or create if not found
     *
     * @param $id
     * @return array
     */
    public function getMasterJobLevel($id): array
    {
        try {
            $response = $this->masterJobLevelRepository->find($id);

            return ServiceHelper::data(MasterJobLevelDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
