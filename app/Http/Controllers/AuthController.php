<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public $tempt_otp;
    public function authenticating(OtpRequest $request)
    {
        $this->tempt_otp = $request->input('tempt_otp'); // Retrieve 'tempt_otp' from request
        // Mail::to(Auth::user()->email)->send(new MailerLoginOtp(Auth::user()->email, $this->tempt_otp));
        Session::put('tempt_otp', $this->tempt_otp);
        return response()->json(['status' =>  'already send otp: ' .  Session::get('tempt_otp') . ' to ' . Auth::user()->email], 200);
    }

    public function verifyOTP(OtpRequest $request)
    {
        $user_otp =  (int)  $request->input('otp');
        // $tempt_otp = 123123;
        $tempt_otp = Session::get('tempt_otp');

        // Validate OTP
        if ($tempt_otp === $user_otp) {
            // OTP verification successful
            Session::put('isVerified', true);
            $isVerified = Session::get('isVerified');
            return response()->json(['status' => $isVerified], 200);
        }

        return response()->json(['status' => 'Check your OTP again, make sure you entered it correctly.' . $tempt_otp . ' ' . $user_otp], 401);
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
        return response()->json(
            [
                'isEmailValid' => Session::get('isEmailValid'),
                'authEmail' => Session::get('email'),
                'contactNum' => Session::get('contactNum'),
                'dialingCodeId' => Session::get('dialingCodeId'),
                'dialingCode' => Session::get('dialingCode'),
            ],
            200
        );
    }
}
