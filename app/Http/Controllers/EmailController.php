<?php

namespace App\Http\Controllers;

use App\Mail\SendVerificationCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendVerificationCode($verificationCode, $email)
    {
        try {
            $send = Mail::to($email)
                ->send(new SendVerificationCode($verificationCode));

            if (!$send) {
                return response()->json(false);
            }

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
