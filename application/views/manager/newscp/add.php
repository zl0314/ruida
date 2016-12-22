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
    <form method="POST" action="" id="form" onsubmit="return checkForm()">
        <input type="hidden" name="data[id]" value="<?=!empty($vo['id']) ? $vo['id'] : '';?>" />
        
        <div class="form">

            <div class="form-row">
                <label for="name" class="form-field">标题</label>
                <div class="form-cont">
                    <input id="name" type="text" required name="data[title]" class="input-txt" value="<?=!empty($vo['title']) ? $vo['title'] : '';?>" />
                </div>
                </div>

              <div class="form-row">
              <label for="name" class="form-field">新闻分类</label>
              <div class="form-cont">
                  
                   <select name="data[type]" id="type">
                        <option value="0">请选择</option>
                        <option value="1" <?php if(!empty($vo['type']) && $vo['type'] == 1){ echo 'selected';} ?> >品牌新闻</option>
                        <option value="2" <?php if(!empty($vo['type']) && $vo['type'] == 2){ echo 'selected';} ?> >项目动态</option>
                    </select>
              </div>
              </div>


         <div class="form-row">
          <label for="thumb" class="form-field">缩略图</label>
          <div class="form-cont">
            <input id="thumb" type="text" name="data[thumb]" readonly class="input-txt" value="<?=!empty($vo['thumb']) ? $vo['thumb'] : '';?>" />
            <input type="button"class="ajaxUploadBtn"  id="thumb_button" onclick="ajaxUpload('thumb','project_news')" value="上传图片" style="width:70px; height:25px;">
            <p>建议大小宽180px，高180px</p>
          </div>
        </div> 
        

            <div class="form-row">
          <label for="content" class="form-field">内容</label>
          <div class="form-cont">
            <script  name="data[content]" id="content" type="text/html" style="width:750px;height:450px;"><?=!empty($vo['content']) ?  htmlspecialchars_decode($vo['content']) : '';?></script>
          </div>
        </div>

        <div class="form-row">
          <label for="listorder" class="form-field">发布时间</label>
          <div class="form-cont">
            <input type="text" name="data[fb_time]" class="input-txt Wdate"   onClick="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',readOnly:true})" value="<?=!empty($vo['fb_time']) ? date('Y-m-d H:i:s',($vo['fb_time'])) : date('Y-m-d H:i:s');?>">
          </div>
        </div>

             <div class="form-row">
                <label for="name" class="form-field">排序</label>
                <div class="form-cont">
                    <input id="name" type="text" required name="data[listorder]" class="input-txt" value="<?=isset($vo['listorder']) ? $vo['listorder'] : '1';?>" />
                    数值越大越靠前
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
