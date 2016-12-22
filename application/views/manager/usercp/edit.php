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
</script>
  <div class="set-area">
    <form method="POST" action="" id="form">
      <input type="hidden" name="data[id]" value="<?=!empty($vo['id']) ? $vo['id'] : '';?>" />
      <div class="form">
      
        <div class="form-row">
          <label for="username" class="form-field">用户名</label>
          <div class="form-cont">
            <input id="username" type="text" name="data[username]" readonly class="input-txt" value="<?=!empty($vo['username']) ? $vo['username'] : '';?>" />
          </div>
        </div>
        
        <div class="form-row">
          <label for="realname" class="form-field">真实姓名</label>
          <div class="form-cont">
            <input id="realname" type="text" name="data[realname]" class="input-txt" value="<?=!empty($vo['realname']) ? $vo['realname'] : '';?>" />
          </div>
        </div>
		
		 <div class="form-row">
          <label for="sex" class="form-field">性别</label>
          <div class="form-cont">
            <?=$vo['sex'] == 1 ? '男' : '女';?>
          </div>
        </div>
		
	
		
      <div class="form-row">
          <label for="mobile" class="form-field">手机号</label>
          <div class="form-cont">
            <input id="mobile" type="text" name="data[mobile]" class="input-txt" value="<?=!empty($vo['mobile']) ? $vo['mobile'] : '';?>" />
          </div>
        </div>

    

        
         <div class="form-row">
          <label for="password" class="form-field">密码</label>
            <div class="form-cont">
				<input id="password" type="text" name="data[password]" class="input-txt" value="" />不修改请留空           
           </div>
        </div>
        
      
        
         <div class="form-row">
          <label for="email" class="form-field">头像</label>
            <div class="form-cont">
			<?=!empty($vo['headimgurl']) ? '<a href="'.$vo['headimgurl'].'" target="_blank" title="查看大头像"><img style="width:100px;" src="'.$vo['headimgurl'].'"></a>' : '<img src="/static/web/img/pic08.jpg">';?>    
           </div>
        </div>
        
        <div class="btn-area">
          <input type="submit" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>
<script>
function checkForm(){
	return true;
}
<?php 
if(!empty($msg)){
	?>
alert('<?php echo $msg?>');
	<?php 
}
?>
</script>

