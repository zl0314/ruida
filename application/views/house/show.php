<script type="text/javascript" src="/static/web/js/jquery.jqzoom.js"></script>
<script type="text/javascript" src="/static/web/js/base.js"></script>
<link rel="stylesheet" href="/static/web/css/echo.css">
<script src="/static/web/js/echo.js"></script>

<!-- ========main======= -->
<div class="warp clearfix">
    <?php $this->load->view('location') ?>
    <div class="xx_top">
        <h2><?php echo $row['title'] ?></h2>
        <?php echo $row['second_title'] ?>
    </div>
    <div class="xx_center clearfix">
    <?php if(!empty($thumb_pic_array)): ?>
        <!--图开始-->
        <div class="xx_center_img">
            <div id="preview" class="spec-preview"> <span class="jqzoom"><img jqimg="<?php echo $thumb_pic_array[0]['source'] ?>" src="<?php echo $thumb_pic_array[0]['source'] ?>" /></span> </div>
            <!--缩图开始-->
            <div class="spec-scroll"> <a class="prev">&lt;</a> <a class="next">&gt;</a>
                <div class="items">
                    <ul>
                    <?php foreach ($thumb_pic_array as $k => $r): ?>
                    	 <li><img  jqimg="<?php echo $r['source']; ?>" src="<?php echo $r['thumb'] ?>" onmouseover="preview(this);"></li>
                    <?php endforeach ?>
                       
                    </ul>
                </div>
            </div>
            <!--缩图结束-->
        </div>
    <?php endif; ?>
<style>
    #preview img {
        background: #fff no-repeat center ;
        background-image:url('/static/web/images/ajax.gif');
    }
</style>
        <div class="xx_center_right">
            <div class="xx_center_right_1">
                 <?php if($row['sales_type'] == 1 && $row['type'] == 1): ?>
                    <span><?php echo intval($row['month_price']) ?></span><font>元/月</font>
                <?php elseif($row['type'] != 4 ): ?>
                    <span><?php echo intval( $row['total_price']) ?></span><font>万</font>
                    单价<?php echo intval($row['unit_price']) ?>元/平米


                <?php elseif($row['type'] == 4): ?>
                <span><?php echo intval($row['avg_price']) ?></span><font>元/平</font>
           
            <?php endif; ?>
            </div>
            <div class="xx_center_right_2 clearfix">
                <ul>
                    <li>
                 <?php if(!empty($r['shi']) && !empty($r['ting'])): ?>

                        <span><?php echo $row['shi'] ?>室<?php echo $row['ting'] ?>厅</span>
                        <?php echo !empty($row['ting_shi_txt']) ? $row['ting_shi_txt'] : ''; ?>
                <?php endif; ?>

                    </li>

                    <li>
                        <span><?php echo !empty($chaoxiang[$row['chaoxiang']] ) ? $chaoxiang[$row['chaoxiang']] : ''?></span>
                        <?php echo !empty($row['chaoxiang_txt'] ) ? $row['chaoxiang_txt']  : ''?>
                        
                    </li>
                    <li>
                        <span><?php echo $row['acreage'] ?>平米</span>
                        <?php echo !empty($row['acreage_txt']) ? $row['acreage_txt'] : '' ?>
                    </li>
                </ul>
            </div>
            <div class="xx_center_right_3 clearfix">
                <dl>
                    <dt>小区名称</dt>
                    <dd>
                        <?php echo $row['village'] ?>
                    </dd>
                </dl>
                <dl>
                    <dt>所在区域</dt>
                    <dd>
                        <a href="javascript:;"> <?php echo !empty($area_info['0']['name']) ? $area_info['0']['name'] : ''?></a>
                        <a href="javascript:;"> <?php echo !empty($area_info['1']['name']) ? $area_info['1']['name'] : ''?></a>

                        <?php echo $row['huan'] ?>环
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
                <img src="/static/web/images/400.png" alt=""><br>
                <a target="_blank" href="http://p.qiao.baidu.com/cps/chat?siteId=10341286&userId=23090150">
                    <img src="/static/web/images/zxzx.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="xx_bottom clearfix">
        <div class="xx_bottom_list clearfix">
            <h2>
                基本信息
            </h2>
            
            <div class="xx_bottom_nr clearfix">
               
                <div class="xx_bottom_nr_2 clearfix">
                    <?php echo $row['trade_intro'] ?>
                </div>
            </div>

        </div>

        <div class="xx_bottom_list clearfix">
            <?php if(!empty($row['hx_intro'])): ?>
            <h2>
                房源介绍
            </h2>
            <div class="xx_bottom_nr clearfix">
                <div class="xx_bottom_nr_text clearfix">
                    <?php echo $row['hx_intro'] ?>
                </div>
            </div>
        <?php endif; ?>
       
        <?php if(!empty($row['xiaoqu_intro'])): ?>
            <div class="xx_bottom_list clearfix">
               <h2>
                    大厦介绍
                </h2>

                 <div class="xx_bottom_nr clearfix">
                    <div class="xx_bottom_nr_text clearfix">
                        <?php echo $row['xiaoqu_intro'] ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        </div>
        <?php if(!empty($row['house_pics'])): ?>
            <div class="xx_bottom_list_1">
                <h2>
                    房源照片
                </h2>
                <div class="xx_bottom_list_img" id="xx_bottom_list_img">
                        <?php echo $row['house_pics'] ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Echo.js -->
<script>
$(function(){
    $('#xx_bottom_list_img').find('img').each(function(){
        var src = $(this).attr('_src');
        $(this).attr('src', '/static/web/images/blank.gif')
        $(this).removeAttr('_src');
        $(this).attr('data-echo', src);
    });
})

document.onreadystatechange = dosomething;
function dosomething(){
    Echo.init({
      offset: 0,
      throttle: 250,
      datasrc : 'data-echo'
    });
}
</script>

<style>
    #xx_bottom_list_img img {
        width:700px;
        margin-bottom: 5px;
    }
</style>
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
                <a href="<?php echo site_url('house/show/'.$r['id']) ?>">
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
<script>
    $(function(){
        $('p span').css('white-space', 'normal');
    })
</script>