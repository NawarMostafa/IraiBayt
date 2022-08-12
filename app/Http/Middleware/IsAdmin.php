<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(auth()->check() && (auth()->user()->role=='admin' ||
                auth()->user()->role=='RealEstate-admin' ||
                auth()->user()->role=='Currancy-admin' ||
                auth()->user()->role=='Weather-admin' ||
                auth()->user()->role=='Material-admin' ||
                auth()->user()->role=='Quiz-admin' ||
                auth()->user()->role=='Rules-admin' ||
                auth()->user()->role=='AboutIraq-admin' ||
                auth()->user()->role=='Info-admin' ||
                auth()->user()->role=='Analize-admin')){
            return $next($request);
        }
        return redirect(404);

    }
}
