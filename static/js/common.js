//得到以JSON格式为字符串的原型
function S(str){
	return eval( '(' + str + ')' );
}

function reload(s){
	if(typeof(s) == 'undefined'){
		window.location.reload(true);
	}else{
		setTimeout(function(){
			window.location.reload(true);
		}, s*1000);
	}
}


function format_number(n){
   var b=parseInt(n).toString();
   var len=b.length;
   if(len<=3){return b;}
   var r=len%3;
   return r>0?b.slice(0,r)+","+b.slice(r,len).match(/\d{3}/g).join(","):b.slice(r,len).match(/\d{3}/g).join(",");
}


function cut_str(str, len){
    var char_length = 0;
    for (var i = 0; i < str.length; i++){
        var son_str = str.charAt(i);
        encodeURI(son_str).length > 2 ? char_length += 1 : char_length += 0.5;
        if (char_length >= len){
            var sub_len = char_length == len ? i+1 : i;
            return str.substr(0, sub_len);
            break;
        }
    }
    return str;
}

/**
 * ajax提交str数据
 * @param url 地址
 * @param jsobject js一维对象
 * @param successfun 成功回调 回调信息类型依据后台返回而定 如果为write_json则为json格式 否则是文本格式
 * @param errorfun 失败回调
 */
function ajax(url,jsobject,successfun,errorfun,pobj,cache){
	if(!pobj){
		pobj = window;
	}
	if(!cache){
		cache = false;
	}
	var md5key = '';
	if(cache){
		md5key = md5(url+jQuery.toJSON(jsobject));
		if(window[md5key]){
			if(typeof successfun =='string'){
				eval(successfun);
			}else{
				successfun.apply(pobj,window[md5key]);
			}
			return;
		}
	}
	var async = true;
	if(errorfun===false){
		async = false;
	}
	jQuery.ajax({
		url: url,
		type: "post",
		data:jsobject,
		async:async,
		cache: cache,
		dataType:"json",
		success: function(msg,reqdata){
			if(cache){
				window[md5key] = [msg,reqdata];
			}
			if(successfun){
				if(typeof successfun =='string'){
					eval(successfun);
				}else{
					successfun.apply(pobj,[msg,reqdata]);
				}				
			}
		},error : function(obj,errmsg){
			if(errorfun){
				errorfun.apply(pobj,[errmsg]);
			}
		}
	});
}

static_path = typeof( static_path ) == 'undefined' ? '/static/common/' : static_path;
/**
 * 吐丝信息框
 * @param txt
 * @returns
 */
function tusi(txt,fun){
	$('.tusi').remove();
	var div = $('<div style="background: url('+static_path+'img/tusi.png);max-width: 85%;min-height: 77px;min-width: 270px;position: absolute;left: -1000px;top: -1000px;text-align: center;border-radius:10px;"><span style="color: #ffffff;line-height: 77px;font-size: 23px;">'+txt+'</span></div>');
	$('body').append(div);
	div.css('zIndex',9999999);
	div.css('left',parseInt(($(window).width()-div.width())/2));
	var top = parseInt($(window).scrollTop()+($(window).height()-div.height())/2);
	div.css('top',top);
	setTimeout(function(){
		div.remove();
    	if(fun){
    		fun();
    	}
	},2000);
}

/**
 * 吐丝信息框
 * @param txt
 * @returns
 */
function toast(txt,fun){
	$('.tusi').remove();
	var div = $('<div style="background: url('+static_path+'/img/tusi.png);max-width: 85%;min-height: 77px;min-width: 270px;position: absolute;left: -1000px;top: -1000px;text-align: center;border-radius:10px;"><span style="color: #ffffff;line-height: 77px;font-size: 23px;">'+txt+'</span></div>');
	$('body').append(div);
	div.css('zIndex',9999999);
	div.css('left',parseInt(($(window).width()-div.width())/2));
	var top = parseInt($(window).scrollTop()+($(window).height()-div.height())/2);
	div.css('top',top);
	setTimeout(function(){
		div.animate({ 
	        top: top-200,
	        opacity:0}, {
	        duration:888,
	        complete:function(){
	        	div.remove();
	        	if(fun){
	        		fun();
	        	}
	        }
	    });
	},1888);
}

/**
 * 加载信息框
 * @param txt
 * @returns
 */
function loading(txt){
	if(txt === false){
		$('.qp_lodediv').remove();
	}else{
		$('.qp_lodediv').remove();
		var div = $('<div class="qp_lodediv" style="background: url('+static_path+'img/loadb.png);width: 269px;height: 107px;position: absolute;left: -1000px;top: -1000px;text-align: center;"><span style="color: #ffffff;line-height: 107px;font-size: 23px; white-space: nowrap;">&nbsp;&nbsp;&nbsp;<img src="'+yyuc_jspath+'/img/load.gif" style="vertical-align: middle;"/>&nbsp;&nbsp;'+txt+'</span></div>');
		$('body').append(div);
		div.css('zIndex',9999999);
		div.css('left',parseInt(($(window).width()-div.width())/2));
		var top = parseInt($(window).scrollTop()+($(window).height()-div.height())/2);
		div.css('top',top);
	}	
}