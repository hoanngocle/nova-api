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
    case MYTHICAL;

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
