<?php

namespace App\Models\Brand;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model implements TranslatableContract
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
}
