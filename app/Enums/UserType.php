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
            self::ADMIN         => 'Chưởng Khống Giả',
            self::SUPER_ADMIN   => 'Sáng Thế Thần',
        };
    }

    public function ability(): string
    {
        return match ($this) {
            UserType::SUPER_ADMIN    => 'super-admin-access',
            UserType::ADMIN          => 'admin-access',
            UserType::MEMBER         => 'member-access',
        };
    }
}
