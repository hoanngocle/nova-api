<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Hero\CreateHeroRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateHeroData extends DataTransferObject
{
    public string $name;
    public string $type;

    /**
     * @param CreateHeroRequest $request
     * @return CreateHeroData
     * @throws UnknownProperties
     */
    public static function fromRequest(CreateHeroRequest $request): CreateHeroData
    {
        $inputs = $request->validated();

        return new self([
            'name'          => $inputs['name'],
            'bio'           => $inputs['bio'],
            'avatar'        => $inputs['avatar'],
            'rarity'        => $inputs['rarity'],
            'element'       => $inputs['element'],
            'type'          => $inputs['type'],
            'status'        => $inputs['status'],
            'defend'        => $inputs['defend'],
            'health'        => $inputs['health'],
            'eva_rate'      => $inputs['eva_rate'],
            'aim_rate'      => $inputs['aim_rate'],
            'crit_rate'     => $inputs['crit_rate'],
            'crit_damage'   => $inputs['crit_damage'],
            'exp_rate'      => $inputs['exp_rate'],
            'coin_rate'     => $inputs['coin_rate'],
            'effect_rate'   => $inputs['effect_rate'],
            'effect_value'  => $inputs['effect_value'],
            'sale_price'    => $inputs['sale_price'],
            'buy_price'     => $inputs['buy_price'],
        ]);
    }
}
