<?php

namespace App\Models\Option;

use App\Models\Order\OrderItem;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OptionValue extends Model
{
    // ========== Relationships ==========
    // ========= Belongs To ========
    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }
    // ========= Belongs To Many ========
    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'variant_option_value');
    }
    public function orderItems(): BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class, 'order_item_option_value');
    }
}
