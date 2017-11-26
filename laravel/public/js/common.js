jQuery.support.cors = true;
/**
 * 扩展jquery的事件注册，可以为选择器子选择器注册多个事件 
 * 	$("#talkfield").onEvent({
 *		'click' : {
 *   		'.page a' : function(){
 *    			var url = $(this).attr('url'); 
 *    		},
 *    		'tbody tr' : function(){
 * 				var bSelected = $(this).hasClass("row_selected");
 * 			} 
 * 		} 
 * 	});
 */
$.fn.extend(
	{onEvent:function(obj){
		for ( var event in obj)
			for ( var selector in obj[event])
				$(this).on(event, selector, obj[event][selector]);			
		return this;
		}
	}
)
/**
 * 解析url的参数
 */
function getParams(url){
	var params = new Object();
	if(!url){
		url = window.location.href;
	}

	var url_arr = url.split('?');
	var param_string = url_arr[1];
	var param_arr = param_string.split('&');
	for(i in param_arr){
		var param = param_arr[i].split('=');
		params[param[0]] = param[1];
	}
	return params;
}	

$(function(){
	/**
	 * 设置公共头部导航栏的动画
	 */
	$('body').onEvent({
		'mouseover' : {
			'.common_nav_list' :  function(){
				$('.common_nav_list').stop(true);
				$(this).closest('a').find('.small_nav').removeClass('hide');
			}
		},
		'mouseout' : {
			'.common_nav_list' :  function(){
				$('.common_nav_list').stop(true);
				$(this).closest('a').find('.small_nav').addClass('hide');				
			}
		},
		//公共的登录按钮点击事件--弹出登录窗口
		'click' : {
			'.login_btn' : function(){
				layer.open({
                    type: 1,
                    title: '登录',
                    maxmin: false, //弹出层是否可缩放
                    shadeClose: false, //点击遮罩关闭层
                    area : ['350px' , '330px'],
                    content: $('.commen_login_div')
                })
			},
			'.common_login_btn' : function(){
				//获取用户名
				var user_name = $('input.user_name').val();
				//获取密码
				var password = $('input.password').val();
				password = hex_md5(password);
				//检测用户名和密码是否正确
				$.post('/User/login', {user_name : user_name, password : password}, function(data){
					if(!data.status){
						if(data.info.if_jump){
							window.location.href = 'http://www.btmblog.com/failNotify/'+data.info.info+'/'+data.info.time;
						}else{
							layer.msg(data.info);
						}						
					}else{
						window.location.reload();
					}
				})

			},
			'.change_method_wx' : function(){
				layer.msg('暂不支持微信登录');
			},
			'.change_method_wb' : function(){
				layer.msg('暂不支持微博登录');
			}
		}
	})


	//注册handlebars标签
    Handlebars.registerHelper("eq",function(value1,value2,options){
        if(value1 == value2){
            return options.fn(this);
        }else{
            return options.inverse(this);
        }           
    });

})
