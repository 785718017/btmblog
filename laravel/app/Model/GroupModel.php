<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    //定义表名
    protected $table = 'group';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 获取所有的用户组
     */
    public function getAllGroup(){
        $groups = $this->get();
        if($groups->isEmpty()){
            return array();
        }
        return $groups;
    }
}
