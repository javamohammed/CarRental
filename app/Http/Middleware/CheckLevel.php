<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckLevel
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
        if( Auth::user()->level !== 'admin'){
           return redirect()->route('notfound');
        }
        return $next($request);

        
    }
}
