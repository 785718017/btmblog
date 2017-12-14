<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleTagModel extends Model
{
    //定义表名
    protected $table = 'article_tags';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 根据文章id获取文章的标签数组
     * @param $id 文章id
     * @return array 标签id数组
     */
    public function getTagIdsByArticleId($id){
        $tag_ids = $this->where('article_id', $id)->get()->toArray();
        if(empty($tag_ids)){
            return array();
        }
        return array_column($tag_ids, 'tag_id');
    }

    /**
     * 根据标签id获取文章id数组
     * @param $tag_id 标签id
     */
    public function getArticlesByTagId($tag_id){
        $articles = $this->where('tag_id', $tag_id)->orderBy('id','desc')->paginate(5);
        if($articles->isEmpty()){
            return array();
        }
        $pages = $articles->links();
        $arr = array();
        foreach($articles as $key=>$article){
            $arr[] = $article->article_id;
        }
        return array('article_ids' => $arr, 'pages' => strval($pages));
    }
}
