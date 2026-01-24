<?php

namespace App\Models\Setting;

use App\Enums\DataTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $appends = ['value'];

    protected $casts = [
        'type' => DataTypeEnum::class,
    ];

    public function getValueAttribute($value)
    {
        if ($this->type === DataTypeEnum::FILE) {
            return asset($value);
        }

        return $value;
    }
}
