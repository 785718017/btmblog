@extends('admin.Common.common')
@section('style')
    <style>
		.index_div{
            width: 1000px;
            height: 450px;          
            margin:0px auto;
            margin-top: 50px;            
        }
        .name_th{
            width: 200px;
        }
        .group_table{
            border-collapse: collapse;
        }
        .group_table td{
            text-align: center;
            height: 40px;
            line-height: 40px;
        }
	</style>
    @stop
@section('common_content')
    <div class='index_div'>
        <div class='group_list'>
            
        </div>
    </div>
    @stop
@section('script')
    @verbatim
    <script  id="groups" type="text/x-handlebars-template">
         <table class='group_table'>
            <tr>
                <th class='id_th'>id</th>
                <th class='name_th'>名称</th>
                <th class='opr_th'>操作</th>
            </tr>
            {{#each this}}
            <tr>
                <td>{{id}}</td>
                <td>{{name}}</td>
                <td><a href="/Admin/User/groupAuth/{{id}}">权限</a></td>
            </tr>
            {{/each}}
         </table>
    </script>
    @endverbatim

    <script type="text/javascript">
        $(function(){
            // 获取该权限的所有子权限
            $.post('/Admin/User/getAllGroups', null, function(data){
                if(data.status){
                    $('.group_list').html($('#groups').template(data.info));
                }else{
                    layer.msg('暂无数据');
                }
            })
        })
    </script>
    @stop
