<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * 检测是否已经登录,如果已登录,则跳转到首页
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!empty(session('uid'))){
            //判断是get还是post请求
            if($request->isMethod('get')){
                return redirect('/failNotify/您已登录!/3');
            }
        }
        return $next($request);
    }
}
