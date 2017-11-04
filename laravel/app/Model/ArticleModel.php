<?php

namespace App\Model;

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
        $articles = $this->orderBy('id', 'desc')->limit(5)->get();
        if($articles->isEmpty()){
            return array();
        }
        return $articles;

    }

    /**
     * 获取阅读量最高的9篇文章
     */
    public function getHotNineArticles(){
        $articles = $this->orderBy('browse_times', 'desc')->orderBy('id', 'desc')->limit(9)->get();
        if($articles->isEmpty()){
            return array();
        }
        return $articles;
    }
}
