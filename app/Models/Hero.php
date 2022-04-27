<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'bio',
        'avatar',
        'rarity',
        'element',
        'type',
        'attack',
        'health',
        'defend',
        'eva',
        'aim',
        'crit_rate',
        'crit_damage',
        'exp_rate',
        'coin_rate',
        'status',
    ];
}
