<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    //定义表名
    protected $table = 'btm_tags';

    public function getAllTags(){
        $tags = $this->get();
        return empty($tags)?array():$tags;
    }
}
