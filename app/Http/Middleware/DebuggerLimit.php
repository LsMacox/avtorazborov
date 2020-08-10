<?php

namespace App\Http\Middleware;

use Closure;

class DebuggerLimit
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
//        if (in_array(auth()->id(), [1, 2, 3, 4])) {
//            \Debugbar::enable();
//        }
//        else {
//            \Debugbar::disable();
//        }
        \Debugbar::enable();

        return $next($request);
    }
}
