<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\PasswordResetRequest;
use App\Notifications\SendOtp;
use App\Repositories\Contracts\AdminRepositoryInterface as AdminRepository;
use App\Repositories\Contracts\OtpRepositoryInterface as OtpRepository;
use App\Services\OtpService;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct(
        protected AdminRepository $adminRepository,
        protected OtpRepository $otpRepository,
    ){}
    public function requestPasswordReset()
    {
        return view('dashboard.auth.password.email');
    }

    public function sendPasswordResetOtp(PasswordResetRequest $request)
    {
        $admin = $this->adminRepository->findByEmail($request->input('email'));

        $otp = $this->otpRepository->create(['identifier' => $admin->email, 'validity' => 10]);
        $admin->notify(new SendOtp($otp->token, 10));

        request()->session()->put('email', $admin->email);
        return redirect()->route('admin.password.confirm.index')->with('success', __('OTP sent successfully.'));
    }
    public function confirmPasswordReset()
    {
        return view('dashboard.auth.password.confirm');
    }
    public function confirmPasswordResetPost()
    {
        $validated = $this->otpRepository->validate(request()->session()->get('email'), request()->input('otp'));
        if (!$validated) {
            return redirect()->back()->withErrors([
                'otp' => __('Invalid OTP.')
            ]);
        }
        return redirect()->route('admin.password.reset.index')->with('success', __('OTP verified successfully. You can now reset your password.'));
    }
    public function resetPasswordForm()
    {
        return view('dashboard.auth.password.reset', ['email' => request()->session()->get('email')]);
    }
    public function resetPassword()
    {
        $admin = $this->adminRepository->updateByEmail(request()->session()->get('email'), ['password' => Hash::make(request()->input('password'))]);
        request()->session()->forget('email');
        return redirect()->route('admin.login')->with('success', __('Password reset successful.'));
    }

}
