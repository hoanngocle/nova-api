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
        return $this->_model->where('id', 'like', "%{$params['keyword']}%")
            ->orWhere('name', 'like', "%{$params['keyword']}%")
            ->orderBy($params['sort_by'], $params['sort_order'])
            ->paginate($params['per_page']);
    }
}
