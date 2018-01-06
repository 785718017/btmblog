<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Constants;

class MessageModel extends Model
{

    //定义表名
    protected $table = 'message';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 添加留言
     * @param $content 留言内容
     * @param $email 邮箱地址
     * @param $uid 用户id
     * @param $time 留言时间
     */
    public function addMessage($content, $email, $uid, $time){
        $this->user_id = $uid;
        $this->content = $content;
        $this->email = $email;
        $this->publish_time = $time;
        $res = $this->save();
        if(empty($res)){
            return false;
        }
        return true;
    }

    /**
     * 获取更多的留言
     * @param $last_id 上次获取的最后一条记录id
     */
    public function getMoreMessage($last_id = 0){
        $where = array();
        $where[] = ['status','=',Constants::MESSAGE_STATUS_ENABLE];
        if(!empty($last_id)){
            $where[] = ['id', '<', $last_id];
        }
        $messages = $this->select('id','user_id','content','publish_time')->where($where)->orderBy('id','desc')->limit(11)->get()->toArray();
        if(empty($messages)){
            return array();
        }
        return $messages;
    }

    /**
     * 根据id获取留言的信息
     * @param $id
     */
    public function getMessageById($id){
        $message = $this->where('id',$id)->first();
        if(empty($message)){
            return array();
        }
        return $message;
    }
}
