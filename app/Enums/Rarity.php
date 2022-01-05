<?php

namespace App\Enums;

enum Rarity
{
    case COMMON;
    case NORMAL;
    case RARE;
    case EPIC;
    case UNIQUE;
    case LEGENDARY;

    public function color(): string
    {
        return match ($this) {
            self::COMMON    => 'grey',
            self::NORMAL    => 'green',
            self::RARE      => 'blue',
            self::EPIC      => 'purple',
            self::UNIQUE    => 'yellow',
            self::LEGENDARY => 'red',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::COMMON    => 'Phàm phẩm',
            self::NORMAL    => 'green',
            self::RARE      => 'blue',
            self::EPIC      => 'purple',
            self::UNIQUE    => 'yellow',
            self::LEGENDARY => 'red',
        };
    }
}
