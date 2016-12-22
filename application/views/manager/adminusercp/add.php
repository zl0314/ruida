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
    <form method="POST" action="">
      <input type="hidden" name="data[id]" value="<?php echo $vo['id'];?>" />
      <div class="form">
        <div class="form-row">
          <label for="username" class="form-field">登录账号</label>
          <div class="form-cont">
            <?php if( !empty($vo['id'])):?>
            <?php echo $vo['username'];?>
            <?php else:?>
            <input id="username" type="text" name="data[username]" class="input-txt" value="<?php echo $vo['username'];?>" />
            <?php endif;?>
          </div>
        </div>
        <div class="form-row">
          <label for="password" class="form-field">登录密码</label>
          <div class="form-cont">
            <input id="password" type="password" name="data[password]" class="input-txt" value="" />
          </div>
        </div>
		<div class="form-row">
          <label for="password" class="form-field">重复登录密码</label>
          <div class="form-cont">
            <input id="password2" type="password" name="data[password2]" class="input-txt" value="" />
          </div>
        </div>
        <div class="form-row">
          <label for="nickname" class="form-field">真实姓名</label>
          <div class="form-cont">
            <input id="nickname" type="text" name="data[nickname]" class="input-txt" value="<?php echo $vo['nickname'];?>" />
          </div>
        </div>
        <!--  <div class="form-row" id="form_1">
          <label for="" class="form-field">权限</label>
          <div class="form-cont">
            <label>
              <input type="radio" <?php if( $vo['is_root'] == 1):?> checked="checked"<?php endif;?> name="data[is_root]" value="1" />
              超级管理员</label>
            <label>
              <input type="radio" <?php if( $vo['is_root'] == 0):?> checked="checked"<?php endif;?> name="data[is_root]" value="0" />
              一般权限 </label>
          </div>
        </div>
        -->
        <input type="hidden" value="<?php echo $vo['is_root'];?>" name="data[is_root]" />
        <div class="btn-area">
          <input type="submit" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>
