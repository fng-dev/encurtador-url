<?php

namespace App\Http\Middleware;

use App\Singletons\ShortenerAuth;
use Closure;

class ShortenerAuthMiddleware
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
        if (ShortenerAuth::guest()) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
