<?php

namespace App\Models\Option;

use App\Enums\DataTypeEnum;
use App\Models\Cart\CartItem;
use App\Models\Category\Category;
use App\Models\Order\OrderItem;
use App\Models\Product\ProductVariant;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'unit'];

    protected $with = ['translations'];

    protected $casts = [
        'is_active' => 'boolean',
        'type' => DataTypeEnum::class,
    ];

    // Scope
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
    protected function type($query, $type)
    {
        $query->whereType($type);
    }

    // ========== Relationships ==========
    // ========= Belongs To Many ========
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_option');
    }

    // ========= Has Many ========
    public function values(): HasMany
    {
        return $this->hasMany(OptionValue::class);
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

    public function cartItems(): BelongsToMany
    {
        return $this->belongsToMany(CartItem::class, 'cart_item_option_value');
    }
}
