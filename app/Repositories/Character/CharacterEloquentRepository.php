<?php

namespace App\Repositories\Character;

use App\Models\Attribute;
use App\Models\Character;
use App\Repositories\Base\BaseEloquentRepository;
use Exception;

class CharacterEloquentRepository extends BaseEloquentRepository implements CharacterRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return Character::class;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function findByUserId($userId): mixed
    {
        return $this->_model->where('user_id', $userId)
            ->get();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function listSearch($params): mixed
    {
        $params = $this->transferData($params);
        return $this->_model->when(isNotEmptyInArray($params, 'keyword'), function ($subQuery) use ($params) {
            $subQuery->where('id', 'like', "%{$params['keyword']}%")
                ->orWhere('name', 'like', "%{$params['keyword']}%");
        })->with('attribute')
            ->orderBy($params['sort_by'], $params['sort_order'])
            ->paginate($params['per_page']);
    }

    /**
     * @param $id
     * @param $params
     * @return string
     */
    public function updateCharacter($id, $params)
    {
        // Create attribute

        // Create character

        // Create character image
        return 'updated';
    }

    /**
     * @param $id
     * @return string
     */
    public function deleteCharacter($id)
    {
        // Delete character image

        // Delete character

        // Delete attribute


        return 'deleted';
    }
}
