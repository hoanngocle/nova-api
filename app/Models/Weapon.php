<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Weapon extends Model
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

    /**
     * @return HasOne
     */
    public function attribute(): HasOne
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }
}
