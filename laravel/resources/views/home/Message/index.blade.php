@extends('home.Common.common')
@section('style')
    <style>    
        .home_main_content{
            width: 1100px;
            margin: 0px auto;
            min-height: 500px;
            padding-top: 20px;
            padding-bottom: 100px;
            overflow: hidden;
        }
        .user_input_message_div{
            margin-top: 20px;
            overflow: hidden;
        }
        .message_all_div{
            width: 1000px;
            margin: 0px auto;
            min-height: 300px;
            border-radius: 10px;
            background-color: #FFF;
            border:solid #FFF 1px;
        }
        .login_btn{
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            text-align: center;
            background-color: #f6ce5b;
            font-weight: bold;
            font-size: 20px;
            color: #FFF;
            border-radius: 40px;
            cursor: pointer;
            margin-right: 30px;
            margin-top: 10px;
        }
        .user_info_area_btn{
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            text-align: center;
            background-color: #f6ce5b;
            font-weight: bold;
            font-size: 20px;
            color: #FFF;
            border-radius: 40px;
            border: solid #ccc 1px;
            cursor: pointer;
            margin-left: 30px;
            margin-right: 30px;
            margin-top: 10px;
            background-size: 80px 80px;
        }
        .user_info_div{
            float: left;
            width: 142px;
            text-align: center;
        }
        .input_message_div{
            float: left;
            border: solid #ccc 1px;
            overflow: hidden;
            border-radius: 5px;
        }
        .user_email {
            width: 550px;
            height: 25px;
            margin-left: 3px;
            margin-top: 3px;
            padding-left: 10px;
        }
        .add_message_btn {
            width: 200px;
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

        /*留言样式开始*/
        .message_list{
            width: 800px;
            margin: 0px auto;
            border-top: dashed #ccc 1px;
            margin-top: 30px;
        }
        .message_div{
            overflow: hidden;
            border-bottom: dashed #ccc 1px;
            padding-bottom: 10px;
        }
        .message_user_info{
            float: left;
            width: 120px;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666666;
        }
        .message_user_head{
            width: 60px;
            height: 60px;
            border-radius: 30px;
            background-size: 60px 60px;
            margin:0px auto;           
            border:solid 1px #ccc;
        }
        .message_right_div{
            float: left;
        }
        .message_content{
            width: 660px;
            margin-top: 20px;
            min-height: 80px;
        }
        .oprs{
            width: 660px;
            font-size: 12px;
            color: #666666;
            text-align: right;
            margin-bottom: 10px;
        }
        .reply_btn{
            margin-left: 10px;
            color: #2698d7;
            cursor: pointer;
        }
        /*留言样式结束*/

        /*回复框样式开始*/
        .reply_show_area{
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 26px;
            margin-bottom: 10px;
            border: solid #ccc 1px;
            border-radius: 5px;
        }
        .reply_user_email{
            width: 430px;
            height: 16px;
            padding-left: 10px;
            padding-right: 10px;
            margin-left: 5px;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .reply_message_btn{
            display: inline-block;
            width: 115px;
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
            width: 115px;
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

        /*回复样式开始*/
        .reply_user_info_content{
            overflow: hidden;
        }
        .message_reply{
            padding-bottom: 10px;
            border-top: solid 1px #ccc;
            background: #f5f5f5;
        }
        .reply_user_info{
            width: 60px;
            margin-left: 10px;
            overflow: hidden;
            float: left;
        }
        .reply_user_head{
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 25px;
            border: solid #ccc 1px;
            float: left;
            margin-top: 10px;
            margin-left: 5px;
            background-size: 50px 50px;
        }
        .reply_user_name_div{
            display: inline-block;
            float: left;
            font-size: 12px;
        }
        .reply_for_and_content_div{
            float: left;
            margin-left: 5px;
        }
        .reply_user_name{
            width: 60px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #666666;
        }
        .reply_for_user_name{
            width: 300px;
            margin-left: 10px;
            margin-top: 10px;
            padding-bottom: 5px;
            font-size: 12px;
            color: #666666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .reply_content{
            width: 570px;
            margin-left: 10px;
            padding-bottom: 5px;
        }
        .reply_time_div{
            margin-right: 15px;
            margin-top: 30px;
            overflow: hidden;
        }
        .reply_time_agree{
            text-align: right;
            margin-right: 20px;
        }
        .reply_time{
            display: inline-block;
            font-size: 12px;
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
        .show_more_message_btn{
            width: 800px;
            background-color: #eaeaea;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5px;
            margin: 0px auto;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
            cursor: pointer;
        }
        .no_more_message_btn{
            width: 800px;
            background-color: #eaeaea;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5px;
            margin: 0px auto;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
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
    <div class='home_main_content'>
        <div class='message_all_div'>
            <!-- 装饰部分 -->
            <div class='connect_me_div'>
                
            </div>
            <!-- 留言输入框 -->
            <div class='user_input_message_div'>
                <div class='user_info_div dib'>
                    @if (session("uid") != null)
                    <span class='user_info_area_btn'
                        @if (session('head') == 0)
                            style="background-image: url({{asset('/image/home/default_head.jpg')}});"
                        @else
                            style="background-image: url({{asset('/image/home/headimg.jpg')}});"
                        @endif 
                    >
                    </span>
                    <span>{{session('nick_name')}}</span>
                    @else
                    <span class='login_btn'>登录</span>
                    @endif
                </div>
                <div class='input_message_div dib'>
                    <div>
                        <script id="message_editor" type="text/plain"> </script>
                    </div>
                    <div>
                        <span><input type="text" class='user_email' placeholder="接收回复的email地址" /></span>
                        <span class='add_message_btn dib'>留言</span>
                    </div>                   
                </div>
            </div>
            <!-- 留言展示部分 -->
            <div class='message_list'>
                
            </div>
            <!-- 留言加载更多的点击栏 -->
            <div class='show_more_message_div'>
                
            </div>
        </div>       
    </div>
    @stop
@section('script')
    @verbatim
    <script  id="message_list" type="text/x-handlebars-template">
        {{#each this}}
            <div class='message_div'>
                <div class='message_user_info dib'>
                    <div class='message_user_head' 
                        {{#eq user_head 0}}
                            style="background-image: url('http://www.btmblog.com/image/home/default_head.jpg');"
                        {{else}}
                            style="background-image: url('http://www.btmblog.com/image/home/head_img.jpg');"
                        {{/eq}}
                    ></div>
                    <div class='message_user_name_agree'>
                        <span class='message_user_name dib' title="{{user_name}}">{{user_name}}</span>
                    </div>                                     
                </div>
                <div class='message_right_div'>
                    <div class='message_content_div dib' message_id="{{id}}">
                        <div class='message_content'>{{{content}}}</div>
                        <div class='oprs'>  
                            <span class='message_time'>{{publish_time}}</span>
                            <span class='reply_btn' message_id='{{id}}' user_id='{{user_id}}' user_name='{{user_name}}'>回复</span>
                        </div>              
                        <div class='message_replys'>
                            {{#each replys}}
                                <div class='message_reply'>
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
                                                <span class='reply_user_name dib' title="{{user_name}}">{{user_name}}</span>
                                            </div>                           
                                        </div>
                                        <div class='reply_for_and_content_div'>
                                            <div class='reply_for_user_name' title='{{reply_for_user_name}}'>回复：{{reply_for_user_name}}</div>
                                            <div class='reply_content'>{{{content}}}</div>
                                        </div>
                                    </div>
                                    <div class='reply_time_agree'>
                                        <span class='reply_time'>{{publish_time}}</span>
                                        <span class='reply_btn reply_for_reply' reply_id='{{id}}' message_id='{{message_id}}' user_id='{{user_id}}' user_name='{{user_name}}'>回复</span>
                                    </div>
                                </div>
                            {{/each}}
                        </div>
                        <!-- <span>删除</span> -->
                    </div>
                </div>                
            </div>
        {{/each}}
    </script>
    @endverbatim
    <script type="text/javascript">
        $(function(){
            //实例化编辑器
            var ue = UE.getEditor( 'message_editor',{
                autoHeightEnabled: false,
                initialFrameWidth: 800,
                initialFrameHeight:200,
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

            //获取最近的10条留言
            var last_id = null;
            $.post('Message/getMoreMessage', {last_id:last_id}, function(data){
                if(data.status){
                    $('.message_list').html($('#message_list').template(data.info.messages));
                    if(data.info.is_end){
                        $('.show_more_message_div').html("<div class='no_more_message_btn'>没有更多留言了~</div>");
                    }else{
                        $('.show_more_message_div').html("<div class='show_more_message_btn'>查看更多...</div>");
                    }
                    last_id = data.info.last_id;
                }else{
                    $('.show_more_message_div').html("");
                    layer.msg('获取留言失败！');
                }
                
            })


            $('body').onEvent({
                'click' : {
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
                                offset: ['100px', '110px'],
                                content: $('.user_info_box')
                            })
                        }                       
                    },
                    '.add_message_btn' : function(){
                        //获取评论的内容
                        var message = ue.getContent();
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
                        var params = {
                            message : message,
                            email : email
                        }
                        //提交评论
                        $.post('/Message/addMessage', params, function(data){
                            if(data.status){
                                //重置留言输入框的内容
                                ue.setContent('');
                                //将用户添加的留言放在评论列表中的第一条
                                var data = data.info;

                                layer.msg('评论成功！');

                            }else{
                                layer.msg(data.info);
                            }
                        })
                    },
                    '.reply_btn' : function(){
                        var user_id = $(this).attr('user_id');
                        var message_id = $(this).attr('message_id');
                        var user_name = $(this).attr('user_name');

                        //检测当前评论下是否有回复框，如果有，不做任何处理
                        if($(this).closest('.message_right_div').find('.reply_show_area').length > 0){
                            //销毁编辑器
                            UE.getEditor('reply_editor').destroy();
                            $('.message_right_div .reply_show_area').remove();
                        }

                        //检测其它评论下是否有回复框，如果有，则关掉其它回复框
                        if($('.message_right_div .reply_show_area').length > 0){
                            //销毁编辑器
                            UE.getEditor('reply_editor').destroy();
                            $('.message_right_div .reply_show_area').remove();
                        }
                        if($(this).hasClass('reply_for_reply')){
                            var str = "<div class='hide reply_show_area'><div class='reply_area'><script id='reply_editor' type='text/plain'><\/script><\/div><div><span><input type='text' class='reply_user_email' placeholder='接收回复的email地址' \/><\/span><span class='reply_reply_btn dib' user_id='"+user_id+"' message_id='"+message_id+"'>回复<\/span><\/div><\/div>";
                        }else{
                            var str = "<div class='hide reply_show_area'><div class='reply_area'><script id='reply_editor' type='text/plain'><\/script><\/div><div><span><input type='text' class='reply_user_email' placeholder='接收回复的email地址' \/><\/span><span class='reply_message_btn dib' user_id='"+user_id+"' message_id='"+message_id+"'>回复<\/span><\/div><\/div>";
                        }
                        
                        $(this).closest('.message_right_div').append(str);
                        $('.reply_show_area').removeClass('hide');
                        //实例化编辑器
                        reply_ue = UE.getEditor('reply_editor',{
                            autoHeightEnabled: false,
                            initialFrameWidth: 600,
                            initialFrameHeight:150,
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
                    '.show_more_message_btn' : function(){
                        $.post('Message/getMoreMessage', {last_id:last_id}, function(data){
                            if(data.status){
                                $('.message_list').append($('#message_list').template(data.info.messages));
                                if(data.info.is_end){
                                    $('.show_more_message_div').html("<div class='no_more_message_btn'>没有更多留言了~</div>");
                                }else{
                                    $('.show_more_message_div').html("<div class='show_more_message_btn'>查看更多...</div>");
                                }
                                last_id = data.info.last_id;
                            }else{
                                $('.show_more_message_div').html("");
                                layer.msg('获取留言失败！');
                            }                            
                        })
                    },
                    '.reply_message_btn' :  function(){
                        var reply_content = reply_ue.getContent();
                        var reply_email = $('.reply_user_email').val();
                        var message_id = $(this).attr('message_id');
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
                            message_id : message_id,
                            reply_for_uid : reply_for_uid
                        };
                        $.post('/Message/replyForMessage', params, function(data){
                            if(data.status){
                                data = data.info;
                                //销毁编辑器
                                UE.getEditor('reply_editor').destroy();
                                $('.message_right_div .reply_show_area').remove();

                                //在这条留言的最后加上回复的内容
                                var str = "<div class='message_reply'><div class='reply_user_info_content'><div class='reply_user_info'><span class='reply_user_head' style=\"background-image: url('http://www.btmblog.com/image/"+data.head+".jpg');\"></span><div class='reply_user_name_div'><span class='reply_user_name dib' title='"+data.user_name+"'>"+data.user_name+"</span></div></div><div class='reply_for_and_content_div'><div class='reply_for_user_name' title='"+data.reply_for_user_name+"'>回复："+data.reply_for_user_name+"</div><div class='reply_content'>"+data.content+"</div></div></div><div class='reply_time_agree'><span class='reply_time'>"+data.publish_time+"</span> <span class='reply_btn reply_for_reply' reply_id='"+data.id+"' message_id='"+data.message_id+"' user_id='"+data.user_id+"' user_name='"+data.user_name+"'>回复</span></div></div>";


                                $('.message_content_div[message_id='+data.message_id+']').find('.message_replys').append(str);
                                layer.msg('评论成功！');
                            }else{
                                layer.msg(data.info);
                            }
                        })
                    },
                    '.reply_reply_btn' : function(){
                        var reply_content = reply_ue.getContent();
                        var reply_email = $('.reply_user_email').val();
                        var message_id = $(this).attr('message_id');
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
                            message_id : message_id,
                            reply_for_uid : reply_for_uid
                        };
                        $.post('/Message/replyForReply', params, function(data){
                            if(data.status){
                                data = data.info;
                                //销毁编辑器
                                UE.getEditor('reply_editor').destroy();
                                $('.message_right_div .reply_show_area').remove();
                                
                                // 在这条评论的最后加上回复的内容
                                var str = "<div class='message_reply'><div class='reply_user_info_content'><div class='reply_user_info'><span class='reply_user_head' style=\"background-image: url('http://www.btmblog.com/image/"+data.head+".jpg');\"></span><div class='reply_user_name_div'><span class='reply_user_name dib' title='"+data.user_name+"'>"+data.user_name+"</span></div></div><div class='reply_for_and_content_div'><div class='reply_for_user_name' title='"+data.reply_for_user_name+"'>回复："+data.reply_for_user_name+"</div><div class='reply_content'>"+data.content+"</div></div></div><div class='reply_time_agree'><span class='reply_time'>"+data.publish_time+"</span> <span class='reply_btn reply_for_reply' reply_id='"+data.id+"' message_id='"+data.message_id+"' user_id='"+data.user_id+"' user_name='"+data.user_name+"'>回复</span></div></div>";


                                $('.message_content_div[message_id='+data.message_id+']').find('.message_replys').append(str);
                                layer.msg('评论成功！');
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