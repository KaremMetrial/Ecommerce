<?php

namespace App\Models\Coupon;

use App\Enums\DiscountTypeEnum;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
        'discount_type' => DiscountTypeEnum::class,
    ];

    #[Scope]
    protected function active($query)
    {
        $query->whereIsActive(true);
    }

    #[Scope]
    protected function inactive($query)
    {
        $query->whereIsActive(false);
    }

    #[Scope]
    protected function code($query, $code)
    {
        $query->whereCode($code);
    }

    #[Scope]
    protected function discountType($query, $discountType)
    {
        $query->whereDiscountType($discountType);
    }

    // Relations
    // ========= Belongs To ========
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
