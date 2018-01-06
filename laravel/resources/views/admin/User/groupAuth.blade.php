@extends('admin.Common.common')
@section('style')
    <style>
		.index_div{
            width: 1000px;        
            margin:0px auto;
            margin-top: 50px;            
        }

        input{
            width: 20px;
            height: 20px;
        }
        .first_level_auth_area{
            background-color: #ccc;
            padding-left: 20px;
            height: 30px;
            line-height: 30px;
            font-size: 18px;
            font-weight: bold;
        }
        .second_level_auth_area{
            background-color: #ededed;
            padding-left: 50px;
            height: 25px;
            line-height: 25px;
            font-size: 16px;
        }
        .third_level_auth_area{
            padding-left: 100px;
        }
        label{
            display: inline-block;
            width: 200px;
            overflow: hidden;
        }

        .update_btn{
            width: 120px;
            height: 35px;
            text-align: center;
            line-height: 35px;
            font-size: 14px;
            color:#FFF;
            background-color: #4cd9ea;
            cursor: pointer;
            border-radius: 10px;
            margin: 0px auto;
            margin-top: 20px;
        }
        .auth_title{
            display: inline-block;
            width: 180px;
            height: 18px;
            line-height: 18px;
            overflow : hidden;
            text-overflow :ellipsis;
            white-space : nowrap;         
        }
	</style>
    @stop
@section('common_content')
    <div class='index_div'>
        <!-- 权限展示区域 -->
        <div class='auths_area'>
            @foreach ($auths as $auth)
                <div class='first_level_auth_area'>
                    <label><input type="checkbox" name="auth" value="{{$auth['id']}}" class='auth_input'><span class='auth_title' title="{{$auth['title']}}">{{$auth['title']}}</span></label>
                </div>
                @if (!empty($auth['child_auths']))
                    @foreach ($auth['child_auths'] as $second_auth)
                        <div class='second_level_auth_area'>
                            <label><input type="checkbox" name="auth" value="{{$second_auth['id']}}" class='auth_input'><span class='auth_title' title="{{$second_auth['title']}}">{{$second_auth['title']}}</span></label>
                        </div>
                        @if (!empty($second_auth['child_auths']))
                            <div class='third_level_auth_area'>
                            @foreach ($second_auth['child_auths'] as $third_auth)
                                <label><input type="checkbox" name="auth" value="{{$third_auth['id']}}" class='auth_input'><span class='auth_title' title="{{$third_auth['title']}}">{{$third_auth['title']}}</span></label>
                            @endforeach   
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class='update_btn'>更新权限</div>
    </div>
    @stop
@section('script')
    @verbatim
    <script  id="groups" type="text/x-handlebars-template">
         
    </script>
    @endverbatim

    <script type="text/javascript">
        var group_id = {{$group_id}};
        $(function(){
            // 获取该用户组的所有权限
            $.post('/Admin/Auth/getGroupAuths', {group_id : group_id}, function(data){
                // 选中已有的权限
                $('.auth_input').each(function(){
                    var auth_id = $(this).attr('value');
                    if($.inArray(parseInt(auth_id), data.info) !== -1){
                        $(this).attr('checked', true);
                    }else{
                        $(this).removeAttr('checked');
                    }
                })
            })

            $('body').onEvent({
                'click' : {
                    // 更新权限
                    '.update_btn' :  function(){
                        // 获取选好的所有权限id
                        if($('.auth_input:checked').length == 0){
                            layer.msg('至少选择一个权限！');
                        }
                        
                        var auth_ids = [];
                        $('.auth_input:checked').each(function(){
                            var auth_id = $(this).attr('value');
                            auth_ids.push(auth_id);
                        })
                        // 更新
                        $.post('/Admin/Auth/updateGroupAuth', {group_id : group_id, auth_ids : auth_ids}, function(data){
                            if(data.status){
                                layer.msg('更新权限成功');
                            }else{
                                layer.msg(data.info);
                            }
                        })

                    }
                }
            })

        })
    </script>
    @stop
