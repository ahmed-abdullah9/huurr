<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class FreelancerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if (!empty(Session::get('login_id')) && (Session::get('user_role') == 'freelancer' || Session::get('user_role') == 'admin')) {
            return $next($request);
        }
        return redirect()->guest('login');
        //return redirect('login');
    }
}
