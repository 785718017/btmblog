<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupAuthModel extends Model
{
    //定义表名
    protected $table = 'group_auth';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 获取用户组的权限(值为数组)
     * @param $group_id 用户组id
     */
    public function getGroupAuthsById($group_id){
        $auths = $this->where('group_id', $group_id)->get()->toArray();
        if(empty($auths)){
            return array();
        }
        return $auths;
    }

    /**
     * 为用户组添加权限
     * @param $group_id 用户组id
     * @param $auth_ids 权限id数组
     */
    public function addGroupAuths($group_id, $auth_ids){
        $auths = array();
        foreach ($auth_ids as $auth_id){
            $arr = array();
            $arr['group_id'] = $group_id;
            $arr['auth_id'] = $auth_id;
            $auths[] = $arr;
        }

        $res = $this->insert($auths);

        if($res == false){
            return false;
        }
        return true;
    }

    /**
     * 为用户组删除权限
     * @param $group_id 用户组id
     * @param $auth_ids 权限id数组
     */
    public function deleteGroupAuths($group_id, $auth_ids){
        $res = $this->where('group_id', $group_id)->whereIn('auth_id', $auth_ids)->delete();
        if($res == false){
            return false;
        }
        return true;
    }

    /**
     * 获取用户组的所有权限
     * @param $group_ids 用户组id数组
     */
    public function getGroupsAuths($group_ids){
        $auths = $this->whereIn('group_id', $group_ids)->get()->toArray();
        if(empty($auths)){
            return array();
        }
        return $auths;
    }


}
