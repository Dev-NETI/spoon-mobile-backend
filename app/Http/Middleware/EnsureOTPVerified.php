<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $otp_verified = Session::get('isVerified');

        if (Auth::check() && $otp_verified) {
            // Return a JSON response with the Next.js OTP login route
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthenticated.',
        ], 403); // 403 Forbidden status

    }
}
