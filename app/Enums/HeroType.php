<?php

namespace App\Enums;

enum HeroType: int
{
    case ATTACKER       = 1;
    case DEFENDER       = 2;
    case EXECUTIONER    = 3;
    case SHADOWER       = 4;
    case SUPPORTER      = 5;

    public function color(): string
    {
        return match ($this) {
            self::ATTACKER      => 'red',
            self::DEFENDER      => 'orange',
            self::EXECUTIONER   => 'yellow',
            self::SHADOWER      => 'purple',
            self::SUPPORTER     => 'green',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::ATTACKER      => 'Attacker',
            self::DEFENDER      => 'Defender',
            self::EXECUTIONER   => 'Executioner',
            self::SHADOWER      => 'Shadower',
            self::SUPPORTER     => 'Supporter',
        };
    }
}
