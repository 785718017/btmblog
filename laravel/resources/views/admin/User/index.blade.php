@extends('admin.Common.common')
@section('style')
    <style>
		.index_div{
            width: 1000px;
            height: 450px;          
            margin:0px auto;
            margin-top: 50px;            
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
    <script  id="child_auths" type="text/x-handlebars-template">
         <table class='auth_table'>
            <tr>
                <th class='id_th'>id</th>
                <th class='url_th'>名称</th>
                <th class='title_th'>操作</th>
            </tr>
            {{#each this}}
            <tr>
                <td>{{id}}</td>
                <td>{{auth_name}}</td>
                <td><a href="/Admin/User/groupAuth/">权限</a></td>
            </tr>
            {{/each}}
         </table>
    </script>
    @endverbatim

    <script type="text/javascript">
        $(function(){
            
        })
    </script>
    @stop
