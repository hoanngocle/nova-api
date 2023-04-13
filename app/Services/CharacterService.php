<?php

namespace App\Services;

use App\DataTransferObjects\CreateAttributeData;
use App\DataTransferObjects\CreateCharacterData;
use App\Helpers\ServiceHelper;
use App\Http\Resources\Character\CharacterDetailResource;
use App\Http\Resources\Character\CharacterResource;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Character\CharacterRepositoryInterface;

class CharacterService
{
    protected CharacterRepositoryInterface $characterRepository;
    protected AttributeRepositoryInterface $attributeRepository;

    /**
     * @param CharacterRepositoryInterface $characterRepository
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(
        CharacterRepositoryInterface $characterRepository,
        AttributeRepositoryInterface $attributeRepository,
    )
    {
        $this->characterRepository = $characterRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Get character or create if not found
     *
     * @param $id
     * @return array
     */
    public function getCharacterInfo($id): array
    {
        try {
            $response = $this->characterRepository->findByUserId($id);
            dd($response);

            return ServiceHelper::data(CharacterDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get list character
     *
     */
    public function getList($params): array
    {
        try {
            $response = $this->characterRepository->listSearch($params);

            return ServiceHelper::paginatedData(CharacterResource::collection($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * Get character or create if not found
     *
     * @param $id
     * @return array
     */
    public function getCharacter($id): array
    {
        try {
            $response = $this->characterRepository->find($id);

            return ServiceHelper::data(CharacterDetailResource::make($response));
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }

    /**
     * @param CreateAttributeData $attibuteData
     * @param CreateCharacterData $characterData
     * @return array
     */
    public function create(CreateAttributeData $attibuteData, CreateCharacterData $characterData,): array
    {
        try {
            $attribute = $this->attributeRepository->create($attibuteData->all());
            $response = $this->characterRepository->create(['attribute_id' => $attribute->id, ...$characterData->all()]);

            return ServiceHelper::createdWithData('Character', $response);
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
            $response = $this->characterRepository->updateCharacter($id, $params);

            return ServiceHelper::updatedWithData('Character', $response);
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
            $response = $this->characterRepository->deleteCharacter($id);

            if ($response) {
                return ServiceHelper::deleted('Character');
            } else {
                return ServiceHelper::deleteConflict('Character');
            }
        } catch (\Exception $e) {
            logger(__METHOD__ . ' ' . __LINE__ . ': ' . $e->getMessage());
            return ServiceHelper::serverError($e);
        }
    }
}
