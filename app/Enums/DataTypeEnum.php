<?php

namespace App\Enums;

enum DataTypeEnum: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case DATE = 'date';
    case TIME = 'time';
    case DATETIME = 'datetime';
    case FILE = 'file';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::STRING => __('String'),
            self::INTEGER => __('Integer'),
            self::BOOLEAN => __('Boolean'),
            self::DATE => __('Date'),
            self::TIME => __('Time'),
            self::DATETIME => __('Datetime'),
            self::FILE => __('File'),
        };
    }
}
