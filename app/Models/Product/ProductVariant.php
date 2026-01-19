<?php

namespace App\Models\Product;

use App\Models\Option\Option;
use App\Models\Option\OptionValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductVariant extends Model
{
    // ================== Relationships =========================
    // ========= Belongs To ========
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    // ========= Belongs To Many ========
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'variant_option_value');
    }
    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class, 'variant_option_value');
    }
}
