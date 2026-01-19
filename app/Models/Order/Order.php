<?php

namespace App\Models\Order;

use App\Enums\StatusEnum;
use App\Models\City\City;
use App\Models\Transaction\Transaction;
use App\Models\User\AddressUser;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $casts = [
        'status' => StatusEnum::class,
        'user_data' => 'array',
        'address_data' => 'array',
    ];
    //================== Relationships =========================
    // ========= Belongs To ========
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(AddressUser::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    // ================== Has Many =========================
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    // ================== Has One =========================
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
