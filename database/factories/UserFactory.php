<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'username'          => $this->faker->username(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'bio'               => $this->faker->text(200),
            'avatar'            => 'images/avatar/avatar_' . $this->faker->numberBetween(1,11),
            'dob'               => $this->faker->dateTimeBetween('1980-01-01', '2012-12-31')->format('Y-m-d'),
            'address'           => $this->faker->address(),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
