<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return $next($request);
    }
} 