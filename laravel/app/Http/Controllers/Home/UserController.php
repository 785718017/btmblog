<?php

namespace App\Http\Controllers\Home;

use App\Constants;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //用户控制器

    /**
     * 显示博主个人简介
     */
    public function about(){
        return view('home/User/about',['page_title'=>'关于我']);
    }

    /**
     * 注册页面
     */
    public function regist(){
        return view('home/User/regist',['page_title'=>'注册']);
    }

    /**
     * 检测用户名是否存在
     */
    public function checkUserName(Request $request, UserService $userService){
        if(!empty(session('uid'))){
            $fail = ['info'=>'您已登录','time'=>3,'if_jump'=>true];
            return $this->error($fail);
        }
        $user_name = $request->input('user_name');
        $user_name = strval(trim($user_name));
        $res = $userService->getUserByUserName($user_name);
        if(!empty($res)){
            //存在返回false
            return $this->error(false);
        }
        return $this->success(true);
    }

    /**
     * 注册用户信息
     */
    public function registUser(Request $request, UserService $userService){
        if(!empty(session('uid'))){
            $fail = ['info'=>'您已登录','time'=>3,'if_jump'=>true];
            return $this->error($fail);
        }
        $user_name = $request->input('user_name');
        $password = $request->input('password');
        $nick_name = $request->input('nick_name');
        $email = $request->input('email');

        if(empty($user_name) || empty($password) || empty($nick_name)){
            return $this->error('缺少用户名、密码或者昵称!');
        }

        if(empty($email)){
            $email = '';
        }

        //开启事务
        $this->startTrans();

        //先验证用户名是否已存在
        $user_name = strval(trim($user_name));
        $res = $userService->getUserByUserName($user_name);
        if(!empty($res)){
            //存在返回false
            return $this->error('用户名已存在!');
        }
        //注册用户
        $user_id = $userService->registUser($user_name, $password, $nick_name, $email);
        if(empty($user_id)){
            return $this->error('注册失败!');
        }
        //自动登录
        //将用户信息存入session
        $user_info = array();
        $user_info['uid'] = $user_id;
        $user_info['nick_name'] = $nick_name;
        $user_info['login_type'] = Constants::LOGIN_TYPE_ACCOUNT;
        $user_info['head'] = '0';
        session($user_info);
        return $this->success(['info' => '恭喜您,注册成功', 'time' => 5]);
    }

    /**
     * 登录
     */
    public function login(Request $request, UserService $userService){
        if(!empty(session('uid'))){
            $fail = ['info'=>'您已登录','time'=>3,'if_jump'=>true];
            return $this->error($fail);
        }
        $user_name = $request->input('user_name');
        $user_name = strval(trim($user_name));
        $user = $userService->getUserByUserName($user_name);
        if(empty($user)){
            //用户名不存在
            return $this->error('用户名不存在');
        }

        $password = $request->input('password');
        if(empty($password)){
            return $this->error('密码不能为空');
        }
        //验证密码是否正确
        if(password_verify($user->password, $password)){
            return $this->error('密码不正确!');
        }

        //将用户信息存入session,刷新页面
        $user_info = array();
        $user_info['uid'] = $user->id;
        $user_info['nick_name'] = $user->nick_name;
        $user_info['login_type'] = $user->login_type;
        $user_info['head'] = $user->head;
        session($user_info);
        //更新最后一次登录时间
        $this->startTrans();
        $res = $userService->updateLastLoginTime($user->id);
        if(!$res){
            $this->error('更新最后一次登录时间失败');
        }
        return $this->success('登录成功!');

    }

}
