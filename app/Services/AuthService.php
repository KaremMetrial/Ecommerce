<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function authenticate($credentials, $remember, $guard = 'admin')
    {
        return Auth::guard($guard)->attempt($credentials, $remember);
    }

    public static function logout($guard = 'admin')
    {
        Auth::guard($guard)->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
