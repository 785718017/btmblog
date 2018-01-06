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

//后台
Route::Group(['namespace' => 'Admin' , 'prefix' => 'Admin', 'middleware' => ['check_auth']],function(){
    //后台首页
    Route::get('/' , 'AdminController@index');

    //文章
    Route::Group(['prefix' => 'Article'],function(){
        //显示文章列表
        Route::get('index' , 'ArticleController@index');
        //显示文章撰写页面
        Route::get('write' , 'ArticleController@write');
        //写文章
        Route::post('addArticle' , 'ArticleController@addArticle');

        //上传logo图,并返回logo数据以作展示
        Route::post('uploadLogo' , 'ArticleController@uploadLogo');
        //获取所有的文章
        Route::post('getAllArticles' , 'ArticleController@getAllArticles');

        //修改文章页面
        Route::get('update','ArticleController@update');
        //修改文章
        Route::post('updateArticle','ArticleController@updateArticle');

        //文章下线
        Route::post('onlineOrOffline' , 'ArticleController@onlineOrOffline');

        //获取文章信息
        Route::post('getArticleInfo' , 'ArticleController@getArticleInfo');


    });
    //标签
    Route::Group(['prefix' => 'Tags'],function(){
        //显示页面
        Route::get('index' , 'TagsController@index');
        //添加标签
        Route::post('addTag' , 'TagsController@addTag');
        //修改标签
        Route::post('changeTag' , 'TagsController@changeTag');
        //禁用/恢复标签
        Route::post('banTag' , 'TagsController@banTag');
        //获取二级标签
        Route::post('getSecondLevelByTopId' , 'TagsController@getSecondLevelByTopId');
        //根据标签id获取标签信息
        Route::post('getTagById' , 'TagsController@getTagById');
        //获取可用的顶级标签
        Route::post('getTopLevelTags' , 'TagsController@getTopLevelTags');

        //获取所有标签
        Route::post('getTags' , 'TagsController@getTags');
    });
    //权限
    Route::Group(['prefix' => 'Auth'],function(){
        //获取该权限下的子权限列表
        Route::get('/{id?}' , 'AuthController@index');
        //添加权限页面
        Route::get('addChildAuth/{id}' , 'AuthController@addChildAuth');
        //添加权限
        Route::post('addAuth' , 'AuthController@addAuth');

        //获取所有子权限
        Route::post('getChildAuths' , 'AuthController@getChildAuths');
        //禁用权限

        //用户组权限页面
        Route::get('groupAuth' , 'AuthController@groupAuth');
        //更新用户组权限
        Route::post('updateGroupAuth' , 'AuthController@updateGroupAuth');
        //获取用户组所有权限
        Route::post('getGroupAuths' , 'AuthController@getGroupAuths');

    });

    //用户
    Route::Group(['prefix' => 'User'],function(){
        //用户组列表页面
        Route::get('groupList' , 'UserController@groupList');
        //用户组权限页面
        Route::get('groupAuth/{id}' , 'UserController@groupAuth');
        //获取所有的用户组
        Route::post('getAllGroups' , 'UserController@getAllGroups');

    });
});



//前台
Route::Group(['namespace' => 'Home','middleware' => ['check_auth']],function(){
    //前台首页
    Route::get('/' , 'IndexController@index');

    //个人资料
    Route::get('/About' , 'UserController@about');

    Route::Group(['prefix' => 'Article'],function(){
        //获取推荐文章(最新的五篇文章)
        Route::post('getRecommend' , 'ArticleController@getRecommend');

        //获取点击量最多的9篇文章
        Route::post('getHotNineArticles' , 'ArticleController@getHotNineArticles');
        //展示文章页面
        Route::get('/{id}' , 'ArticleController@index');
        //根据文章id,获取文章的详细信息
        Route::post('getArticleDetail' , 'ArticleController@getArticleDetail');
        //获取文章的点赞、评论等信息
        Route::post('getArticleRelateInfo' , 'ArticleController@getArticleRelateInfo');
        //点赞文章
        Route::post('addArticleAgree' , 'ArticleController@addArticleAgree');
        //点踩文章
        Route::post('addArticleDisagree' , 'ArticleController@addArticleDisagree');
        //根据标签展示文章列表
        Route::get('/articleList/{tag_id}' , 'ArticleController@articleList');
        //根据标签id获取文章
        Route::post('getArticlesByTagId' , 'ArticleController@getArticlesByTagId');

        //提交评论
        Route::post('comment' , 'CommentController@comment');
        //回复评论
        Route::post('replyForComment' , 'CommentController@replyForComment');
        //回复评论的回复
        Route::post('replyForReply' , 'CommentController@replyForReply');
        //点赞评论
        Route::post('addCommentAgree' , 'CommentController@addCommentAgree');
        //点踩评论
        Route::post('addCommentDisagree' , 'CommentController@addCommentDisagree');
    });
    Route::Group(['prefix' => 'Tags'],function(){
        //获取热门标签
        Route::post('getHotTags' , 'TagsController@getHotTags');
    });
    Route::Group(['prefix' => 'Message'],function(){
        //展示留言页面
        Route::get('/' , 'MessageController@index');
        //添加留言
        Route::post('addMessage' , 'MessageController@addMessage');
        //获取更多留言
        Route::post('getMoreMessage' , 'MessageController@getMoreMessage');
        //添加留言评论
        Route::post('replyForMessage' , 'MessageController@replyForMessage');
        //添加留言评论的评论
        Route::post('replyForReply' , 'MessageController@replyForReply');
    });

    //用户组
    Route::Group(['prefix' => 'User'],function (){
        //检验用户名是否存在
        Route::post('checkUserName' , 'UserController@checkUserName')->middleware('CheckLogin');
        //注册用户
        Route::post('registUser' , 'UserController@registUser')->middleware('CheckLogin');
        //登录
        Route::post('login' , 'UserController@login')->middleware('CheckLogin');
    });

    //前台公共成功提示页面
    Route::get('/successNotify/{info}/{time}' ,'Notify@successNotify');
    //前台公共失败提示页面
    Route::get('/failNotify/{info}/{time}' ,'Notify@failNotify');
    //注册页面
    Route::get('/regist' , 'UserController@regist')->middleware('CheckLogin');
});

// 注销
Route::post('/login_out', function (\Illuminate\Http\Request $request){
    $request->session()->flush();
    return 1;
});
