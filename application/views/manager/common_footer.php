<script>
function reloadpage(){
	setTimeout(function(){
		window.location.reload(true);
	},1000)
}
//列表批量排序
function listorder(order_field){
	var str = '';
	var con = '';
	var input_field = 'short_txt';
	if(typeof(order_field) == 'undefined'){
		order_field = 'listorder';
		input_field = order_field;
	}
	$('.'+input_field).each(function(){
		var value = $(this).val();
		var itemid = $(this).attr('itemid');
		str += con+itemid+'-'+value;
		con = ',';
	});
	$.post('<?php echo site_url('manager/publicprocess/listorder')?>', { formhash: '<?php echo formhash(1);?>', dosubmit : 1, data : str , model : '<?php echo $siteclass;?>', order_field : order_field}, function(data) {
		if(data == 'ok'){
			setTimeout(function(){
				window.location.reload();
			},300);
		}
	});
}


//列表批量删除
function delitem(id,o,siteclass){

	var model = typeof(siteclass) != 'undefined' ? siteclass : '<?php echo $siteclass?>';
	var ids = [];
	var imgs = [];
	var reload = 0;
	$('td').find('input[type="checkbox"]:checked').each(function(){
		ids[ids.length] = $(this).val();
	});
	
	if(id=='a' && ids.length > 0){
		if(ids.length <=0 ){
		alert('请选择删除项目');
		return;
	}
	
		if(confirm('确定删除这些信息吗？')){
			doit = true;
			reload = 1;
			for(i=0;i<ids.length;i++){
				imgs[i] = $('#item_'+ids[i]).find('.itempic').attr('href');
			}
			$.post('<?php echo site_url('manager/publicprocess/delete')?>', { formhash: '<?php echo formhash(1);?>', dosubmit : 1, ids : ids , model : model}, function(data) {
					if(data == 'ok'){
						for(i=0;i<ids.length;i++){
							$('#item_'+ids[i]).remove();
						}
						delpic(imgs);
						reloadpage();
					}else{
						
					}
			});
		}
	}else if(id != 'a'){
		if(confirm('确定删除这些信息吗？')){
			doit = true;
			var img = $('#item_'+id).find('.itempic').attr('href');
			$.post('<?php echo site_url('manager/publicprocess/delete')?>', { formhash: '<?php echo formhash(1);?>', dosubmit : 1, ids : id , model : model}, function(data) {
				if(data == 'ok'){
					$(o).parent().parent().remove();
					delpic(img);
					reloadpage();
				}else{
					data = eval( '(' + data + ')' );
					alert(data.message);
				}
			});
		}
	}else{
		alert('请选择删除信息');
	}
	
}

//删除图片
function delpic(pic){
	console.log(typeof(pic));
	if(typeof('pic') == 'object' && pic.length <= 0){
		return false;
	}
	if(pic == '' && typeof('pic') == 'string'){
		return false;
	}
	if(typeof(pic) == 'undefined'){
		return false;
	}
	$.post('<?php echo site_url('manager/publicpicprocess/delete')?>', { pic:pic, dosubmit : 1, formhash: '<?php echo formhash(1);?>' }, function(data) {});
}

//全选操作
function selallck(o){
	if($(o).prop('checked')){
		$('td').find('input[type="checkbox"]').prop('checked',true);
	}else{
		$('td').find('input[type="checkbox"]').prop('checked',false);
	}
}

var allow = 1;
var allow_size = typeof(allow_size) == 'undefined' ? '<?php echo str_replace('M','', ini_get('upload_max_filesize'))*1024*1024?>' : allow_size;

function fileSelected(t){
	var oid = 'Filedata_e';
	if(typeof(t) != 'undefined'){
		oid = t;
	}
	 var oFile = document.getElementById(t).files[0];
	// console.log(document.getElementById('Filedata_e'));
	    // little test for filesize
	    console.log(oFile.size);
	    if(parseInt(oFile.size) > allow_size ){
	    	allow = 0;
	    	var size = allow_size / 1024 / 1024;
	    	alert('图片尺寸不能超过'+( Math.round(size*10)/10)+'M');
	    	return false;
	    }
	    return true;
}

//ajax上传图片 id 输入框ID ，upload指定POST文件对象
function ajaxUpload ( id, upload ) {
  if(typeof('upload') == 'undefined'){
      upload = 'default';
  }
  if(typeof(size) == 'undefined'){
	  size = allow_size;
  }
  
  new AjaxUpload($("#"+id+"_button"),{
    action: "<?php echo site_url('manager/publicpicprocess/upload');?>/"+upload,
    type:"POST",
    data:{ },
    autoSubmit:true,
    responseType:'html',//"json",
    name:upload,
       onChange: function(file, ext){
        var o = this._input;
        var oid = $(o).attr('id');
    	if (!(ext && /^(jpg|jpeg|JPG|JPEG|PNG|gif)$/i.test(ext))) {
            alert('图片格式不正确');
            return false;
        }else{
        	fileSelected(oid);
        	if(allow == 1){
	    		$('#upload_img_tr').show();
		    	$('#uploading').show();
	    	}
	    	if(allow == 0){
	    		return false;
	    	}
        }
    	return true;
    },
    onComplete: function(file, resp){
      if( typeof(resp['error']) != 'undefined' ){
        console.log(resp);
      }else{
        console.log(resp);
        if(resp.indexOf('uploads') < 0){
        	alert(resp);
        }else{
        	$('#'+id).val(resp);
        	alert('图片上传成功');
        }
        if(typeof(upload_callback) == 'function'){
        	upload_callback(resp);
        }
      }
    }
  });
}
$(".ajaxUploadBtn").trigger('click');


//ajax上传文件 id 输入框ID ，upload指定POST文件对象
function ajaxUploadFile ( id, upload ) {
  if(typeof('upload') == 'undefined'){
      upload = 'default';
  }
  new AjaxUpload($("#"+id+"_button"),{
    action: "<?php echo site_url('manager/publicpicprocess/uploadFile');?>/"+upload,
    type:"POST",
    data:{ },
    autoSubmit:true,
    responseType:'html',//"json",
    name:upload,
    onChange: function(file, ext){ },
    onComplete: function(file, resp){
      if( typeof(resp['error']) != 'undefined' ){
        console.log(resp);
      }else{
        console.log(resp);
        $('#'+id).val(resp);
        if(typeof(upload_callback) == 'function'){
        	upload_callback(resp);
        }
        alert('文件上传成功');
      }
    }
  });
}



$(function(){
	var tdl = $('table').find('thead').find('th').length;
	$('table').find('tfoot').find('td').attr('colspan', tdl);

	var no_data_td = $('table').find('tbody').find('td').length;
	if(no_data_td == 1){
		$('table').find('tbody').find('td').attr('colspan', tdl);
	}
})
</script>

<script>
var curpage = '<?php echo !empty($GLOBALS['curpage']) ? $GLOBALS['curpage'] : ''?>';
var perpage = '<?php echo !empty($GLOBALS['perpage']) ? $GLOBALS['perpage'] : ''?>';


$('table tbody tr').each(function(i,d ){
	//console.log($(this).find("td:eq(0)").html());
	var v = $(this).find("td:eq(0)").find('input').val();
	//console.log(v);
	if( typeof(v) == 'undefined'){
		var p = parseInt($(this).find("td:eq(0)").text());
	}else{
		var p = parseInt($(this).find("td:eq(1)").text());
	}
	
	if(curpage > 1 && $('table tbody tr').length > 1) {
		if(typeof(v) == 'undefined'){
			console.log(parseInt(p + (curpage - 1 )*perpage));
			$(this).find("td:eq(0)").html(parseInt(p+(curpage - 1 )*perpage))
		}else{
			$(this).find("td:eq(1)").html(parseInt(p+(curpage - 1 )*perpage))
		}
	}
});
$(function(){
	$('input[type="button"]').addClass('input-button');
})

</script>


<script>
	function fill_name(obj, tar){

		var str = $(obj).find('option:selected').text();
		if(obj.value>0 && obj.value != ''){
			$('#'+tar).val(str);
		}else{
			$('#'+tar).val('');
		}
	} 
</script>

<style>
	.td-foot-bg a {
		margin:0 8px;
	}
</style>
</body>
</html>