@extends('admin.Common.common')
@section('style')
    <style>
		.index_div{
            width: 1000px;
            height: 450px;          
            margin:0px auto;
            margin-top: 50px;            
        }
        .btn_area a{
            text-decoration: none;
            margin-right: 30px;
        }
        .father_auth{
            width: 900px;
            height: 30px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            line-height: 30px;
        }
        .no_child{
            width: 500px;
            height: 200px;
            text-align: center;
            line-height: 200px;
            border: solid #ccc 1px;
        }
        .auth_table{
            border-collapse: collapse;
        }
        .auth_table th,.auth_table td{
            border: solid #ccc 1px;
            text-align: center;
        }
        .id_th{
            width: 80px;
        }
        .url_th{
            width: 300px;
        }
        .title_th{
            width: 300px;
        }
        .type_th{
            width: 80px;
        }
        .opr_th{
            width: 200px;
        }
        .auth_table a{
            text-decoration: none;
            color: #24a1f0;
        }
	</style>
    @stop
@section('common_content')
    <div class='index_div' auth_id='{{$auth_id}}'>
        
        <div class='father_auth'>{{$auth_title}}</div>
        <!-- 按钮区域 -->
        <div class='btn_area'>
            <a href='/Admin/Auth/addChildAuth/{{$auth_id}}'>添加</a>
            <a href='/Admin/Auth/{{$father_id}}'>返回上级</a>
        </div>
        <!-- 子权限展示区域 -->
        <div class='children_auths_area'>
            
        </div>
    </div>
    @stop
@section('script')
    @verbatim
    <script  id="child_auths" type="text/x-handlebars-template">
         <table class='auth_table'>
            <tr>
                <th class='id_th'>id</th>
                <th class='url_th'>路由</th>
                <th class='title_th'>中文描述</th>
                <th class='type_th'>类型</th>
                <th class='opr_th'>操作</th>
            </tr>
            {{#each this}}
            <tr>
                <td>{{id}}</td>
                <td><a href="/Admin/Auth/{{id}}">{{auth_name}}</a></td>
                <td><a href="/Admin/Auth/{{id}}">{{title}}</a></td>
                <td>
                    {{#eq type 1}}
                        get
                    {{else}}
                        post
                    {{/eq}}
                </td>
                <td>编辑</td>
            </tr>
            {{/each}}
         </table>
    </script>
    @endverbatim

    <script type="text/javascript">
        $(function(){
            // 获取该权限的所有子权限
            var auth_id = $('.index_div').attr('auth_id');
            $.post('/Admin/Auth/getChildAuths', {auth_id : auth_id}, function(data){
                if(data.status){
                    $('.children_auths_area').html($('#child_auths').template(data.info));
                }else{
                    layer.msg('暂无子权限');
                    $('.children_auths_area').html('<div class="no_child">暂无子权限</div>');
                }
            })
        })
    </script>
    @stop
