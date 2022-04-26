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
            'email_verified_at' => $this->faker->dateTime(),
            'password'          => Hash::make('password'),
            'bio'               => $this->faker->text(200),
            'avatar'            => config('images.image_directory') . config('images.user.avatar_path') . 'avatar_' . $this->faker->numberBetween(1,11),
            'dob'               => $this->faker->dateTimeBetween('1980-01-01', '2012-12-31')->format('Y-m-d'),
            'address'           => $this->faker->address(),
            'remember_token'    => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'role'              => $this->faker->numberBetween(1,2),
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
