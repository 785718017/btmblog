<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    //定义表名
    protected $table = 'tags';

    /**
     * 获取所有标签
     */
    public function getAllTags(){
        $tags = self::all();
        return empty($tags)?array():$tags;
    }
}
