<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
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
    protected function default($query)
    {
        $query->whereIsDefault(true);
    }
}
