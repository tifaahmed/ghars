<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsDashboard {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!Auth::Check() || Auth::User()->active != "yes" || Auth::User()->type != "company") {
            if (Auth::Check()) {
                Auth::logout();
            }
            return redirect('dashboard/login');
        }
        return $next($request);
    }

}
