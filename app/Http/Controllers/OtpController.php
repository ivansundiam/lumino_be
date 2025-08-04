<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    use ApiResponse;
    public function send(User $user)
    {
        try {
            $otpCode = random_int(100000, 999999);

            Session::put('user_otp', $otpCode);
            Session::put('user_otp_expires_at', now()->addHours(24));

            Mail::to($user->email)->send(new OtpMail($otpCode));

            return $this->success(null, "OTP has been sent to your email successully");
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function verify(Request $request)
    {
        $sessionOtp = Session::get('user_otp');
        $sessionOtpExpiry = Session::get('user_otp_expires_at');

        if ($sessionOtp && now()->greaterThan($sessionOtpExpiry)) {
            $this->clearSession();

            return $this->error('Invalid OTP code.');
        }
        if($sessionOtp == $request->input('otp')) {
            $this->clearSession();

            $user = User::find(Auth::id());
            $user->update(['email_verified_at' => now()]);

            return $this->success(null, 'Email verified');
        }
        else {
            return $this->error('Invalid OTP code.');
        }
    }

    private function clearSession()
    {
        Session::forget('user_otp');
        Session::forget('user_otp_expires_at');
    }
}
