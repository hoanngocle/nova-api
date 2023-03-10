<?php

namespace App\Http\Resources\MasterLevel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MasterLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'level'       => $this->level,
            'exp'         => $this->exp,
            'name'        => $this->name,
            'sub_name'    => $this->sub_name,
            'inner_state' => $this->inner_state,
        ];
    }
}
