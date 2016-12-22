
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
      <input type="hidden" name="data[id]" id="recordid" value="<?php echo !empty($vo['id']) ? $vo['id'] : '';?>" />
      <div class="form">
      
      <div class="form-row">
          <label for="pos" class="form-field" >所属位置</label>
          <div class="form-cont">
          	<select id="pos" name="data[pos]" >
            <option value="">选择位置</option>
            <?php
             foreach( $posArr as $k => $v ):
             	$pos = '';
	            if($vo['poscontent']){
	            	$pos = $vo['pos'].'|'.$vo['poscontent'];
	            }else{
	            	$pos = $vo['pos'];
	            }
            ?>
            <option <?php echo ( $k == $pos )?'selected="selected"':'';?> value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php endforeach;?>
            </select>
            
          </div>
        </div>
       

      
		<div class="form-row">
          <label for="pic" class="form-field">图片</label>
          <div class="form-cont">
            <input id="pic" type="text" name="data[pic]" readonly class="input-txt" value="<?php echo !empty($vo['pic']) ? $vo['pic'] : '';?>" />
            <input type="button" class="ajaxUploadBtn" id="pic_button" onclick="ajaxUpload('pic','scrollpic')" value="上传图片" style="width:70px; height:25px;">
            <p>首页推荐大小为宽4920像素，高768像素 <br> 用户登录&用户注册页面宽1920像素  高592像素 <br>其它页面宽1920像素，高419像素。<br>
              手机端宽640像素，高221像素
            </p>
          </div>
        </div>
		
		 <div class="form-row">
          <label for="url" class="form-field">链接地址</label>
          <div class="form-cont">
            <input class="input-txt" id="url" type="text" name="data[url]"value="<?php echo !empty($vo['url']) ? $vo['url'] : '';?>">
            可以留空
          </div>
        </div>

		 <div class="form-row">
          <label for="listorder" class="form-field">排序</label>
          <div class="form-cont">
            <input class="input-txt" id="listorder" type="text" name="data[listorder]" value="<?php echo !empty($vo['listorder']) ? $vo['listorder'] : '0';?>">数值越小越靠前 </div>
        </div>
        
        
        <div class="btn-area">
          <input type="submit" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>