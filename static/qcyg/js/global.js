function isPC(){
	var ispc = false;
	//平台、设备和操作系统
	var system ={
			win : false,
			mac : false,
			xll : false
	};
	//检测平台
	var p = navigator.platform;
	system.win = p.indexOf("Win") == 0;
	system.mac = p.indexOf("Mac") == 0;
	system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
	//跳转语句
	if(system.win||system.mac||system.xll){
		window.location.href = domain+'/denied';
	   ispc = true;
	}
	return ispc;
}




function isname(str,len){
      var namep = /^([\u4e00-\u9fa5]|[\ufe30-\uffa0]|[A-Za-z0-9_-])/;
      if(len){
          namep = /^([\u4e00-\u9fa5]|[\ufe30-\uffa0]|[A-Za-z0-9_-]){6,16}/;
      }
      return namep.test(str);
}

function isqq(str){
     var qqp = /^\d{5,10}/;
     return qqp.test(str);
}

function isemail(str){
    var emailp = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.\-]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    return emailp.test(str);
}

function istel(str){
    var telphonep = /^(13|15|18|17){1}\d{9}$/;
    return telphonep.test(str);
}

function isphone(str){
    var phone = /^(0){1}[0-9]{2,3}(-)?\d{7,8}(\-\d{1,6})?$/;
    return phone.test(str);
}


function isidcard(idcard){
    var cardnumPattern = /^\d{6}((1[89])|(2\d))\d{2}((0\d)|(1[0-2]))((3[01])|([0-2]\d))\d{3}(\d|X)$/i;
    var res = cardnumPattern.test(idcard);
    if(!res){
        var cardnumPattern = /(^\d{15}$)|(^\d{17}([0-9]|X)$)/i;
        var res = cardnumPattern.test(idcard);
    }
    return res;
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