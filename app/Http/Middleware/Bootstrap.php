<?php

namespace App\Http\Middleware;

use Closure;

class Bootstrap
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
//        $value = $request->session()->get('key');
//        $request->session()->put('quote', '');
//        $request->session()->forget('key');

        return $next($request);
    }
}
