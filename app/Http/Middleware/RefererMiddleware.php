<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RefererMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty($request->headers->get('referer'))) {
            abort(404);
        }

        return $next($request);
    }
}
