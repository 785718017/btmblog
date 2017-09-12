<?php
    namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;

    class ArticleController extends Controller{
        public function index(){
            return view('admin.Article.article',['page_title'=>'文章管理']);
        }
    }