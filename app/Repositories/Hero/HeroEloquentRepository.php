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

}
