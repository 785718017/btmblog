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
       .name{
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
            width: 995px;
            height: 80px;
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
       .show_tags ul li .selected_tag{
            background-color: #ccc; 
            padding: 5px 10px;
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
       }
    </style>
    @stop
@section('script_src')
        <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.config.js')}}"></script>
        <script type="text/javascript" src="{{asset('/plugin/ueditor/ueditor.all.js')}}"></script>
    @stop

@section('common_content')
    <table class='article_info_table'>
        <tr>
            <td class='title_td'>文章标题</td>
            <td>
                <input type="text" class='name' />
            </td>
            <td class='title_td'>作者</td>
            <td>
                <input type="text" class='name' />
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
                        <input type="file" id='input_file' />
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
                    <select multiple="multiple">
                        <option value='1'>编程语言</option>
                        <option value='2'>前端</option>
                        <option value='3'>数据库</option>
                    </select>
                    <!-- 二级标签 -->
                    <select multiple="multiple">
                        <option value='1'>编程语言</option>
                        <option value='2'>前端</option>
                        <option value='3'>数据库</option>
                    </select>
                    <!-- 三级标签 -->
                    <select multiple="multiple">
                        <option value='1'>编程语言</option>
                        <option value='2'>前端</option>
                        <option value='3'>数据库</option>
                    </select>
                    <!-- 操作 -->
                    <div class='dib opr_div'>
                        <div><button class='opr_btn'>显示下级标签</button></div>
                        <div><button class='opr_btn'>返回上级</button></div>
                        <div><button class='opr_btn'>添加标签</button></div>
                    </div>
                    <!-- 显示已选择的标签 -->
                    <div class='show_tags'>
                        <ul>
                            <li><div class='delete_tag'></div><div class='selected_tag'>编程语言</div></li>
                            <li><div class='selected_tag'>随想</div><div class='delete_tag'></div></li>
                            <li><div class='selected_tag'>电影</div><div class='delete_tag'></div></li>
                            <li><div class='selected_tag'>laravel</div><div class='delete_tag'></div></li>
                            <li><div class='selected_tag'>mysql</div><div class='delete_tag'></div></li>
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

        $(function(){
            $('body').onEvent({
                'change' : {
                    '#input_file' : function(){
                        var file = $(this)[0].files[0];
                        //上传文件，并在页面上显示

                    }
                }
            })
        })

    </script>
    @stop
