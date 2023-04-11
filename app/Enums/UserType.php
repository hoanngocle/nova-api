<?php

namespace App\Enums;

enum UserType: int
{
    case SUPER_ADMIN    = 9;
    case ADMIN          = 1;
    case CLIENT         = 2;

    public function color(): string
    {
        return match ($this) {
            self::SUPER_ADMIN   => 'red',
            self::ADMIN         => 'green',
            self::CLIENT        => 'grey',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::CLIENT        => 'Người Chơi',
            self::ADMIN         => 'Chưởng Khống Giả',
            self::SUPER_ADMIN   => 'Sáng Thế Thần',
        };
    }

    public function ability(): string
    {
        return match ($this) {
            UserType::SUPER_ADMIN    => 'super-admin-access',
            UserType::ADMIN          => 'admin-access',
            UserType::CLIENT         => 'client-access',
        };
    }
}
