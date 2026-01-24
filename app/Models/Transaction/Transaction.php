<?php

namespace App\Models\Transaction;

use App\Enums\TransactionStatusEnum;
use App\Models\Order\Order;
use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $casts = [
        'status' => TransactionStatusEnum::class,
    ];

    // ================== Relationships =========================
    // ========= Belongs To ========
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
