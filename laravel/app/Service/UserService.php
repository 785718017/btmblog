<?php

namespace App\Service;

use App\Constants;
use App\Model\GroupUserModel;
use App\Model\UserModel;

class UserService extends CommonService
{
    /**
     * 检测用户名是否存在
     * @param $user_name 用户名
     */
    public function getUserByUserName($user_name){
        $UserModel = new UserModel();
        $user = $UserModel->getUserByUserName($user_name);
        return $user;
    }

    /**
     * 注册用户
     * @param $user_name 用户名
     * @param $password 密码
     * @param $nick_name 昵称
     * @param $email 邮箱
     */
    public function registUser($user_name, $password, $nick_name, $email){
        $UserModel = new UserModel();
        $user_id = $UserModel->registUser($user_name, $password, $nick_name, $email);

        if(empty($user_id)){
            return false;
        }
        return $user_id;
    }

    /**
     * 更新最后一次登录时间
     * @param $user_id int 用户id
     */
    public function updateLastLoginTime($user_id){
        $UserModel = new UserModel();
        $res = $UserModel->updateLastLoginTime($user_id);
        return $res;
    }

    /**
     * 根据用户id获取用户的信息
     * @param $user_id int 用户id
     */
    public function getUserById($user_id){
        $UserModel = new UserModel();
        $user = $UserModel->getUserById($user_id);
        return $user;
    }

    /**
     * 根据用户id数组获取用户的信息
     * @param $user_ids 用户id数组
     */
    public function getUserByUids($user_ids){
        $UserModel = new UserModel();
        $user = $UserModel->getUserByIds($user_ids);
        return $user;
    }

    /**
     * 添加用户的用户分组
     * @param $uid
     * @param $group_id
     */
    public function addUserGroup($uid, $group_id){
        $GroupUserModel = new GroupUserModel();
        $group = $GroupUserModel->addUserGroup($uid, $group_id);
        return $group;
    }

    /**
     * 根据用户id获取用户组
     * @param $uid用户id
     */
    public function getUserGroupsByUid($uid){
        $GroupUserModel = new GroupUserModel();
        $user_groups = $GroupUserModel->getUserGroupsByUid($uid);
        return $user_groups;
    }
}
