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

    /**
     * 展示文章页面
     */
    public function index($id){
//        $id = $request->input('id');
        return view('Home/Article/index' , ['page_title' => '文章' , 'id' => $id]);
    }

    /**
     *  根据文章id,获取文章的详细信息
     */
    public function getArticleDetail(Request $request, ArticleService $articleService){
        $id = $request->input('id');
        $article = $articleService->getArticleById($id);
        if(empty($article)){
            return $this->error('获取数据失败');
        }
        return $this->success($article);
    }
}
