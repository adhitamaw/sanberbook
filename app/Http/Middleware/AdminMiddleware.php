<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('AdminMiddleware executed for: '.$request->url());
        
        if (auth()->user()->role !== 'admin') {
            \Log::warning('Unauthorized access attempt by user: '.auth()->user()->id);
            return redirect()->route('books.index')
                ->with('error', 'Akses ditolak - Hanya admin yang boleh mengakses');
        }
        
        return $next($request);
    }
} 