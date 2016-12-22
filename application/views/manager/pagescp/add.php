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
          <label for="name" class="form-field">标题</label>
          <div class="form-cont">
            <input id="name" type="text" name="data[name]" class="input-txt" value="<?=!empty($vo['name']) ? $vo['name'] : '';?>" />
          </div>
        </div>
        
       <div class="form">
        <div class="form-row"> 
          <label for="hook" class="form-field">   选择模板</label>
            <select id="hook" name="data[hook]">
            <option value="">请选择</option>
            <?php
            if(!empty($template_arr)){
			 foreach( $template_arr as $k => $v ):?>
	            <option <?php if(!empty($vo['hook'])){ echo ( $k == $vo['hook'])?'selected="selected"':'';}?> value="<?php echo $k?>"><?php echo $v?></option>
	            <?php endforeach;
	            }
	            ?>
            </select>
        </div>
        </div>
        <div class="form-row">
          <label for="content" class="form-field">内容</label>
          <div class="form-cont">
          <script id="content" name="data[content]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['content']) ? $vo['content'] : '';?></script>
            </div>
        </div>
        <div class="btn-area">
          <input type="submit" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" charset="utf-8" src="/static/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/static/ueditor1_4_3/editor_api.js"></script>
<script type="text/javascript" charset="utf-8" src="/static/ueditor1_4_3/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" charset="utf-8">
var ue = UE.getEditor('content');
</script>
