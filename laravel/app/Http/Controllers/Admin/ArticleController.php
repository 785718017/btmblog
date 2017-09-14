<?php
    namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;

    class ArticleController extends Controller{
        /**
         * 显示文章列表
         * @author 半透明
         */
        public function index(){
            return view('admin.Article.article',['page_title'=>'文章管理']);
        }

        /**
         * 显示后台写文章的页面
         * @author 半透明
         */
        public function write(){
            return view('admin.Article.write',['page_title'=>'写文章']);
        }
    }