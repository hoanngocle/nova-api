<?php

namespace App\Repositories\MasterJobLevel;

use App\Models\MasterJobLevel;
use App\Repositories\Base\BaseEloquentRepository;

class MasterJobLevelEloquentRepository extends BaseEloquentRepository implements MasterJobLevelRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return MasterJobLevel::class;
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
