<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id',
            'nickname',
            'gender',
            'skin',
            'avatar',
            'attack',
            'health',
            'defend',

            'eva_rate',
            'aim_rate',
            'crit_rate',
            'crit_damage',
            'exp_rate',
            'coin_rate',
            'gem_rate',
            'spirit_rate',

            'job_pharmacist_level',
            'job_pharmacist_exp',
            'job_alchemist_level',
            'job_alchemist_exp',

            'inventory_size',
            'gem',
            'coin',
            'level',
            'exp'
        ];
    }
}
