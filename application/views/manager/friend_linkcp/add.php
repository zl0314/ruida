
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
          <label for="title" class="form-field">标题</label>
          <div class="form-cont">
            <input id="title" type="text" name="data[name]" class="input-txt" value="<?=!empty($vo['name']) ? $vo['name'] : '';?>" />
          </div>
        </div>
        
        <div class="form-row">
          <label for="title" class="form-field">链接</label>
          <div class="form-cont">
            <input id="title" type="text" name="data[link_url]" class="input-txt" value="<?=!empty($vo['link_url']) ? $vo['link_url'] : '';?>" />
          </div>
        </div>
        
        <div class="form-row">
          <label for="listorder" class="form-field">排序</label>
          <div class="form-cont">
            <input id="listorder" type="text" name="data[listorder]" class="input-txt" value="<?=isset($vo['listorder']) ? $vo['listorder'] : '0';?>" />
            <p>数字越大，排名越前</p>
          </div>
        </div>
        
        <div class="form-row">
          <label for="listorder" class="form-field">是否显示</label>
            <div class="form-cont">
            <input class="input-radio" id="isshow" <?php if($vo['isshow'] == 1 ){echo 'checked';}?> type="radio" name="data[isshow]"value="1"> 显示&nbsp;&nbsp;
			 <input class="input-radio" id="isshow" <?php if($vo['isshow'] == 0){echo 'checked';}?> type="radio" name="data[isshow]"value="0"> 不显示
          </div>
        </div>
        
        <div class="btn-area">
          <input type="submit" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>

