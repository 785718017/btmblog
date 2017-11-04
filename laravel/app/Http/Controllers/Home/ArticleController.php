<?php

namespace App\Http\Controllers\Home;

use App\Service\ArticleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //前台文章控制器


    /**
     * 获取推荐的文章列表(即最新的5篇文章)
     */
    public function getRecommend(ArticleService $articleService){
        $articles =  $articleService->getRecommend();
        if(empty($articles)){
            return $this->error('获取数据失败');
        }
        return $this->success($articles);
    }

    /**
     * 获取阅读量最多的9篇文章
     */
    public function getHotNineArticles(ArticleService $articleService){
        $articles = $articleService->getHotNineArticles();
        if(empty($articles)){
            return $this->error('获取数据失败');
        }
        return $this->success($articles);
    }
}