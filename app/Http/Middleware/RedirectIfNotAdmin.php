<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next , $guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->guest('/admin/login');
        }
        return $next($request);
    }
}
