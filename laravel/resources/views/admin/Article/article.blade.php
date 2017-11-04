@extends('admin.Common.common')
@section('style')
    <script>

    </script>
    @stop
@section('script_src')
    <style type="text/css">
        .btn_div{
            height: 60px;
        }
        .write_btn,.tags_manage_btn{
            width: 120px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            background: #333;
            margin-top: 12px;
            margin-left: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn_div a{
            color: #FFF;
        }
        /*文章列表样式开始*/
        .articles_table{
            width: 1160px;
            margin: 0px auto;
            border-collapse: collapse;
        }
        .articles_table th{
            border: solid #ccc 1px;
            height: 40px;
            line-height: 40px;
            text-align: center;
        }
        .origin_td{
            text-align: center;
        }
        .articles_table td{
            border: solid #ccc 1px;
            text-align: center;
            height: 100px;
            overflow: hidden;
        }


        .id_th{
            width: 80px;
        }
        .logo_th{
            width: 100px;
        }
        .name_th{
            width: 150px;
        }
        .author_th{
            width: 80px;
        }
        .introduce_th{
            width: 200px;
        }
        .tags_th{
            width: 200px;
        }
        .rewrite_time_th{
            width: 120px;
        }
        .browse_times_th{
            width: 50px;
        }
        .agree_num_th{
            width: 50px;
        }
        .disagree_num_th{
            width: 50px;
        }
        .opr_th{
            width: 80px;
        }
        .logo_img{
            width: 60px;
            height: 60px;
            margin-top: 20px;
        }
        .update_btn a{
            color: black;
            text-decoration: none;
        }
        .offline_btn{
            cursor: pointer;
        }
        .offline_tr{
            color: #CCC;
        }
        .offline_tr .update_btn a{
            color: #CCC;
        }

        .introduce{
            width: 200px;
            height: 100px;
            font-size: 12px;
            overflow: hidden;
        }
        /*文章列表样式结束*/

        /*分页样式开始*/
        .page{
            width: 1160px;
            margin: 0px auto;
            margin-top: 20px;
        }
        .page ul{
            text-align: center;
        }
        .page ul li{
            list-style: none;
            text-decoration: none;
            display: inline-block;         
            border: solid #ccc 1px;
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
        }

        .page ul li a{
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-decoration: none;
            color: #666666;
        }
        .active{
            background: #CCC;
            color: #FFF;
        }

        /*分页样式结束*/
    </style>
    @stop
@section('common_content')
    <div>
        {{--按钮--}}
        <div class='btn_div'>
            <a href="/Admin/Article/write" target="_blank"><div class='write_btn dib'>写文章</div></a>
            <a href="/Admin/Tags/index" target="_blank"><div class='tags_manage_btn dib'>标签管理</div></a>
        </div>

        {{--文章列表--}}
        <div>
            <table class='articles_table'>
                <tr>
                    <th>id</th>
                    <th>logo</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>简介</th>
                    <th>标签</th>
                    <th>修改时间</th>
                    <th>阅读量</th>
                    <th>点赞</th>
                    <th>点踩</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td colspan="11" class='origin_td'>暂无数据</td>
                </tr>
            </table>
        </div>
        {{--分页--}}
        <div class='page'></div>
    </div>
    @stop
@section('script')
    @verbatim
        <script id="articles_tmp" type="text/x-handlebars-template">
            <tr>
                <th class='id_th'>id</th>
                <th class='logo_th'>logo</th>
                <th class='name_th'>标题</th>
                <th class='author_th'>作者</th>
                <th class='introduce_th'>简介</th>
                <th class='tags_th'>标签</th>
                <th class='rewrite_time_th'>修改时间</th>
                <th class='browse_times_th'>阅读量</th>
                <th class='agree_num_th'>点赞</th>
                <th class='disagree_num_th'>点踩</th>
                <th class='opr_th'>操作</th>
            </tr>
            {{#each this}}
            <tr class='{{#eq status 0}}offline_tr{{/eq}}'>
                <td>{{id}}</td>
                <td>
                    <img src="/storage/{{logo.url}}" class='logo_img'>
                </td>
                <td>{{name}}</td>
                <td>{{author}}</td>
                <td><div class='introduce' title='{{introduce}}'>{{introduce}}</div></td>
                <td>
                    {{#each tags}}
                    <div class='tag color_{{color}} {{#eq status 0}}ban{{/eq}}' data_id='{{id}}'>{{name}}</div>
                    {{/each}}
                </td>
                <td>{{rewrite_time}}</td>
                <td>{{browse_times}}</td>
                <td>{{agree_num}}</td>
                <td>{{disagree_num}}</td>
                <td>
                    <span class='update_btn'><a href="/Admin/Article/update?id={{id}}" target="_blank">修改</a></span>
                    <span article_id='{{id}}' class='offline_btn'>{{#eq status 1}}下线{{else}}上线{{/eq}}</span>
                </td>
            </tr>
            {{/each}}
        </script>
    @endverbatim

    <script type="text/javascript">
        //注册handlebars标签
            Handlebars.registerHelper("eq",function(value1,value2,options){
                if(value1 == value2){
                    return options.fn(this);
                }else{
                    return options.inverse(this);
                }           
            }); 
        $(function(){
            //获取所有的文章
            $.post('/Admin/Article/getAllArticles', null, function(data){
                if(data.status){
                    $('.articles_table').html($('#articles_tmp').template(data.info.data.data));
                    $('.page').html(data.info.pages)
                }else{
                    layer.msg('暂无文章数据');
                }
                
            })


            $('body').onEvent({
                'click' : {
                    '.page ul li a' : function(e){
                        //处理分页的标签点击事件，阻止a标签，然后用ajax获取数据
                        e.preventDefault();
                        var url = $(this).attr('href');
                        var params = getParams(url);
                        
                        //获取其它页的文章
                        $.post('/Admin/Article/getAllArticles', params, function(data){
                            if(data.status){
                                $('.articles_table').html($('#articles_tmp').template(data.info.data.data));
                                $('.page').html(data.info.pages)
                            }else{
                                layer.msg('暂无文章数据');
                            }                           
                        })

                    },
                    '.offline_btn' : function(){
                        var id = $(this).attr('article_id');
                        $.post('/Admin/Article/onlineOrOffline', {id : id}, function(data){
                            if(data.status){
                                window.location.reload();
                            }else{
                                layer.msg('操作失败');
                            }
                        })
                    }
                }
            })


        })



        

    </script>
    @stop
