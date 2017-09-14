<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TagsModel;
class TagsController extends Controller
{
    /**
     * 展示标签页
     */
    public function index(){
        $TagsModel = new TagsModel;
        $tags = $TagsModel->getAllTags();
        return dd($tags);
//        return view('admin/Tags/index',['page_title'=>'标签管理']);
    }
}
