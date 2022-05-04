<?php

namespace App\Enums;

enum UserStatus: int
{
    case WAITING    = 0;
    case ACTIVE     = 1;
    case DISABLE    = 2;

    public function text(): string
    {
        return match ($this) {
            self::WAITING   => 'Tài khoản chờ kích hoạt',
            self::ACTIVE    => 'Tài khoản đã kích hoạt',
            self::DISABLE   => 'Tài khoản đã bị cấm',
        };
    }
}
