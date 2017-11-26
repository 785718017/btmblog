<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleCommentModel extends Model
{
    //文章评论模型

    //定义表名
    protected $table = 'article_comment';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 添加文章评论
     * @param $uid 用户id
     * @param $article_id 文章id
     * @param $comment 评论内容
     * @param $email 邮箱地址
     */
    public function addComment($uid, $article_id, $comment, $email, $time){
        $this->user_id = $uid;
        $this->article_id = $article_id;
        $this->content = $comment;
        $this->email = $email;
        $this->publish_time = $time;
        $res = $this->save();
        if(empty($res)){
            return false;
        }
        return true;
    }
}
