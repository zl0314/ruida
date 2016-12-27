<!-- ========main======= -->
<div class="xf_top" <?php if(!empty($ad_row)): ?> style="background: url('<?php echo $ad_row['pic'] ?>')" <?php endif; ?>>
    <div class="warp">
    <form action="<?php echo site_url('house/lists') ?>" method="get" id="searchForm">
        <div class="xf_ss">
            <div class="xf_ss_1">
            	<input type="hidden" name="t" value="<?php echo request_get('t') ?>">
                <input type="text" name="q" class="js_wbk" placeholder="楼盘名/关键字">
                <input type="submit" class="js_but" value="">
            </div>
            <div class="xf_ss_2 clearfix">
                <h2>条件找房：</h2>
                <div class="xf_ss_2_list clearfix">
                    <select class="ss_xl_wbk" name="area_id" >
                        <option value="">区域</option>
                        <?php foreach ($area as $k => $r): ?>
                        	<option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="ss_xl_wbk" name="subway">
                        <option value="">地铁</option>
                         <?php foreach ($subway as $k => $r): ?>
                        	<option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="ss_xl_wbk" name="house_type">
                        <option value="">房型</option>
                        <?php foreach ($htype as $k => $r): ?>
                        	<option value="<?php echo $k ?>"><?php echo $r ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="ss_xl_wbk" name="price">
                        <option value="">售价</option>
                         <?php foreach ($jiage as $k => $r): ?>
                        	<option value="<?php echo $k ?>"><?php echo $r ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="xf_ss_3">
                <a href="javascript:;" onClick="$('#searchForm').submit()">
                    筛选
                </a>
            </div>
        </div>
</form>
    </div>
</div>
<?php if(!empty($list)): ?>
<div class="warp clearfix">
    <div class="tj_title">
        推荐楼盘
    </div>
    <div class="tj_bottom clearfix">
    <?php foreach ($list as $k => $r): ?>
    	
        <div class="tj_bottom_list clearfix <?php if($k % 3 == 0){ echo 'ml';} ?>">
            <div class="tj_bottom_list_img">
                <a href="<?php echo site_url('house/show/'.$r['id']) ?>">
                    <img src="<?php echo $r['thumb'] ?>" alt="">
                </a>
            </div>
            <div class="tj_bottom_list_bt">
                <span class="bt_tj">
                    <span class="tj_bq">
                            <?php if(!empty($r['label'])): ?>
                        <a href="<?php echo site_url('house/show/'.$r['id']) ?>">
                    	<?php $r['label'] = str_replace('，', ',', $r['label']); ?>
                    	<?php $label = explode(',', $r['label']) ?>
				        <?php if(!empty($label)): ?>
				        	<?php foreach ($label as $key => $value): ?>
							     <?php echo $value ?> 
				        <?php endforeach ?>
				    <?php endif; ?>
				    <?php endif; ?>
                        </a>
                    </span>
                    <a href="<?php echo site_url('house/show/'.$r['id']) ?>">
                        <?php echo $r['title'] ?>
                    </a>
                </span>
                        <?php echo $r['address'] ?>
                
            </div>
            <div class="tj_bottom_list_text">
                <span class="tj_pm">
                    <?php if(!empty($r['build_acreage'])): ?>建面 <?php echo $r['build_acreage'] ?>m² <?php endif; ?>
                </span>
                均价：<font><?php echo intval($r['avg_price']) ?> 元/平</font>
            </div>
        </div>
    <?php endforeach ?>

    </div>
    <div class="tj_but">
        <a href="<?php echo site_url('house/lists?t=4') ?>">
            查看更多
        </a>
    </div>
<?php endif; ?>
</div>
