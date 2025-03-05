<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorTokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('2fa:user:id') || !Session::has('2fa:token') || now()->greaterThan(Session::get('2fa:expires_at'))) {
            return redirect()->route('login')->withErrors(['form.email' => 'O código expirou. Faça login novamente.']);
        }

        return $next($request);
    }
}
