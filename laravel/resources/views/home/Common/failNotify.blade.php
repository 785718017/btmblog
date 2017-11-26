@extends('home.Common.common')
@section('style')
    <style>   
        .success_div{
            width: 1000px;
            height: 600px;
            margin: 0px auto;
            text-align: center;
            background: #FFF;
            font-size: 20px;
            overflow: hidden;
        } 
        .notice_img{
            float: left;
            width: 200px;
            height: 200px;
            margin-top: 150px;
            margin-left: 200px;
        }   
        .notice_info{
            float: left;
            display: inline-block;
            width: 300px;
            height: 200px;
            text-align: center;
            line-height: 200px;
            font-size: 30px;
            color: red;
            margin-top: 150px;
        }   
        .jump_text_area{
            display: inline-block;
            float: left;
            width: 200px;
            height: 200px;
            text-align: left;
            line-height: 200px;
            margin-top: 150px;
        } 
	</style>
    @stop
@section('style_src')
        
    @stop
@section('script_src')
    
    @stop
@section('common_content')
    <div class='success_div'>
        <img src="{{asset('/image/home/failNotify.gif')}}" class='notice_img'/>
        <span class='notice_info'>{{$info}}</span>
        <div class='jump_text_area'>
            <span class='time'>5</span>秒后
            <a href="{{$href}}" class='header_a'>跳转</a>
        </div>
        
    </div>
    @stop
@section('script')
    <script type="text/javascript">
        var href = "{{$href}}";
        var time = parseInt({{$time}});
        $('.time').html(time);
        //倒计时后然后跳转
        setInterval("reduce_time()", 1000);
        function reduce_time(){
            if(time > 0){
                time = time - 1;
                $('.time').html(time);
            }else{
                window.location.href = href;
            }
        }
    </script>
    @stop
