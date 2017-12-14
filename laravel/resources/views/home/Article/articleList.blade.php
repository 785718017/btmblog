@extends('home.Common.common')
@section('style')
    <style>
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
            padding-left: 20px;
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
            padding-top: 10px;
            padding-bottom: 20px;
            border-bottom:solid #F1F0EE 2px;
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
            height: 106px;
            float: right;
            font-size: 14px;
            color: #413c3c;
            overflow: hidden;
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
        }
        .agree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
        }
        .agree_num.hadAgree{
            color: #ec4b38;
        }
        .agree_img.enable{
            cursor: pointer;
        }
        .agree_img.hadAgree{
            background-position: -21px -42px;
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
        }
        .disagree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
        }
        .disagree_num.hadDisagree{
            color: #ec4b38;
        }
        .disagree_img.enable{
            cursor: pointer;
        }
        .disagree_img.hadDisagree{
            background-position: -42px -42px;
        }
        .tag_author_time_comment{
            width: 494px;
        }
        .article_tag{
            width: 430px;
            height: 45px;
        }
        .article_tag_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: -42px 0px;
            float: left;
            margin-top: 14px;
            margin-left: 20px;
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
            margin-right:3px;
        }
        .comment_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 14px;
            color: #36353b;
            float: left;
        }
        .no_tags{
            display: inline-block;
            margin-top: 12px;
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
        .hot_tags_div .hot_tags_content{           
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

        .title_tag{
            font-size: 18px;
        }
        .no_article{
            width: 100%;
            height: 300px;
            text-align: center;
            line-height: 300px;
        }
        /*分页样式开始*/
        .page{
            width: 250px;
            margin: 0px auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .page ul{
            text-align: center;
        }
        .page ul li{
            list-style: none;
            text-decoration: none;
            display: inline-block;         
            border: solid #ccc 1px;
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
        }

        .page ul li a{
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-decoration: none;
            color: #666666;
        }
        .active{
            background: #CCC;
            color: #FFF;
        }
        /*分页样式结束*/
	</style>
    @stop
@section('style_src')
        
    @stop
@section('script_src')
    <script type="text/javascript" src="{{asset('/plugin/layer-v3.1.0/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/plugin/handlebars-v3.0.3.min.js')}}"></script>
    @stop
@section('common_content')
    <!-- 首页主题内容区域 -->
    <div class='home_main_content' tag_id="{{$tag->id}}">
        <!-- 文章推荐 -->
        <div class='article_recommend dib'>
            <div class='article_recommend_title'>
                <a href="/Article/articleList/{{$tag->id}}"><div class='title_tag tag color_{{$tag->color}}'>{{$tag->name}}</div></a>
            </div>
            <!-- 文章 -->
            <div class='article_div'>
                
            </div>
            <div class='page'>
                
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
                <div class='hot_tags_content'>
                    
                </div>
            </div>
            <!-- 扫码关注 -->
            <div></div>
            <!-- 文章排行 -->
            <div>
                <div class='article_rank_title'>文章排行：</div>
                <ul class='rank_ul'>
                    
                </ul>
            </div>
        </div>
    </div>
    @stop
@section('script')
        @verbatim
            <script id="article" type="text/x-handlebars-template">
            {{#each this}}
                    <div class='article_info' article_id='{{id}}'>
                        <!-- 标题 -->
                        <div class='article_title'>
                            <span class='dib'><a href="/Article/{{id}}" class='article_title_a' target="_blank">{{name}}</a></span>
                            <!-- 点踩 -->
                            <span class='dib disagree_span' title='踩'><span class='dib disagree_img {{#eq agree_type 0}}enable{{/eq}} {{#eq agree_type 2}}hadDisagree{{/eq}}' article_id='{{id}}'></span><span class='disagree_num {{#eq agree_type 2}}hadDisagree{{/eq}}' article_id='{{id}}' disagree_num='{{disagree_num}}'>{{disagree_num}}</span></span>
                            <!-- 点赞 -->
                            <span class='dib agree_span' title='赞'><span class='dib agree_img {{#eq agree_type 0}}enable{{/eq}} {{#eq agree_type 1}}hadAgree{{/eq}}' article_id='{{id}}'></span><span class='agree_num {{#eq agree_type 1}}hadAgree{{/eq}}' article_id='{{id}}' agree_num='{{agree_num}}'>{{agree_num}}</span></span>
                            <!-- 浏览量 -->
                            <span class='dib vision_span' title='浏览量'><span class='dib vision_img'></span><span class='vision_num'>{{browse_times}}</span></span>
                        </div>
                        <!-- 内容 -->
                        <div class='article_logo_content'>
                            <!-- 文章标志图 -->
                            <div class='dib article_logo_div'><img src="/storage/{{logo.url}}" class='article_logo'></div>
                            <!-- 内容简要 -->
                            <div class='dib article_content_big_div'>
                                <div class='dib article_content'>
                                    <a href="/Article/{{id}}" target="_blank">{{introduce}}</a>
                                </div>
                                <!-- 文章信息和操作区域 -点赞-点踩-评论 -->
                                <div class='dib tag_author_time_comment'>
                                    <!-- 文章信息 -->
                                    <div class='article_tag_div' title='标签'>
                                        <!-- 标签 -->
                                        <span class='dib article_tag'>
                                            <span class='dib article_tag_img'></span>
                                                {{#if tags}}
                                                    {{#each tags}}
                                                    <a href="/Article/articleList/{{id}}"><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div></a>
                                                    {{/each}}                                                   
                                                {{else}}                   
                                                    <span class='no_tags'>暂无标签</span>
                                                {{/if}}
                                        </span>
                                    </div>
                                    <div>
                                        <!-- 作者 -->
                                        <span class='author_span dib' title='作者'> 
                                            <span class='dib author_img'></span><span class='author_name'>{{author}}</span>
                                        </span>
                                        <!-- 时间 -->
                                        <span class='time_span dib' title='发布时间'>
                                            <span class='dib time_img'></span><span class='article_time'>{{publish_time}}</span>
                                        </span>                                                                     
                                        <!-- 评论-跳转到文章的评论页面 -->
                                        <span class='comment_span dib' title='评论'>
                                            <span class='dib comment_img'></span><span class='comment_num'>{{comment_num}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
            {{/each}}
            </script>

            <script  id="hot_tags" type="text/x-handlebars-template">
                {{#each this}}
                <a href="/Article/articleList/{{id}}"><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div></a>
                {{/each}} 
            </script>

            <script  id="hot_articles" type="text/x-handlebars-template">
                {{#each this}}
                <a href="/Article/{{id}}" title='{{name}}'><li class='rank_li'>{{name}}</li></a>
                {{/each}} 
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
            $(function(){
                var tag_id = $('.home_main_content').attr('tag_id');
                //获取该标签下的文章
                $.post('/Article/getArticlesByTagId', {tag_id:tag_id}, function(data){
                    if(data.status){
                        $('.article_div').html($('#article').template(data.info.articles.data));
                        $('.page').html(data.info.pages);
                    }else{
                        $('.article_div').html('<div class="no_article">暂无文章！请去其它分类看看吧~</div>');
                    }
                })
                //获取热门标签
                $.post('/Tags/getHotTags', null, function(data){
                    if(data.status){
                        $('.hot_tags_content').html($('#hot_tags').template(data.info));
                    }else{
                        layer.alert('获取热门标签，请刷新页面重试！', {icon : 6});
                    }
                })

                //获取阅读量最多的9篇文章
                $.post('/Article/getHotNineArticles', null, function(data){
                    if(data.status){
                        $('.rank_ul').html($('#hot_articles').template(data.info));
                    }else{
                        layer.alert('获取文章排行失败，请刷新页面重试！', {icon : 6});
                    }
                })


                $('body').onEvent({
                    'click' : {
                       '.agree_img.enable' : function(){
                            var article_id = $(this).attr('article_id');
                            $.post('/Article/addArticleAgree',{article_id : article_id},function(data){
                                if(data.status){
                                    //将该点赞按钮和点踩按钮变成不可点击
                                    $('.agree_img[article_id='+data.info.article_id+']').removeClass('enable').addClass('hadAgree');
                                    $('.disagree_img[article_id='+data.info.article_id+']').removeClass('enable');
                                    var agree_num = $('.agree_num[article_id='+data.info.article_id+']').attr('agree_num');
                                    agree_num = parseInt(agree_num) + 1;
                                    $('.agree_num[article_id='+data.info.article_id+']').html(agree_num).addClass('hadAgree');

                                    layer.msg('操作成功！');                                    
                                }else{
                                    layer.msg(data.info);
                                }
                            })
                       },
                       '.disagree_img.enable' : function(){
                            var article_id = $(this).attr('article_id');
                            $.post('/Article/addArticleDisagree',{article_id : article_id},function(data){
                                if(data.status){
                                    //将该点赞按钮和点踩按钮变成不可点击
                                    $('.agree_img[article_id='+data.info.article_id+']').removeClass('enable');
                                    $('.disagree_img[article_id='+data.info.article_id+']').removeClass('enable').addClass('hadDisagree');
                                    var disagree_num = $('.disagree_num[article_id='+data.info.article_id+']').attr('disagree_num');
                                    disagree_num = parseInt(disagree_num) + 1;
                                    $('.disagree_num[article_id='+data.info.article_id+']').html(disagree_num).addClass('hadDisagree');

                                    layer.msg('操作成功！');                                    
                                }else{
                                    layer.msg(data.info);
                                }
                            })
                       },
                       '.page ul li a' : function(e){
                            //处理分页的标签点击事件，阻止a标签，然后用ajax获取数据
                            e.preventDefault();

                            var tag_id = $('.home_main_content').attr('tag_id');
                            var url = $(this).attr('href');
                            url = url + '&tag_id='+tag_id;
                            var params = getParams(url);                       
                            
                            //获取其它页的文章
                            $.post('/Article/getArticlesByTagId', params, function(data){
                                if(data.status){
                                    $('.article_div').html($('#article').template(data.info.articles.data));
                                    $('.page').html(data.info.pages);
                                }else{
                                    layer.msg('获取数据失败');
                                }                           
                            })
                        }
                    }
                })
            })           
        </script>
    @stop
