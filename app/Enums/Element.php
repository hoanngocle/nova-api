<?php

namespace App\Enums;

enum Element: int
{
    case WATER      = 1;
    case FIRE       = 2;
    case WIND       = 3;
    case THUNDER    = 4;
    case DARK       = 5;
    case LIGHT      = 6;

    public function color(): string
    {
        return match ($this) {
            self::WATER     => 'blue',
            self::FIRE      => 'red',
            self::WIND      => 'green',
            self::THUNDER   => 'yellow',
            self::DARK      => 'dark',
            self::LIGHT     => 'white',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::WATER     => 'Thủy',
            self::FIRE      => 'Hỏa',
            self::WIND      => 'Phong',
            self::THUNDER   => 'Lôi',
            self::DARK      => 'Ám',
            self::LIGHT     => 'Quang',
        };
    }
}
