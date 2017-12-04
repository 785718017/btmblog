<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //定义表名
    protected $table = 'user';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 根据用户名获取用户记录
     * @param $user_name 用户名
     */
    public function getUserByUserName($user_name){
        $user = $this->where('user_name', $user_name)->first();
        if(empty($user)){
            return array();
        }
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
        $data = array();
        $data['user_name'] = $user_name;
        $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        $data['nick_name'] = $nick_name;
        if($email != ''){
            $data['email'] = $email;

        }
        $time = date('Y-m-d H:i:s');
        $data['first_login_time'] = $time;
        $data['last_login_time'] = $time;
        $user = $this->insertGetId($data);
        if(empty($user)){
            return false;
        }
        return $user;
    }

    /**
     * 更新最后一次登录时间
     * @param $user_id int 用户id
     */
    public function updateLastLoginTime($user_id){
        $time = date('Y-m-d H:i:s');
        $res = $this->where('id', $user_id)->update(['last_login_time' => $time]);
        if(empty($res)){
            return false;
        }
        return $res;
    }

    /**
     * 根据用户id获取用户的信息
     * @param $user_id int 用户id
     */
    public function getUserById($user_id){
        $user = $this->where('id', $user_id)->first();
        if(empty($user)){
            return array();
        }
        return $user;
    }

    /**
     * 根据用户id数组获取用户的信息数组
     * @param $user_ids
     */
    public function getUserByIds($user_ids){
        $users = $this->whereIn('id', $user_ids)->get()->toArray();
        if(empty($users)){
            return array();
        }
        return $users;
    }
}
