<?php

namespace App\Http\Middleware;

use App\Service\AuthService;
use App\Service\UserService;
use Closure;
use Illuminate\Support\Facades\Redirect;

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
        $url = $request->getRequestUri();
        $uid = session('uid');
        $method = $request->method();

        // 获取该路径的权限id
        $AuthService = new AuthService();
        $auth_id = $AuthService->getAuthIdByUrl($url);

        //如果该权限不存在
        if(empty($auth_id)){
            if($method == 'get'){
                return redirect()->to('/failNotify/没有权限/3');
            }else{
                return response()->json(['info'=>'没有权限','status'=>2]);
            }
        }
        // 判断用户是否有该操作权限
        $groups = array();
        // 游客用户
        if(empty($uid)){
            $groups = [1];
        }else{
            // 获取用户的用户组id
            $UserService = new UserService();
            $user_groups = $UserService->getUserGroupsByUid($uid);
            if(empty($user_groups)){
                if($method == 'get'){
                    return redirect()->to('/failNotify/账户异常/3');
                }else{
                    return response()->json(['info'=>'账户异常','status'=>2]);
                }
            }else{
                $groups = array_column($user_groups, 'group_id');
            }
        }

        // 获取用户组权限id
        $AuthService = new AuthService();
        $auths = $AuthService->getGroupsAuths($groups);
        if(empty($auths)){
            if($method == 'GET'){
                return redirect()->to('/failNotify/没有权限/3');
            }else{
                return response()->json(['info'=>'没有权限','status'=>2]);
            }
        }

        // 判断用户是否有该权限
        if(!in_array(intval($auth_id), $auths)){
            if(empty($uid)){
                if($method == 'GET'){
                    return redirect()->to('/failNotify/该功能需要登录!/3');
                }else{
                    return response()->json(['info'=>'该功能需要登录!','status'=>2]);
                }
            }
            if($method == 'GET'){
                return redirect()->to('/failNotify/没有权限/3');
            }else{
                return response()->json(['info'=>'没有权限','status'=>2]);
            }
        }

        return $next($request);
    }
}
