<?php

namespace App\Models\Order;

use App\Models\Option\OptionValue;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderItem extends Model
{
    protected $casts = [
        'product_data' => 'array',
    ];

    // ================== Relationships =========================
    // ========= Belongs To ========
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
    // ========= Belongs To Many ========
    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class, 'order_item_option_value');
    }
}
