<?php

namespace App\Models\Governorate;

use App\Models\City\City;
use App\Models\Country\Country;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Governorate extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;

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
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    // ========= Has Many ========
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
