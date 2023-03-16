<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::user() && \Auth::user()->isSeller == true){
            return $next($request);
        }

        return back()->with('error', 'Oops, You are not Seller');
    }
}
