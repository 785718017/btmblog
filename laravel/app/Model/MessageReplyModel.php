<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Constants;

class MessageReplyModel extends Model
{
    //定义表名
    protected $table = 'message_reply';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 添加回复
     * @param $reply_content 回复的内容
     * @param $reply_email 接收回复的邮箱
     * @param $message_id 评论的id
     * @param $reply_for_uid 评论对象的id
     * @param $uid 用户的id
     */
    public function addReply($reply_content, $reply_email, $message_id, $reply_for_uid, $uid){
        $data = array();
        $data['message_id'] = $message_id;
        $data['user_id'] = $uid;
        $data['content'] = $reply_content;
        $data['reply_for_user_id'] = $reply_for_uid;
        $data['email'] = $reply_email;
        $data['publish_time'] = date('Y-m-d H:i:s');

        $rid = $this->insertGetId($data);
        if(empty($rid)){
            return array();
        }
        return $rid;
    }

    /**
     * 根据id获取回复
     * @param $reply_id 回复id
     */
    public function getReplyById($reply_id){
        $reply = $this->where('id', $reply_id)->first();
        if(empty($reply)){
            return array();
        }
        return $reply;
    }

    /**
     * 根据留言id数组获取回复
     * @param $mids 留言id数组
     */
    public function getReplyByMessageIds($mids){
        $replys = $this->whereIn('message_id', $mids)->where('status', Constants::MESSAGE_REPLY_STATUS_ENABLE)->get()->toArray();
        if(empty($replys)){
            return array();
        }
        return $replys;
    }
}
