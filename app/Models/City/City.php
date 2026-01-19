<?php

namespace App\Models\City;

use App\Models\Country\Country;
use App\Models\Governorate\Governorate;
use App\Models\User\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model implements TranslatableContract
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
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    // ========= Has Many ========
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // ========= Has One Through ========
    public function country(): HasOneThrough
    {
        return $this->hasOneThrough(Country::class, Governorate::class);
    }
}
