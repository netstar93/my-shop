<?php

namespace App\Http\Middleware;

use Closure;

class ValidateCustomer
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
        $customer = $request->session()->get('customer');
        $isLoggedIn = $customer['logged_in'];
        if(!$isLoggedIn){
            return redirect('customer/login')->with('error','Please login first!');
        }
        return $next($request);
    }
}
