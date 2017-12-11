<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleAgreeModel extends Model
{
    //用户文章点赞点踩记录表
    //定义表名
    protected $table = 'article_agree';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 用户对文章的点赞或者点踩操作
     * @param $article_id 文章id
     * @param $user_id 用户id
     * @param $type 操作类型,点赞/点踩
     */
    public function addUserArticleAgree($article_id, $user_id, $type){
        $data = array();
        $data['article_id'] = $article_id;
        $data['user_id'] = $user_id;
        $data['agree_type'] = $type;
        $res = $this->insertGetId($data);
        if(empty($res)){
            return array();
        }
        return $res;
    }

    /**
     * 根据文章id和用户id,判断用户是否对该文章有过点赞或者点踩
     * @param $article_id
     * @param $user_id
     */
    public function getArticleAgreeByAidAndUid($article_id, $user_id){
        $info = $this->where('article_id', $article_id)->where('user_id', $user_id)->first();
        if(empty($info)){
            return array();
        }
        return $info;
    }
}
