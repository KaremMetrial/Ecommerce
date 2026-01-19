<?php

namespace App\Enums;

enum DiscountTypeEnum: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::FIXED => __('Fixed'),
            self::PERCENTAGE => __('Percentage'),
        };
    }
}
