<?php

namespace App\Models\User;

use App\Models\City\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddressUser extends Model
{
    protected $casts = [
        'user_data' => 'array',
    ];

    // ================== Relationships =========================
    // ========= Belongs To ========
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
