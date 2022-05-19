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
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name'          => $this->name,
            'bio'           => $this->bio,
            'avatar'        => $this->avatar,
            'rarity'        => $this->rarity,
            'element'       => $this->element,
            'type'          => $this->type,
            'status'        => $this->status,
            'attack'        => $this->attribute->attack,
            'health'        => $this->attribute->health,
            'defend'        => $this->attribute->defend,
            'eva'           => $this->attribute->eva,
            'aim'           => $this->attribute->aim,
            'crit_rate'     => $this->attribute->crit_rate,
            'crit_damage'   => $this->attribute->crit_damage,
            'exp_rate'      => $this->attribute->exp_rate,
            'coin_rate'     => $this->attribute->coin_rate,
            'effect_rate'   => $this->attribute->effect_rate,
            'effect_value'  => $this->attribute->effect_value,
            'sale_price'    => $this->attribute->sale_price,
            'buy_price'     => $this->attribute->buy_price,
            'created_at'    => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'deleted_at'    => $this->deleted_at,
        ];
    }
}
