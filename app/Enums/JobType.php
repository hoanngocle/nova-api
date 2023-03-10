<?php

namespace App\Enums;

enum JobType: int
{
    case WATER      = 1;
    case FIRE       = 2;

    public function color(): string
    {
        return match ($this) {
            self::WATER     => 'blue',
            self::FIRE      => 'red',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::WATER     => 'Thủy',
            self::FIRE      => 'Hỏa',
        };
    }
}
