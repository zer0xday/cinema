<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionMiddleware
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
        $movie = $request->session()->get('movie');
        $places = $request->session()->get('places');

        if (empty($movie)) {
            return redirect()
                ->route('movies')
                ->withErrors(__('Twoja sesła wygasła, proszę dokonać zamówienia ponownie'));
        }

        if (empty($places)) {
            return redirect()
                ->route('places')
                ->withErrors(__('Twoja sesła wygasła, proszę dokonać wyboru miejsca ponownie'));
        }

        return $next($request);
    }
}
