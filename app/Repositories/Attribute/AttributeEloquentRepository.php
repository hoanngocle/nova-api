<?php

namespace App\Repositories\Attribute;

use App\Models\Attribute;
use App\Repositories\Base\BaseEloquentRepository;

class AttributeEloquentRepository extends BaseEloquentRepository implements AttributeRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return Attribute::class;
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
     * @param $params
     * @return string
     */
    public function createAttribute($params)
    {
        return $this->_model->create($params);
    }

    /**
     * @param $id
     * @param $params
     * @return string
     */
    public function updateAttribute($id, $params)
    {
        // Create attribute

        // Create attribute

        // Create attribute image
        return 'updated';
    }

    /**
     * @param $id
     * @return string
     */
    public function deleteAttribute($id)
    {
        // Delete attribute image

        // Delete attribute

        // Delete attribute


        return 'deleted';
    }
}
