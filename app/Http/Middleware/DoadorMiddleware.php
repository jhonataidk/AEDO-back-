<?php

namespace App\Http\Middleware;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DoadorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->id_perfil === 2) {
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
