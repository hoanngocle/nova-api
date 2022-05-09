<?php

namespace App\Repositories\Weapon;

use App\Models\Weapon;
use App\Repositories\Base\BaseEloquentRepository;
use Exception;

class WeaponEloquentRepository extends BaseEloquentRepository implements WeaponRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return Weapon::class;
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
