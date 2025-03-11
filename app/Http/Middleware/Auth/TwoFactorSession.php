<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('two_factor_start')) {
            return redirect()->route('login')->with('status', 'Tempo expirado, faça o login novamente!');
        }

        $start = session('two_factor_start');
        $now = Carbon::now();

        if ($now->diffInMinutes($start) > 5) {
            session()->forget('two_factor_start');
            return redirect()->route('login')->with('status', 'Tempo expirado, faça o login novamente!');
        }

        return $next($request);
    }
}
