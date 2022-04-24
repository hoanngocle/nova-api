<?php

namespace App\Enums;

enum Rarity: int
{
    case COMMON     = 1;
    case NORMAL     = 2;
    case RARE       = 3;
    case EPIC       = 4;
    case UNIQUE     = 5;
    case LEGENDARY  = 6;
    case MYTHICAL   = 7;

    public function color(): string
    {
        return match ($this) {
            self::COMMON    => 'grey',
            self::NORMAL    => 'green',
            self::RARE      => 'blue',
            self::EPIC      => 'purple',
            self::UNIQUE    => 'yellow',
            self::LEGENDARY => 'orange',
            self::MYTHICAL  => 'red',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::COMMON    => 'Phàm Phẩm',
            self::NORMAL    => 'Thường',
            self::RARE      => 'Hiếm',
            self::EPIC      => 'Cực Hiếm',
            self::UNIQUE    => 'Siêu Phẩm',
            self::LEGENDARY => 'Huyền Thoại',
            self::MYTHICAL  => 'Thần Thoại',
        };
    }
}
