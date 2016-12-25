<script type="text/javascript" src="/static/web/js/jquery.jqzoom.js"></script>
<script type="text/javascript" src="/static/web/js/base.js"></script>
<!-- ========main======= -->
<div class="warp clearfix">
    <?php $this->load->view('location') ?>
    <div class="xx_top">
        <h2><?php echo $row['title'] ?></h2>
        <?php echo $row['second_title'] ?>
    </div>
    <div class="xx_center clearfix">
    <?php if(!empty($row['scrollpic'])): ?>
    	<?php $scrollpic = json_decode($row['scrollpic']) ?>
        <!--图开始-->
        <div class="xx_center_img">
            <div id="preview" class="spec-preview"> <span class="jqzoom"><img jqimg="<?php echo $scrollpic[0] ?>" src="<?php echo $scrollpic[0] ?>" /></span> </div>
            <!--缩图开始-->
            <div class="spec-scroll"> <a class="prev">&lt;</a> <a class="next">&gt;</a>
                <div class="items">
                    <ul>
                    <?php foreach ($scrollpic as $k => $r): ?>
                    	 <li><img  jqimg="<?php echo $r; ?>" src="<?php echo $r ?>" onmousemove="preview(this);"></li>
                    <?php endforeach ?>
                       
                    </ul>
                </div>
            </div>
            <!--缩图结束-->
        </div>
    <?php endif; ?>
        <div class="xx_center_right">
            <div class="xx_center_right_1">
                <span><?php echo intval( $row['total_price']) ?></span><font>万</font>
                单价<?php echo intval($row['unit_price']) ?>元/平米
            </div>
            <div class="xx_center_right_2 clearfix">
                <ul>
                    <li>
                        <span><?php echo $row['shi'] ?>室<?php echo $row['ting'] ?>厅</span>
                        <?php echo $row['ting_shi_txt'] ?>
                    </li>
                    <li>
                        <span><?php echo $chaoxiang[$row['chaoxiang']] ?></span>
                        <?php echo $row['chaoxiang_txt'] ?>
                        
                    </li>
                    <li>
                        <span><?php echo $row['acreage'] ?>平米</span>
                        <?php echo $row['acreage_txt'] ?>
                    </li>
                </ul>
            </div>
            <div class="xx_center_right_3 clearfix">
                <dl>
                    <dt>小区名称</dt>
                    <dd>
                        <?php echo $row['title'] ?>
                    </dd>
                </dl>
                <dl>
                    <dt>所在区域</dt>
                    <dd>
                        <a href="javascript:;"> <?php echo !empty($area_info['0']['name']) ? $area_info['0']['name'] : ''?></a>
                        <a href="javascript:;"> <?php echo !empty($area_info['1']['name']) ? $area_info['1']['name'] : ''?></a>

                        <?php echo $row['huan'] ?>
                        <a href="javascript:;">近<?php echo !empty($subway_info['0']['name']) ? $subway_info['0']['name'] : ''?>
<?php echo !empty($subway_info['1']['name']) ? $subway_info['1']['name'] : ''?>                        
                        站</a>
                    </dd>
                </dl>
                <dl>
                    <dt>看房时间</dt>
                    <dd>
                        <?php echo $row['watch_time'] ?>
                    </dd>
                </dl>
            </div>
            <div class="xx_center_right_4">
                <img src="/static/web/images/400.png" alt="">
            </div>
        </div>
    </div>
    <div class="xx_bottom clearfix">
        <div class="xx_bottom_list clearfix">
            <h2>
                基本信息
            </h2>
            <div class="xx_bottom_nr clearfix">
                <div class="xx_bottom_nr_1 clearfix">
                    基本属性
                </div>
                <div class="xx_bottom_nr_2 clearfix">
                    <?php echo $row['base_intro'] ?>
                </div>
            </div>
            <div class="xx_bottom_nr clearfix">
                <div class="xx_bottom_nr_1 clearfix">
                    交易属性
                </div>
                <div class="xx_bottom_nr_2 clearfix">
                    <?php echo $row['trade_intro'] ?>
                </div>
            </div>
        </div>
        <div class="xx_bottom_list clearfix">
            <h2>
                房源介绍
            </h2>
            <div class="xx_bottom_nr clearfix">
                <div class="xx_bottom_nr_1 clearfix">
                    户型介绍
                </div>
                <div class="xx_bottom_nr_text clearfix">
                    <?php echo $row['hx_intro'] ?>
                </div>
            </div>
            <div class="xx_bottom_nr clearfix">
                <div class="xx_bottom_nr_1 clearfix">
                    周边配套
                </div>
                <div class="xx_bottom_nr_text clearfix">
                    <?php echo $row['zb_intro'] ?>
                </div>
            </div>
            <div class="xx_bottom_nr clearfix">
                <div class="xx_bottom_nr_1 clearfix">
                    小区介绍
                </div>
                <div class="xx_bottom_nr_text clearfix">
                    <?php echo $row['xiaoqu_intro'] ?>
                </div>
            </div>
        </div>
        <div class="xx_bottom_list_1">
            <h2>
                房源照片
            </h2>
            <div class="xx_bottom_list_img">
                    <?php echo $row['house_pics'] ?>
            </div>
        </div>
    </div>
</div>
<!-- 推荐房源 -->
<?php if(!empty($row['recomment_house']) && !empty($recomment_house)): ?>
<div class="tjfy clearfix">
    <div class="warp clearfix">
        <div class="tjfy_title">
            推荐房源
        </div>
        <?php if(!empty($recomment_house)): ?>
        <?php foreach ($recomment_house as $k => $r): ?>
           <div class="tjfy_bottom_list <?php if($k == 0): ?>wu <?php endif; ?>">
                <a href="<?php echo site_url('hosue/show/'.$r['id']) ?>">
                    <img src="<?php echo $r['thumb'] ?>" alt="">
                    <div class="tj_nr">
                        <span>
                            <?php echo $r['title'] ?>
                        </span>
                        <?php echo $r['village'] ?> <?php echo $r['shi'] ?>室<?php echo $r['ting']?>厅 <?php echo $r['acreage'] ?>平米
                    </div>
                </a>
            </div>
        <?php endforeach ?>
		<?php endif; ?>
    </div>
</div>
<?php endif; ?>