@extends('admin.Common.common')
@section('style')
    <style>
		.index_div{
            width: 1000px;
            height: 450px;          
            margin:0px auto;
            margin-top: 50px;            
        }
        .add_btn{
            width: 100px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            margin: 0px auto;
            margin-top: 10px;
            background: #37bab5;
            border-radius: 20px;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
        }
        .auth_type{
            width: 60px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            border: solid 1px #ccc;
            background-color: #f6f6f6;
            cursor: pointer;
        }
        .auth_type.selected{
            background-color: #f59999;
        }
        .cancel{
            display: inline-block;
            width: 100px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            margin: 0px auto;
            margin-top: 10px;
            background: #37bab5;
            border-radius: 20px;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
	</style>
    @stop
@section('common_content')
    <div class='index_div'>
        <table>
            <tr>
                <td>路由：</td>
                <td>
                    <input type="text" name="url" class='url' />
                </td>
            </tr>
            <tr>
                <td>描述：</td>
                <td>
                    <input type="text" name="description" class='description' />
                </td>
            </tr>
            <tr>
                <td>参数：</td>
                <td>
                    <input type="text" name="params_num" class='params_num' value='0'/>
                </td>
            </tr>
            <tr>
                <td>父级：</td>
                <td>
                    {{$auth['title']}}（{{$auth['id']}}）
                </td>
            </tr>
            <tr>
                <td>类型</td>
                <td>
                    <span class='auth_type selected dib' type='1'>get</span>
                    <span class='auth_type dib' type='2'>post</span>
                </td>
            </tr>
            <tr>
                <td><span class='add_btn dib' father_id="{{$auth['id']}}">添加</span></td>
                <td><a href="/Admin/Auth/{{$auth['id']}}" class='cancel'>取消</a></td>
            </tr>
        </table>
    </div>
    @stop
@section('script')

    <script type="text/javascript">
        $(function(){
            $('body').onEvent({
                'click' : {
                    '.auth_type' : function(){
                        if(!$(this).hasClass('selected')){
                            $('.auth_type.selected').removeClass('selected');
                            $(this).addClass('selected');
                        }
                    },
                    '.add_btn' : function(){
                        // 获取该权限的所有子权限
                        var father_id = $(this).attr('father_id');
                        var url = $('.url').val();
                        var description = $('.description').val();
                        var type = $('.auth_type.selected').attr('type');
                        var params_num = $('.params_num').val();
                        var params = {
                            father_id : father_id,
                            url : url,
                            description : description,
                            type : type,
                            params_num : params_num
                        }
                        $.post('/Admin/Auth/addAuth', params, function(data){
                            if(data.status){
                                // 跳转到上一个页面
                                window.location.href = '/Admin/Auth/'+ father_id;
                            }else{
                                layer.msg('添加失败');
                            }
                        })
                    }
                }
            })

        })
    </script>
    @stop
