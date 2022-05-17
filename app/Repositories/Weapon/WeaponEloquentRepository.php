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
    public function createWeapon($params) {
        // Create attribute

        // Create weapon

        // Create weapon image
        return 'created';
    }

    /**
     * @param $id
     * @param $params
     * @return string
     */
    public function updateWeapon($id, $params) {
        // Create attribute

        // Create weapon

        // Create weapon image
        return 'updated';
    }

    /**
     * @param $id
     * @return string
     */
    public function deleteWeapon($id) {
        // Delete weapon image

        // Delete weapon

        // Delete attribute


        return 'deleted';
    }
}
