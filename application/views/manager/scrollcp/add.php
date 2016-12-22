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
      <input type="hidden" name="data[id]" id="recordid" value="<?=!empty($row['id']) ? $row['id'] : '';?>" />
      <div class="form">

        <div class="form-row">
          <label for="listorder" class="form-field">广告名称</label>
          <div class="form-cont">
            <input class="input-txt" id="listorder" type="text" name="data[title]" value="<?=!empty($row['title']) ? $row['title'] : '';?>">
          </div>
        </div>
      
      

      <div class="form-row">
          <label for="coverpic" class="form-field">封面图片</label>
          <div class="form-cont">
            <input id="coverpic" type="text" name="data[coverpic]" readonly class="input-txt" value="<?=!empty($row['coverpic']) ? $row['coverpic'] : '';?>" />
            <input type="button" class="ajaxUploadBtn" id="coverpic_button" onclick="ajaxUpload('coverpic','ad')" value="上传图片" style="width:70px; height:25px;">
            <p>
              手机端宽640像素，高431像素
            </p>
          </div>
        </div>
		<div class="form-row">
          <label for="coverpic_url" class="form-field">封面图片链接地址</label>
          <div class="form-cont">
            <input class="input-txt" id="coverpic_url" type="text" name="data[coverpic_url]" value="<?=!empty($row['coverpic_url']) ? $row['coverpic_url'] : '';?>">
          </div>
        </div>
		
		
		<div class="form-row">
          <label for="toppic" class="form-field">顶部图片</label>
          <div class="form-cont">
            <input id="toppic" type="text" name="data[toppic]" readonly class="input-txt" value="<?=!empty($row['toppic']) ? $row['toppic'] : '';?>" />
            <input type="button" class="ajaxUploadBtn" id="toppic_button" onclick="ajaxUpload('toppic','ad')" value="上传图片" style="width:70px; height:25px;">
            <p>
              手机端宽640像素，高431像素
            </p>
          </div>
        </div>
		<div class="form-row">
          <label for="toppic_url" class="form-field">顶部图片链接地址</label>
          <div class="form-cont">
            <input class="input-txt" id="toppic_url" type="text" name="data[toppic_url]" value="<?=!empty($row['toppic_url']) ? $row['toppic_url'] : '';?>">
          </div>
        </div>
		
		
		<div class="form-row">
          <label for="bottompic" class="form-field">底部图片</label>
          <div class="form-cont">
            <input id="bottompic" type="text" name="data[bottompic]" readonly class="input-txt" value="<?=!empty($row['bottompic']) ? $row['bottompic'] : '';?>" />
            <input type="button" class="ajaxUploadBtn" id="bottompic_button" onclick="ajaxUpload('bottompic','ad')" value="上传图片" style="width:70px; height:25px;">
            <p>
              手机端宽640像素，高431像素
            </p>
          </div>
        </div>
		<div class="form-row">
          <label for="bottompic_url" class="form-field">底部图片链接地址</label>
          <div class="form-cont">
            <input class="input-txt" id="bottompic_url" type="text" name="data[bottompic_url]" value="<?=!empty($row['bottompic_url']) ? $row['bottompic_url'] : '';?>">
          </div>
        </div>

   
	
        
        <div class="btn-area">
          <input type="button" onclick="checkForm()" value="保 存" style="width:70px; height:25px;">
        </div>
      </div>
    </form>
  </div>
</div>
<script>

function checkForm(){
	
	$('#form').submit();
}
</script>
<script>
  function getProject(obj){
    var project = $(obj).val();
    if(project == 'project-show'){
      $('#project').show();
    }else{
      $('#project').hide();
    }
  }
</script>

