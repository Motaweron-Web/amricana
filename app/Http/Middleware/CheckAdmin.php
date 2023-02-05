<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        //        dd(auth('admin')->user());
        if(auth('admin')->user()->supervisor_type == 'admin'){

            return $next($request);

        }else {

            return redirect()->back();
        }
    }
}
