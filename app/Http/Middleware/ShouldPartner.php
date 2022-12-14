<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShouldPartner
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
        if($request->path() == "partner/create") return $next($request);
        if(!isset(\Auth::user()->role)) return redirect("/"); 
        if(\Auth::user()->role != "partner") return redirect("/");

        return $next($request);
    }
}
