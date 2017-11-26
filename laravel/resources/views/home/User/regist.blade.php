@extends('home.Common.common')
@section('style')
    <style>    
        .regist_div{
            width: 1030px;
            margin: 0px auto;
            background: white;
            padding-bottom: 20px;
            min-height: 580px;
        }
        .regist_table{
            width: 600px;
            margin: 0px auto;
            padding-top: 70px;
        }
        .regist_table td{
            height: 60px;
            line-height: 60px;
        }
        .regist_table .tr_title{
            display: inline-block;
            width: 140px;
            text-align: right;
            font-size: 16px;
            padding-right: 20px;
        }
        .regist_table input{
            width: 200px;
            height: 35px;
            line-height: 35px;
            padding-left: 20px;
            font-size: 16px;
            border-radius: 5px;
            border: solid #ccc 1px;
        }
        .notice_td{
            width: 240px;
            font-size: 12px;
            color: red;
        }
        .regist_btn{
            width: 120px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 5px;
            color: #FFF;
            background-color: #ccc;
            margin-left: 240px;
            background: #eab41a;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .green_check{
            background-image: url("{{asset('/image/home/green_check.jpg')}}");
            background-size: 30px 30px;
            width: 30px;
            height: 30px;
        }

        .email_notice{
            font-size: 12px;
            color: red;
        }
	</style>
    @stop
@section('style_src')
        
    @stop
@section('script_src')
    <script type="text/javascript" src="{{asset('/plugin/layer-v3.1.0/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/plugin/handlebars-v3.0.3.min.js')}}"></script>
    @stop
@section('common_content')
    <div class='regist_div'>
        <table class='regist_table'>
            <tr>
                <td><span class='tr_title'>用户名：</span></td>
                <td><input type="text" class='user_name' placeholder="必填"></td>
                <td class='notice_td'></td>
            </tr>
            <tr>
                <td><span class='tr_title'>密码：</span></td>
                <td><input type="password" class='password' placeholder="必填"></td>
                <td class='notice_td'></td>
            </tr>
            <tr>
                <td><span class='tr_title'>确认密码：</span></td>
                <td><input type="password" class='rewrite_password' placeholder="必填"></td>
                <td class='notice_td'></td>
            </tr>
            <tr>
                <td><span class='tr_title'>昵称：</span></td>
                <td><input type="text" class='nick_name' placeholder="必填"></td>
                <td class='notice_td'></td>
            </tr>
            <tr>
                <td><span class='tr_title'>默认邮箱：</span></td>
                <td><input type="text" class='email' placeholder="可不填"></td>
                <td class='notice_td'></td>
            </tr>
            <tr>
                <td></td>
                <td class='email_notice' colspan="2">（邮箱可不填写）仅支持qq邮箱、126邮箱、163邮箱、新浪邮箱和gmail</td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class='regist_btn dib'>注册</span>
                </td>
            </tr>
        </table>

    </div>
    @stop
@section('script')
    <script type="text/javascript">
        //初始化各个输入框（设置值为空）
        $('input').each(function(i,obj){
            $(obj).val('');
        });

        $('body').onEvent({
            'click' : {
                '.regist_btn' : function(){
                    //如果有错误提示，则展示最上面的错误提示
                    if($('.error_span').length > 0){
                        var error_content = $('.error_span').eq(0).attr('error_content');                       
                        layer.msg(error_content);
                        return false;
                    }

                    //如果没有错误提示，则判断前面5个框是否为空
                    var user_name = $('.user_name').val();
                    var password = $('.password').val();
                    var rewrite_password = $('.rewrite_password').val();
                    var nick_name = $('.nick_name').val();
                    var email = $('.email').val();

                    if(user_name == ''){
                        layer.msg('用户名不能为空');
                        return false;
                    }

                    if(password == ''){
                        layer.msg('密码不能为空');
                        return false;
                    }

                    if(rewrite_password == ''){
                        layer.msg('确认密码不能为空');
                        return false;
                    }

                    if(nick_name == ''){
                        layer.msg('昵称不能为空');
                        return false;
                    }
                    var param = {
                        user_name : user_name,
                        password : hex_md5(password),
                        nick_name : nick_name,
                        email : email
                    };

                    $.post('/User/registUser', param, function(data){
                        if(data.status){
                            params = data.info;
                            window.location.href = 'http://www.btmblog.com/successNotify/'+params.info+'/'+params.time;
                        }else{
                            if(data.info.if_jump){
                                window.location.href = 'http://www.btmblog.com/failNotify/'+data.info.info+'/'+data.info.time;
                            }else{
                                layer.msg(data.info);
                            }
                        }
                    })
                }
            },
            'blur' : {
                '.user_name' : function(){
                    $(this).removeClass('effective');
                    var user_name = $(this).val();
                    //验证用户名是否为空
                    if(user_name == ''){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（用户名不能为空）">（用户名不能为空）</span>');
                        return false;
                    }
                    //验证用户名是否符合规则--以数字和英文组成的字符串，不低于6位，不高于30位
                    var pattern = /^[a-zA-Z0-9]{6,30}$/;
                    // var patt = new RegExp(pattern);
                    if(!pattern.exec(user_name)){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（6到30位的数字、字母！）">（6到30位的数字、字母！）</span>');
                        return false;
                    }
                    //验证用户名是否已被使用
                    $.post('/User/checkUserName', {user_name : user_name}, function(data){
                        if(data.status){                            
                            //如果符合条件，则提示区域为绿色的勾
                            $('.user_name').addClass('effective');
                            $('.user_name').closest('tr').find('.notice_td').html("<div class='green_check'></div>");
                        }else{
                            if(data.info.if_jump){
                                window.location.href = 'http://www.btmblog.com/failNotify/'+data.info.info+'/'+data.info.time;
                            }else{
                            //已存在
                                $('.user_name').closest('tr').find('.notice_td').html('<span class="error_span" error_content="（该用户名已被使用！）">（该用户名已被使用！）</span>');
                            }
                        }
                    })
                    
                },
                '.password' : function(){
                    $(this).removeClass('effective');
                    var password = $(this).val();
                    //验证密码是否为空
                    if(password == ''){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（密码不能为空）">（密码不能为空）</span>');
                        return false;
                    }
                    //验证密码是否符合规则--以数字、字母和下划线组成的字符串，不低于6位，不高于30位
                    var pattern = /^[a-zA-Z0-9_]{6,30}$/;
                    // var patt = new RegExp(pattern);
                    if(!pattern.exec(password)){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（6到30位的数字、字母、下划线！）">（6到30位的数字、字母、下划线！）</span>');
                        return false;
                    }
                    //如果符合条件，则提示区域为绿色的勾
                    $(this).addClass('effective');
                    $(this).closest('tr').find('.notice_td').html("<div class='green_check'></div>");
                },
                '.rewrite_password' : function(){
                    $(this).removeClass('effective');
                    var rewrite_password = $(this).val();
                    var password = $('.password').val();
                    if(rewrite_password != password){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（两次输入的密码不一致！）">（两次输入的密码不一致！）</span>');
                        return false;
                    }
                    //如果符合条件，则提示区域为绿色的勾
                    $(this).closest('tr').find('.notice_td').html("<div class='green_check'></div>");
                },
                '.nick_name' : function(){  
                    $(this).removeClass('effective');                 
                    var nick_name = $(this).val();
                    if(nick_name == ''){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（昵称不能为空！）">（昵称不能为空！）</span>');
                        return false;
                    }
                    //验证昵称是否符合条件--1-30位的数字字母下划线中文丶~
                    var pattern = /^[a-zA-Z0-9_丶~\u4e00-\u9fa5]{1,30}$/;
                    // var patt = new RegExp(pattern);
                    if(!pattern.exec(nick_name)){
                        $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（昵称不能超过30位字符！）">（昵称不能超过30位字符！）</span>');
                        return false;
                    }
                    //如果符合条件，则提示区域为绿色的勾
                    $(this).addClass('effective');
                    $(this).closest('tr').find('.notice_td').html("<div class='green_check'></div>");
                },
                '.email' : function(){
                    $(this).removeClass('effective');
                    var email = $(this).val();
                    if(email != ''){
                        //仅支持qq邮箱、126邮箱、163邮箱、新浪邮箱和gmail
                        var pattern = /^([a-zA-Z0-9])+@(qq\.com)|(163\.com)|(126\.com)|(sina\.com)|(sina\.cn)|(gmail\.com)$/;
                        // var patt = new RegExp(pattern);
                        if(!pattern.exec(email)){
                            $(this).closest('tr').find('.notice_td').html('<span class="error_span" error_content="（邮箱格式不正确！）">（邮箱格式不正确！）</span>');
                            return false;
                        }
                        //如果符合条件，则提示区域为绿色的勾
                        $(this).addClass('effective');
                        $(this).closest('tr').find('.notice_td').html("<div class='green_check'></div>");
                        return false;
                    } 
                    $(this).closest('tr').find('.notice_td').html("");              
                }
            }
        })
    </script>
    @stop
