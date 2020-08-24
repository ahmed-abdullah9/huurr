<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use Illuminate\Support\Facades\Auth;
use DB;

class Authenticate {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!empty(Session::get('login_id')) && (Session::get('user_role') == 'admin')) {
            return $next($request);
        }
        return redirect()->guest('login');
        //return redirect('login');
        
    }

    public function handle2($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('login');
            }
        }
        return $next($request);
    }

}
