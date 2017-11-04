<?php

namespace App\Service;

use App\Model\TagsModel;
use App\Constants;

class TagsService extends CommonService
{  
	/**
	 * 获取所有的标签
	 * @return 所有的标签数据
	 */
    public function getAllTags(){
        $TagsModel = new TagsModel();
        $tags = $TagsModel->getAllTags();
        if(empty($tags)){
            return array();
        }
        //整理数据
        $tags_arr = array();
        foreach($tags as $tag){
            //取出顶级标签
            if($tag['level'] == Constants::TAG_LEVEL_ONE){
                $tags_arr[] = $tag;
            }
        }
        if(empty($tags_arr)){
            return array();
        }
        //取出二级标签
        foreach($tags as $tag){
            foreach($tags_arr as $key=>$one_level_tag){
                if($tag['father_id'] == $one_level_tag['id']){
                    $tags_arr[$key]['child'][] = $tag;
                }
            }
        }
        //取出三级标签
        foreach($tags_arr as $key=>$one_level_tag){
            if(!isset($one_level_tag['child'])){
                $tags_arr[$key]['child'] = array();
                $tags_arr[$key]['child_num'] = 0;
            }else{
                $tags_arr[$key]['child_num'] = count($one_level_tag['child']);
                foreach($one_level_tag['child'] as $k=>$two_level_tag){
                    foreach($tags as $tag){
                        if($tag['father_id'] == $two_level_tag['id']){
                            $tags_arr[$key]['child'][$k]['child'][] = $tag;
                        }
                    }
                }
            }
        }
        return $tags_arr;
    }
    /**
     * 添加标签
     * @param $name string 标签名
     * @param $color int 标签颜色
     * @param $first_father int 顶级标签
     * @param $second_father int 二级标签
     * @return 成功返回true,失败返回false
     */
    public function addTag($name, $color, $first_father, $second_father){
        $tagsModel = new TagsModel();
        $tagsModel->name = $name;
        $tagsModel->color = $color;
        $tagsModel->status = Constants::TAG_STATUS_USE;
        if($first_father == 0){
            //标签是顶级标签时
            $tagsModel->level = Constants::TAG_LEVEL_ONE;
            $tagsModel->father_id = Constants::TOP_LEVEL_TAG_FATHER_ID;
        }elseif ($first_father != 0 && $second_father == 0){
            //标签是二级标签时
            $tagsModel->level = Constants::TAG_LEVEL_TWO;
            $tagsModel->father_id = $first_father;
        }else{
            //标签是三级标签时
            $tagsModel->level = Constants::TAG_LEVEL_THREE;
            $tagsModel->father_id = $second_father;
        }
        $tag = $tagsModel->save();
        if(empty($tag)){
            return false;
        }
        return $tag;
    }
    /**
     * 修改标签
     * @param $id int 标签id
     * @param $name string 标签名
     * @param $color int 标签颜色
     * @param $first_father int 顶级标签
     * @param $second_father int 二级标签
     * @return 成功返回true,失败返回false
     */
    public function changeTag($id,$name, $color, $first_father, $second_father){
        $tagsModel = new TagsModel();
        $data = array();
        $data['name'] = $name;
        $data['color'] = $color;
        if($first_father == 0){
            //标签是顶级标签时
            $data['level'] = Constants::TAG_LEVEL_ONE;
            $data['father_id'] = Constants::TOP_LEVEL_TAG_FATHER_ID;
        }elseif ($first_father != 0 && $second_father == 0){
            //标签是二级标签时
            $data['level'] = Constants::TAG_LEVEL_TWO;
            $data['father_id'] = $first_father;
        }else{
            //标签是三级标签时
            $data['level'] = Constants::TAG_LEVEL_THREE;
            $data['father_id'] = $second_father;
        }
        $tag = $tagsModel->where('id', $id)->update($data);
        if(empty($tag)){
            return false;
        }
        return $tag;
    }
    /**
     * 获取level为1且status为1的标签
     */
    public function getTopLevelTags(){
        $tagsModel = new TagsModel();
        $tags = $tagsModel->getTopLevelTags();
        return $tags;
    }
    /**
     * 根据顶级标签的id获取二级标签
     * @param $id 父级标签id
     */
    public function getSecondLevelByTopId($id){
        $tagsModel = new TagsModel();
        $child_tags = $tagsModel->getSecondLevelByTopId($id);
        return $child_tags;
    }
    /**
     * 根据标签id获取标签信息
     * @param $id int 标签id
     */
    public function getTagById($id){
        $tagsModel = new TagsModel();
        $tag = $tagsModel->getTagById($id);
        if(empty($tag)){
            return array();
        }
        //根据level和father_id 获取一级标签和二级标签
        if($tag->level == Constants::TAG_LEVEL_ONE){
            $tag->first_tag_id = 0;
            $tag->second_tag_id = 0;
        }elseif($tag->level == Constants::TAG_LEVEL_TWO){
            $tag->first_tag_id = $tag->father_id;
            $tag->second_tag_id = 0;
        }else{
            $father = $tagsModel->getTagById($tag->father_id);
            if(empty($father)){
                return array();
            }
            $tag->first_tag_id = $father->father_id;
            $tag->second_tag_id = $tag->father_id;
        }
        return $tag;
    }
    /**
     * 禁用/恢复标签
     * @param $id 父级标签id
     */
    public function banTag($id){
        $tagsModel = new TagsModel();
        //获取该标签的status
        $tag = $tagsModel->where('id', $id)->first();
        if(empty($tag)){
            return array();
        }
        if($tag->status == 1){
            $up = $tagsModel->where('id', $id)->update(['status'=>0]);
            $info = '禁用成功';
        }else{
            $up = $tagsModel->where('id', $id)->update(['status'=>1]);
            $info = '恢复成功';
        }
        if(empty($up)){
            return false;
        }
        return $info;
    }

    /**
     * 获取热门标签(这里可以做缓存)
     */
    public function getHotTags(){
        $TagsModel = new TagsModel();
        $tags = $TagsModel->getHotTags();
        if(empty($tags)){
            return array();
        }
        //获取其中随机的5条标签
        $hot_tag_keys = array_rand($tags, 5);
        $hot_tags = array();
        foreach($hot_tag_keys as $tag_key){
            $hot_tags[] = $tags[$tag_key];
        }

        return $hot_tags;
    }
}
