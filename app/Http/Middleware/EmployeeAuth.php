<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class EmployeeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('employee')->check()) {
            return redirect()->route('employee.login')
                ->with('error', 'Please login as Employee');
        }

        if (Auth::guard('employee')->user()->role !== 'employee') {
            Auth::guard('employee')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('employee.login')
                ->with('error', 'Unauthorized access');
        }
        return $next($request);
    }
}
