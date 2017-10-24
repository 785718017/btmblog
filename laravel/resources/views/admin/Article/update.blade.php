@extends('admin.Common.common')
@section('style')
    <style>
        .article_info_table{
            width: 1200px;
            margin: 50px auto;
            border: solid #ccc 1px;
            padding: 10px;
       }
       .title_td{
            width: 100px;
            height: 40px;
            line-height: 40px;
            font-size: 14px;
            color: #8f8a8a;
            text-align: center;
       }
       .name,.author{
            border: 1px solid #c3c3c3;
            padding-left: 5px;
            height: 24px;
            line-height: 24px;
            font-size: 14px;
            width: 400px;
       }
       .content{
            width: 975px;
            padding: 10px 20px;
            height: 400px;
            overflow-y: auto;
       }
       .content_title,.introduct_title,.logo_title,.tag_title{
            vertical-align: top;
       }
       .introduct{
            width: 975px;
            height: 70px;
            padding: 10px;
       }
       #input_file{                
            width: 100%;
            height: 100%;
            opacity: 0;
       }
       #input_file_div{
            width: 220px;
            height: 150px;
            margin-top: 15px;
            margin-bottom: 15px;
            border:solid #ccc 1px;
       }
       #input_file_btn{  
            width: 120px;
            height:120px;             
            background: url("{{asset('/image/admin/img_icon.jpg')}}");
            margin-left: 50px;
            margin-top: 10px;
       }
       .select_tag_div{
            margin-top: 10px;
       }
       select{
            width: 150px;
            height: 150px;
            padding: 5px;
            float: left;
            border:solid #ccc 1px;               
       }
       .opr_div{
            float: left;
            height: 140px;
            padding: 5px;
            border: solid #ccc 1px;  
       }
       .opr_btn{
            width: 120px;
            height: 25px;
            margin-bottom: 5px;
       }
       .show_tags{
            width:400px;
            height: 150px;
            margin-left: 10px;
            float: left; 
            border: solid #ccc 1px;
       }
       .show_tags ul{
            overflow: hidden;
       }
       .show_tags ul li{
            list-style: none;
            float: left;
            font-size: 14px;                              
            margin:10px;
            position: relative;
       }
       .delete_tag{
            width: 20px;
            height: 20px;
            background: url("{{asset('/image/admin/delete_tag.png')}}");
            background-size: 20px 20px;
            position: absolute;
            right: -7px; 
            top: -7px;   
            cursor: pointer;   
       }
       .submit{
            width: 200px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            margin: 0px auto;
            margin-top:10px;
            background: #37bab5;
            border-radius: 20px;
            color:#FFF;
            font-weight: bold;
            cursor: pointer;
       }
    </style>
    @stop
@section('script_src')
        <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.config.js')}}"></script>
        <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.all.js')}}"></script>
    @stop

@section('common_content')
    <table class='article_info_table'  article_id='{{$id}}'>
        <tr>
            <td class='title_td'>文章标题</td>
            <td>
                <input type="text" class='name'/>
            </td>
            <td class='title_td'>作者</td>
            <td>
                <input type="text" class='author'/>
            </td>
        </tr>                                      
        <tr>
            <td class='title_td content_title'>正文</td>
            <td colspan="3">
                <script id="editor" type="text/plain"> </script>
            </td>
        </tr>
        <tr>
            <td class='title_td logo_title'>封面图片</td>
            <td>
                <div id='input_file_div' class='dib'>
                    <div id='input_file_btn' class='dib'>
                        <input type="file" id='input_file' class='logo' logo_id=''/>
                    </div>
                </div>
            </td>                       
        </tr>
        <tr>
            <td class='title_td introduct_title'>内容简介</td>
            <td colspan="3">
                <textarea class='introduct'></textarea>
            </td>
        </tr>                  
        <tr>
            <td class='title_td tag_title'>标签选择</td>
            <td colspan="3">
                <div class='select_tag_div'>
                    <!-- 一级标签 -->
                    <select multiple="multiple" class='top_level_tags'>
                        
                    </select>
                    <!-- 二级标签 -->
                    <select multiple="multiple" class='second_level_tags'>

                    </select>
                    <!-- 三级标签 -->
                    <select multiple="multiple" class='third_level_tags'>

                    </select>
                    <!-- 操作 -->
                    <div class='dib opr_div'>
                        <div><button class='opr_btn show_child_tags'>显示下级标签</button></div>
                        <div><button class='opr_btn back_to_father'>返回上级</button></div>
                        <div><button class='opr_btn add_article_tag'>添加标签</button></div>
                    </div>
                    <!-- 显示已选择的标签 -->
                    <div class='show_tags'>
                        <ul>
                            
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div class='submit'>提交</div>
            </td>
        </tr>
    </table>
    @stop
@section('script')
    @verbatim
        <script id="level_tags_options" type="text/x-handlebars-template">
            {{#each this}}
            <option value='{{id}}' tag_name='{{name}}' tag_color='{{color}}'>{{name}}</option>
            {{/each}}
        </script>
        <script id="selected_tags" type="text/x-handlebars-template">
            {{#each this}}
                <li>
                    <div class='selected_tag tag color_{{color}}' tag_id='{{id}}'>{{name}}</div>
                    <div class='delete_tag'></div>
                </li>
            {{/each}}
        </script>
    @endverbatim
    <script type="text/javascript">
        //实例化编辑器
        var ue = UE.getEditor( 'editor',{
            autoHeightEnabled: true,
            initialFrameWidth: 995,
            initialFrameHeight:300,
            toolbars: [
                ['undo', 'redo', 'italic', 'bold', 'indent', 'underline', 'blockquote','justifyleft','justifyright','justifycenter','justifyjustify','forecolor','backcolor','insertorderedlist','fontfamily','fontsize','lineheight'],
                ['preview','link','emotion','spechars','inserttable','deletetable','mergecells','mergeright','mergedown','insertcode','searchreplace','simpleupload','insertimage','insertvideo']
            ]
        });
        //获取顶级标签
        $.post('/Admin/Tags/getTopLevelTags',null,function(data){
            if(data.status){
                $('.top_level_tags').html($('#level_tags_options').template(data.info));
            }else{
                layer.msg('获取顶级标签失败，请刷新页面');
            }
        })

        var id = $('.article_info_table').attr('article_id');
        //获取文章信息
        $.post('/Admin/Article/getArticleInfo',{id : id},function(data){
            if(data.status){
                //展示数据
                $('.name').val(data.info.name);
                $('.author').val(data.info.author);
                $('.logo').attr('logo_id',data.info.logo);
                $('.introduct').html(data.info.introduce);
                
                //正文
                ue.ready(function() {
                    ue.execCommand('inserthtml', data.info.content)
                });
                //设置logo图
                $('#input_file_btn').css('width','100%');
                $('#input_file_btn').css('height','100%');
                $('#input_file_btn').css('marginLeft','20px');
                $('#input_file_btn').css('marginTop','1p5x');
                $('#input_file_btn').css('background','url('+data.info.logo.url+')');
                $('#input_file_btn').css('backgroundSize','180px 120px');
                $('#input_file_btn').css('backgroundRepeat','no-repeat');               
                $('#input_file').attr('logo_id',data.info.logo.logo_id);
                //设置标签
                $('.show_tags ul').html($('#selected_tags').template(data.info.tags));


            }else{
                layer.msg('获取数据失败');
            }
        })

        $(function(){
            $('body').onEvent({
                'change' : {
                    '#input_file' : function(){
                        var file = $(this)[0].files[0];
                        //上传文件，并在页面上显示
                        var formdata = new FormData();
                            formdata.append('file',file);
                        $.ajax({
                            url : '/Admin/Article/uploadLogo',
                            type : 'POST',
                            processData : false,
                            contentType : false,
                            data : formdata,
                            success : function(data){
                                if(data.status){
                                    $('#input_file_btn').css('width','100%');
                                    $('#input_file_btn').css('height','100%');
                                    $('#input_file_btn').css('marginLeft','20px');
                                    $('#input_file_btn').css('marginTop','1p5x');
                                    $('#input_file_btn').css('background','url('+data.info.url+')');
                                    $('#input_file_btn').css('backgroundSize','180px 120px');
                                    $('#input_file_btn').css('backgroundRepeat','no-repeat');
                                    
                                    $('#input_file').attr('logo_id',data.info.logo_id);
                                }
                            }
                        })
                    }
                },
                'click' : {
                    '.show_child_tags' : function(){
                        //判断是否选择了三级标签
                        if($('.third_level_tags option').length == 0){
                            //有三级标签，则点击无效，否则判断是否有二级标签
                            if($('.second_level_tags option').length == 0){
                                //获取已选中的一级标签
                                var select_tags = $('.top_level_tags').val();
                                if(select_tags){
                                    if(select_tags.length > 1){
                                        layer.msg('无法获取多个标签的子标签');
                                    }else{
                                        var tag_id = select_tags[0];
                                        $.post('/Admin/Tags/getSecondLevelByTopId',{father_id : tag_id}, function(data){
                                            if(data.status){
                                                $('.second_level_tags').html($('#level_tags_options').template(data.info));
                                            }else{
                                                layer.msg('暂未获取到子标签');
                                            }
                                        })
                                    }
                                }else{
                                    layer.msg('至少选择一个顶级标签');
                                }
                            }else{
                                //获取已选中的二级标签
                                var select_tags = $('.second_level_tags').val();
                                if(select_tags){
                                    if(select_tags.length > 1){
                                        layer.msg('无法获取多个标签的子标签');
                                    }else{
                                        var tag_id = select_tags[0];
                                        $.post('/Admin/Tags/getSecondLevelByTopId',{father_id : tag_id}, function(data){
                                            if(data.status){
                                                $('.third_level_tags').html($('#level_tags_options').template(data.info));
                                            }else{
                                                layer.msg('暂未获取到子标签');
                                            }
                                        })
                                    }
                                }else{
                                    layer.msg('至少选择一个二级标签');
                                }
                            }
                        }
                    },
                    '.back_to_father' : function(){
                        //判断是否选择了三级标签
                        if($('.third_level_tags option').length > 0){
                            //有三级标签，判断是否选择了三级标签
                            $('.third_level_tags').empty();
                        }else{
                            if($('.second_level_tags option').length > 0){
                                $('.second_level_tags').empty();
                            }
                        }
                    },
                    '.add_article_tag' : function(){
                        //判断是否选择了三级标签
                        if($('.third_level_tags option').length > 0){
                            //有三级标签，添加三级标签
                            var select_tags = $('.third_level_tags').val();
                            if(select_tags){
                                for(i in select_tags){
                                    //获取标签名称
                                    var tag_name = $('.third_level_tags option[value='+select_tags[i]+']').attr('tag_name');
                                    var tag_color = $('.third_level_tags option[value='+select_tags[i]+']').attr('tag_color');
                                    $('.show_tags ul').append("<li><div class='selected_tag tag color_"+tag_color+"' tag_id='"+select_tags[i]+"'>"+tag_name+"</div><div class='delete_tag'></div></li>");
                                }
                            }else{
                                layer.msg('请至少选择一个标签');
                            }
                        }else{
                            if($('.second_level_tags option').length > 0){
                                //没有三级标签，但有二级标签，添加二级标签
                                var select_tags = $('.second_level_tags').val();
                                if(select_tags){
                                    for(i in select_tags){
                                        //获取标签名称
                                        var tag_name = $('.second_level_tags option[value='+select_tags[i]+']').attr('tag_name');
                                        var tag_color = $('.second_level_tags option[value='+select_tags[i]+']').attr('tag_color');
                                        $('.show_tags ul').append("<li><div class='selected_tag tag color_"+tag_color+"' tag_id='"+select_tags[i]+"'>"+tag_name+"</div><div class='delete_tag'></div></li>");
                                    }
                                }else{
                                    layer.msg('请至少选择一个标签');
                                }
                            }else{
                                if($('.top_level_tags option').length > 0){
                                    //添加一级标签
                                    var select_tags = $('.top_level_tags').val();
                                    if(select_tags){
                                        for(i in select_tags){
                                            //获取标签名称
                                            var tag_name = $('.top_level_tags option[value='+select_tags[i]+']').attr('tag_name');
                                            var tag_color = $('.top_level_tags option[value='+select_tags[i]+']').attr('tag_color');
                                            $('.show_tags ul').append("<li><div class='selected_tag tag color_"+tag_color+"' tag_id='"+select_tags[i]+"'>"+tag_name+"</div><div class='delete_tag'></div></li>");
                                        }
                                    }else{
                                        layer.msg('请至少选择一个标签');
                                    }
                                }
                            }
                        }
                    },
                    '.delete_tag' : function(){
                        $(this).closest('li').remove();
                    },
                    '.submit' : function(){
                        //获取文章的id
                        var id = $('.article_info_table').attr('article_id');

                        //先获取填写的内容
                        var name = $('.name').val();    //标题
                        var author = $('.author').val();  //作者
                        var content = ue.getContent();  //文章内容
                        var introduct = $('.introduct').val(); //简介
                        if(name == ''){
                            layer.msg('标题不能为空');
                            return false;
                        }
                        if(author == ''){
                            layer.msg('别忘了署名哦！');
                            return false;
                        }
                        if(content == ''){
                            layer.msg('啥都没写就提交？');
                            return false;
                        }
                        if(introduct == ''){
                            layer.msg('简介不能少！');
                            return false;
                        }
                        //获取标签
                        if($('.selected_tag').length > 0){
                            var tags = [];
                            $('.selected_tag').each(function(){
                                var tag_id = $(this).attr('tag_id');
                                tags.push(tag_id);
                            })
                        }else{
                            layer.msg('请至少选择一个标签');
                            return false;
                        }

                        //logo要单独处理
                        var logo_id = $('#input_file').attr('logo_id');
                        if(logo_id == ''){
                            layer.msg('logo图呢？');
                            return false;
                        }
                        var data = {
                            id : id,
                            name : name,
                            author : author,
                            content : content,
                            introduct : introduct,
                            tags : tags,
                            logo_id : logo_id
                            
                        };
                        //保存文章
                        $.post('/Admin/Article/updateArticle', data, function(data){
                            //添加成功后，跳转到文章列表页面，否则留在本页面
                            if(data.status){
                                window.location.href = '/Admin/Article/index';
                            }else{
                                layer.alert('保存文章失败，请重试!', {icon: 6});
                            }
                        });
                    }
                }
            })
        })

    </script>
    @stop
