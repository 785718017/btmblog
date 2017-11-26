@extends('home.Common.common')
@section('style')
    <style>    
        .about_me_div{
            width: 1030px;
            margin: 0px auto;
        }
        .about_content{
            width: 970px;
            margin: 0px auto;
            text-indent: 2em;
            padding-bottom: 20px;
        }
        .about_title{
            width: 170px;
            height: 50px;
            line-height: 50px;
            background: #5fcdea;
            color: #eeeeee;
            font-size: 24px;
            font-weight: bold;
            padding-left: 30px;
            border-top-right-radius: 25px; 
            border-bottom-right-radius: 25px; 
        }
        .about_me_div{
            background: white;
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
    <div class='about_me_div'>
        <!-- 印象集合 -->
        <!-- <img src="{{asset('/image/home/headimg.jpg')}}"> -->
        <!-- 文字简介 -->
        <div class='about_title'>关于我</div>
        <div class='about_content'>
            <br/>
            <p>
                半透明，男，90后码农。
            </p>
            <br/>
            <p>
                毕业于江苏省某财经高校的广告专业，然未从事此行，先于15年求得一份手游策划职位，成为了开发部门中的一员（类似于产品经理）。踉跄一载，迷惘潦倒，且在策划岗位上未有建树，遂重寻出路。
            </p>
            <br/>
            <p>
                16年春，开始了解编程，决心转行web开发，自学基础知识。16年夏，递交辞呈，参加培训，全心学习编程。从php入手，学习了很多web开发技术，并尝试和同学合作，写一个完整的小项目。培训结束后，如意觅得一份开发工作，正式开始成为码农中的一员。
            </p>
            <br/>
            <p>
                半路出家者，深知自己落后于人，须笃志而力行，遂创此博客。一为记录所学所感，方便有些时候能快速找到；二为分享一些有趣的事物，为平淡的生活增添一丝色彩。愿生活不辜负每个人的努力。
            </p> 
            <br/>
            <br/>
        </div>
        <!-- 联系方式 -->
        <!-- 邮箱 -->
        <!-- 微信公众号 -->
        <!-- 博客介绍 -->
        <div class='about_title'>关于博客</div>
        <div class='about_content'>
            <br/>
            <div>域名：wwww.btmblog.com</div>
            <div>服务器：linux</div>
            <div>框架：laravel 5.5</div>
        </div>
        

    </div>
    @stop
@section('script')

    @stop
