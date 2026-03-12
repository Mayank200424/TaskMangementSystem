<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class ManagerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('manager')->check()) {
            return redirect()->route('manager.login')
                ->with('error', 'Please login as Manager');
        }

        if (Auth::guard('manager')->user()->role !== 'manager') {
            Auth::guard('manager')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('manager.login')
                ->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
