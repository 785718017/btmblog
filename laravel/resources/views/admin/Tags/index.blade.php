@extends('admin.Common.common')
@section('style')
    <style>
		.add_tags_div{
            width: 1200px;
            height: 40px;
            overflow: hidden;
        }
        .add_tags_btn{
            width: 150px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            background: #333;
            color: #FFF;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            float: right;
        }
        
        /*添加标签弹出层样式开始*/
        .add_tags_dialog{
            width: 500px;
            height: 220px;
            margin: 10px auto;
        }
        .add_tags_table{
            width:500px;
            height: 220px;
            border-collapse: collapse;
        }
        .add_tags_table td{
            font-size: 14px;
            color: #382f2f;
        }
        .tag_color{
            padding: 5px 10px;
            color:#FFF;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            border:solid transparent 2px;
        }
        .tag_color.selected{
            border:solid #ff4141 2px;
        }
        .green{
            background-color: #71a532;
        }
        .orange{
            background-color: #ff9900;
        }
        .purple{
            background-color: #8c49ad;
        }
        .pink{
            background-color: #e7769e;
        }
        .coffee{
            background-color: #a98659;
        }
        .blue{
            background-color: #63B6F7;
        }
        .add_tag_name{
            width: 70px;
            height: 60px;
            line-height: 60px;            
            text-align: justify;
            text-justify: distribute-all-lines;
            text-align-last:justify;
            padding-left: 10px;
            padding-right: 20px;
        }
        .add_tag_color{
            width: 70px;
            height: 100px;
            line-height: 100px;
            text-justify: inter-ideograph;
            text-align: justify;
            text-align-last:justify;
            padding-left: 10px;
            padding-right: 20px;
        }
        .add_tag_name_input{
            width: 240px;
            height: 25px;
            font-size: 14px;
            padding-left: 10px;
        }
        .add_tag_father{
            width: 70px;
            height: 60px;
            line-height: 60px;
            text-justify: inter-ideograph;
            text-align: justify;
            text-align-last:justify;
            padding-left: 10px;
            padding-right: 20px;
        }
        .add_tag_father_select{
            width: 150px;
            height: 25px;
            font-size: 14px;
        }
        /*添加标签弹出层样式结束*/
	</style>
    @stop
@section('style_src')
        
    @stop
@section('script_src')
    <script type="text/javascript" src="{{asset('/plugin/layer-v3.1.0/layer/layer.js')}}"></script>
    @stop
@section('common_content')
    {{--添加标签部分--}}
    <div class='add_tags_div'>
        <div class='add_tags_btn'>添加标签</div>
    </div>
    {{--标签列表--}}
    <div class=''>

    </div>
    {{--添加标签的弹出层--}}
    <div class='add_tags_dialog hide'>
        <table class='add_tags_table'>
            <tr>
                <td class='add_tag_name'>标签名</td>
                <td>
                    <input type="text" class='add_tag_name_input'/>
                </td>
            </tr>
            <tr>
                <td class='add_tag_color'>颜色</td>
                <td>
                    <div>
                        <div class='dib tag_color green'>墨绿</div>
                        <div class='dib tag_color orange selected'>橙色</div>
                        <div class='dib tag_color purple'>紫色</div>
                        <div class='dib tag_color pink'>粉色</div>
                        <div class='dib tag_color coffee'>棕色</div>
                        <div class='dib tag_color blue'>天空蓝</div>
                    </div>
                </td>
            </tr>                      
            <tr>
                <td class='add_tag_father'>父级标签</td>
                <td>
                    <select class='add_tag_father_select add_tag_first_father'>
                        <option value="0">顶级标签</option>
                        <option value="1">编程语言</option>
                        
                    </select>
                    <select class='add_tag_father_select add_tag_second_father'>
                        <option value="0">顶级标签</option>
                        <option value="1">php</option>
                        
                    </select>
                </td>
            </tr>
        </table>
    </div>   
    @stop
@section('script')
        <script type='text/javascript'>
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
