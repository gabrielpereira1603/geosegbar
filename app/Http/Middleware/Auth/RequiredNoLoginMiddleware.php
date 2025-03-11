<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RequiredNoLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user') || session()->has('token')) {
            return redirect()->route('users')->with('status', 'Você já está logado!');
        }

        return $next($request);
    }
}
