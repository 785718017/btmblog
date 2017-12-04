<?php

namespace App\Http\Controllers\Home;

use App\Constants;
use App\Service\ArticleService;
use App\Service\CommentService;
use App\Service\ReplyService;
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

    /*
     * 获取文章的点赞、评论等信息
     */
    public function getArticleRelateInfo(Request $request, CommentService $commentService, ArticleService $articleService){
        $id = $request->input('id');
        if(empty($id)){
            return $this->error('缺少文章id!');
        }

        //获取用户的id,如果是游客,则设置id为0
        $uid = session('uid');
        if(empty($uid)){
            $uid = 0;
        }
        //获取用户对文章的点赞情况以及文章自身的点赞点踩数量
//        $articleService->

        //获取文章的所有评论、回复以及用户对评论、回复的点赞情况
        $comments = $commentService->getCommentsAndReplys($id, $uid);
        if(empty($comments)){
            //没有评论
            return $this->error('没有评论!');
        }
        $pages = $commentService->getPages();
        $data = [
            'uid' => $uid,
            'comments' => $comments,
            'pages' => $pages
        ];
        return $this->success($data);
    }
}
