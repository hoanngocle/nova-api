<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'nickname',
        'gender',
        'skin',
        'avatar',
        'attack',
        'health',
        'defend',

        'eva',
        'aim',
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
