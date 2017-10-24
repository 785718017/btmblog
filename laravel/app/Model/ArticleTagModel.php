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
}
