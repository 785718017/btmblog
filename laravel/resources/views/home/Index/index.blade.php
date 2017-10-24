@extends('home.Common.common')
@section('style')
    <style>
		.home_banner{ 
            width: 100%;
            height: 265px;
            background: url("{{asset('/image/home/blog_banner.png')}}");
            background-size: 100% 100%;
        }
        .home_banner .head_img_out_div{
            width: 1030px;
            margin: 0px auto;
        }
        .head_img{
            width: 140px;
            height: 140px;
            border-radius: 100%;
            background: url("{{asset('/image/home/headimg.jpg')}}");
            background-size: 100% 100%;
            position: relative;
            left: 700px;
            top: 70px;
            cursor: pointer;
            overflow: hidden;
            border:solid #FFF 2px;
        }
        .myname{
            width: 140px;
            height: 70px;
            line-height: 30px;
            background-color: rgba(0, 0, 0, .5);
            color: #FFF;
            font-size: 16px;
            text-align: center;
            margin-top: 140px;
        }
        .background{
            background: #F1F0EE;
        }
        /*页面布局*/
        .home_main_content{
            width: 1100px;
            margin:0px auto;
            min-height: 500px;
            padding-top: 20px;
            padding-bottom: 100px;
            overflow: hidden;
        }
        .article_recommend{
            width: 770px;
            min-height: 300px;
            background-color: #FFF;
            float:left;
            margin-left:20px;
        }
        .right_nav{
            width: 270px;
            min-height: 300px;
            background-color: #FFF;
            float:right;
            margin-right:20px;
        }

        /*单个文章样式开始*/        
        .article_recommend_title{
            /*font: 18px "微软雅黑", Arial, Helvetica, sans-serif;*/
            font-size: 18px;
            font-weight: bold;
            margin: 10px;
            letter-spacing: 3px;
        }
        .article_recommend_title_span{
            color: #db7878;
        }
        .article_div{
            margin-top: 20px;
            border-top:solid #F1F0EE 2px;
        }
        .article_info{
            width: 740px;
            margin:0px auto;
        }
        .article_title{
            font: 18px "微软雅黑", Arial, Helvetica, sans-serif;
            color: #544E4C;
            margin-top: 10px;
            font-weight: bold;
        }
        .article_title_a{
            color:#36353b;
            text-decoration: none;
        }
        .article_logo_content{
            margin-top: 10px;
        }
        .article_logo_div{
            padding: 5px;
            border:solid #ccc 1px;
            float: left;
        }
        .article_logo{
            width: 220px;
            height: 150px;          
        }
        .article_logo_content .article_content_big_div{
            width: 494px;
            overflow: hidden;
            margin-left: 10px;
        }
        .article_content{
            width: 494px;
            float: right;
            font-size: 14px;
            color: #413c3c;
        }
        .article_content a{
            color:#36353b;
            text-decoration: none;
        }
        .vision_span{
            width: 70px;
            height: 25px;           
            float: right;
            margin-right: 10px;
            overflow: hidden;
        }
        .vision_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: 0px -21px;
            float: left;
        }
        .vision_num,.agree_num,.disagree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
        }
        .agree_span{
            width: 70px;
            height: 25px;           
            float: right;
            margin-right: 10px;
            overflow: hidden;
        }
        .agree_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: -21px -21px;
            float: left;
            cursor: pointer;
        }
        .agree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
            cursor: pointer;
        }
        .disagree_span{
            width: 70px;
            height: 25px;           
            float: right;
            margin-right: 10px;
            overflow: hidden;
        }
        .disagree_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: -42px -21px;
            float: left;
            cursor: pointer;
        }
        .disagree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
            cursor: pointer;
        }
        .tag_author_time_comment{
            width: 494px;
        }
        .article_tag_name_li{
            color: #36353b;
            list-style: none;
            padding:3px 5px;
            float: left;
            background: #ccc;
            margin: 5px 5px;
            border-radius: 3px;
            font-size: 14px;
        }
        .article_tag_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: -42px 0px;
            float: left;
            margin-top: 22px;
            margin-left: 20px;
        }
        .article_tag_div ul{
            margin: 0px;
            padding: 0px;
            float: left;
            overflow: hidden;
            margin-top:15px;
        }
        .author_span{
            width: 100px;
            height: 25px;           
            float: left;
            margin-left: 20px;
            margin-right: 10px;
            overflow: hidden;
        }
        .author_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: -21px 0px;
            float: left;
            margin-right:3px;
        }
        .author_name{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
        }
        .time_span{
            width: 200px;
            height: 25px;           
            float: left;
            margin-right: 10px;
            overflow: hidden;
        }
        .time_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: 0px 0px;
            float: left;
            margin-right:3px;
        }
        .article_time{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
        }
        .comment_span{
            width: 100px;
            height: 25px;           
            float: left;
            margin-right: 10px;
            overflow: hidden;
        }
        .comment_img{
            width: 25px;
            height: 25px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:75px 75px;
            background-repeat: no-repeat;
            background-position: 0px -50px;
            float: left;
            cursor: pointer;
            margin-right:3px;
        }
        .comment_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
            cursor: pointer;
        }
        /*文章模块样式结束*/

        /*右侧边栏的样式开始*/
        .search_box{
            width: 180px;
            height: 30px;
            padding-left: 30px;
            margin-left:27px;
            margin-top: 20px;
            background: url("{{asset('/image/home/search_btn.png')}}");
            background-size:20px 20px;
            background-repeat: no-repeat;
            background-position: 5px 5px;
            font-size: 16px;
            border:solid #ccc 1px;
            opacity:0.7;
            filter:alpha(opacity=70);/*ie*/
        }
        .hot_tags_div{          
            margin-top: 20px;
        }
        .hot_tags_div ul{           
            overflow: hidden;
            margin:0px;
            padding: 0px;
            width: 210px;
            margin-left: 27px;
        }
        .rank_ul{
            list-style: none;
            margin:0px;
            padding: 0px;
            margin-left: 15px;          
            background: url("{{asset('/image/home/rank.jpg')}}");
            background-size: 19px 270px;
            background-repeat: no-repeat;
            background-position:8px 8px; 
            margin-bottom: 30px;
        }
        .rank_ul a{
            text-decoration: none;
        }
        .rank_li{
            width: 210px;
            height: 31px;
            line-height: 31px;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space:nowrap;             
            color: #36353b;
            padding-left: 30px;
            font-size: 12px;
        }
        .hot_tags_title,.article_rank_title{
            margin-top: 30px;
            border-top:#ccc 1px dashed;
            padding: 5px;
            padding-left: 10px;
            font-size: 14px;
            font-weight: bold;
        }
        /*右侧边栏的样式结束*/
	</style>
    @stop
@section('style_src')
        
    @stop
@section('script_src')
    <script type="text/javascript" src="{{asset('/plugin/layer-v3.1.0/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/plugin/handlebars-v3.0.3.min.js')}}"></script>
    @stop
@section('common_content')
    <!-- 首页banner -->
    <div class='home_banner'>
        <div class='head_img_out_div'>
            <div class='head_img'>
                <!-- 显示名字的部分 -->
                <div class='myname'>
                    半透明
                </div>
            </div>
        </div>
    </div>
    <!-- 首页主题内容区域 -->
    <div class='background'>
        <div class='home_main_content'>
            <!-- 文章推荐 -->
            <div class='article_recommend dib'>
                <div class='article_recommend_title'>文章<span class='article_recommend_title_span'>推荐</span></div>
                <!-- 单个文章 -->
                <div class='article_div'>
                    <div class='article_info'>
                        <!-- 标题 -->
                        <div class='article_title'>
                            <span class='dib'><a href="" class='article_title_a'>写给thinkphp开发者的laravel系列教程(一)序言</a></span>
                            <!-- 点踩 -->
                            <span class='dib disagree_span' title='踩'><span class='dib disagree_img'></span><span class='disagree_num'>12134</span></span>
                            <!-- 点赞 -->
                            <span class='dib agree_span' title='赞'><span class='dib agree_img'></span><span class='agree_num'>12134</span></span>
                            <!-- 浏览量 -->
                            <span class='dib vision_span' title='浏览量'><span class='dib vision_img'></span><span class='vision_num'>12134</span></span>
                        </div>
                        <!-- 内容 -->
                        <div class='article_logo_content'>
                            <!-- 文章标志图 -->
                            <div class='dib article_logo_div'><img src="{{asset('/image/home/article_logo.jpg')}}" class='article_logo'></div>
                            <!-- 内容简要 -->
                            <div class='dib article_content_big_div'>
                                <div class='dib article_content'>
                                    <a href="">终于；终于；终于； 开始正式写 laravel 系列了； 本系列教程主要面向的是多少懂点 thinkphp3.X 的开发者们； 我把我从tp3转到laravel的历程转成一篇篇的文章教程； 愿这一系列的文章； 能成为童鞋们踏入laravel的引路人； 如果还没下定决定要使用laravel； 那么我上来就是一个连接； 不是别人说好我也跟着说好的； 而是我实实在在的使用过后；... </a>
                                </div>
                                <!-- 文章信息和操作区域 -点赞-点踩-评论 -->
                                <div class='dib tag_author_time_comment'>
                                    <!-- 文章信息 -->
                                    <div class='article_tag_div' title='标签'>
                                        <!-- 标签 -->
                                        <span class='dib article_tag'>
                                            <span class='dib article_tag_img'></span>
                                            <ul>
                                                <a href=""><li class='article_tag_name_li'>电影</li></a>
                                                <a href=""><li class='article_tag_name_li'>Laravel</li></a>
                                                <a href=""><li class='article_tag_name_li'>JavaScript</li></a>
                                            </ul>
                                        </span>
                                    </div>
                                    <div>
                                        <!-- 作者 -->
                                        <span class='author_span dib' title='作者'> 
                                            <span class='dib author_img'></span><span class='author_name'>半透明</span>
                                        </span>
                                        <!-- 时间 -->
                                        <span class='time_span dib' title='发布时间'>
                                            <span class='dib time_img'></span><span class='article_time'>2017-9-7 23:06:06</span>
                                        </span>                                                                     
                                        <!-- 评论-跳转到文章的评论页面 -->
                                        <span class='comment_span dib' title='评论'>
                                            <span class='dib comment_img'></span><span class='comment_num'>356</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- 右侧边栏 -->
            <div class='right_nav dib'>
                <!-- 站内搜索 -->
                <div>
                    <input type="text" class='search_box'/>
                </div>
                <!-- 热门标签 -->
                <div class='hot_tags_div'>
                    <div class='hot_tags_title'>
                        热门标签:
                    </div>
                    <ul>
                        <a href=""><li class='article_tag_name_li'>电影</li></a>
                        <a href=""><li class='article_tag_name_li'>Laravel</li></a>
                        <a href=""><li class='article_tag_name_li'>JavaScript</li></a>
                        <a href=""><li class='article_tag_name_li'>电影</li></a>
                        <a href=""><li class='article_tag_name_li'>Laravel</li></a>
                        <a href=""><li class='article_tag_name_li'>JavaScript</li></a>
                    </ul>
                </div>
                <!-- 扫码关注 -->
                <div></div>
                <!-- 文章排行 -->
                <div>
                    <div class='article_rank_title'>文章排行：</div>
                    <ul class='rank_ul'>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                        <a href="" title='【活动作品】柠檬绿兔小白个人博客模板'><li class='rank_li'>【活动作品】柠檬绿兔小白个人博客模板</li></a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 公共底部-显示网站的基本信息 -->
        <div></div>
    </div>
    @stop
@section('script')
        @verbatim
            <script id="show_tags" type="text/x-handlebars-template">
                
            </script>
        @endverbatim
        <script type='text/javascript'>
            //注册handlebars标签
            Handlebars.registerHelper("eq",function(value1,value2,options){
                if(value1 == value2){
                    return options.fn(this);
                }else{
                    return options.inverse(this);
                }           
            }); 
            //进入页面时获取所有标签
            $(function(){
                

                $('body').onEvent({
                    'click' : {
                        //添加标签
                        '.add_tags_btn' : function(){
                            //弹出窗口
                            layer.open({
                                type: 1,
                                title: '添加标签',
                                maxmin: false, //弹出层是否可缩放
                                shadeClose: false, //点击遮罩关闭层
                                area : ['600px' , '350px'],
                                content: $('.add_tags_dialog'),
                                btn : ['添加' , '取消'],
                                cancel : function(index , layero){
                                    layer.close(index);
                                },
                                yes : function(index , layero){
                                    
                                }

                            });
                        }
                    }
                })
            })           
        </script>
    @stop
