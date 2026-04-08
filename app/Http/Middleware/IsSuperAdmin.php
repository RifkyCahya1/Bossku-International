<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'superadmin') {
            abort(403, 'Akses ditolak. Hanya superadmin yang diizinkan.');
        }

        return $next($request);
    }
}
