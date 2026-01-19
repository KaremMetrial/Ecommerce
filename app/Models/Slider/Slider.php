<?php

namespace App\Models\Slider;

use App\Models\Product\Product;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slider extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['title', 'description'];
    protected $with = ['translations'];
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
    // ================== Relationships =========================
    // ========= Belongs To ========
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    // ================== Media =========================
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slider')
            ->withResponsiveImages()
            ->singleFile();
    }
}
