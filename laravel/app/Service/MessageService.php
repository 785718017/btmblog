<?php

namespace App\Service;

use App\Constants;
use App\Model\MessageModel;
use App\Model\MessageReplyModel;
use App\Util\Util;

class MessageService extends CommonService
{
    /**
     * 添加留言
     * @param $content 留言内容
     * @param $email 邮箱地址
     * @param $uid 用户id
     * @param $time 留言时间
     */
    public function addMessage($content, $email, $uid, $time){
        //如果没有邮箱地址,则判断用户是否有默认邮箱
        if(empty($email)){
            $UserService = new UserService();
            $user = $UserService->getUserById($uid);
            if(empty($user)){
                return array();
            }
            //如果邮箱为空,则不发送邮件
            if(empty($user->email)){
                $email = 0;
            }else{
                $email = $user->email;
            }
        }

        $MessageModel = new MessageModel();
        $res = $MessageModel->addMessage($content, $email, $uid, $time);
        if(empty($res)){
            return array();
        }
        //将评论加入消息队列,推送给我自己


        return $res;
    }

    /**
     * 获取更多的留言
     * @param $last_id 上次获取的最后一条记录id
     */
    public function getMoreMessage($last_id){
        //先获取11条留言
        $MessageModel = new MessageModel();
        $messages = $MessageModel->getMoreMessage($last_id);
        if(empty($messages)){
            return array();
        }
        //如果留言条数小于11条,则表示没有更多的留言了
        $is_end = false;
        if(count($messages) < 11){
            $is_end = true;
        }
        //如果有11条留言,则去掉最后一条,返回前十条
        if(!$is_end){
            array_values($messages);
            unset($messages[10]);
        }

        //获取留言的回复
        $mids = array_column($messages, 'id');
        $MessageReplyModel = new MessageReplyModel();
        $replys = $MessageReplyModel->getReplyByMessageIds($mids);
        $reply_user_ids = array();
        $reply_for_user_ids = array();
        if(!empty($replys)){
            $reply_user_ids = array_column($replys, 'user_id');
            $reply_for_user_ids = array_column($replys, 'reply_for_user_id');
            $replys = Util::array_group($replys, 'message_id');
        }

        //获取留言和回复的用户的信息
        $uids = array_column($messages, 'user_id');
        $uids = array_merge($uids, $reply_user_ids, $reply_for_user_ids);
        $UserService = new UserService();
        $users = $UserService->getUserByUids($uids);
        if(empty($users)){
            return array();
        }
        $users = Util::array_convert($users, 'id');
        foreach ($messages as $key=>$vo){
            if(isset($users[$vo['user_id']])){
                $messages[$key]['user_name'] = $users[$vo['user_id']]['nick_name'];
                $messages[$key]['user_head'] = $users[$vo['user_id']]['head'];
            }else{
                return array();
            }

            if(isset($replys[$vo['id']])){
                foreach($replys[$vo['id']] as $k=>$reply){
                    $replys[$vo['id']][$k]['user_name'] = $users[$reply['user_id']]['nick_name'];
                    $replys[$vo['id']][$k]['user_head'] = $users[$reply['user_id']]['head'];
                    $replys[$vo['id']][$k]['reply_for_user_name'] = $users[$reply['reply_for_user_id']]['nick_name'];
                }
                $messages[$key]['replys'] = $replys[$vo['id']];
            }
        }

        $data = array();
        $data['messages'] = $messages;
        $data['is_end'] = $is_end;
        $last_message = end($messages);
        $data['last_id'] = $last_message['id'];
        return $data;
    }

    /**
     * 根据id获取留言的信息
     * @param $id
     */
    public function getMessageById($id){
        $MessageModel = new MessageModel();
        $message = $MessageModel->getMessageById($id);
        return $message;
    }

    /**
     * 添加留言的回复
     * @param $reply_content 回复内容
     * @param $reply_email 接收回复的邮箱
     * @param $message_id 留言id
     * @param $reply_for_uid 回复对象的id
     * @param $uid 用户id
     */
    public function addMessageReply($reply_content, $reply_email, $message_id, $reply_for_uid, $uid){
        //获取用户自己的信息
        $UserService = new UserService();
        $user = $UserService->getUserById($uid);
        if(empty($user)){
            return array();
        }
        //判断是否设置了邮箱地址
        if(empty($reply_email)){

            //如果邮箱为空,则不发送邮件
            if(empty($user->email)){
                $reply_email = 0;
            }else{
                $reply_email = $user->email;
            }
        }

        //添加回复
        $MessageReplyModel = new MessageReplyModel();
        $rid = $MessageReplyModel->addReply($reply_content, $reply_email, $message_id, $reply_for_uid, $uid);
        if(empty($rid)){
            return array();
        }
        //查询一遍回复
        $reply = $MessageReplyModel->getReplyById($rid);
        if(empty($reply)){
            return array();
        }
        //查询留言是否有邮箱地址,如果没有则查询回复对象是否有默认邮箱,如果有,则将回复信息加入消息队列,推送给回复对象

        //获取回复的用户的昵称、头像等信息
        $reply_user = $UserService->getUserById($reply_for_uid);
        if(empty($reply_user)){
            return array();
        }
        //设置默认头像
        if($user->head == 0){
            $reply->head = 'home/default_head';
        }else{
            $reply->head = $user->head;
        }
        $reply->user_name = $user->nick_name;
        $reply->reply_for_user_name = $reply_user->nick_name;
        //返回回复内容
        return $reply;
    }
}
