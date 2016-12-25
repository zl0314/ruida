
<div class="set-area">
    <form method="POST" action="" id="form" onsubmit="return checkForm()">
        <input type="hidden" name="data[id]" value="<?=!empty($vo['id']) ? $vo['id'] : '';?>" />
        <div class="form">

            <div class="form-row">
                <label for="title" class="form-field">标题</label>
                <div class="form-cont">
                    <input id="title" type="text" required name="data[title]" class="input-txt" value="<?=!empty($vo['title']) ? $vo['title'] : '';?>" />
                </div>
            </div>

            <div class="form-row">
                <label for="second_title" class="form-field">详情页副标题</label>
                <div class="form-cont">
                    <input id="second_title" type="text" required name="data[second_title]" class="input-txt" value="<?=!empty($vo['second_title']) ? $vo['second_title'] : '';?>" />
                </div>
            </div>

          <div class="form-row">
                <label for="house_cert_year" class="form-field">房本满</label>
                <div class="form-cont">
                    <input id="house_cert_year" type="text"  name="data[house_cert_year]" class="input-txt" value="<?=!empty($vo['house_cert_year']) ? $vo['house_cert_year'] : '';?>" /> 年
                </div>
            </div>

             <div class="form-row">
                <label for="village" class="form-field">小区名称</label>
                <div class="form-cont">
                    <input id="village" type="text" required name="data[village]" class="input-txt" value="<?=!empty($vo['village']) ? $vo['village'] : '';?>" />
                </div>
            </div>
          

             <div class="form-row">
                <label for="label" class="form-field">列表页面标签</label>
                <div class="form-cont">
                    <input id="label" type="text"  name="data[label]" class="input-txt" value="<?=!empty($vo['label']) ? $vo['label'] : '';?>" />
                    请用”,”逗号隔开,例如：免卫生费,免水费
                </div>
            </div>

            <div class="form-row">
                <label for="watch_time" class="form-field">看房时间</label>
                <div class="form-cont">
                    <input id="watch_time" type="text" required name="data[watch_time]" class="input-txt" value="<?=!empty($vo['watch_time']) ? $vo['watch_time'] : '';?>" />
                </div>
            </div>
  <div class="form-row">
                <label for="thumb" class="form-field">缩略图</label>
                <div class="form-cont">
                  <input id="thumb" type="text" name="data[thumb]"  class="input-txt" value="<?=!empty($vo['thumb']) ? $vo['thumb'] : '';?>" />
                  <input type="button"class="ajaxUploadBtn"  id="thumb_button" onclick="ajaxUpload('thumb','house')" value="上传图片" style="width:70px; height:25px;">
                  <span class="form-tips">宽232px, 高174px</span>
                </div>
              </div>

        <div class="form-row">
                <label for="type" class="form-field">房源类型</label>
                <div class="form-cont">
                        <select name="data[type]" required onchange="show_type(this)"> 
                            <option value="0">请选择</option>
                              <?php if(!empty($type)):?>
                                <?php foreach ($type as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['type']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                </div>
            </div>

      <div class="house_type" id="rent_salse_type" style="display: <?php if(!empty($vo) && $vo['type'] == 1){ echo 'block'; }else{echo 'none';} ?>;">
            <div class="form-row">
                <label for="second_title" class="form-field">出租/出售</label>
                <div class="form-cont">
                    <select name="data[sales_type]" required> 
                          <option value="0">请选择</option>
                            <?php if(!empty($sales_type)):?>
                              <?php foreach ($sales_type as $k => $r): ?>
                                      <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['sales_type']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                              <?php endforeach ?>
                          <?php endif; ?>
                      </select>
                </div>
            </div>
        </div>

<div class="house_type" id="bus_house_div" style="display: <?php if(!empty($vo) && $vo['type'] != 4){ echo 'block'; }else{echo 'none';} ?>;">
            <div class="form-row">
                <label for="total_price" class="form-field">总价</label>
                <div class="form-cont">
                    <input id="total_price" type="text"  name="data[total_price]" class="input-txt" value="<?=!empty($vo['total_price']) ? $vo['total_price'] : '';?>" /> 万/元
                </div>
            </div>
            <div class="form-row">
                <label for="unit_price" class="form-field">单价</label>
                <div class="form-cont">
                    <input id="unit_price" type="text"  name="data[unit_price]" class="input-txt" value="<?=!empty($vo['unit_price']) ? $vo['unit_price'] : '';?>" /> 元/平米
                </div>
            </div>
</div>

          <div class="house_type" id="new_house_div" style="display: <?php if(!empty($vo) && $vo['type'] == 4){ echo 'block'; }else{ echo 'none';} ?>;">
              <div class="form-row">
                  <label for="month_price" class="form-field">每月价格</label>
                  <div class="form-cont">
                      <input id="month_price" type="text"  name="data[month_price]" class="input-txt" value="<?=!empty($vo['month_price']) ? $vo['month_price'] : '';?>" /> 元/月
                  </div>
              </div>

                            <div class="form-row">
                  <label for="build_acreage" class="form-field">建筑面积</label>
                  <div class="form-cont">
                      <input id="build_acreage" type="text"  name="data[build_acreage]" class="input-txt" value="<?=!empty($vo['build_acreage']) ? $vo['build_acreage'] : '';?>" /> m²
                  </div>
              </div>

              <div class="form-row">
                  <label for="address" class="form-field">详细地址</label>
                  <div class="form-cont">
                      <input id="address" type="text"  name="data[address]" class="input-txt" value="<?=!empty($vo['address']) ? $vo['address'] : '';?>" />
                  </div>
              </div>
            </div>
<script>
  function show_type(obj){
    $('.house_type').hide();
    if(obj.value == 4){
        $('#new_house_div').show();
    }else if(obj.value == 1){
        $('#bus_house_div').show();
        $('#rent_salse_type').show();
    }else if(obj.value != 4){
        $('#bus_house_div').show();
    }
  }
</script>
            <div class="form-row">
                <label for="area" class="form-field">所在区域</label>
                <div class="form-cont">
                    <select name="data[province_id]" id="province_id" required onchange="get_sub_area(this,'','city_id')"> 
                        <option value="0">请选择</option>
                         <?php if(!empty($area)):?>
                                <?php foreach ($area as $k => $r): ?>
                                        <option value="<?php echo $r['id'] ?>" <?php if(!empty($vo) && $r['id'] == $vo['province_id']): ?> selected <?php endif; ?>  ><?php echo $r['name']; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                    </select>
                    <select name="data[city_id]" id="city_id" required  onchange="get_sub_area(this,'','area_id')">
                        <option value="0">请选择</option>
                    </select>
                    <select name="data[area_id]" id="area_id" required  onchange="get_sub_area(this,'', 'address_id')">
                        <option value="0">请选择</option>
                    </select>
                    <select name="data[address_id]" id="address_id" required  onchange="get_sub_area(this,'', '')">
                        <option value="0">请选择</option>
                    </select>

                    位于 <input type="text" name="data[huan]" id="" value="<?=!empty($vo['huan']) ? $vo['huan'] : '';?>" class="short_txt"> 环，
                    距地铁 
                      <select name="data[subway]"  required onchange="get_subway_station(this)">
                        <option value="">请选择</option>
                        <?php if(!empty($subway)): ?>
                          <?php foreach ($subway as $key => $r): ?>
                            <option value="<?php echo $r['id'] ?>" <?php if(!empty($vo) && $r['id'] == $vo['subway']): ?> selected <?php endif; ?>><?php echo $r['name'] ?></option>
                          <?php endforeach ?>
                        <?php endif; ?>
                      </select>
                    线，
                    地铁站
                      <select name="data[subway_station]" required id="subway_station">
                        <option value="">请选择</option>
                      </select>站
                      <input type="text" name="data[meter]" id="" value="<?=!empty($vo['meter']) ? $vo['meter'] : '';?>"  class="short_txt">米
                </div>
            </div>


            <div class="form-row">
                <label for="chaoxiang" class="form-field">朝向</label>
                <div class="form-cont">
                   <select name="data[chaoxiang]" required>
                       <option value="0">请选择</option>
                       <?php if(!empty($chaoxiang)):?>
                                <?php foreach ($chaoxiang as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['chaoxiang']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                   </select>
                    &nbsp;&nbsp;&nbsp;
                   详情页下方文字 <input type="text" name="data[chaoxiang_txt]" value="<?=!empty($vo['chaoxiang_txt']) ? $vo['chaoxiang_txt'] : '';?>"class="input-txt">
                </div>
            </div>

             <div class="form-row">
                <label for="ting_shi" class="form-field">厅室</label>
                <div class="form-cont">
                       <input type="text" required name="data[ting]" id="" value="<?=!empty($vo['ting']) ? $vo['ting'] : '';?>"class="short_txt"> 厅
                       <input type="text" required name="data[shi]" id="" value="<?=!empty($vo['shi']) ? $vo['shi'] : '';?>"class="short_txt"> 室
                   &nbsp;&nbsp;&nbsp;详情页下方文字 <input type="text" name="data[ting_shi_txt]" value="<?=!empty($vo['ting_shi_txt']) ? $vo['ting_shi_txt'] : '';?>"class="input-txt">
                </div>
            </div>

             <div class="form-row">
                <label for="acreage" class="form-field">面积</label>
                <div class="form-cont">
                       <input type="text" required name="data[acreage]" value="<?=!empty($vo['acreage']) ? $vo['acreage'] : '';?>" class="short_txt" > 平米
                   &nbsp;&nbsp;&nbsp;详情页下方文字 <input type="text" value="<?=!empty($vo['acreage_txt']) ? $vo['acreage_txt'] : '';?>"name="data[acreage_txt]" class="input-txt">
                </div>
            </div>


             <div class="form-row">
                <label for="zhuangxiu" class="form-field">装修程度</label>
                <div class="form-cont">
                        <select name="data[zhuangxiu]" required> 
                            <option value="0">请选择</option>
                            <?php if(!empty($zhuangxiu)):?>
                                <?php foreach ($zhuangxiu as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['zhuangxiu']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                </div>
            </div>


             <div class="form-row">
                <label for="dianti" class="form-field">有无电梯</label>
                <div class="form-cont">
                        <select name="data[dianti]" required> 
                            <option value="0">请选择</option>
                              <?php if(!empty($dianti)):?>
                                <?php foreach ($dianti as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['dianti']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                </div>
            </div>

             <div class="form-row">
                <label for="yongtu" class="form-field">用途</label>
                <div class="form-cont">
                        <select name="data[yongtu]" required> 
                            <option value="0">请选择</option>
                              <?php if(!empty($yongtu)):?>
                                <?php foreach ($yongtu as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['yongtu']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                </div>
            </div>

             <div class="form-row">
                <label for="weizhi" class="form-field">位置</label>
                <div class="form-cont">
                        <select name="data[weizhi]" required> 
                            <option value="0">请选择</option>
                              <?php if(!empty($weizhi)):?>
                                <?php foreach ($weizhi as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if(!empty($vo) && $k == $vo['weizhi']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                </div>
            </div>

        <div class="form-row">
          <label for="fb_time" class="form-field">发布时间</label>
          <div class="form-cont">
            <input type="text" name="data[fb_time]" class="input-txt Wdate"   onClick="WdatePicker({ dateFmt:'yyyy-MM-dd H:m:s',readOnly:true})" value="<?=!empty($vo['fb_time']) ? date('Y-m-d H:i:s',$vo['fb_time']) : date('Y-m-d H:i:s');?>">
          </div>
        </div>

            <?php
            $this->data['spicname'] = 'scrollpic';
            $this->data['spicwidth'] = '700像素';
            $this->data['spicheight'] = '400像素';
            $this->load->view('public_uploadify');
            ?>

              <div class="form-row">
          <label for="base_intro" class="form-field">基本属性</label>
          <div class="form-cont">
          <script id="base_intro" name="data[base_intro]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['base_intro']) ? $vo['base_intro'] : '';?></script>
            </div>
        </div>
          <div class="form-row">
          <label for="trade_intro" class="form-field">交易属性</label>
          <div class="form-cont">
          <script id="trade_intro" name="data[trade_intro]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['trade_intro']) ? $vo['trade_intro'] : '';?></script>
            </div>
        </div>
          <div class="form-row">
          <label for="hx_intro" class="form-field">户型介绍</label>
          <div class="form-cont">
          <script id="hx_intro" name="data[hx_intro]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['hx_intro']) ? $vo['hx_intro'] : '';?></script>
            </div>
        </div>
          <div class="form-row">
          <label for="zb_intro" class="form-field">周边配套</label>
          <div class="form-cont">
          <script id="zb_intro" name="data[zb_intro]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['zb_intro']) ? $vo['zb_intro'] : '';?></script>
            </div>
        </div>
          <div class="form-row">
          <label for="xiaoqu_intro" class="form-field">小区介绍</label>
          <div class="form-cont">
          <script id="xiaoqu_intro" name="data[xiaoqu_intro]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['xiaoqu_intro']) ? $vo['xiaoqu_intro'] : '';?></script>
            </div>
        </div>

        <div class="form-row">
          <label for="house_pics" class="form-field">房源照片</label>
          <div class="form-cont">
          <script id="house_pics" name="data[house_pics]" type="text/plain" style="width:650px;height:250px;"><?=!empty($vo['house_pics']) ? $vo['house_pics'] : '';?></script>
            </div>
        </div>


        <div class="form-row">
            <label for="recomment_house" class="form-field">推荐房源</label>
            <div class="form-cont"  >
                    <select name="data[recomment_house][]" multiple="true" size="5" id="recomment_house" > 
                        <option value="0">请选择</option>
                    </select>
                    <a href="javascript:;" onclick="get_recomment_house()">点击加载房源</a>
            </div>
        </div>
        <!--<div class="form-row">
            <label for="to_index" class="form-field">是否推荐到首页</label>
            <div class="form-cont"  >
                    <select name="data[to_index]" id="to_index" required > 
                        <option value="0" <?php echo empty($vo['to_index']) ? 'selected' : '' ?>>否</option>
                        <option value="1"  <?php echo !empty($vo['to_index']) && $vo['to_index'] == 1 ? 'selected' : '' ?>>是</option>
                    </select>
            </div>
        </div>-->

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
<script>
<?php if(!empty($vo['province_id'])): ?>
get_sub_area(<?php echo $vo['province_id'] ?>, '<?php echo $vo['city_id'] ?>', 'city_id');
<?php endif; ?>
<?php if(!empty($vo['city_id'])): ?>
get_sub_area(<?php echo $vo['city_id'] ?>, '<?php echo $vo['area_id'] ?>', 'area_id');
<?php endif; ?>
<?php if(!empty($vo['area_id'])): ?>
get_sub_area(<?php echo $vo['area_id'] ?>, '<?php echo $vo['address_id'] ?>', 'address_id');
<?php endif; ?>

<?php if(!empty($vo['subway'])): ?>
get_subway_station(<?php echo $vo['subway'] ?>);
<?php endif; ?>

  function get_recomment_house(){
    $.post('<?php echo site_url('manager/housecp/public_get_recomment_house')?>', {id: '<?php echo !empty($vo['id']) ? $vo['id'] : 0 ?>'}, function(res) {
      $('#recomment_house').html(res.data);
    }, 'json');
  }

  function get_sub_area(obj, sub_id, tar){
    if(tar == 'city_id'){
        $('#city_id').html('<option value="">请选择</option>');
        $('#area_id').html('<option value="">请选择</option>');
        $('#address_id').html('<option value="">请选择</option>');
    }else if(tar == 'area_id'){
        $('#area_id').html('<option value="">请选择</option>');
        $('#address_id').html('<option value="">请选择</option>');
    }
    var parent = typeof(obj) == 'number' ? obj : obj.value;
    var sub_id = typeof(sub_id) != 'undefined' ? sub_id : '';
    $.post('<?php echo site_url('linkage/get_lists')?>', {'parent': parent, 'id' : sub_id}, function(res) {
      if(tar){
        $('#'+tar).html(res.data);
      }
    }, 'json');
  }

  function get_subway_station(obj){
    var parent = typeof(obj) == 'number' ? obj : obj.value;

    $.post('<?php echo site_url('subway/get_lists')?>', {'parent': parent, 'id' : '<?php echo @$vo['subway_station'] ?>'}, function(res) {
      $('#subway_station').html(res.data);
    }, 'json');
  }
</script>
<script type="text/javascript" charset="utf-8">
var ue = UE.getEditor('base_intro');
var ue = UE.getEditor('trade_intro');
var ue = UE.getEditor('hx_intro');
var ue = UE.getEditor('zb_intro');
var ue = UE.getEditor('xiaoqu_intro');
var ue = UE.getEditor('house_pics');
</script>