<?php

namespace App\Repositories\MasterLevel;

use App\Models\MasterLevel;
use App\Repositories\Base\BaseEloquentRepository;

class MasterLevelEloquentRepository extends BaseEloquentRepository implements MasterLevelRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return MasterLevel::class;
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
}
