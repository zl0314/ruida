//弹出对话框
function omnipotent(id,linkurl,title,close_type,w,h) {
	if(!w) w=810;
	if(!h) h=500;
	art.dialog({id:id,iframe:linkurl, title:title, width:w, height:h, lock:true},
	function(){
		if(close_type==1) {
			art.dialog({id:id}).close()
		} else {
			var d = art.dialog({id:id}).data.iframe;
			var form = d.document.getElementById('dosubmit');form.click();
		}
		return false;
	},
	function(){
			art.dialog({id:id}).close()
	});void(0);
}

function remove_ajax_item(sid,id, itemid) {
	var relation_ids = $('#'+itemid).val();
	if(relation_ids !='' ) {
		$('#'+sid).remove();
		var r_arr = relation_ids.split('|');
		var newrelation_ids = '';
		$.each(r_arr, function(i, n){
			if(n!=id) {
				if(i==0) {
					newrelation_ids = n;
				} else {
				 newrelation_ids = newrelation_ids+'|'+n;
				}
			}
		});
		$('#'+itemid).val(newrelation_ids);
	}
}

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