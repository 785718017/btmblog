<?php

namespace App\Service;

use App\Constants;
use App\Model\ArticleCommentModel;
use App\Model\UserModel;

class CommentService extends CommonService
{
    /**
     * 添加文章评论
     * @param $uid 用户id
     * @param $article_id 文章id
     * @param $comment 评论内容
     * @param $email 邮箱地址
     */
    public function addComment($uid, $article_id, $comment, $email, $time){
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

        $ArticleCommentModel = new ArticleCommentModel();
        $res = $ArticleCommentModel->addComment($uid, $article_id, $comment, $email, $time);
        return $res;
    }
}
