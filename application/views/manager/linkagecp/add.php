<?php if(!empty($parent_linkage)): ?>
<div style="font-weight: bold;font-size:19px; margin:10px 0">
  所属城市　： <?php echo $parent_linkage['name'] ?>
</div>
<?php endif; ?>
  <div class="set-area">
    <form method="POST" action="" id="form">
    <?php if(empty($parentid)): ?>
      <input type="hidden" name="data[id]" value="<?=!empty($vo['id']) ? $vo['id'] : '';?>" />
    <?php else: ?>
      <input type="hidden" name="data[parentid]" value="<?=request_get('parentid')?>" />
    <?php endif; ?>

       
        <div class="form-row">
          <label for="title" class="form-field">名称</label>
          <div class="form-cont">
            <?php if(!empty($vo['id'])): ?>
            <input id="name" type="text" name="data[name]" class="input-txt" value="<?=!empty($vo['name']) ? $vo['name'] : '';?>" />
          <?php else: ?>
            <textarea name="data[name]" id="name" class="input-area"></textarea><br>输入名称， 一行一个名称。如： <br>朝阳<br>张北县
          <?php endif; ?>
          </div>
        </div>

        <?php if($parentid == 0 && $vo['parentid'] ==0 && !empty($vo['id'])):?>
          <div class="form-row">
          <label for="pic" class="form-field">省图片</label>
          <div class="form-cont">
            <input id="pic" type="text" name="data[pic]" readonly class="input-txt" value="<?php echo !empty($vo['pic']) ? $vo['pic'] : '';?>" />
            <input type="button" class="ajaxUploadBtn" id="pic_button" onclick="ajaxUpload('pic','linkage')" value="上传图片" style="width:70px; height:25px;">
            
          </div>
        </div>
        <?php endif;?>
        
        <?php if(!empty($vo['id'])):?>

         <div class="form-row">
              <label for="name" class="form-field">推荐到招聘首页城市列表</label>
              <div class="form-cont">
                  
                   <select name="data[recommend_to_job_index]" id="recommend_to_job_index">
                        <option value="0">请选择</option>
                        <?php foreach ($recommend as $k => $v)  :?>
                        <option value="<?= $k ?>" <?php if(!empty($vo['recommend_to_job_index']) && $vo['recommend_to_job_index'] == $k){ echo 'selected';} ?> ><?= $v ?></option>
                        <?php endforeach?>
                    </select>
              </div>
              </div>
        <?php endif;?>

        <div class="btn-area">
          <input type="submit" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>

