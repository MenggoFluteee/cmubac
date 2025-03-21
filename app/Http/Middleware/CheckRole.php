<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        if (Auth::user()->role_id == $role) {
            return $next($request);
        }

        return redirect()->route('unauthorizedPage');
    }
}
