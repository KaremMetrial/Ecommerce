<?php

namespace App\Models\Cart;

use App\Models\Option\Option;
use App\Models\Option\OptionValue;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CartItem extends Model
{
    // ========== Relationships ==========
    // ========= Belongs To ========
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    // ========= Belongs To Many ========
    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class, 'cart_item_option_value');
    }
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'cart_item_option_value');
    }
}
