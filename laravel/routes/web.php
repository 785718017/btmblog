<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('Admin/Tags/getTags' , 'Admin\TagsController@getTags');

//后台
Route::Group(['namespace' => 'Admin' , 'prefix' => 'Admin'],function(){
    //后台首页
    Route::get('/' , 'AdminController@index');

    //文章
    Route::Group(['prefix' => 'Article'],function(){
        //显示文章列表
        Route::get('index' , 'ArticleController@index');
        Route::get('write' , 'ArticleController@write');
    });
    //标签
    Route::Group(['prefix' => 'Tags'],function(){
        //显示页面
        Route::get('index' , 'TagsController@index');
        Route::get('write' , 'ArticleController@write');
        //获取所有标签

    });
});

//前台
Route::Group(['namespace' => 'Home'],function(){
    //后台首页
    Route::get('/' , 'IndexController@index');
});