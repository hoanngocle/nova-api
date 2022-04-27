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
            'nickname'      => $this->faker->colorName,
            'gender'        => $this->faker->numberBetween(1,2),
            'skin'          => $this->faker->imageUrl,
            'avatar'        => config('images.image_directory') . config('images.user.avatar_path') . 'avatar_' . $this->faker->numberBetween(1,11),

            'attack'        => $this->faker->numberBetween(0,5000),
            'health'        => $this->faker->numberBetween(0,5000),
            'defend'        => $this->faker->numberBetween(0,5000),
            'eva'      => $this->faker->numberBetween(0,5000),
            'aim'      => $this->faker->numberBetween(0,5000),
            'crit_rate'     => $this->faker->numberBetween(0,5000),
            'crit_damage'   => $this->faker->numberBetween(0,5000),
            'exp_rate'      => $this->faker->numberBetween(0,5000),
            'coin_rate'     => $this->faker->numberBetween(0,5000),
            'gem_rate'      => $this->faker->numberBetween(0,5000),
            'spirit_rate'   => $this->faker->numberBetween(0,5000),

            'job_pharmacist_level'  => $this->faker->numberBetween(0,10),
            'job_pharmacist_exp'    => $this->faker->numberBetween(0,5000),
            'job_alchemist_level'   => $this->faker->numberBetween(0,10),
            'job_alchemist_exp'     => $this->faker->numberBetween(0,5000),

            'inventory_size'    => $this->faker->numberBetween(1,36),
            'vault_size'        => $this->faker->numberBetween(1,36),
            'gem'               => $this->faker->numberBetween(0,5000),
            'coin'              => $this->faker->numberBetween(0,500000),
            'level'             => $this->faker->numberBetween(0,50),
            'exp'               => $this->faker->numberBetween(0,50000),
        ];
    }
}
