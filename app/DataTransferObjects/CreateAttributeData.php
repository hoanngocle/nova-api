<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Hero\CreateHeroRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateAttributeData extends DataTransferObject
{
    public int $attack;
    public int $defend;
    public int $health;
    public int $eva_rate;
    public int $aim_rate;
    public int $crit_rate;
    public int $crit_damage;
    public int $exp_rate;
    public int $coin_rate;
    public int $effect_rate;
    public int $effect_value;
    public int $sale_price;
    public int $buy_price;

    /**
     * @param CreateHeroRequest $request
     * @return CreateAttributeData
     * @throws UnknownProperties
     */
    public static function fromRequest(CreateHeroRequest $request): CreateAttributeData
    {
        $inputs = $request->validated();

        return new self([
            'attack'        => $inputs['attack'] ?? 0,
            'defend'        => $inputs['defend'] ?? 0,
            'health'        => $inputs['health'] ?? 0,
            'eva_rate'      => $inputs['eva_rate'] ?? 0,
            'aim_rate'      => $inputs['aim_rate'] ?? 0,
            'crit_rate'     => $inputs['crit_rate'] ?? 0,
            'crit_damage'   => $inputs['crit_damage'] ?? 0,
            'exp_rate'      => $inputs['exp_rate'] ?? 0,
            'coin_rate'     => $inputs['coin_rate'] ?? 0,
            'effect_rate'   => $inputs['effect_rate'] ?? 0,
            'effect_value'  => $inputs['effect_value'] ?? 0,
            'sale_price'    => $inputs['sale_price'] ?? 0,
            'buy_price'     => $inputs['buy_price'] ?? 0,
        ]);
    }
}
