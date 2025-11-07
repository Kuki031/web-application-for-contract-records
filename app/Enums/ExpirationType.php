<?php

namespace App\Enums;

enum ExpirationType: string
{
    case HalfYear = 'half_year';
    case FullYear = 'full_year';

    public function label(): string
    {
        return match ($this) {
            self::HalfYear => '6 mjeseci',
            self::FullYear => '1 godina',
        };
    }

    public static function options(): array
    {
        return [
            self::HalfYear,
            self::FullYear,
        ];
    }
}
