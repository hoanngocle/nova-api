<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Repositories\Attribute\AttributeRepositoryInterface;

class AttributeService
{
    protected AttributeRepositoryInterface $attributeRepository;

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Get list attribute
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->attributeRepository->listSearch($params);

            return ServiceHelper::paginatedData(AttributeResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get attribute or create if not found
     *
     * @param $id
     * @return array
     */
    public function getAttribute($id): array
    {
        try {
            $response = $this->attributeRepository->find($id);

            return ServiceHelper::data(AttributeDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param CreateAttributeData $createAttributeData
     * @return array
     */
    public function create(CreateAttributeData $createAttributeData): array
    {
        try {
            $response = $this->attributeRepository->createAttribute($createAttributeData->all());

            return ServiceHelper::createdWithData('Attribute', $response);
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
            $response = $this->attributeRepository->updateAttribute($id, $params);

            return ServiceHelper::updatedWithData('Attribute', $response);
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
            $response = $this->attributeRepository->deleteAttribute($id);

            if ($response) {
                return ServiceHelper::deleted('Attribute');
            } else {
                return ServiceHelper::deleteConflict('Attribute');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
