<?php

namespace App\Enums;

enum JobType: int
{
    case APOTHECARY = 1; // Luyện dược sư
    case ALCHEMIST  = 2; // Luyện khí sư

    public function text(): string
    {
        return match ($this) {
            self::APOTHECARY    => 'Luyện dược sư',
            self::ALCHEMIST     => 'Luyện khí sư',
        };
    }
}
