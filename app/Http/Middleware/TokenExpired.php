<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TokenExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $token = $request->bearerToken();
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->expires_at && now()->greaterThan($accessToken->expires_at)) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['token_expired' => 'Your session has expired. Please log in again.']);
            }
        }

        return $next($request);
    }
}
