<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tags extends Model
{
    // ================== Relationships =========================
    // ========= Belongs To Many ========
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
