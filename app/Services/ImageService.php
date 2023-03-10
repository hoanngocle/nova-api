<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Http\Resources\Image\ImageDetailResource;
use App\Http\Resources\Image\ImageResource;
use App\Repositories\Image\ImageRepositoryInterface;

class ImageService
{
    protected ImageRepositoryInterface $imageRepository;

    /**
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * Get list image
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->imageRepository->listSearch($params);

            return ServiceHelper::paginatedData(ImageResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get image or create if not found
     *
     * @param $id
     * @return array
     */
    public function getImage($id): array
    {
        try {
            $response = $this->imageRepository->find($id);

            return ServiceHelper::data(ImageDetailResource::make($response));
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
            $response = $this->imageRepository->createImage($params);

            return ServiceHelper::createdWithData('Image', $response);
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
            $response = $this->imageRepository->updateImage($id, $params);

            return ServiceHelper::updatedWithData('Image', $response);
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
            $response = $this->imageRepository->deleteImage($id);

            if ($response) {
                return ServiceHelper::deleted('Image');
            } else {
                return ServiceHelper::deleteConflict('Image');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
