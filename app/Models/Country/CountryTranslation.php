<?php

namespace App\Models\Country;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryTranslation extends Model
{
    use SoftDeletes;

    public $timestamps = false;
}
