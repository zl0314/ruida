
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
                <label for="village" class="form-field">小区名称</label>
                <div class="form-cont">
                    <input id="village" type="text" required name="data[village]" class="input-txt" value="<?=!empty($vo['village']) ? $vo['village'] : '';?>" />
                </div>
            </div>

            <div class="form-row">
                <label for="area" class="form-field">所在区域</label>
                <div class="form-cont">
                    <select name="data[area_id]" id="area_id" required> 
                        <option value="0">请选择</option>
                         <?php if(!empty($area)):?>
                                <?php foreach ($area as $k => $r): ?>
                                        <option value="<?php echo $r['id'] ?>" <?php if($r['id'] == $vo['area']): ?> selected <?php endif; ?>  ><?php echo $r['name']; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                    </select>
                    <select name="data[subarea_id]" id="subarea_id" required>
                        <option value="0">请选择</option>
                    </select>
                    位于 <input type="text" name="data[huan]" id="" class="short_txt"> 环，
                    临近地铁 <input type="text" name="data[subway]" id=""  class="short_txt"> 线，
                    地铁站 <input type="text" name="data[subway_station]" id=""  class="short_txt"> 站，
                    距离 <input type="text" name="data[meter]" id=""  class="short_txt"> 米
                </div>
            </div>

            <div class="form-row">
                <label for="watch_time" class="form-field">看房时间</label>
                <div class="form-cont">
                    <input id="watch_time" type="text" required name="data[watch_time]" class="input-txt" value="<?=!empty($vo['watch_time']) ? $vo['watch_time'] : '';?>" />
                </div>
            </div>

            <div class="form-row">
                <label for="total_price" class="form-field">总价</label>
                <div class="form-cont">
                    <input id="total_price" type="text"  name="data[total_price]" class="input-txt" value="<?=!empty($vo['total_price']) ? $vo['total_price'] : '';?>" /> 万/元
                </div>
            </div>

            <div class="form-row">
                <label for="unit_price" class="form-field">单价</label>
                <div class="form-cont">
                    <input id="unit_price" type="text" required name="data[unit_price]" class="input-txt" value="<?=!empty($vo['unit_price']) ? $vo['unit_price'] : '';?>" /> 元/平米
                </div>
            </div>


            <div class="form-row">
                <label for="chaoxiang" class="form-field">朝向</label>
                <div class="form-cont">
                   <select name="data[chaoxiang]" required>
                       <option value="0">请选择</option>
                       <?php if(!empty($chaoxiang)):?>
                                <?php foreach ($chaoxiang as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if($k == $vo['chaoxiang']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                   </select>
                    &nbsp;&nbsp;&nbsp;
                   详情页下方文字 <input type="text" name="data[chaoxiang_txt]" class="input-txt">
                </div>
            </div>

             <div class="form-row">
                <label for="ting_shi" class="form-field">厅室</label>
                <div class="form-cont">
                       <input type="text" name="data[ting]" id="" class="short_txt"> 厅
                       <input type="text" name="data[shi]" id="" class="short_txt"> 室
                   &nbsp;&nbsp;&nbsp;详情页下方文字 <input type="text" name="data[ting_shi_txt]" class="input-txt">
                </div>
            </div>

             <div class="form-row">
                <label for="acreage" class="form-field">面积</label>
                <div class="form-cont">
                       <input type="text" name="data[acreage]" class="short_txt" > 平米
                   &nbsp;&nbsp;&nbsp;详情页下方文字 <input type="text" name="data[acreage_txt]" class="input-txt">
                </div>
            </div>


             <div class="form-row">
                <label for="zhuangxiu" class="form-field">装修程度</label>
                <div class="form-cont">
                        <select name="data[zhuangxiu]" required> 
                            <option value="0">请选择</option>
                            <?php if(!empty($zhuangxiu)):?>
                                <?php foreach ($zhuangxiu as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if($k == $vo['zhuangxiu']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
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
                                        <option value="<?php echo $k ?>" <?php if($k == $vo['dianti']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
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
                                        <option value="<?php echo $k ?>" <?php if($k == $vo['yongtu']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
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
                                        <option value="<?php echo $k ?>" <?php if($k == $vo['weizhi']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                </div>
            </div>

        <div class="form-row">
                <label for="type" class="form-field">房源类型</label>
                <div class="form-cont">
                        <select name="data[type]" required> 
                            <option value="0">请选择</option>
                              <?php if(!empty($type)):?>
                                <?php foreach ($type as $k => $r): ?>
                                        <option value="<?php echo $k ?>" <?php if($k == $vo['type']): ?> selected <?php endif; ?>  ><?php echo $r; ?></option>
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
                    <select name="data[recomment_house]" > 
                        <option value="0">请选择</option>
                    </select>
                    <a href="javascript:;">点击加载房源</a>
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
var ue = UE.getEditor('base_intro');
var ue = UE.getEditor('trade_intro');
var ue = UE.getEditor('hx_intro');
var ue = UE.getEditor('zb_intro');
var ue = UE.getEditor('xiaoqu_intro');
var ue = UE.getEditor('house_pics');
</script>