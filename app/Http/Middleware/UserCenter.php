<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class UserCenter
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
        if(\Auth::user()->id){
            return $next($request);
        }else{
            return back()->with('msg', '你的良心不会痛吗？');
        }
    }
}
