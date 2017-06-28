<?php if(!empty($parent_linkage)): ?>
<div style="font-weight: bold;font-size:19px; margin:10px 0">
  所属地铁　： <?php echo $parent_linkage['name'] ?>
</div>
<?php endif; ?>
  <div class="set-area">
    <form method="POST" action="" id="form">
    <?php if(empty($parentid)): ?>
      <input type="hidden" name="data[id]" value="<?=!empty($vo['id']) ? $vo['id'] : '';?>" />
    <?php else: ?>
      <input type="hidden" name="data[parentid]" value="<?=request_get('parentid')?>" />
    <?php endif; ?>

      <div class="form">
        <div class="form-row">
          <label for="title" class="form-field">名称</label>
          <div class="form-cont">
            <?php if(!empty($vo['id'])): ?>
            <input id="name" type="text" name="data[name]" class="input-txt" value="<?=!empty($vo['name']) ? $vo['name'] : '';?>" />
          <?php else: ?>
            <textarea name="data[name]" id="name" class="input-area"></textarea><br>输入名称， 一行一个名称。如： <br>2号线<br>4号线
          <?php endif; ?>
          </div>
        </div>
        
        <div class="btn-area">
          <input type="submit" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>

