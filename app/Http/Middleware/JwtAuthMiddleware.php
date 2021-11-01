<?php

namespace App\Http\Middleware;

use Closure;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   return response('Unauthorised', 401);
        return $next($request);
    }
}
