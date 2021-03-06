<?php

namespace App\Model;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    //定义表名
    protected $table = 'article';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 获取所有的文章(后台管理用)
     */
    public function getAllArticles(){
        $articles = $this->select('id','name','introduce','logo','author','publish_time','browse_times','agree_num','disagree_num','rewrite_time','status')->orderBy('id', 'desc')->paginate(5);

        return $articles->isEmpty() ? array() : $articles;
    }

    /**
     * 根据id获取文章信息
     * @param $id int 文章id
     */
    public function getArticleById($id){
        $article = $this->where('id', $id)->first();
        if(empty($article)){
            return array();
        }
        return $article;
    }

    /**
     * 修改文章的状态
     * @param $id int 文章id
     * @param $status int 要修改为什么状态,0表示下线,1表示上线
     */
    public function updateArticleStatus($id, $status){
        $data = array();
        $data['status'] = $status;

        $article = $this->where('id', $id)->update($data);
        if(empty($article)){
            return array();
        }
        return $article;
    }

    /**
     * 获取推荐的文章列表(即最新的5篇文章)
     */
    public function getRecommend(){
        $articles = $this->where('status',Constants::ARTICLE_ONLINE)->orderBy('id', 'desc')->limit(5)->get();
        if($articles->isEmpty()){
            return array();
        }
        return $articles;

    }

    /**
     * 获取阅读量最高的9篇文章
     */
    public function getHotNineArticles(){
        $articles = $this->where('status',Constants::ARTICLE_ONLINE)->orderBy('browse_times', 'desc')->orderBy('id', 'desc')->limit(9)->get();
        if($articles->isEmpty()){
            return array();
        }
        return $articles;
    }

    /**
     * 增加阅读量
     * @param $id 文章id
     * @param $vision_times 新的阅读量
     */
    public function increaseVisionTimes($id, $vision_times){
        $data = array();
        $data['browse_times'] = $vision_times;
        $res = $this->where('id', $id)->update($data);
        if(empty($res)){
            return array();
        }
        return $res;
    }

    /**
     * 修改点赞数量
     * @param $article_id 文章id
     * @param $num 新的点赞数量
     */
    public function addArticleAgree($article_id, $num){
        $res = $this->where('id', $article_id)->update(['agree_num' => $num]);
        if(empty($res)){
            return array();
        }
        return $res;
    }

    /**
     * 修改点赞数量
     * @param $article_id 文章id
     * @param $num 新的点赞数量
     */
    public function addArticleDisagree($article_id, $num){
        $res = $this->where('id', $article_id)->update(['disagree_num' => $num]);
        if(empty($res)){
            return array();
        }
        return $res;
    }

    /**
     * 根据文章id数组获取文章
     * @param $ids 文章id数组
     */
    public function getArticlesByIds($ids){
        $articles = $this->whereIn('id',$ids)->get();
        if($articles->isEmpty()){
            return array();
        }
        return $articles;
    }

    /**
     * 根据标签id获取文章
     * @param $tag_id
     */
    public function getArticlesByTagId($tag_id){
        $articles = $this->join('article_tags', 'article.id', '=', 'article_tags.article_id')->where('article_tags.tag_id',$tag_id)->where('article.status',Constants::ARTICLE_ONLINE)->orderBy('article.id','desc')->paginate(5);
        if($articles->isEmpty()){
            return array();
        }
        return $articles;
    }

    /**
     * 获取文章的点赞和点踩数量
     * @param $id文章id
     */
    public function getArticleAgreeNum($id){
        $articles = $this->select('id','agree_num','disagree_num')->where('id', $id)->first();
        if(empty($articles)){
            return array();
        }
        return $articles;
    }
}
