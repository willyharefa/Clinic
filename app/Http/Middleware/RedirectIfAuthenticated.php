<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if($guard === 'patient') {
                    return redirect()->route('dashboard_patient');
                }
                elseif($guard === 'doctor') {
                    return redirect()->route('dashboard_doctor');
                }
                elseif($guard === 'pharmacist') {
                    return redirect()->route('dashboard_pharmacist');
                }
                else {
                    return redirect()->route('dashboard_admin');
                }
                // return redirect(RouteServiceProvider::HOME);
                // else 
            }
        }

        return $next($request);
    }
}
