<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifiedEmail
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {


        // if(Auth::guard('admin')->check()){
        //     $user = Auth::guard('admin')->user();
        //     $route = 'admin.login';
        // }else{
        //     $user = Auth::guard('web')->user();
        //     $route = 'login';
        // }
        $user = Auth::guard('web')->user();
        $route = 'verification.notice';
        if (!$user->email_verified_at) {
            //auth()->logout();
            //dd($route);
            return redirect()->route($route)
                    ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return $next($request);
    }
}
