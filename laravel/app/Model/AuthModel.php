<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    //定义表名
    protected $table = 'auth';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 根据id获取权限(结果为数组)
     * @param $id 权限id
     */
    public function getAuthById($id){
        $auth = $this->where('id', $id)->first()->toArray();
        if(empty($auth)){
            return array();
        }
        return $auth;
    }

    /**
     * 添加权限
     * @param $father_id 父级id
     * @param $url 路由地址
     * @param $description 中文描述
     * @param $type get为1,post为2
     * @param $params_num 参数数量
     */
    public function addAuth($father_id, $url, $description, $type, $params_num){
        $data = array();
        $data['auth_name'] = $url;
        $data['title'] = $description;
        $data['father_id'] = $father_id;
        $data['type'] = $type;
        $data['params_num'] = $params_num;

        $res = $this->insert($data);
        if(empty($res)){
            return false;
        }
        return true;
    }

    /**
     * 获取该权限下的所有子权限
     * @param $auth_id
     */
    public function getChildAuths($auth_id){
        $child_auths = $this->where('father_id', $auth_id)->get()->toArray();
        if(empty($child_auths)){
            return array();
        }
        return $child_auths;
    }

    /**
     * 获取所有的权限规则(结果为数组)
     */
    public function getAllAuths(){
        $auths = $this->get()->toArray();
        if(empty($auths)){
            return array();
        }
        return $auths;
    }
}
