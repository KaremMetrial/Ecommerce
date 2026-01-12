<?php

namespace App\Models\Category;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes;
    public $translatedAttributes = ['name'];
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
    // Relations
    // ========= Belongs To ========
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    // ========= Has Many ========
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
