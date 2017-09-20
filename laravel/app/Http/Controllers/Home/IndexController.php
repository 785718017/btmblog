<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //前台首页控制器

    /**
     * 前台首页展示
     */
    public function index(){
        return view('home/Index/index',['page_title'=>'首页']);
    }
}
