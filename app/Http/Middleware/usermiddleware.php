<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class usermiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user() == null) {
            return redirect('home');
        }elseif (Auth::user()->role_id !='1' || Auth::user()->isleaseout !='0') {
            return redirect('home');
        } else {
            return $next($request);
        }
    }
}
