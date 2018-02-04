<?php

namespace App\Http\Controllers\Home;

use App\Constants;
use App\Service\ArticleService;
use App\Service\CommentService;
use App\Service\ReplyService;
use App\Service\TagsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //前台文章控制器


    /**
     * 获取推荐的文章列表(即最新的5篇文章)
     */
    public function getRecommend(ArticleService $articleService,CommentService $commentService){
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
        //增加一条阅读量
        $this->startTrans();
        $articleService = new ArticleService();
        $res = $articleService->increaseVisionTimes($id);
        if(empty($res)){
            DB::rollback();
            echo '获取文章数据出错,请刷新重试!';
        }else{
            DB::commit();
            $url = public_path('static/home/Article/index/'.$id.'.html');
            if(file_exists($url)){
                // 读取文件内容
                $res = fopen($url, 'r');
                $html = fread($res, filesize($url));
                return $html;
            }else{
                $article = $articleService->getArticleById($id);
                $data = view('home/Article/index' , ['page_title' => '文章' , 'id' => $id, 'article' => $article])->render();
                // 要不要把静态文件的二进制数据存在memcache中
                $res = $this->createOrUpdateDirAndFile($url, $data);
                if(!$res){
                    // 将生成该页面的任务丢进消息队列

                }
                return $data;
            }


        }
    }

    /**
     *  根据文章id,获取文章的详细信息
     */
    public function getArticleDetail(Request $request, ArticleService $articleService){
        $id = $request->input('id');
        // 获取文章的点赞情况
        $article = $articleService->getArticleAgreeNum($id);
        if(empty($article)){
            return $this->error('获取点赞数量失败');
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

    /**
     * 用户点赞文章
     */
    public function addArticleAgree(Request $request, ArticleService $articleService){
        //判断用户是否已登录
        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('请登录后再操作!');
        }
        $article_id = $request->input('article_id');

        $had_agree = $articleService->hadUserAgreeArticle($article_id, $uid);
        if(!empty($had_agree)){
            return $this->error('您已经对这篇文章点过赞或者点过踩了!');
        }
        $this->startTrans();
        $res = $articleService->addArticleAgree($article_id, $uid);
        if(empty($res)){
            return $this->error('操作失败!');
        }
        return $this->success(['article_id' => $article_id]);
    }

    /**
     * 用户点踩文章
     */
    public function addArticleDisagree(Request $request, ArticleService $articleService){
        //判断用户是否已登录
        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('请登录后再操作!');
        }
        $article_id = $request->input('article_id');

        $had_agree = $articleService->hadUserAgreeArticle($article_id, $uid);
        if(!empty($had_agree)){
            return $this->error('您已经对这篇文章点过赞或者点过踩了!');
        }
        $this->startTrans();
        $res = $articleService->addArticleDisagree($article_id, $uid);
        if(empty($res)){
            return $this->error('操作失败!');
        }
        return $this->success(['article_id' => $article_id]);
    }

    /**
     * 根据文章标签id展示文章列表
     */
    public function articleList($tag_id){
        //获取标签名
        $TagsService = new TagsService();
        $tag = $TagsService->getTagById($tag_id);
        if(empty($tag)){
            return  redirect('/failNotify/该分类信息不存在!/3');
        }
        return view('home/Article/articleList' , ['page_title' => $tag->name , 'tag' => $tag]);
    }

    /**
     * 根据标签id获取文章
     */
    public function getArticlesByTagId(Request $request, ArticleService $articleService){
        $tag_id = $request->input('tag_id');
        $articles = $articleService->getArticlesByTagId($tag_id);
        if(empty($articles)){
            return $this->error('没有文章数据!');
        }
        $pages = $articleService->getPages();
        $data = ['articles'=>$articles,'pages'=>$pages];
        return $this->success($data);
    }
}
