<?php

namespace App\Http\Middleware;

use Closure;

class CheckIdMiddleWare
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
        if($request['cost'] <= 0)
            return back();
        else
            return $next($request);
    }
}
