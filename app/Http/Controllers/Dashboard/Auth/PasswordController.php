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
        toastr()->positionClass('toast-bottom-right')->success(__('OTP sent successfully.'));
        return redirect()->route('admin.password.confirm.index');
    }
    public function confirmPasswordReset()
    {
        return view('dashboard.auth.password.confirm');
    }
    public function confirmPasswordResetPost()
    {
        $validated = $this->otpRepository->validate(request()->session()->get('email'), request()->input('otp'));
        if (!$validated) {
            toastr()->positionClass('toast-bottom-right')->error(__('Invalid OTP.'));
            return redirect()->back();
        }
        toastr()->positionClass('toast-bottom-right')->success(__('OTP verified successfully. You can now reset your password.'));
        return redirect()->route('admin.password.reset.index');
    }
    public function resetPasswordForm()
    {
        return view('dashboard.auth.password.reset', ['email' => request()->session()->get('email')]);
    }
    public function resetPassword()
    {
        $admin = $this->adminRepository->updateByEmail(request()->session()->get('email'), ['password' => Hash::make(request()->input('password'))]);
        request()->session()->forget('email');

        toastr()->positionClass('toast-bottom-right')->success(__('Password reset successful.'));
        return redirect()->route('admin.login');
    }

}
