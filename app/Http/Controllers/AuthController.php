<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public $temp_otp;
    public function authenticating(Request $request)
    {
        $this->temp_otp = $request->input('temp_otp'); // Retrieve 'tempt_otp' from request
        // Mail::to(Auth::user()->email)->send(new MailerLoginOtp(Auth::user()->email, $this->temp_otp));
        Session::put('temp_otp', $this->temp_otp);
        return response()->json(['status' =>  'already send otp: ' .  Session::get('temp_otp')], 200);
    }

    public function verifyOTP(Request $request)
    {
        $user_otp =  (int)  $request->input('otp');
        $temp_otp = Session::get('temp_otp');

        // Validate OTP
        if ($temp_otp === $user_otp) {
            // OTP verification successful
            Session::put('isVerified', true);
            $isVerified = Session::get('isVerified');
            return response()->json(['status' => $isVerified], 200);
        }

        return response()->json(['status' => 'Check your OTP again, make sure you entered it correctly.'], 401);
    }

    public function checkingStatusOTP()
    {
        $isVerified = Session::get('isVerified');
        return response()->json(['status' => $isVerified], 200);
    }

    public function checkRegisterEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            Session::put('email', $email);
            Session::put('isEmailValid', true);
            return response()->json(['isEmailValid' => true], 200);
        }

        Session::put('isEmailValid', false);
        return response()->json(['isEmailValid' => false], 200);
    }

    public function checkStatusEmail()
    {
        $isVerified = Session::get('isEmailValid');
        return response()->json(['status' => $isVerified], 200);
    }
}
