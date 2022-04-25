<?php

namespace App\Enums;

enum InventoryType: int
{
    case BAG    = 1;
    case VAULT  = 2;

    public function text(): string
    {
        return match ($this) {
            self::BAG   => 'Hành Trang',
            self::VAULT => 'Rương',
        };
    }
}
