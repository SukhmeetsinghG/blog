<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class Authcheck
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
        if(session::has('emailid'))
        return $next($request);
    return redirect('practice/pract-login');
    }
}
