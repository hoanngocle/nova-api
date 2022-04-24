<?php

namespace App\Enums;

enum HeroStatus: int
{
    case PREPARE = 0;
    case RELEASE = 1;

    public function color(): string
    {
        return match ($this) {
            self::PREPARE   => 'grey',
            self::RELEASE   => 'green',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::PREPARE    => 'Phàm Phẩm',
            self::RELEASE    => 'Thường',
        };
    }
}
