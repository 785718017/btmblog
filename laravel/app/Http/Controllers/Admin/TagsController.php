<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\TagsModel;
use App\Service\TagsService;
use Illuminate\Http\Request;
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
            return $this->error('获取标签数据失败');
        }
        //获取可用的顶级标签
        $top_tags = $TagsService->getTopLevelTags();
        if(empty($top_tags)){
            return $this->error('获取顶级标签失败');
        }
        $data['tags'] = $tags;
        $data['top_tags'] = $top_tags;
        return $this->success($data);
    }
    /**
     * 添加标签
     */
    public function addTag(Request $request,TagsService $TagsService){
        $tag_name = $request->input('tag_name');
        $tag_color = $request->input('tag_color');
        $first_father = $request->input('first_father');
        $second_father = $request->input('second_father');
        if(empty($tag_name) || empty($tag_color)){
            return $this->error('缺少参数');
        }
        //开启事务
        $this->startTrans();
        $tag = $TagsService->addTag($tag_name, $tag_color, $first_father, $second_father);
        if($tag == false){
            return $this->error('添加标签失败');
        }
        return $this->success($tag);
    }
    /**
     * 修改标签
     */
    public function changeTag(Request $request,TagsService $TagsService){
        $id = $request->input('tag_id');
        $tag_name = $request->input('tag_name');
        $tag_color = $request->input('tag_color');
        $first_father = $request->input('first_father');
        $second_father = $request->input('second_father');
        if(empty($tag_name) || empty($tag_color)){
            return $this->error('缺少参数');
        }
        //开启事务
        $this->startTrans();
        $tag = $TagsService->changeTag($id, $tag_name, $tag_color, $first_father, $second_father);
        if($tag == false){
            return $this->error('修改标签失败');
        }
        return $this->success($tag);
    }
    /**
     * 根据顶级标签的id获取二级标签
     */
    public function getSecondLevelByTopId(Request $request, TagsService $TagsService){
        $id = $request->input('father_id');
        $childs = $TagsService->getSecondLevelByTopId($id);
        if(empty($childs)){
            return $this->error('暂无二级标签');
        }
        return $this->success($childs);
    }
    /**
     * 根据标签id获取标签信息
     */
    public function getTagById(Request $request, TagsService $TagsService){
        $id = $request->input('id');
        $data = $TagsService->getTagById($id);
        if(empty($data)){
            return $this->error('获取标签信息失败');
        }
        return $this->success($data);
    }
    /**
     * 禁用/恢复标签
     */
    public function banTag(Request $request, TagsService $TagsService){
        $id = $request->input('id');
        $data = $TagsService->banTag($id);
        if(empty($data)){
            return $this->error('禁用/恢复标签失败');
        }
        return $this->success($data);
    }
    /**
     * 获取可用的顶级标签
     */
    public function getTopLevelTags(TagsService $TagsService){
        $top_tags = $TagsService->getTopLevelTags();
        if(empty($top_tags)){
            return $this->error('获取顶级标签失败');
        }
        return $this->success($top_tags);
    }
}
