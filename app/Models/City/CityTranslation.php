<?php

namespace App\Models\City;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityTranslation extends Model
{
    use SoftDeletes;

    public $timestamps = false;
}
