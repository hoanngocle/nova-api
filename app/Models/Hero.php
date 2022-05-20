<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hero extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'attribute_id',
        'name',
        'bio',
        'avatar',
        'rarity',
        'element',
        'type',
        'status',
    ];

    /**
     * @return HasOne
     */
    public function attribute(): HasOne
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(HeroImage::class);
    }
}
