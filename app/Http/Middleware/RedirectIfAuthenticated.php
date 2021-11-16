<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if($user->isSuperAdmin()){
                return redirect('/admin/user');
            }else if($user->isAdmin()){
                return redirect('/admin/marketer');
            }else if($user->isMarketer()){
                return redirect('/marketer/marketers');
            }else if($user->isSeller()){

            }else if($user->isAccountant()){

            }else if($user->isMarketer()){


            }
        }

        return $next($request);
    }
}
