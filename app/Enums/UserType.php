<?php

namespace App\Enums;

enum UserType: int
{
    case MEMBER         = 1;
    case ADMIN          = 2;
    case SUPER_ADMIN    = 9;

    public function color(): string
    {
        return match ($this) {
            self::MEMBER        => 'grey',
            self::ADMIN         => 'green',
            self::SUPER_ADMIN   => 'red',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::MEMBER        => 'Người Chơi',
            self::ADMIN         => 'Thiên Hành Giả',
            self::SUPER_ADMIN   => 'Chưởng Khống Giả',
        };
    }
}
