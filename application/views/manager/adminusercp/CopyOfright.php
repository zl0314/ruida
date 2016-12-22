<?php $this->load->view('common_header');?>
<script>
$(function(){
  $('#skinlist li').click(function(){
    $('#skinlist li').removeClass('current');
    $(this).addClass('current');
    i = $(this).index();
    $('.form').hide();
    $('.form:eq('+i+')').show();
    });
});
function checkPrivileges(a, b){	
	var c = document.getElementsByName("privileges["+a+"][]");
	var checkd = b=='on' ? true : false;
	for (var i=0; i<c.length; i++){
		c[i].checked = checkd;
	}
}

function checkALLPrivileges(b){	
	<?php foreach($classmenu as $k => $r):?>
	checkPrivileges('<?php echo $r?>', b);
	<?php endforeach;?>
}

</script>
<link type="text/css" rel="stylesheet" href="/static/admin/admincp.css" media="screen" />

  <div class="set-area">
    
<form method="post" action="" >
<input type="hidden" name="user_id" value="<?php echo $vo['id'];?>" />
  <div class="table_div">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
      <tbody>
	  	 <tr class="tr1">
          <td width="22%" height="35" align="right"><p class="b">管理员ID：</p></td>
          <td colspan="2" align="left"><?php echo $vo['id'];?></td>
        </tr>
        <tr>
          <td height="35" align="right"><p class="b">管理员登录名：</p></td>
          <td colspan="2" align="left"><?php echo $vo['username'];?> (<?php echo $vo['nickname'];?>)</td>
        </tr>
      </tbody>
    </table>
  </div>
  
  
   <div class="table_div">
   <div class="title" style="margin-bottom:10px;">全局权限&nbsp;&nbsp;
   (<a href="javascript:;" onclick="checkALLPrivileges('on');">全选</a> / <a href="javascript:;" onclick="checkALLPrivileges('off');">反选</a>)</div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
      <tbody>
        <?php 
        $i = 0;
        foreach($privilegesmenu as $k => $v):?>
        <?php $i++?>
        <tr class="<?php if ($i%2==0):?>tr1<?php endif;?>">
          <td width="22%" height="35" align="right"><p class="b"><?php echo $v['menuhtml'];?>：</p></td>
          <td colspan="2" align="left">
		  <?php echo $v['checkhtml'];?>
		  </td>
        </tr>
		<?php endforeach;?>
		
      </tbody>
    </table>
  </div>
  
  
  <div class="table_div align_c">
    <input type="submit" id="SubmitBtn" value="确 定" class="button100" />
	<input type="button" value="返 回" class="button100" onclick="window.location.href='<?php echo site_url('adminuser')?>'" />
    <input type="hidden" name="formhash" value="<?php echo formhash()?>" />
    <input type="hidden" name="dosubmit" value="1" />
  </div>
</form>
  </div>
</div>
<script>
/*
$(function(){
	$('.checkbox').click(function(){
		console.log($(this).is(':checked'));
		var t = $(this).is(':checked')?"checked":false;
		$(this).parents('.checkbox_parent').find('input.'+$(this).val()).attr('checked' , $(this).is(':checked') );
		
	});
});*/
</script>
<?php $this->load->view('common_footer');?>
