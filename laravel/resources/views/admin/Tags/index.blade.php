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
            margin-top:10px;
            border-radius: 5px;
        }
        
        /*添加标签弹出层样式开始*/
        .add_tags_dialog,.change_tags_dialog{
            width: 500px;
            height: 220px;
            margin: 10px auto;
        }
        .add_tags_table,.change_tags_table{
            width:500px;
            height: 220px;
            border-collapse: collapse;
        }
        .add_tags_table td,.change_tags_table td{
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
        .add_tag_name,.change_tag_name{
            width: 70px;
            height: 60px;
            line-height: 60px;            
            text-align: justify;
            text-justify: distribute-all-lines;
            text-align-last:justify;
            padding-left: 10px;
            padding-right: 20px;
        }
        .add_tag_color,.change_tag_color{
            width: 70px;
            height: 100px;
            line-height: 100px;
            text-justify: inter-ideograph;
            text-align: justify;
            text-align-last:justify;
            padding-left: 10px;
            padding-right: 20px;
        }
        .add_tag_name_input,.change_tag_name_input{
            width: 240px;
            height: 25px;
            font-size: 14px;
            padding-left: 10px;
        }
        .add_tag_father,.change_tag_father{
            width: 70px;
            height: 60px;
            line-height: 60px;
            text-justify: inter-ideograph;
            text-align: justify;
            text-align-last:justify;
            padding-left: 10px;
            padding-right: 20px;
        }
        .add_tag_father_select,.change_tag_father_select{
            width: 150px;
            height: 25px;
            font-size: 14px;
        }
        /*添加标签弹出层样式结束*/
        .tags_table{
            width: 1200px;
            border-collapse: collapse;  
            margin:10px auto;                              
        }
        .tags_table td{
            border:solid #ccc 1px;
        }

        .first_level_tags{
            width: 150px;
            text-align: center;
        }
        .second_level_tags{
            width: 200px;
            text-align: center;
        }
        .tag{
            margin-bottom: 0px;
        }
        .change_tag,.ban_tag{
            font-size: 12px;
            cursor: pointer;            
            margin-bottom: 10px;
        }
        .ban_tag{
            margin-left: 10px;
        }
        .third_single_tag{
            width: 100px;
            display: inline-block;
        }
        .third_single_tag .change_tag{
            margin-left: 10px;
        }
        .single_tag .tag.ban{
            background-color: #CCC;
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
    {{--添加标签部分--}}
    <div class='add_tags_div'>
        <div class='add_tags_btn'>添加标签</div>
    </div>
    {{--标签列表--}}
    <div class='tags_show'>

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
                        <div class='dib tag_color green' color-data="1">墨绿</div>
                        <div class='dib tag_color orange selected' color-data="2">橙色</div>
                        <div class='dib tag_color purple' color-data="3">紫色</div>
                        <div class='dib tag_color pink' color-data="4">粉色</div>
                        <div class='dib tag_color coffee' color-data="5">棕色</div>
                        <div class='dib tag_color blue' color-data="6">天空蓝</div>
                    </div>
                </td>
            </tr>                      
            <tr>
                <td class='add_tag_father'>父级标签</td>
                <td>
                    <select class='add_tag_father_select add_tag_first_father'>
                        <option value="0">顶级标签</option> 
                    </select>
                    <select class='add_tag_father_select add_tag_second_father'>
                        <option value="0">二级标签</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>   

    {{--修改标签的弹出层--}}
    <div class='change_tags_dialog hide'>
        <table class='change_tags_table' tag_id=''>
            <tr>
                <td class='change_tag_name'>标签名</td>
                <td>
                    <input type="text" class='change_tag_name_input'/>
                </td>
            </tr>
            <tr>
                <td class='change_tag_color'>颜色</td>
                <td>
                    <div>
                        <div class='dib tag_color green' color-data="1">墨绿</div>
                        <div class='dib tag_color orange' color-data="2">橙色</div>
                        <div class='dib tag_color purple' color-data="3">紫色</div>
                        <div class='dib tag_color pink' color-data="4">粉色</div>
                        <div class='dib tag_color coffee' color-data="5">棕色</div>
                        <div class='dib tag_color blue' color-data="6">天空蓝</div>
                    </div>
                </td>
            </tr>                      
            <tr>
                <td class='change_tag_father'>父级标签</td>
                <td>
                    <select class='change_tag_father_select change_tag_first_father'>
                        <option value="0">顶级标签</option> 
                    </select>
                    <select class='change_tag_father_select change_tag_second_father'>
                        <option value="0">二级标签</option>
                    </select>
                </td>
            </tr>
        </table>
    </div> 
    @stop
@section('script')
        @verbatim
            <script id="show_tags" type="text/x-handlebars-template">
                <table class='tags_table'>
                    {{#each this}}
                        {{#eq child_num 0}}                       
                            <tr>
                                <td class='first_level_tags'><div class='single_tag'><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div><div><span class='change_tag'>修改</span><span class='ban_tag'>{{#eq status 1}}禁用{{else}}恢复{{/eq}}</span></div></div></td>
                                <td class='second_level_tags'></td>
                                <td class='third_level_tags'>
                                   
                                </td>
                            </tr>
                        {{else}}
                            {{#each child}}
                                {{#eq @index 0}}                
                                <tr>
                                    <td class='first_level_tags'  rowspan="{{../../child_num}}"><div class='single_tag'><div class='tag color_{{../../color}} {{#eq ../../status 0}}ban{{/eq}}' data_id='{{../../id}}'>{{../../name}}</div><div><span class='change_tag'>修改</span><span class='ban_tag'>{{#eq ../../status 1}}禁用{{else}}恢复{{/eq}}</span></div></div></td>
                                    <td class='second_level_tags'><div class='single_tag'><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div><div><span class='change_tag'>修改</span><span class='ban_tag'>{{#eq status 1}}禁用{{else}}恢复{{/eq}}</span></div></div></td>
                                    <td class='third_level_tags'>
                                        {{#each child}}
                                            <div class='single_tag third_single_tag'><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div>
                                            <div>
                                                <span class='change_tag'>修改</span>
                                                <span class='ban_tag'>
                                                    {{#eq status 1}}{{#eq status 1}}禁用{{else}}恢复{{/eq}}{{else}}恢复{{/eq}}
                                                </span>
                                            </div></div>
                                        {{/each}}
                                    </td>
                                </tr>
                                {{else}}
                                <tr>
                                    <td class='second_level_tags'><div class='single_tag'><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div><div><span class='change_tag'>修改</span><span class='ban_tag'>{{#eq status 1}}禁用{{else}}恢复{{/eq}}</span></div></div></td>
                                    <td class='third_level_tags'>
                                        {{#each child}}
                                            <div class='single_tag third_single_tag'><div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div><div><span class='change_tag'>修改</span><span class='ban_tag'>{{#eq status 1}}禁用{{else}}恢复{{/eq}}</span></div></div>
                                        {{/each}}
                                    </td>
                                </tr>
                                {{/eq}}
                            {{/each}}
                        {{/eq}}
                    {{/each}}
                </table>
            </script>
            <script id="first_father_tags" type="text/x-handlebars-template">
                <option value="0">顶级标签</option>
                {{#each this}}
                <option value="{{id}}">{{name}}</option>
                {{/each}}
            </script>
            <script id="second_father_tags" type="text/x-handlebars-template">
                <option value="0">二级标签</option>
                {{#each this}}
                <option value="{{id}}">{{name}}</option>
                {{/each}}
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
                $.post('/Admin/Tags/getTags', null, function(data){
                    if(data.status){
                        //展示所有的标签
                        $('.tags_show').html($('#show_tags').template(data.info.tags));
                        //给弹出框赋予顶级标签数据
                        $('.add_tag_first_father').html($('#first_father_tags').template(data.info.top_tags));
                        $('.change_tag_first_father').html($('#first_father_tags').template(data.info.top_tags));
                    }else{
                        layer.msg('获取数据失败');
                    }
                    
                })

                var second_tag_id = '';
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
                                    //获取标签信息
                                    var tag_name = $('.add_tag_name_input').val();
                                    var tag_color = $('.add_tags_table .tag_color.selected').attr('color-data');
                                    var first_father = $('.add_tag_first_father').val();
                                    var second_father = $('.add_tag_second_father').val();
                                    if(tag_name == ''){
                                        layer.alert('标签名不能为空！', {icon : 6});
                                    }else{
                                        var param = {
                                            tag_name : tag_name,
                                            tag_color : tag_color,
                                            first_father : first_father,
                                            second_father : second_father
                                        }
                                        //添加标签
                                        $.post('/Admin/Tags/addTag', param, function (data){
                                            if(data.status){
                                                layer.msg('添加标签成功！');
                                                layer.close(index);
                                                window.location.reload();
                                            }else{
                                                layer.alert(data.info);
                                            }
                                        })
                                    }                                   
                                }

                            });
                        },
                        '.add_tags_table .tag_color' : function(){
                            if(!$(this).hasClass('selected')){
                                $('.add_tags_table .tag_color.selected').removeClass('selected');
                                $(this).addClass('selected');
                            }                          
                        },
                        '.change_tags_table .tag_color' : function(){
                            if(!$(this).hasClass('selected')){
                                $('.change_tags_table .tag_color.selected').removeClass('selected');
                                $(this).addClass('selected');
                            }                          
                        },
                        '.change_tag' : function(){
                            //获取标签id
                            var tag_id = $(this).closest('.single_tag').find('.tag').attr('data_id');
                            //获取标签信息
                            $.post('/Admin/Tags/getTagById',{id : tag_id},function(data){
                                if(data.status){
                                    $('.change_tags_table').attr('tag_id',data.info.id);
                                    $('.change_tag_name_input').val(data.info.name);
                                    switch(data.info.color){
                                        case '1' :
                                            $('.change_tags_table .green').click();
                                            break;
                                        case '2' :
                                            $('.change_tags_table .orange').click();
                                            break;
                                        case '3' :
                                            $('.change_tags_table .purple').click();
                                            break;
                                        case '4' :
                                            $('.change_tags_table .pink').click();
                                            break;
                                        case '5' :
                                            $('.change_tags_table .coffee').click();
                                            break;
                                        case '6' :
                                            $('.change_tags_table .blue').click();
                                            break;
                                    }
                                    second_tag_id = data.info.second_tag_id;
                                    $('.change_tags_table .change_tag_first_father').val(data.info.first_tag_id).change();

                                    layer.open({
                                        type: 1,
                                        title: '添加标签',
                                        maxmin: false, //弹出层是否可缩放
                                        shadeClose: false, //点击遮罩关闭层
                                        area : ['600px' , '350px'],
                                        content: $('.change_tags_dialog'),
                                        btn : ['添加' , '取消'],
                                        cancel : function(index , layero){
                                            layer.close(index);
                                        },
                                        yes : function(index , layero){
                                            //获取标签信息
                                            var tag_name = $('.change_tag_name_input').val();
                                            var tag_color = $('.change_tags_table .tag_color.selected').attr('color-data');
                                            var first_father = $('.change_tag_first_father').val();
                                            var second_father = $('.change_tag_second_father').val();
                                            if(tag_name == ''){
                                                layer.alert('标签名不能为空！', {icon : 6});
                                            }else{
                                                var param = {
                                                    tag_id : tag_id,
                                                    tag_name : tag_name,
                                                    tag_color : tag_color,
                                                    first_father : first_father,
                                                    second_father : second_father
                                                }
                                                //添加标签
                                                $.post('/Admin/Tags/changeTag', param, function (data){
                                                    if(data.status){
                                                        layer.msg('修改标签成功！');
                                                        layer.close(index);
                                                        window.location.reload();
                                                    }else{
                                                        layer.alert(data.info);
                                                    }
                                                })
                                            }                                   
                                        }
                                    });

                                }else{
                                    layer.msg('获取标签信息失败');
                                }
                                
                            })
                        },
                        '.ban_tag' : function(){
                            var tag_id = $(this).closest('.single_tag').find('.tag').attr('data_id');
                            layer.confirm('禁用这个标签？',{ btn:['禁用','取消']},function(){
                                $.post('/Admin/Tags/banTag',{id : tag_id},function(data){
                                    if(data.status){
                                        layer.msg(data.info);
                                        window.location.reload();
                                    }else{
                                        layer.msg(data.info);
                                    }
                                })
                            })
                        }
                    },
                    'change' : {
                        '.add_tag_first_father' : function(){
                            var top_value = $(this).val();
                            if(top_value == 0){
                                $('.add_tag_second_father').html('<option value="0">顶级标签</option>');
                            }else{
                                $.post('/Admin/Tags/getSecondLevelByTopId',{father_id : top_value}, function(data){
                                    if(data.status){
                                        $('.add_tag_second_father').html($('#second_father_tags').template(data.info));
                                    }else{
                                        $('.add_tag_second_father').html('<option value="0">二级标签</option>');
                                    }
                                })
                            }
                        },
                        '.change_tag_first_father' : function(){
                            var top_value = $(this).val();
                            if(top_value == 0){
                                $('.change_tag_second_father').html('<option value="0">顶级标签</option>');
                            }else{
                                $.post('/Admin/Tags/getSecondLevelByTopId',{father_id : top_value}, function(data){
                                    if(data.status){
                                        if(second_tag_id != ''){
                                            $('.change_tag_second_father').html($('#second_father_tags').template(data.info)).val(second_tag_id);
                                            second_tag_id = '';
                                        }else{
                                            $('.change_tag_second_father').html($('#second_father_tags').template(data.info));
                                        }                                       
                                    }else{
                                        $('.change_tag_second_father').html('<option value="0">二级标签</option>');
                                    }
                                })
                            }
                        }

                    }
                })
            })           
        </script>
    @stop
