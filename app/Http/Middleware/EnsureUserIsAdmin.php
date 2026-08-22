<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and has role 'admin'
        // Note: Since we are using simple simulation in routes currently, 
        // we might need to adjust this once we have full auth.
        // For now, let's assume we will implement proper Auth::user() check.

        // However, since the current route implementation is just closures without real Auth::login,
        // this middleware might not work as expected until we switch to real Auth.
        // But the user requested "Route admin must use middleware".

        // Let's implement the standard Laravel Auth check.
        // If the user session has 'role' = 'admin' (simulated) or Auth::user()->role == 'admin'

        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
