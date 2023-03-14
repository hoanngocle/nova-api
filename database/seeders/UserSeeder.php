<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();
        Character::query()->truncate();

        $data = [
            [
                'username'          => 'admin',
                'email'             => 'admin@nova.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('admin'),
                'bio'               => 'Darkness guide you, child. You have outgrown this house, of that I am now certain. Should you return again here, I shall keep you safe.',
                'avatar'            => 'images/avatar/avatar_1.jpg',
                'dob'               => '2021-03-08',
                'address'           => '1041 Rogers Street, Cincinnati, South Carolina',
                'remember_token'    => 'AcjJJGqrohOnFhtMRtSn',
                'role'              => UserType::SUPER_ADMIN->value,
                'status'            => UserStatus::ACTIVE->value,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'username'          => 'user',
                'email'             => 'user@nova.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('user'),
                'bio'               => 'Mother Night, we like to call her, though rare is the occasion when she dotes on us. She has her many, many children to look after, many of whom reside now in locales beyond my reckoning, and perhaps beyond hers. ',
                'avatar'            => 'images/avatar/avatar_2.jpg',
                'dob'               => '2021-03-08',
                'address'           => '1041 Rogers Street, Cincinnati, South Carolina',
                'remember_token'    => 'AcjJJGqrohOnFhtMRtSn',
                'role'              => UserType::ADMIN->value,
                'status'            => UserStatus::ACTIVE->value,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ];

        User::insert($data);
        User::factory(10)->create()->each(function ($user) {
            Character::factory()->for($user)->create();
        });
    }
}
