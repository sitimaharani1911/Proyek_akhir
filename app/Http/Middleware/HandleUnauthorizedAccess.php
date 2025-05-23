<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class HandleUnauthorizedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if (session()->has('selected_role')) {
                session()->forget('selected_role');
            }
            return redirect()->route('login');
        }

        if (!session()->has('selected_role')) {
            return redirect()->route('select.role');
        }

        return $next($request);
    }
}
