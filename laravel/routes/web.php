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

//后台首页
Route::get('/Admin' , 'Admin\AdminController@index');
//后台文章模块
Route::Group(['namespace' => 'Admin' , 'prefix' => 'Admin'],function(){
    Route::Group(['prefix' => 'Article'],function(){
        //显示文章列表
        Route::get('index' , 'ArticleController@index');
    });
});