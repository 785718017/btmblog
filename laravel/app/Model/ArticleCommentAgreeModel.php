<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleCommentAgreeModel extends Model
{
    //文章评论点赞情况模型

    //定义表名
    protected $table = 'article_comment_agree';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 获取用户的文章评论点赞情况
     * @param $article_id 文章id
     * @param $uid 用户id
     */
    public function getUserArticleCommentAgrees($article_id, $uid){
        $comment_agrees = $this->where('article_id', $article_id)->where('user_id', $uid)->get()->toArray();
        if(empty($comment_agrees)){
            return array();
        }
        return $comment_agrees;
    }
}
