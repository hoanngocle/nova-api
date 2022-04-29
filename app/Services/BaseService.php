<?php

namespace App\Services;

use App\Repositories\Base\BaseRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class BaseService
{
    protected BaseRepositoryInterface $baseRepository;

    /**
     * AuthServices constructor.
     * @param BaseRepositoryInterface $baseRepository
     */
    public function __construct(BaseRepositoryInterface $baseRepository)
    {
        $this->baseRepository = $baseRepository;
    }

    /**
     * @param $request
     * @return bool
     * @throws Exception
     */
    public function getList(): bool
    {

        return true;
    }

    /**
     * Destroy all sessions for the current logged-in base
     */
    public function getBase()
    {
    }

    /**
     * Get profile of base
     *
     */
    public function createBase($params)
    {

    }

    /**
     *
     * @param $params
     * @return JsonResponse|null
     */
    public function updateBase($params): ?JsonResponse
    {

        return null;
    }


}
