<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureOTPVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $otp_verified = FacadesSession::get('isVerified');

        // Add debugging
        Log::info('OTP Verification Check', [
            'isVerified' => $otp_verified,
            'user_authenticated' => Auth::check(),
            'session_all' => FacadesSession::all()
        ]);

        if (Auth::check() && !$otp_verified) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'debug_info' => [
                    'isVerified' => $otp_verified,
                    'user_authenticated' => Auth::check()
                ]
            ], 403);
        }

        return $next($request);
    }
}
