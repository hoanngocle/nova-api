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
            'name'          => 'required|unique:heroes|max:100',
            'bio'           => 'required|max:500',
            'avatar'        => 'required|max:255',
            'rarity'        => 'required|integer',
            'element'       => 'required|integer',
            'type'          => 'required|integer',
            'status'        => 'required|in: ' . implode(',', [0, 1]),
            'attack'        => 'required|numeric ',
            'defend'        => 'required|numeric ',
            'health'        => 'required|numeric ',
            'eva_rate'      => 'nullable|numeric ',
            'aim_rate'      => 'nullable|numeric ',
            'crit_rate'     => 'nullable|numeric ',
            'crit_damage'   => 'nullable|numeric ',
            'exp_rate'      => 'nullable|numeric ',
            'coin_rate'     => 'nullable|numeric ',
            'effect_rate'   => 'nullable|numeric ',
            'effect_value'  => 'nullable|numeric ',
            'sale_price'    => 'nullable|numeric ',
            'buy_price'     => 'nullable|numeric ',
        ];
    }
}
