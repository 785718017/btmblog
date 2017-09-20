<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\TagsModel;
use App\Service\TagsService;
use Illuminate\Http\Response;
class TagsController extends Controller
{
    /**
     * 展示标签页
     */
    public function index(TagsService $TagsService){
        return view('admin/Tags/index',['page_title'=>'标签管理']);
    }
    /**
     * 获取所有标签
     */
    public function getTags(TagsService $TagsService){
        $tags = $TagsService->getAllTags();
        if(empty($tags)){
            $this->error('获取标签数据失败');
        }
        return $this->success($tags);
    }
}
