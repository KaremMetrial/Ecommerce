<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function login()
    {
        return view('dashboard.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::guard('admin')->attempt($credentials, $request->filled('remember_token'))) {
            return back()->withErrors(['email' => __('Invalid credentials.')]);
        }

        return redirect()->intended(route('admin.dashboard'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('admin.login'));
    }
}
