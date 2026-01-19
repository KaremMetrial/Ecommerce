<?php

namespace App\Models\Flag;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['question', 'answer'];
    protected $with = ['translations'];
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
