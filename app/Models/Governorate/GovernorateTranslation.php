<?php

namespace App\Models\Governorate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GovernorateTranslation extends Model
{
    use SoftDeletes;

    public $timestamps = false;
}
