<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsPartner
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['partner', 'superadmin', 'admin'])) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}