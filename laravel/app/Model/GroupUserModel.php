<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupUserModel extends Model
{
    //定义表名
    protected $table = 'group_user';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 添加用户的用户分组
     * @param $uid
     * @param $group_id
     */
    public function addUserGroup($uid, $group_id){
        $data = array();
        $data['group_id'] = $group_id;
        $data['user_id'] = $uid;
        $res = $this->insert($data);
        if($res == false){
            return false;
        }
        return true;
    }

    /**
     * 根据用户id获取用户组
     * @param $uid用户id
     */
    public function getUserGroupsByUid($uid){
        $user_groups = $this->where('user_id', $uid)->get()->toArray();
        if(empty($user_groups)){
            return array();
        }
        return $user_groups;
    }
}
