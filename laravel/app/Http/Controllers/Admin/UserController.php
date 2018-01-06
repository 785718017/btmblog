<?php

namespace App\Http\Controllers\Admin;

use App\Service\AuthService;
use App\Service\UserGroupService;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 用户组列表页面
     */
    public function groupList(){
        return view('admin.User.groupList',['page_title'=>'用户组']);
    }

    /**
     * 获取所有的用户组
     */
    public function getAllGroups(UserGroupService $userGroupService){
        $groups = $userGroupService->getAllGroup();
        if(empty($groups)){
            return $this->error('获取用户组数据失败');
        }
        return $this->success($groups);
    }

    /**
     * 用户组权限页面
     * @param $id 用户组id
     */
    public function groupAuth($id){
        // 获取所有的权限(分层)
        $AuthService = new AuthService();
        $auths = $AuthService->getAllLevelAuths();

        return view('admin.User.groupAuth',['page_title'=>'用户组','auths'=>$auths,'group_id'=>$id]);
    }
}
