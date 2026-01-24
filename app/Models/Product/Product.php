<?php

namespace App\Models\Product;

use App\Enums\DiscountTypeEnum;
use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Currency\Currency;
use App\Models\Slider\Slider;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia, TranslatableContract
{
    use InteractsWithMedia, SoftDeletes, Translatable;

    public $translatedAttributes = ['name'];

    protected $with = ['translations'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_auto_manage_stock' => 'boolean',
        'is_available_in_stock' => 'boolean',
        'discount_type' => DiscountTypeEnum::class,
    ];

    // Scopes
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
    protected function sku($query, $sku)
    {
        $query->whereSku($sku);
    }

    #[Scope]
    protected function availableFor($query, $availableFor)
    {
        $query->whereAvailableFor($availableFor);
    }

    #[Scope]
    protected function discountStartDate($query, $discountStartDate)
    {
        $query->whereDiscountStartDate($discountStartDate);
    }

    #[Scope]
    protected function discountEndDate($query, $discountEndDate)
    {
        $query->whereDiscountEndDate($discountEndDate);
    }

    #[Scope]
    protected function autoManageStock($query)
    {
        $query->whereIsAutoManageStock(true);
    }

    #[Scope]
    protected function notAutoManageStock($query)
    {
        $query->whereIsAutoManageStock(false);
    }

    #[Scope]
    protected function availableInStock($query)
    {
        $query->whereIsAvailableInStock(true);
    }

    #[Scope]
    protected function notAvailableInStock($query)
    {
        $query->whereIsAvailableInStock(false);
    }

    // ================== Relationships =========================
    // ========= Belongs To ========
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    // ================== Belongs To Many =========================
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class);
    }

    // ================== Has Many =========================
    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class);
    }

    // ================== Media =========================
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->withResponsiveImages();
    }
}
