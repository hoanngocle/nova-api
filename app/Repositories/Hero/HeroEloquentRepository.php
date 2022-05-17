<?php

namespace App\Repositories\Hero;

use App\Models\Hero;
use App\Repositories\Base\BaseEloquentRepository;
use Exception;

class HeroEloquentRepository extends BaseEloquentRepository implements HeroRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return Hero::class;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function listSearch($params): mixed
    {
        $params = $this->transferData($params);
        return $this->_model->when(isNotEmptyInArray($params, 'keyword') ,function ($subQuery) use ($params) {
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
    public function createHero($params) {
        // Create attribute

        // Create hero

        // Create hero image
        return 'created';
    }

    /**
     * @param $id
     * @param $params
     * @return string
     */
    public function updateHero($id, $params) {
        // Create attribute

        // Create hero

        // Create hero image
        return 'updated';
    }

    /**
     * @param $id
     * @return string
     */
    public function deleteHero($id) {
        // Delete hero image

        // Delete hero

        // Delete attribute


        return 'deleted';
    }
}
