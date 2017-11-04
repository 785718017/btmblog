<?php

namespace App\Http\Controllers\Home;

use App\Service\TagsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * 获取热门标签(随机获取5条非一级的标签)
     */
    public function getHotTags(TagsService $tagsService){
        $hot_tags = $tagsService->getHotTags();
        if(empty($hot_tags)){
            return $this->error('获取热门标签失败');
        }
        return $this->success($hot_tags);
    }
}
