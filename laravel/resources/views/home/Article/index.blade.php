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
            cursor: pointer;
        }
        .agree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 18px;
            color: #36353b;
            float: left;
            cursor: pointer;
            margin-top: 5px;
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
            cursor: pointer;
        }
        .disagree_num{
            height: 25px;
            line-height: 25px;
            font-weight: normal;
            font-size: 18px;
            color: #36353b;
            float: left;
            cursor: pointer;
            margin-top: 5px;
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
            <div>展示其他人的评论情况</div>
            <div>评论翻页</div>
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
            <span class='dib agree_span' title='赞'><span class='dib agree_img'></span><span class='agree_num'>{{agree_num}}</span></span>
            <!-- 点踩 -->
            <span class='dib disagree_span' title='踩'><span class='dib disagree_img'></span><span class='disagree_num'>{{disagree_num}}</span></span>
        </div>
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
                //设置点赞和点踩，以及用户是否已经点赞或者点踩
                
                //展示文章评论和回复(用户的评论后面加上‘我’的标志)
                
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
                    ['emotion','simpleupload'] //,'fullscreen'
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
                        console.log(email)
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
                    }
                }
            })          
        })
    </script>
    @stop