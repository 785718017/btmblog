<?php

namespace App\Service;

use App\Model\TagsModel;

class TagsService extends CommonService
{  
	/**
	 * 获取所有的标签
	 * @return 所有的标签数据
	 */
    public function getAllTags(){
        $TagsModel = new TagsModel();
        $tags = $TagsModel->getAllTags();
        return empty($tags) ? array() : $tags;
    }

}
