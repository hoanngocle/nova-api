<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'attack',
        'health',
        'defend',
        'eva',
        'aim',
        'crit_rate',
        'crit_damage',
        'exp_rate',
        'coin_rate',
        'effect_rate',
        'effect_value',
        'sale_price',
        'buy_price',
    ];

    public function hero(): BelongsTo
    {
        return $this->belongsTo(Hero::class);
    }
}
