<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
{
    /**
     * 检测权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
