<?php

namespace App\Enums;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';

    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::CONFIRMED => __('Confirmed'),
            self::DELIVERED => __('Delivered'),
            self::CANCELLED => __('Cancelled'),
        };
    }
}
