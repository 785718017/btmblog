<!DOCTYPE html>
<html>
    <head>
        <title>半透明的博客-{{$page_title}}</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{asset('/css/Admin/Common.css')}}">
        <style type="text/css">
            *{               
                margin: 0px;
                padding: 0px;
            }
            body{
                font-family: "Microsoft Yahei","Hiragino Sans GB","Helvetica Neue","WenQuanYi Micro Hei","\5B8B\4F53";
            }
        </style>
        @section('style')

            @show
        @section('style_src')

            @show
        <script type="text/javascript" src="{{asset('/js/jquery-1.8.3.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('/js/common.js')}}"></script>
        @section('script_src')

            @show
    </head>
    <body>
        {{--公共顶部--}}
        <div class='common_top'>
            {{--引入顶部文件--}}
            @include('admin/Common/top')
        </div>
        <div class='common_body'>
            {{--公共侧边栏--}}
            <div class='common_sidebar'>
                @include('admin/Common/sidebar')
            </div>
            {{--内容区域--}}
            <div class='common_content'>
                <div class='common_show_content'>
                    @section('common_content')
                        
                    @show
                </div>
            </div>
        </div>
    </body>
    @section('script')

        @show
</html>
