<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Constants;

class TagsModel extends Model
{
    //定义表名
    protected $table = 'tags';

    //去掉时间戳维护
    public $timestamps = false;
    /**
     * 获取所有标签
     */
    public function getAllTags(){
        $tags = self::all()->toArray();
        return empty($tags)?array():$tags;
    }

    /**
     * 获取level为1且status为1的标签
     */
    public function getTopLevelTags(){
        $tags = $this->select('id', 'name', 'color')
            ->where('level', Constants::TAG_LEVEL_ONE)
            ->where('status', Constants::TAG_STATUS_USE)
            ->get();
        if($tags->isEmpty()){
            return array();
        }
        return $tags;
    }

    /**
     * 根据顶级标签的id获取二级标签
     * @param $id 父级标签id
     */
    public function getSecondLevelByTopId($id){
        $tags = $this->select('id', 'name', 'color')
            ->where('father_id', $id)
            ->where('status', Constants::TAG_STATUS_USE)
            ->get();
        if($tags->isEmpty()){
            return array();
        }
        return $tags;
    }
    /**
     * 根据标签id获取标签信息
     * @param $id int 标签id
     */
    public function getTagById($id){
        $tag = $this->where('id', $id)->first();
        if(empty($tag)){
            return array();
        }
        return $tag;
    }
    /**
     * 根据标签id数组获取标签信息
     * @param $ids array 标签id数组
     */
    public function getTagByIds($ids){
        $tags = $this->whereIn('id', $ids)->get();
        if(empty($tags)){
            return array();
        }
        return $tags;
    }
}
