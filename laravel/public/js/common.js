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
		}
	})

})
