<?php

namespace App\Repositories\Base;

use App\Repositories\Base\BaseRepositoryInterface;

abstract class BaseEloquentRepository implements BaseRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

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
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->_model->all();
    }

    /**
     * Get all data with soft deleted data
     *
     * @return mixed
     */
    public function allWithTrash()
    {
        return $this->_model->withTrashed()->all();
    }

    /**
     * Get all data with locale
     *
     * @param $locale
     * @return mixed
     */
    public function allLocale($locale) {
        return $this->_model->withTranslation($locale)->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * Limit
     * @param $limit
     * @return mixed
     */
    public function limit($limit)
    {
        $result = $this->_model->limit($limit)->get();
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = [])
    {
        $attributes['created_by'] = auth()->guard(STAFF_GUARD)->user()->username;
        $attributes['updated_by'] = auth()->guard(STAFF_GUARD)->user()->username;
        return $this->_model->create($attributes);
    }

    /**
     * Create translate
     * @param array $attributes
     * @return mixed
     */
    public function createTrans($attributes = [])
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, $attributes = [])
    {
        $attributes['updated_by'] = auth()->guard(STAFF_GUARD)->user()->username;
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
     * @return bool|mixed
     */
    public function updateTrans($id, $attributes = [])
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
    public function delete($id)
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
     * @return mixed
     */
    public function restore($id)
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
    public function destroy($id)
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
    public function last()
    {
        $result = $this->_model->orderBy('created_at', 'desc')->first();
        return $result;
    }

    /**
     * @param $sortBy
     * @param $perPage
     * @return mixed
     */
    public function paginate($sortBy, $perPage)
    {
        $result = $this->_model->orderBy($sortBy, 'ASC')->paginate($perPage);
        return $result;
    }

    /**
     * @param $locale
     * @param $sortBy
     * @param $perPage
     * @return mixed
     */
    public function paginateLocale($locale, $sortBy, $perPage)
    {
        $result = $this->_model->translateOrDefault($locale)->orderBy($sortBy, 'ASC')->paginate($perPage);
        return $result;
    }
}
