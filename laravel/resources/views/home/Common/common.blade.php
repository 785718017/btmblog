<!DOCTYPE html>
<html>
    <head>
        <title>{{$page_title}}-半透明的博客</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/x-icon" href="{{asset('/image/little_icon.png')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/css/Home/common.css')}}" />
        <style type="text/css">
            *{               
                margin: 0px;
                padding: 0px;
            }
            body{
                font-family: "Microsoft Yahei","Hiragino Sans GB","Helvetica Neue","WenQuanYi Micro Hei","\5B8B\4F53";
            }

            /*用户个人信息弹出框开始*/
            .user_info_box_id{
                overflow: hidden;
            }
            .user_info_box .user_head{
                display: inline-block;
                width: 70px;
                height: 70px;
                background-color: #f6ce5b;
                font-weight: bold;
                font-size: 14px;
                color: #FFF;
                border-radius: 35px;
                border: solid #ccc 1px;
                float: left;
                margin-left: 15px;
                margin-top: 15px;
                background-size: 70px 70px;
            }
            .user_name_history_reply{
                display: inline-block;
                width: 142px;
                height: 70px;
                float: right;
                margin-right: 15px;
                margin-top: 15px;
                overflow: hidden;
            }
            .user_nick_name{
                display: inline-block;
                width: 142px;
                height: 30px;
                line-height: 30px;
                font-size: 14px;
                overflow: hidden;
                text-overflow:ellipsis;
                white-space: nowrap;
                color: #666666;
                float: left;
            }
            .user_profile{
                display: inline-block;
                width: 100px;
                text-align: center;
                height: 30px;
                line-height: 30px;
                text-decoration: none;
                margin-top: 20px;
                margin-left: 15px;
                background: #f5ce5f;
                color: #FFF;
                border-radius: 10px;
                cursor: pointer;
            }

            .login_out_btn{
                display: inline-block;
                width: 100px;
                text-align: center;
                height: 30px;
                line-height: 30px;
                background: #ccc;
                color: #FFF;
                border-radius: 10px;
                cursor: pointer;
                margin-left: 10px;
            }
            .view_history_a,.my_reply_a{
                display: inline-block;
                width: 142px;
                height: 20px;
                line-height: 20px;
                font-size: 10px;
                overflow: hidden;
                text-overflow:ellipsis;
                white-space: nowrap;
                color: #666666;
                float: left;
                text-decoration: none;
            }
            /*用户个人信息弹出框结束*/
        </style>
        @section('style')

            @show
        @section('style_src')

            @show
        <script type="text/javascript" src="{{asset('/js/jquery-1.8.3.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/js/common.js')}}"></script>
        <script type="text/javascript" src="{{asset('/js/md5.js')}}"></script>
        <script type="text/javascript" src="{{asset('/plugin/layer-v3.1.0/layer/layer.js')}}"></script>
        <script type="text/javascript" src="{{asset('/plugin/handlebars-v3.0.3.min.js')}}"></script>
        @section('script_src')

            @show
    </head>
    <body>
        {{--公共顶部--}}
        <div class='common_top'>
            {{--引入顶部文件--}}
            @include('home/Common/top')
        </div>
        <div class='common_body'>
            <div class='background'>
            {{--内容区域--}}
            @section('common_content')
                              
            @show
            </div>
        </div>
        <div class='common_bottom'>
            @include('home/Common/bottom')
        </div>
        <!-- 公共登录弹窗 -->
        <div class='commen_login_div hide'>
            <!-- 账号密码登录-暂时先用，等有了微信登陆之后，去掉这个功能，或者改为微信的账号密码登录 -->
            <div class='login_by_input'>
                <div class="login_user_name_div">
                    <span >用户名：</span>
                    <input type="text" class='user_name' />
                </div>
                <div class="login_user_password_div">
                    <span>密&nbsp;&nbsp;&nbsp;码：</span>
                    <input type="password" class='password' />
                </div>
                <div>
                    <span class='common_login_btn'>登录</span>
                </div>
                <div class='no_account_regist_div'>
                    <span>没有账号？<a href='/regist' target="_blank">注册</a></span>
                </div>
            </div>
            <!-- 微信扫码登录 -->
            <div class='login_by_wx hide'>
                <!-- 放二维码的div -->
                <div>
                    
                </div>
            </div>

            <div class='change_login_method'>
                <span class='change_method_wx'>微信登录</span>
                <span class='change_method_wb'>微博登录</span>
            </div>
        </div>

        <!-- 公共个人信息展示窗 -->
        <div class='user_info_box hide'>
            <div class='user_info_box_id' user_id="{{session('uid')}}">
                <!-- 头像 -->
                <span class='user_head'
                    @if (session('head') == 0)
                        style="background-image: url({{asset('/image/home/default_head.jpg')}});"
                    @else
                        style="background-image: url({{asset('/image/home/headimg.jpg')}});"
                    @endif 
                ></span>
                  
                <div class='user_name_history_reply'>
                    <!-- 昵称 -->
                    <span class='user_nick_name' title="{{session('nick_name')}}">{{session('nick_name')}}</span> 
                    <!-- 浏览历史 -->
                    <a class='view_history_a' href='/User/viewHistory' target="_blank">阅读历史：12345</a>
                    <!-- 查看回复 -->
                    <a class='my_reply_a' href="/User/replyRecord" target="_blank">收到回复：123</a>
                </div>
                            
            </div>
            <div>
                <a href="/User/profile" class='user_profile' target="_blank">个人中心</a>
                <span class='login_out_btn'>注销</span>
            </div>
        </div>
    </body>
    @section('script')

        @show
</html>
