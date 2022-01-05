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
    public function all(): mixed;

    /**
     * Get all data with soft deleted data
     *
     * @return mixed
     */
    public function allWithTrash(): mixed;

    /**
     * Get all data with locale
     *
     * @param $locale
     * @return mixed
     */
    public function allLocale($locale): mixed;

    /**
     * Get one
     *
     * @param $id
     * @return mixed
     */
    public function find($id): mixed;

    /**
     * Limit
     *
     * @param $limit
     * @return mixed
     */
    public function limit($limit): mixed;

    /**
     * Create
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []): mixed;

    /**
     * Create translate
     *
     * @param array $attributes
     * @return mixed
     */
    public function createTrans($attributes = []): mixed;

    /**
     * Update
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []): mixed;

    /**
     * Update translate
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateTrans($id, $attributes = []): mixed;

    /**
     * Soft delete
     *
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * Restore deleted data
     *
     * @param $id
     * @return mixed
     */
    public function restore($id): mixed;

    /**
     * Hard delete
     *
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * Get last item
     * @return mixed
     */
    public function last(): mixed;

    /**
     * @param $sortBy
     * @param $perPage
     * @return mixed
     */
    public function paginate($sortBy, $perPage): mixed;

    /**
     * @param $locale
     * @param $sortBy
     * @param $perPage
     * @return mixed
     */
    public function paginateLocale($locale, $sortBy, $perPage): mixed;
}
