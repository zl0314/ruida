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
            <?=!empty($vo['username']) ? $vo['username'] : '';?>
          </div>
        </div>
        
        <div class="form-row">
          <label for="realname" class="form-field">真实姓名</label>
          <div class="form-cont">
            <?=!empty($vo['realname']) ? $vo['realname'] : '';?>
          </div>
        </div>
        
        
        <div class="form-row">
          <label for="mobile" class="form-field">手机号</label>
          <div class="form-cont">
            <?=!empty($vo['mobile']) ? $vo['mobile'] : '';?>
          </div>
        </div>
       
         
        
        <div class="form-row">
          <label for="email" class="form-field">注册时间</label>
            <div class="form-cont">
			<?=!empty($vo['addtime']) ? date('Y-m-d H:i:s',$vo['addtime']) : '';?>    
           </div>
        </div>
        
        
        
         <div class="form-row">
          <label for="email" class="form-field">头像</label>
            <div class="form-cont">
			<?=!empty($vo['headimgurl']) ? '<a href="'.$vo['headimgurl'].'" target="_blank" title="查看大头像"><img src="'.getNewImg($vo['headimgurl'],'headpic',false).'"></a>' : '<img src="/static/web/img/pic08.jpg">';?>    
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

