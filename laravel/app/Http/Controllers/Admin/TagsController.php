<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TagsModel;
use App\Service\TagsService;
class TagsController extends Controller
{
    /**
     * 展示标签页
     */
    public function index(TagsService $TagsService){
        $tags = $TagsService->getAllTags();
//        return dd($tags);
        return view('admin/Tags/index',['page_title'=>'标签管理']);
    }
}
