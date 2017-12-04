<?php

namespace App\Service;

use App\Constants;
use App\Model\ArticleCommentReplyModel;

class ReplyService extends CommonService
{
    /**
     * 添加回复
     * @param $reply_content 回复的内容
     * @param $reply_email 接收回复的邮箱
     * @param $comment_id 评论的id
     * @param $reply_for_uid 评论对象的id
     * @param $uid 用户的id
     */
    public function addReply($reply_content, $reply_email, $comment_id, $reply_for_uid, $uid){
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
        $ArticleCommentReplyModel = new ArticleCommentReplyModel();
        $rid = $ArticleCommentReplyModel->addReply($reply_content, $reply_email, $comment_id, $reply_for_uid, $uid);
        if(empty($rid)){
            return array();
        }
        //查询一遍回复
        $reply = $ArticleCommentReplyModel->getReplyById($rid);
        if(empty($reply)){
            return array();
        }
        //查询评论是否有邮箱地址,如果没有则查询回复对象是否有默认邮箱,如果有,则将回复信息加入消息队列,推送给回复对象

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
