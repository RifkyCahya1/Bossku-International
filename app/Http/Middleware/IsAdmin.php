<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            return redirect()->route('home')->with('error', 'Kamu tidak punya akses ke halaman admin.');
        }

        return $next($request);
    }
}
