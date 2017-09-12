<?php
    namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;

    class AdminController extends Controller{
        public function index(){
            return view('admin.Admin.index',['page_title'=>'首页']);
        }
    }