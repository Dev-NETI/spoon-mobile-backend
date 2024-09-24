<?php

namespace App\Http\Controllers;

use App\Mail\SendVerificationCode;
use App\SmsTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    use SmsTrait;

    public function sendVerificationCode($verificationCode, $email, $mobileNumber)
    {
        try {
            $send = Mail::to($email)
                ->send(new SendVerificationCode($verificationCode));

            if (!$send) {
                return response()->json(false);
            }

            $tarMsg = 'Welcome to SpoonPH. Your verification code is: '.$verificationCode.'. Please enter the code above on the verification page to verify your account and do not share this code with anyone.';
            $this->sendSMS($mobileNumber, $tarMsg);

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
