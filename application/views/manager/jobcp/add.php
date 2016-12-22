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
                <label for="worker_age" class="form-field">工作年限</label>
                <div class="form-cont">
                    <input id="worker_age" type="text" required name="data[worker_age]" class="input-txt" value="<?=!empty($vo['worker_age']) ? $vo['worker_age'] : '';?>" />
                </div>
                </div>
                
                     <!--<div class="form-row">
          <label for="toppic" class="form-field">详情页顶部图片</label>
          <div class="form-cont">
            <input id="toppic" type="text" name="data[toppic]" readonly class="input-txt" value="<?=!empty($vo['toppic']) ? $vo['toppic'] : '';?>" />
            <input type="button"class="ajaxUploadBtn"  id="toppic_button" onclick="ajaxUpload('toppic','job')" value="上传图片" style="width:70px; height:25px;">
            <p>建议大小宽980px，高339px</p>
          </div>
        </div>-->
                
             <div class="form-row">
            <label for="fuli" class="form-field">福利待遇</label>
            <div class="form-cont">
                <input id="fuli" type="text" required name="data[fuli]" class="input-txt" value="<?=!empty($vo['fuli']) ? $vo['fuli'] : '';?>" />
                请用“,”隔开， 例如：开放式环境,免费三餐,五险一金
            </div>
            </div>


         <div class="form-row">
                <label for="intro" class="form-field">列表描述信息</label>
                <div class="form-cont">
                   <textarea name="data[intro]" class="input-area" id="intro" ><?=!empty($vo['intro']) ? $vo['intro'] : '';?></textarea>
                </div>
                </div>
                
           

            <div class="form-row">
          <label for="duty" class="form-field">工作职责</label>
          <div class="form-cont">
            <script  name="data[duty]" id="duty" type="text/html" style="width:750px;height:450px;"><?=!empty($vo['duty']) ?  htmlspecialchars_decode($vo['duty']) : '';?></script>
          </div>
        </div>

            <div class="form-row">
                <label for="ability" class="form-field">工作要求</label>
                <div class="form-cont">
                    <script  name="data[ability]" id="ability" type="text/html" style="width:750px;height:450px;"><?=!empty($vo['ability']) ?  htmlspecialchars_decode($vo['ability']) : '';?></script>
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
var ue = UE.getEditor('duty');
var ue = UE.getEditor('ability');

</script>
