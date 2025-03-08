<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetUserRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !session()->has('selected_role')) {
            $routeName = $request->route()->getName();
            if (!in_array($routeName, ['select.role', 'set.role', 'logout'])) {
                return redirect()->route('select.role');
            }
        }

        if (!Auth::check() && session()->has('selected_role')) {
            session()->forget('selected_role');
        }

        if (Auth::check() && session()->has('selected_role')) {
            Auth::user()->role = session('selected_role');
        }

        return $next($request);
    }
}
