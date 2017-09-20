@extends('admin.Common.common')
@section('style')
    <style>
		.home_banner{ 
            width: 100%;
            height: 265px;
            background: url('../image/blog_banner.png');
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
            background: url('../image/headimg.jpg');
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
            background:url('../image/icons.png');
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
            background:url('../image/icons.png');
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
            background:url('../image/icons.png');
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
            background:url('../image/icons.png');
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
            background:url('../image/icons.png');
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
            background:url('../image/icons.png');
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
            background:url('../image/icons.png');
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
            background: url('../image/search_btn.png');
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
            background: url('../image/rank.jpg');
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
