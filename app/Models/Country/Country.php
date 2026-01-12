<?php

namespace App\Models\Country;

use App\Models\City\City;
use App\Models\Governorate\Governorate;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Scope;

class Country extends Model implements TranslatableContract
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
    #[Scope]
    protected function code($query, $code)
    {
        $query->whereCode($code);
    }
    #[Scope]
    protected function phoneCode($query, $phoneCode)
    {
        $query->wherePhoneCode($phoneCode);
    }
    // Relations
    // ========= Has Many ========
    public function governorates(): HasMany
    {
        return $this->hasMany(Governorate::class);
    }
    // ========= Has Many Through ========
    public function cities(): HasManyThrough
    {
        return $this->hasManyThrough(City::class, Governorate::class);
    }
}
