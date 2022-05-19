<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\MasterLevel\MasterLevelDetailResource;
use App\Http\Resources\MasterLevel\MasterLevelResource;
use App\Repositories\MasterLevel\MasterLevelRepositoryInterface;

class MasterLevelService
{
    protected MasterLevelRepositoryInterface $masterLevelRepository;

    /**
     * @param MasterLevelRepositoryInterface $masterLevelRepository
     */
    public function __construct(MasterLevelRepositoryInterface $masterLevelRepository)
    {
        $this->masterLevelRepository = $masterLevelRepository;
    }

    /**
     * Get list masterLevel
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->masterLevelRepository->listSearch($params);

            return ServiceHelper::paginatedData(MasterLevelResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get masterLevel or create if not found
     *
     * @param $id
     * @return array
     */
    public function getMasterLevel($id): array
    {
        try {
            $response = $this->masterLevelRepository->find($id);

            return ServiceHelper::data(MasterLevelDetailResource::make($response));
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
            $response = $this->masterLevelRepository->createMasterLevel($params);

            return ServiceHelper::createdWithData('MasterLevel', $response);
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
            $response = $this->masterLevelRepository->updateMasterLevel($id, $params);

            return ServiceHelper::updatedWithData('MasterLevel', $response);
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
            $response = $this->masterLevelRepository->deleteMasterLevel($id);

            if ($response) {
                return ServiceHelper::deleted('MasterLevel');
            } else {
                return ServiceHelper::deleteConflict('MasterLevel');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
