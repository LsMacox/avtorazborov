<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $userRole = auth()->user()->getRole();

        if ( (string) $userRole == (string) $role) {
            return $next($request);
        }

        return abort(404);
    }
}
