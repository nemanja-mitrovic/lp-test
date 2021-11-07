<?php

namespace App\Http\Middleware;

use App\Http\Services\JwtService;
use Closure;
use Illuminate\Support\Facades\Session;

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
    {
        $loginTime = session()->get('LAST_TOKEN_ACTIVITY');
        if ($loginTime !== null) {
            $loginTimeDifference = time() - $loginTime;
            if ($loginTimeDifference > JwtService::EXPIRES_IN_SECONDS) {
                session()->flush();
                return $next($request);
            } else {
                return response('Token still active', 401);
            }
        } else {
            return $next($request);
        }
    }
}
