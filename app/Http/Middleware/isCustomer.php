<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isCustomer
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
        if (Auth::check() && Auth::user()->isCustomer()) {
            return $next($request);
        }else{
            return response()->view('errors.no_access');
        }

	}
}
