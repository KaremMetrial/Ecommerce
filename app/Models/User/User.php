<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\City\City;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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
    protected function phone($query, $phone)
    {
        $query->wherePhone($phone);
    }

    #[Scope]
    protected function email($query, $email)
    {
        $query->whereEmail($email);
    }

    // Relations
    // ========= Belongs To ========
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
