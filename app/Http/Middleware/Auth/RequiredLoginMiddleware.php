<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequiredLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user') || !session()->has('token')) {
            return redirect()->route('login')->with('status', 'Você precisa estar autenticado!');
        }

        return $next($request);
    }
}
