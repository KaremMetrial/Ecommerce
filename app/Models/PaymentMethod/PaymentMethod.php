<?php

namespace App\Models\PaymentMethod;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ['name', 'code', 'description', 'is_active', 'is_cod'];

    // Scope
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
    protected function cod($query)
    {
        $query->whereIsCod(true);
    }

    // ========== Relationships ==========
    // ========= Has Many ========
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
