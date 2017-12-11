@extends('home.Common.common')
@section('style')
    <style>    
        .home_main_content{
            width: 1140px;
            margin:0px auto;
            min-height: 500px;
            padding-top: 20px;
            padding-bottom: 100px;
            overflow: hidden;
        }
        .article_left_box{
            display: inline-block;
            width: 820px;
            margin-right: 10px;
            float: left;
        }
        

        /*文章区域样式开始*/
        .article_show_div{
            background-color: #FFF;
            border-radius: 10px;
        }
        .article_title{
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            height: 80px;
            line-height: 80px;
        }
        .article_content{
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 20px;
            word-wrap: break-word; 
            word-break: normal; 
        }
        p,pre{
            overflow-x: auto;
        }

        .author_time_tags{
            overflow: hidden;
            border-bottom: #ccc 1px dotted;
        }
        .author_span{
            width: 100px;
            height: 25px;           
            float: left;
            margin-left: 20px;
            margin-right: 10px;
            overflow: hidden;
            margin-top: 12px;
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
            margin-top: 12px;
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
        .article_tag_img{
            width: 21px;
            height: 21px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:63px 63px;
            background-repeat: no-repeat;
            background-position: -42px 0px;
            float: left;
            margin-top: 12px;
        }
        .tag_a{
            display: inline-block;
            float: left;
        }
        /*文章区域样式结束*/

        /*右边栏样式开始*/
        .article_right_box{
            display: inline-block;
            width: 300px;
            float: left;
            background-color: #FFF;
            border-radius: 10px;
        }
        .agree_login_div{
            overflow: hidden;
        }
        .agree_div{
            overflow: hidden;
            float: left;
            width: 190px;
        }
        .agree_left_div{
            overflow: hidden;  
            float: left;
            width: 190px;
            border-bottom: 1px #CCC dotted;
            margin-left: 20px; 
            height: 60px;
        }
        .agree_span{
            display: inline-block;
            width: 80px;
            height: 50px;   
            overflow: hidden;   
            margin-top: 18px;    
        }
        .agree_img{
            width: 28px;
            height: 28px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:84px 84px;
            background-repeat: no-repeat;
            background-position: -28px -28px;
            float: left;
        }
        .agree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 18px;
            color: #36353b;
            float: left;
            margin-top: 5px;
        }
        .agree_num.hadAgree{
            color: #ec4b38;
        }
        .agree_img.enable{
            cursor: pointer;
        }
        .agree_img.hadAgree{
            background-position: -28px -56px;
        }
        .disagree_span{
            display: inline-block;
            width: 80px;
            height: 50px; 
            overflow: hidden; 
            margin-top: 18px;           
        }
        .disagree_img{
            width: 28px;
            height: 28px;
            background:url("{{asset('/image/home/icons.png')}}");
            background-size:84px 84px;
            background-repeat: no-repeat;
            background-position: -56px -28px;
            float: left;
        }
        .disagree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 18px;
            color: #36353b;
            float: left;
            margin-top: 5px;
        }
        .disagree_num.hadDisagree{
            color: #ec4b38;
        }
        .disagree_img.enable{
            cursor: pointer;
        }
        .disagree_img.hadDisagree{
            background-position: -56px -56px;
        }

        .login_btn{
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background-color: #f6ce5b;
            font-weight: bold;
            font-size: 14px;
            color: #FFF;
            border-radius: 25px;
            cursor: pointer;
            float: right;
            margin-right: 30px;
            margin-top: 10px;
        }
        .user_info_area_btn{
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background-color: #f6ce5b;
            font-weight: bold;
            font-size: 14px;
            color: #FFF;
            border-radius: 25px;
            border: solid #ccc 1px;
            cursor: pointer;
            float: right;
            margin-right: 30px;
            margin-top: 10px;
            background-size: 50px 50px;
        }
        .comment_big_div{
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 10px;
            border: solid #ccc 1px;
            overflow: hidden;
            border-radius: 5px;
        }
        .comment_btn{
            width: 80px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: #FFF;
            background-color: #49c6e1;
            margin-top: 3px;
            margin-right: 3px;
            margin-bottom: 3px;
            border-radius: 5px;
            float: right;
            cursor: pointer;
        }
        .user_email{
            width: 165px;
            height: 25px;
            margin-left: 3px;
            margin-top: 3px;
            padding-left: 5px;
        }
        /*右边栏样式结束*/
        .user_info_open .layui-layer-content{            
            background: #fcf6ee;
        }

        /*评论样式开始*/
        .article_comment{
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 15px;
            border-top: solid #ccc 1px;
        }
        .comment_user_info_content{
            overflow: hidden;            
        }
        .comment_user_info{
            width: 60px;
            overflow: hidden;
            float: left;
        }
        .comment_user_head{
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 25px;
            border: solid #ccc 1px;
            float: left;
            margin-top: 10px;
            background-size: 50px 50px;
        }
        .commeny_name_content{
            width: 215px;
            float: left;
            margin-top: 15px;
        }
        .comment_user_name_agree{
            display: inline-block;
            float: left;
            font-size: 12px;
        }
        .comment_user_name{
            width: 55px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .comment_content{
            width: 195px;
            float: left;
            margin-left: 10px;
            margin-top: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 12px;
        }
        .comment_agree,.comment_disagree{
            font-size: 10px;
            color: #666666;
        }
        .comment_agree_img{
            width: 16px;
            height: 16px;
            background-image: url("{{asset('/image/home/icons.png')}}");
            background-size: 48px 48px;
            background-position: -16px -16px;
            margin-left: 10px;
        }
        .comment_agree_img.enable{
            cursor: pointer;
        }
        .comment_agree_img.hadAgree{
            background-position: -16px -32px;
        }
        .comment_disagree_img{
            width: 16px;
            height: 16px;
            background-image: url("{{asset('/image/home/icons.png')}}");
            background-size: 48px 48px;
            background-position: -32px -16px;
        }
        .comment_disagree_img.enable{
            cursor: pointer;
        }
        .comment_disagree_img.hadDisagree{
            background-position: -32px -32px;
        }
        .comment_agree_num,.comment_disagree_num{
            font-size: 10px;
            color: #666666;
            display: inline-block;
            width: 24px;
        }
        .comment_time_div{
            /*margin-left: 90px;*/
            margin-right: 15px;
            margin-top: 30px;
            overflow: hidden;
        }
        .comment_time{
            display: inline-block;
            font-size: 10px;
            color: #666666;
        }
        .comment_time_div .reply_btn{
            margin-left: 5px;
            font-size: 12px;
            color: #2698d7;
            cursor: pointer;
        }
        /*评论样式结束*/

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
            width: 20px;
            height: 20px;
            line-height: 20px;
            font-size: 12px;
        }

        .page ul li a{
            display: inline-block;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-decoration: none;
            color: #666666;
        }
        .active{
            background: #CCC;
            color: #FFF;
        }
        /*分页样式结束*/

        /*回复样式开始*/
        .reply_user_info_content{
            overflow: hidden;
        }
        .comment_replys{
            margin-left: 65px;
            margin-right: 15px;
        }
        .comment_reply{
            margin-top: 10px;
            border-top: solid 1px #ccc;
        }
        .reply_user_info{
            width: 45px;
            overflow: hidden;
            float: left;
        }
        .reply_user_head{
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 20px;
            border: solid #ccc 1px;
            float: left;
            margin-top: 10px;
            background-size: 40px 40px;
        }
        .reply_user_name_div{
            display: inline-block;
            float: left;
            font-size: 10px;
        }
        .reply_user_name{
            width: 44px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #666666;
        }
        .reply_for_user_name{
            width: 135px;
            float: left;
            margin-left: 10px;
            margin-top: 10px;
            padding-bottom: 5px;
            font-size: 10px;
            color: #666666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .reply_content{
            width: 135px;
            float: left;
            margin-left: 10px;
            padding-bottom: 5px;
            font-size: 10px;
        }
        .reply_time_div{
            /*margin-left: 90px;*/
            margin-right: 15px;
            margin-top: 30px;
            overflow: hidden;
        }
        .reply_time{
            display: inline-block;
            font-size: 10px;
            color: #666666;
        }
        .reply_time_div .reply_btn{
            margin-left: 5px;
            font-size: 12px;
            color: #2698d7;
            cursor: pointer;
        }
        .reply_time_agree .reply_btn{
            margin-left: 5px;
            font-size: 12px;
            color: #2698d7;
            cursor: pointer;
        }
        /*回复样式结束*/

        /*回复框样式开始*/
        .reply_show_area{
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 16px;
            border: solid #ccc 1px;
            border-radius: 5px;
        }
        .reply_user_email{
            width: 130px;
            height: 16px;
            padding-left: 10px;
            padding-right: 10px;
            margin-left: 5px;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .reply_comment_btn{
            display: inline-block;
            width: 45px;
            height: 20px;
            line-height: 20px;
            border-radius: 5px;
            color: #FFF;
            text-align: center;
            font-size: 13px;
            margin-top: 5px;
            margin-left: 10px;
            background-color: #49c6e1;
            cursor: pointer;
        }
        .reply_reply_btn{
            display: inline-block;
            width: 45px;
            height: 20px;
            line-height: 20px;
            border-radius: 5px;
            color: #FFF;
            text-align: center;
            font-size: 13px;
            margin-top: 5px;
            margin-left: 10px;
            background-color: #49c6e1;
            cursor: pointer;
        }
        /*回复框样式结束*/

        /*没有评论时样式开始*/
        .no_comments{
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 15px;
            border-top: solid #ccc 1px;
            height: 140px;
            line-height: 140px;
            font-size: 16px;
            color: #666666;
            text-align: center;
        }
        /*没有评论时样式结束*/
	</style>
    @stop
@section('style_src')
        
    @stop
@section('script_src')
    <script type="text/javascript" src="{{asset('/plugin/layer-v3.1.0/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/plugin/handlebars-v3.0.3.min.js')}}"></script>   
    <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.parse.js')}}"></script>
    @stop
@section('common_content')
    <div class='home_main_content' article_id="{{$id}}">
        <!-- 左边显示文章内容，右边显示评论和点赞等操作 -->
        <div class='article_left_box'>
            <div class='article_show_div'>
                <div class='article_title'></div>
                <div class='author_time_tags'>

                </div>
                <div class='article_content'></div>
            </div>
        </div>

        <div class='article_right_box'>
            <div class='agree_login_div'>
                <div class='agree_div'></div>
                <!-- 登录 -->
                @if (session("uid") != null)
                <span class='user_info_area_btn'
                    @if (session('head') == 0)
                        style="background-image: url({{asset('/image/home/default_head.jpg')}});"
                    @else
                        style="background-image: url({{asset('/image/home/headimg.jpg')}});"
                    @endif 
                >
                </span>
                @else
                <span class='login_btn'>登录</span>
                @endif
            </div>
            <div class='comment_big_div'>
                <!-- 评论输入框 -->
                <div class='input_comment_div'>
                    <script id="editor" type="text/plain"> </script>
                </div>
                <div>
                    <span><input type="text" class='user_email' placeholder="接收回复的email地址" /></span>
                    <span class='comment_btn dib'>评论</span>
                </div>
            </div>
            <div class='article_comments_replys'>
                
            </div>
            <div class='page'></div>
        </div>
    </div>
    @stop
@section('script')
    @verbatim
    <script  id="article_info" type="text/x-handlebars-template">
         <!-- 作者 -->
        <span class='author_span dib' title='作者'> 
            <span class='dib author_img'></span><span class='author_name'>{{author}}</span>
        </span>
        <!-- 时间 -->
        <span class='time_span dib' title='发布时间'>
            <span class='dib time_img'></span><span class='article_time'>{{publish_time}}</span>
        </span>
        <!-- 标签 -->
        <span class='dib article_tag'>
            <span class='dib article_tag_img'></span>
            {{#if tags}}
                {{#each tags}}
                <a href="" class='tag_a'><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div></a>
                {{/each}}                                                   
            {{else}}                   
                <span class='no_tags'>暂无标签</span>
            {{/if}}
        </span>
    </script>

    <script  id="article_info_right" type="text/x-handlebars-template">
        <div class='agree_left_div'>
            <!-- 点赞 -->
            <span class='dib agree_span' title='赞'><span class='dib agree_img {{#eq agree_type 0}}enable{{/eq}} {{#eq agree_type 1}}hadAgree{{/eq}}' article_id='{{id}}'></span><span class='agree_num {{#eq agree_type 1}}hadAgree{{/eq}}' article_id='{{id}}' agree_num='{{agree_num}}'>{{agree_num}}</span></span>
            <!-- 点踩 -->
            <span class='dib disagree_span' title='踩'><span class='dib disagree_img {{#eq agree_type 0}}enable{{/eq}} {{#eq agree_type 2}}hadDisagree{{/eq}}' article_id='{{id}}'></span><span class='disagree_num {{#eq agree_type 2}}hadDisagree{{/eq}}' article_id='{{id}}' disagree_num='{{disagree_num}}'>{{disagree_num}}</span></span>
        </div>
    </script>
    <script  id="article_comments" type="text/x-handlebars-template">
        {{#each comments}}
        <div class='article_comment' comment_id='{{id}}'>
            <div class='comment_user_info_content'>
                <div class='comment_user_info'>
                    <span class='comment_user_head' 
                        {{#eq user_head 0}}
                            style="background-image: url('http://www.btmblog.com/image/home/default_head.jpg');"
                        {{else}}
                            style="background-image: url('http://www.btmblog.com/image/home/head_img.jpg');"
                        {{/eq}}
                    ></span>

                    <div class='comment_user_name_agree'>
                        <span class='comment_user_name dib' title="{{user_name}}">{{user_name}}</span>
                    </div>
                </div>
                <div class='comment_content'>{{{content}}}</div> 
                                  
            </div>                   
            <div class='comment_time_div'>
                <div class='oprs'>  
                    <span class='comment_time'>{{publish_time}}</span>                 
                    <!-- 点赞 -->
                    <span class='dib comment_agree_span' title='赞'><span class='dib comment_agree_img {{#eq agree_type 0}}enable{{/eq}} {{#eq agree_type 1}}hadAgree{{/eq}}' comment_id='{{id}}'></span><span class='comment_agree_num {{#eq agree_type 1}}hadAgree{{/eq}}' comment_id='{{id}}' agree_num='{{agree_num}}'>{{agree_num}}</span></span>
                    <!-- 点踩 -->
                    <span class='dib comment_disagree_span' title='踩'><span class='dib comment_disagree_img {{#eq agree_type 0}}enable{{/eq}} {{#eq agree_type 2}}hadDisagree{{/eq}}' comment_id='{{id}}'></span><span class='comment_disagree_num {{#eq agree_type 2}}hadDisagree{{/eq}}' comment_id='{{id}}' disagree_num='{{disagree_num}}'>{{disagree_num}}</span></span>
                    <span class='reply_btn' comment_id='{{id}}' user_id='{{user_id}}' user_name='{{user_name}}'>回复</span>
                </div>              
                
                <!-- <span>删除</span> -->
            </div>

            <div class='comment_replys'>
                {{#each replys}}
                    <div class='comment_reply'>
                        <div class='reply_user_info_content'>
                            <div class='reply_user_info'>
                                <span class='reply_user_head'
                                    {{#eq user_head 0}}
                                        style="background-image: url('http://www.btmblog.com/image/home/default_head.jpg');"
                                    {{else}}
                                        style="background-image: url('http://www.btmblog.com/image/home/head_img.jpg');"
                                    {{/eq}}
                                >
                                </span>
                                <div class='reply_user_name_div'>
                                    <span class='reply_user_name' title="{{user_name}}">{{user_name}}</span>
                                </div>                           
                            </div>
                            <div>
                                <div class='reply_for_user_name' title='{{reply_for_user_name}}'>回复：{{reply_for_user_name}}</div>
                                <div class='reply_content'>{{{content}}}</div>
                            </div>
                        </div>
                        <div class='reply_time_agree'>
                            <span class='reply_time'>{{publish_time}}</span>
                            <span class='reply_btn reply_for_reply' reply_id='{{id}}' comment_id='{{comment_id}}' user_id='{{user_id}}' user_name='{{user_name}}'>回复</span>
                        </div>
                    </div>
                {{/each}}
            </div> 
        </div>
                   
        {{/each}}
    </script>
    <script  id="no_comments" type="text/x-handlebars-template">
        <div class='no_comments'>还没有人评论哦~快抢沙发！</div>
    </script>
    @endverbatim
    <script type="text/javascript">
        $(function(){
            var id = $('.home_main_content').attr('article_id');
            //获取文章的信息
            $.post('/Article/getArticleDetail', {id : id}, function(data){
                if(data.status){
                    data = data.info;
                    $('.article_title').html(data.name);
                    $('.article_content').html(data.content);

                    $('.author_time_tags').html($('#article_info').template(data));
                    $('.agree_div').html($('#article_info_right').template(data));
                    //解析文章内容
                    uParse('.article_content', {rootPath : "{{asset('/plugin/ueditor')}}"});
                }else{
                    layer.alert('获取数据失败！');
                }
                
            })

            //获取文章的点赞、点踩、评论、回复等信息
            $.post('/Article/getArticleRelateInfo', {id : id}, function(data){
                if(data.status){
                    //设置评论和回复
                    $('.article_comments_replys').html($('#article_comments').template(data.info));

                    //设置评论分页
                    $('.page').html(data.info.pages);
                }else{
                    //没有评论
                    $('.article_comments_replys').html($('#no_comments').template());                        
                }
                
            })

            //实例化编辑器
            var ue = UE.getEditor( 'editor',{
                autoHeightEnabled: false,
                initialFrameWidth: 266,
                initialFrameHeight:120,
                elementPathEnabled:false,//删除元素路径
                wordCount: false,//删除字数统计
                pasteplain: true,//纯文本粘贴
                autoFloatEnabled: false,//工具栏不固定
                initialContent: '',
                autoClearinitialContent: true,
                toolbars: [
                    ['emotion'] //,'fullscreen'
                ]
            });

            ue.ready(function () {
                // 删除 路径一行
                $(".edui-editor-bottomContainer").remove();
            });  

            $('body').onEvent({
                'click' : {
                    '.comment_btn' : function(){
                        //获取评论的内容
                        var comment = ue.getContent();
                        var text = ue.getContentTxt();
                        if(parseInt(text.trim().length) < 5){
                            layer.msg('请至少输入5个字！');
                            return false;
                        }
                        //获取邮箱地址
                        var email = $('.user_email').val();
                        //如果有邮箱地址，则验证邮箱地址正则
                        if(email != ''){
                            //仅支持qq邮箱、126邮箱、163邮箱、新浪邮箱和gmail
                            var pattern = /^([a-zA-Z0-9])+@(qq\.com)|(163\.com)|(126\.com)|(sina\.com)|(sina\.cn)|(gmail\.com)$/;
                            // var patt = new RegExp(pattern);
                            if(!pattern.exec(email)){
                                layer.alert('邮箱格式不正确，目前仅支持qq邮箱、163邮箱、126邮箱、gmail和新浪邮箱');
                                return false;
                            }
                        }
                        var article_id = $('.home_main_content').attr('article_id');

                        var params = {
                            article_id : article_id,
                            comment : comment,
                            email : email
                        }
                        //提交评论
                        $.post('/Article/comment', params, function(data){
                            if(data.status){
                                //重置评论输入框的内容
                                ue.setContent('');
                                //将用户添加的评论放在评论列表中的第一条
                                var data = data.info;

                                layer.msg('评论成功！');

                            }else{
                                layer.msg(data.info);
                            }
                        })
                    },
                    '.login_out_btn' : function(){
                        //注销
                        $.post('/login_out', null, function(data){
                            window.location.reload();                         
                        })
                    },
                    '.user_info_area_btn' : function(){
                        var user_id = $('.user_info_box_id').attr('user_id');                       
                        if(user_id != ''){
                            //展示用户个人信息窗口
                            layer.open({
                                type: 1,
                                title: false,
                                maxmin: false, //弹出层是否可缩放
                                shadeClose: false, //点击遮罩关闭层
                                closeBtn: 2,
                                shade: 0,
                                skin: 'user_info_open',
                                area : ['250px' , '150px'],
                                offset: ['60px', '1000px'],
                                content: $('.user_info_box')
                            })
                        }                       
                    },
                    '.page ul li a' : function(e){
                        //处理分页的标签点击事件，阻止a标签，然后用ajax获取数据
                        e.preventDefault();
                        //检测其它评论下是否有回复框，如果有，则关掉其它回复框
                        if($('.article_comment .reply_show_area').length > 0){
                            //销毁编辑器
                            UE.getEditor('reply_editor').destroy();
                            $('.article_comment .reply_show_area').remove();
                        }

                        var id = $('.home_main_content').attr('article_id');
                        var url = $(this).attr('href');
                        url = url + '&id='+id;
                        var params = getParams(url);                       
                        
                        //获取其它页的文章
                        $.post('/Article/getArticleRelateInfo', params, function(data){
                            if(data.status){
                                //设置评论和回复
                                $('.article_comments_replys').html($('#article_comments').template(data.info));
                                //设置评论分页
                                $('.page').html(data.info.pages);
                            }else{
                                layer.msg('获取数据失败');
                            }                           
                        })
                    },
                    '.reply_btn' : function(){
                        var user_id = $(this).attr('user_id');
                        var comment_id = $(this).attr('comment_id');
                        var user_name = $(this).attr('user_name');

                        //检测当前评论下是否有回复框，如果有，不做任何处理
                        if($(this).closest('.article_comment').find('.reply_show_area').length > 0){
                            //销毁编辑器
                            UE.getEditor('reply_editor').destroy();
                            $('.article_comment .reply_show_area').remove();
                        }

                        //检测其它评论下是否有回复框，如果有，则关掉其它回复框
                        if($('.article_comment .reply_show_area').length > 0){
                            //销毁编辑器
                            UE.getEditor('reply_editor').destroy();
                            $('.article_comment .reply_show_area').remove();
                        }
                        if($(this).hasClass('reply_for_reply')){
                            var str = "<div class='hide reply_show_area'><div class='reply_area'><script id='reply_editor' type='text/plain'><\/script><\/div><div><span><input type='text' class='reply_user_email' placeholder='接收回复的email地址' \/><\/span><span class='reply_reply_btn dib' user_id='"+user_id+"' comment_id='"+comment_id+"'>评论<\/span><\/div><\/div>";
                        }else{
                            var str = "<div class='hide reply_show_area'><div class='reply_area'><script id='reply_editor' type='text/plain'><\/script><\/div><div><span><input type='text' class='reply_user_email' placeholder='接收回复的email地址' \/><\/span><span class='reply_comment_btn dib' user_id='"+user_id+"' comment_id='"+comment_id+"'>评论<\/span><\/div><\/div>";
                        }
                        
                        $(this).closest('.article_comment').append(str);
                        $('.reply_show_area').removeClass('hide');
                        //实例化编辑器
                        reply_ue = UE.getEditor('reply_editor',{
                            autoHeightEnabled: false,
                            initialFrameWidth: 220,
                            initialFrameHeight:80,
                            elementPathEnabled:false,//删除元素路径
                            wordCount: false,//删除字数统计
                            pasteplain: true,//纯文本粘贴
                            autoFloatEnabled: false,//工具栏不固定
                            initialContent: '回复@'+user_name+'：',
                            autoClearinitialContent: true,
                            toolbars: [
                                ['emotion'] //,'fullscreen'
                            ]
                        });
                    },
                    '.reply_comment_btn' :  function(){
                        var reply_content = reply_ue.getContent();
                        var reply_email = $('.reply_user_email').val();
                        var comment_id = $(this).attr('comment_id');
                        var reply_for_uid = $(this).attr('user_id');

                        //获取焦点，让编辑器去掉默认内容
                        reply_ue.focus();
                        var text = reply_ue.getContentTxt();
                        if(parseInt(text.trim().length) < 1){
                            layer.msg('请至少输入一个字！');
                            return false;
                        }
                        //如果有邮箱地址，则验证邮箱地址正则
                        if(reply_email != ''){
                            //仅支持qq邮箱、126邮箱、163邮箱、新浪邮箱和gmail
                            var pattern = /^([a-zA-Z0-9])+@(qq\.com)|(163\.com)|(126\.com)|(sina\.com)|(sina\.cn)|(gmail\.com)$/;
                            // var patt = new RegExp(pattern);
                            if(!pattern.exec(reply_email)){
                                layer.alert('邮箱格式不正确，目前仅支持qq邮箱、163邮箱、126邮箱、gmail和新浪邮箱');
                                return false;
                            }
                        }
                        var params = {
                            reply_content : reply_content,
                            reply_email : reply_email,
                            comment_id : comment_id,
                            reply_for_uid : reply_for_uid
                        };
                        $.post('/Article/replyForComment', params, function(data){
                            if(data.status){
                                data = data.info;
                                //销毁编辑器
                                UE.getEditor('reply_editor').destroy();
                                $('.article_comment .reply_show_area').remove();

                                //在这条评论的最后加上回复的内容
                                var str = "<div class='comment_reply'><div class='reply_user_info_content'><div class='reply_user_info'><span class='reply_user_head' style=\"background-image: url('http://www.btmblog.com/image/"+data.head+".jpg');\"></span><div class='reply_user_name_div'><span class='reply_user_name' title='"+data.user_name+"'>"+data.user_name+"</span></div></div><div><div class='reply_for_user_name' title='"+data.reply_for_user_name+"'>回复："+data.reply_for_user_name+"</div><div class='reply_content'>"+data.content+"</div></div></div><div class='reply_time_agree'><span class='reply_time'>"+data.publish_time+"</span><span class='reply_btn reply_for_reply' reply_id='"+data.id+"' comment_id='"+data.comment_id+"' user_id='"+data.user_id+"' user_name='"+data.user_name+"'>回复</span></div></div>";


                                $('.article_comment[comment_id='+data.comment_id+']').find('.comment_replys').append(str);
                                layer.msg('评论成功！');
                            }else{
                                layer.msg(data.info);
                            }
                        })

                    },
                    '.reply_reply_btn' : function(){
                        var reply_content = reply_ue.getContent();
                        var reply_email = $('.reply_user_email').val();
                        var comment_id = $(this).attr('comment_id');
                        var reply_for_uid = $(this).attr('user_id');
                        //获取焦点，让编辑器去掉默认内容
                        reply_ue.focus();
                        var text = reply_ue.getContentTxt();

                        if(parseInt(text.trim().length) < 1){
                            layer.msg('请至少输入一个字！');
                            return false;
                        }
                        //如果有邮箱地址，则验证邮箱地址正则
                        if(reply_email != ''){
                            //仅支持qq邮箱、126邮箱、163邮箱、新浪邮箱和gmail
                            var pattern = /^([a-zA-Z0-9])+@(qq\.com)|(163\.com)|(126\.com)|(sina\.com)|(sina\.cn)|(gmail\.com)$/;
                            // var patt = new RegExp(pattern);
                            if(!pattern.exec(reply_email)){
                                layer.alert('邮箱格式不正确，目前仅支持qq邮箱、163邮箱、126邮箱、gmail和新浪邮箱');
                                return false;
                            }
                        }
                        var params = {
                            reply_content : reply_content,
                            reply_email : reply_email,
                            comment_id : comment_id,
                            reply_for_uid : reply_for_uid
                        };
                        $.post('/Article/replyForReply', params, function(data){
                            if(data.status){
                                data = data.info;
                                //销毁编辑器
                                UE.getEditor('reply_editor').destroy();
                                $('.article_comment .reply_show_area').remove();
                                
                                //在这条评论的最后加上回复的内容
                                var str = "<div class='comment_reply'><div class='reply_user_info_content'><div class='reply_user_info'><span class='reply_user_head' style=\"background-image: url('http://www.btmblog.com/image/"+data.head+".jpg');\"></span><div class='reply_user_name_div'><span class='reply_user_name' title='"+data.user_name+"'>"+data.user_name+"</span></div></div><div><div class='reply_for_user_name' title='"+data.reply_for_user_name+"'>回复："+data.reply_for_user_name+"</div><div class='reply_content'>"+data.content+"</div></div></div><div class='reply_time_agree'><span class='reply_time'>"+data.publish_time+"</span><span class='reply_btn reply_for_reply' reply_id='"+data.id+"' comment_id='"+data.comment_id+"' user_id='"+data.user_id+"' user_name='"+data.user_name+"'>回复</span></div></div>";


                                $('.article_comment[comment_id='+data.comment_id+']').find('.comment_replys').append(str);
                                layer.msg('评论成功！');
                            }else{
                                layer.msg(data.info);
                            }
                        })
                    },
                    '.agree_img.enable' : function(){
                        var article_id = $(this).attr('article_id');
                        $.post('/Article/addArticleAgree',{article_id : article_id},function(data){
                            if(data.status){
                                //将该点赞按钮和点踩按钮变成不可点击
                                $('.agree_img').removeClass('enable').addClass('hadAgree');
                                $('.disagree_img').removeClass('enable');
                                var agree_num = $('.agree_num').attr('agree_num');
                                agree_num = parseInt(agree_num) + 1;
                                $('.agree_num').html(agree_num).addClass('hadAgree');

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
                                $('.agree_img').removeClass('enable');
                                $('.disagree_img').removeClass('enable').addClass('hadDisagree');
                                var disagree_num = $('.disagree_num').attr('disagree_num');
                                disagree_num = parseInt(disagree_num) + 1;
                                $('.disagree_num').html(disagree_num).addClass('hadDisagree');

                                layer.msg('操作成功！');                                    
                            }else{
                                layer.msg(data.info);
                            }
                        })
                   },
                   '.comment_agree_img.enable' : function(){
                        var comment_id = $(this).attr('comment_id');
                        $.post('/Article/addCommentAgree',{comment_id : comment_id},function(data){
                            if(data.status){
                                //将该点赞按钮和点踩按钮变成不可点击
                                $('.comment_agree_img[comment_id='+data.info.comment_id+']').removeClass('enable').addClass('hadAgree');
                                $('.comment_disagree_img[comment_id='+data.info.comment_id+']').removeClass('enable');
                                var agree_num = $('.comment_agree_num[comment_id='+data.info.comment_id+']').attr('agree_num');
                                agree_num = parseInt(agree_num) + 1;
                                $('.comment_agree_num[comment_id='+data.info.comment_id+']').html(agree_num).addClass('hadAgree');

                                layer.msg('操作成功！');                                    
                            }else{
                                layer.msg(data.info);
                            }
                        })
                   },
                   '.comment_disagree_img.enable' : function(){
                        var comment_id = $(this).attr('comment_id');
                        $.post('/Article/addCommentDisagree',{comment_id : comment_id},function(data){
                            if(data.status){
                                  //将该点赞按钮和点踩按钮变成不可点击
                                $('.comment_agree_img[comment_id='+data.info.comment_id+']').removeClass('enable');
                                $('.comment_disagree_img[comment_id='+data.info.comment_id+']').removeClass('enable').addClass('hadDisagree');
                                var disagree_num = $('.comment_disagree_num[comment_id='+data.info.comment_id+']').attr('disagree_num');
                                disagree_num = parseInt(disagree_num) + 1;
                                $('.comment_disagree_num[comment_id='+data.info.comment_id+']').html(disagree_num).addClass('hadAgree');

                                layer.msg('操作成功！');                                 
                            }else{
                                layer.msg(data.info);
                            }
                        })
                   }
                }
            })          
        })
    </script>
    @stop