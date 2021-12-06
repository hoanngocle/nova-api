<?php

namespace App\Repositories\Base;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories\Base
 */
interface BaseRepositoryInterface
{
    /**
     * Get all data without soft deleted data
     *
     * @return mixed
     */
    public function all();

    /**
     * Get all data with soft deleted data
     *
     * @return mixed
     */
    public function allWithTrash();

    /**
     * Get all data with locale
     *
     * @param $locale
     * @return mixed
     */
    public function allLocale($locale);

    /**
     * Get one
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Limit
     *
     * @param $limit
     * @return mixed
     */
    public function limit($limit);

    /**
     * Create
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Create translate
     *
     * @param array $attributes
     * @return mixed
     */
    public function createTrans($attributes = []);

    /**
     * Update
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Update translate
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateTrans($id, $attributes = []);

    /**
     * Soft delete
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Restore deleted data
     *
     * @param $id
     * @return mixed
     */
    public function restore($id);

    /**
     * Hard delete
     *
     * @param $id
     * @return bool
     */
    public function destroy($id);

    /**
     * Get last item
     * @return mixed
     */
    public function last();

    /**
     * @param $sortBy
     * @param $perPage
     * @return mixed
     */
    public function paginate($sortBy, $perPage);

    /**
     * @param $locale
     * @param $sortBy
     * @param $perPage
     * @return mixed
     */
    public function paginateLocale($locale, $sortBy, $perPage);
}
