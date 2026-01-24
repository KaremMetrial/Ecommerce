<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandTranslation extends Model
{
    use SoftDeletes;

    public $timestamps = false;
}
