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

}
