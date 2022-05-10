<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEloquentRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel(): string;

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    /**
     * Get All
     * @return Collection|static[]
     */
    public function all(): Collection|static
    {
        return $this->_model->all();
    }

    /**
     * Get all data with soft deleted data
     *
     * @return mixed
     */
    public function allWithTrash(): mixed
    {
        return $this->_model->withTrashed()->all();
    }

    /**
     * Get all data with locale
     *
     * @param $locale
     * @return mixed
     */
    public function allLocale($locale): mixed
    {
        return $this->_model->withTranslation($locale)->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->_model->find($id);
    }

    /**
     * Limit
     * @param $limit
     * @return mixed
     */
    public function limit($limit): mixed
    {
        return $this->_model->limit($limit)->get();
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []): mixed
    {
        return $this->_model->create($attributes);
    }

    /**
     * Create translate
     * @param array $attributes
     * @return mixed
     */
    public function createTrans($attributes = []): mixed
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, $attributes = []): mixed
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateTrans($id, $attributes = []): mixed
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Soft delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    /**
     * Restore deleted data
     *
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        $result = $this->_model->withTrashed()->find($id);
        if ($result) {
            $result->restore();
            return true;
        }
        return false;
    }

    /**
     * Hard delete
     *
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $result = $this->find($id);
        if ($result) {
            $result->forceDelete();
            return true;
        }
        return false;
    }

    /**
     * Get last item
     * @return mixed
     */
    public function last(): mixed
    {
        return $this->_model->orderBy('created_at', 'desc')->first();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function paginate($params): mixed
    {
        $params = $this->transferData($params);
        return $this->_model->orderBy($params['sort_by'], $params['sort_order'])->paginate($params['per_page']);
    }

    /**
     * @param $locale
     * @param $sortBy
     * @param $sortOrder
     * @param $perPage
     * @return mixed
     */
    public function paginateLocale($locale, $sortBy, $sortOrder, $perPage): mixed
    {
        return $this->_model->translateOrDefault($locale)->orderBy($sortBy, $sortOrder)->paginate($perPage);
    }

    /**
     * @param $params
     */
    public function transferData($params) {
        $params['sort_by']     = $params['sort_by'] ?? config('constant.SORT_BY');
        $params['sort_order']  = $params['sort_order'] ?? config('constant.SORT_ORDER');
        $params['per_page']    = $params['per_page'] ?? config('constant.PER_PAGE');

        return $params;
    }
}
