<?php

namespace App\Http\Requests\Hero;

use Illuminate\Foundation\Http\FormRequest;

class CreateHeroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:users|max:100',
            'bio'           => 'required|unique:users|max:255',
            'avatar'        => 'required|max:255',
            'rarity'        => 'required|integer',
            'element'       => 'required|integer',
            'type'          => 'required|integer',
            'status'        => 'required|in: ' . implode(',', [0, 1]),
            'attack'        => 'required|number',
            'defend'        => 'required|number',
            'health'        => 'required|number',
            'eva_rate'      => 'nullable|number',
            'aim_rate'      => 'nullable|number',
            'crit_rate'     => 'nullable|number',
            'crit_damage'   => 'nullable|number',
            'exp_rate'      => 'nullable|number',
            'coin_rate'     => 'nullable|number',
            'effect_rate'   => 'nullable|number',
            'effect_value'  => 'nullable|number',
            'sale_price'    => 'nullable|number',
            'buy_price'     => 'nullable|number',
        ];
    }
}
