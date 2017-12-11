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

    /**
     * 判断用户是否对该评论进行过点赞或者点踩操作
     * @param $comment_id
     * @param $user_id
     */
    public function getCommentAgreeByAidAndUid($comment_id, $user_id){
        $info = $this->where('comment_id', $comment_id)->where('user_id', $user_id)->first();
        if(empty($info)){
            return array();
        }
        return $info;
    }

    /**
     * 用户对评论的点赞或者点踩操作
     * @param $comment_id 评论id
     * @param $user_id 用户id
     * @param $type 操作类型,点赞/点踩
     */
    public function addUserCommentAgree($article_id, $comment_id, $user_id, $type){
        $data = array();
        $data['article_id'] = $article_id;
        $data['comment_id'] = $comment_id;
        $data['user_id'] = $user_id;
        $data['agree_type'] = $type;
        $res = $this->insertGetId($data);
        if(empty($res)){
            return array();
        }
        return $res;
    }
}
