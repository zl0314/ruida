<!-- ========main======= -->
<div class="warp clearfix">
    <?php $this->load->view('location') ?>
    <form action="" method="get" name="searchForm" id="searchForm">
    <input type="hidden" name="t" value="<?php echo request_get('t');?>">
    <input type="hidden" name="parentid" id="parentid" value="<?php echo request_get('parentid');?>">
    <input type="hidden" name="show_all_province" id="show_all_province" value="<?php echo request_get('show_all_province');?>">
    <div class="lb_top">
        <div class="lb_top_1 clearfix">
            <input type="text" name="q" placeholder="请输入小区" value="<?php echo request_get('q') ?>" class="ss_wbk">
            <input type="submit" value="搜索"  class="ss_but">
        </div>

        <?php if($type == 1): ?>
        <div class="lb_top_2 clearfix">
        <input type="hidden" name="sales_type" id="sales_type"  value="<?php echo request_get('sales_type') ? request_get('sales_type') : 2 ?>" >
            <a href="javascript:;" <?php if( request_get('sales_type') == 2 || request_get('sales_type') == ''){echo 'class="active" ';} ?> onclick="goto('<?php echo site_url('house?t='.$type.'&sales_type=2') ?>')">
                出售
                <i></i>
            </a>
            <a href="javascript:;"   <?php if( request_get('sales_type') == 1){echo 'class="active" ';} ?>   onclick="goto('<?php echo site_url('house?t='.$type.'&sales_type=1') ?>')">
                出租
                <i></i>
            </a>
        </div>
    <?php endif; ?>

        <div class="lb_top_3 clearfix">
            <div class="qh">
                <dl>
                    <dt>
                        位置：
                    </dt>

                    <dd <?php if(request_get('show_all_province') == 'all'): ?>class="active"<?php endif; ?>>
                        <a href="javascript:;" onclick="fill_input('house_province_id', 'all',0),fill_input('house_city_id', '',0),fill_input('house_area_id', '',0),fill_input('house_address_id', '',0),fill_input('show_all_province', 'all',0),fill_input('house_subway_input', '', 1)">
                            不限
                        </a>
                    </dd>

                    <dd <?php if(request_get('show_all_province') != 'all' ): ?>class="active"<?php endif; ?> >
                       <a href="javascript:;"  onclick="fill_input('show_all_province', '',0),filter_pos(this, 'house_city'),fill_input('house_province_id', 'all',0),fill_input('house_city_id', '',0),fill_input('house_area_id', '',0),fill_input('house_address_id', '',1)">
                            行政区域
                        </a>
                    </dd>

                    <dd <?php if(request_get('subway')): ?>class="active"<?php endif; ?> >
                        <a href="javascript:;"  onclick="filter_pos(this, 'house_subway')">
                            地铁线
                        </a>
                    </dd>

                </dl>

               <input type="hidden" name="province_id" id="house_province_id" value="<?php echo request_get('province_id') ?>">
               <input type="hidden" name="city_id" id="house_city_id" value="<?php echo request_get('city_id') ?>">
               <input type="hidden" name="area_id" id="house_area_id" value="<?php echo request_get('area_id') ?>">
               <input type="hidden" name="address_id" id="house_address_id" value="<?php echo request_get('address_id') ?>">

                <dl class="erji"  id="house_province" style="display:block">
                <?php foreach ($province as $k => $r): ?>
                	<dd <?php if(request_get('province_id') == $r['id']): ?> class="active" <?php endif; ?>>
                        <a href="javascript:;" onclick="fill_input('house_province_id', '<?php echo $r['id'] ?>', 0),fill_input('house_area_id', '0', 0),fill_input('province_id', '<?php echo $r['id'] ?>', 0),fill_input('house_city_id', '', 0),fill_input('house_address_id', '', 1)">
                            <?php echo $r['name'] ?>
                        </a>
                    </dd>
                <?php endforeach ?>
                </dl>

            <dl class="erji"  id="house_city" style="display:<?php if(request_get('province_id')&& request_get('province_id')!='all' ){ echo 'block'; }else{ echo 'none'; } ?>">
                <?php foreach ($city as $k => $r): ?>
                    <dd <?php if(request_get('city_id') == $r['id']): ?> class="active" <?php endif; ?>>
                        <a href="javascript:;" onclick="fill_input('house_city_id', '<?php echo $r['id'] ?>', 0),fill_input('house_area_id', '0', 0),fill_input('parentid', '<?php echo $r['id'] ?>', 0),fill_input('house_address_id', '', 1)">
                            <?php echo $r['name'] ?>
                        </a>
                    </dd>
                <?php endforeach ?>
                </dl>

                <dl class="erji" id="house_area" style="display:<?php if(request_get('area_id')){ echo 'block'; }else{ echo 'none'; } ?>"> </dl>
                <dl class="erji" id="house_address" style="display:<?php if(request_get('address_id')){ echo 'block'; }else{ echo 'none'; } ?>">   </dl>


				<input type="hidden" name="subway" id="house_subway_input" value="<?php echo request_get('subway') ?>">			
                <dl class="erji" style="display:<?php if(request_get('subway')){ echo 'block'; }else{ echo 'none'; } ?>" id="house_subway">
                    <?php foreach ($subway as $k => $r): ?>
                	<dd  <?php if(request_get('subway') == $r['id']): ?> class="active" <?php endif; ?>>
                        <a href="javascript:;" onclick="fill_input('house_subway_input', '<?php echo $r['id'] ?>')">
                            <?php echo $r['name'] ?>
                        </a>
                    </dd>
                <?php endforeach ?>
                </dl>
                <dl>
                    <dt>
                        面积：
                    </dt>
                       <dd <?php if(!request_get('mianji')):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_mianji', '0')">
                            不限
                        </a>
                    </dd>
                    <input type="hidden" name="mianji"  id="house_mianji" value="<?php echo request_get('mianji') ?>">
                    <?php foreach ($mianji as $k => $r): ?>
                    	<dd  <?php if(request_get('mianji') == $k):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_mianji','<?php echo $k ?>')">
                           <?php echo $r; ?>
                        </a>
                    </dd>
                    <?php endforeach ?>

                    <dd class="pm_k">
                        <input type=""  name="mianji_min" class="pm_wbk" value="<?php echo request_get('mianji_min') ?>">-
                        <input type=""  name="mianji_max" class="pm_wbk" value="<?php echo request_get('mianji_max') ?>"onblur="$(this).next().show()">平米
                        <input type="button" style="float:right" value="确定" onclick="$('#searchForm').submit()" class="lb_but">
                    </dd>
                </dl>
                <?php if($type == 3 || $type == 4): ?>
                <dl>
                    <dt>
                        房型：
                    </dt>
                       <dd <?php if(!request_get('house_type')):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_type', '0')">
                            不限
                        </a>
                    </dd>
                    <input type="hidden" name="house_type"  id="house_type" value="<?php echo request_get('house_type') ?>">
                    <?php foreach ($htype as $k => $r): ?>
                        <dd  <?php if(request_get('house_type') == $k):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_type','<?php echo $k ?>')">
                           <?php echo $r; ?>
                        </a>
                    </dd>
                    <?php endforeach ?>

                </dl>
                <?php endif; ?>
                <dl>
                    <dt>
                        价格：
                    </dt>
                     <dd <?php if(!request_get('price')):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_price', '0')">
                            不限
                        </a>
                    </dd>
                    <input type="hidden" name="price"  id="house_price" value="<?php echo request_get('price') ?>">
                    <?php foreach ($jiage as $k => $r): ?>
                    	<dd  <?php if(request_get('price') == $k):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_price','<?php echo $k ?>')">
                           <?php echo $r; ?>
                        </a>
                    </dd>
                    <?php endforeach ?>
                    
                    <dd class="pm_k">
                        <input type=""  name="price_min" class="pm_wbk" value="<?php echo request_get('price_min') ?>">-
                        <input type=""  name="price_max" value="<?php echo request_get('price_max') ?>" onblur="$(this).next().show()"class="pm_wbk">万
                        <input type="button" value="确定" class="lb_but" onclick="$('#searchForm').submit()" style="float:right" >
                    </dd>
                </dl>

                <?php if($type != 4): ?>
                <dl>
                    <dt>
                        用途： 
                    </dt>
 						<dd <?php if(!request_get('yongtu')):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_yongtu', '0')">
                            不限
                        </a>
                    </dd>
                    <input type="hidden" name="yongtu"  id="house_yongtu" value="<?php echo request_get('yongtu') ?>">

                    <?php foreach ($yongtu as $k => $r): ?>
                    	<dd  <?php if(request_get('yongtu') == $k):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_yongtu','<?php echo $k ?>')">
                           <?php echo $r; ?>
                        </a>
                    </dd>
                    <?php endforeach ?>
                </dl>
                <?php elseif($type == 4): ?>
                     <dl>
                    <dt>
                        类型： 
                    </dt>
                        <dd <?php if(!request_get('new_house_type')):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_new_house_type', '0')">
                            不限
                        </a>
                    </dd>
                    <input type="hidden" name="new_house_type"  id="house_new_house_type" value="<?php echo request_get('new_house_type') ?>">

                    <?php foreach ($new_house_type as $k => $r): ?>
                        <dd  <?php if(request_get('new_house_type') == $k):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_new_house_type','<?php echo $k ?>')">
                           <?php echo $r; ?>
                        </a>
                    </dd>
                    <?php endforeach ?>
                </dl>
                <?php endif; ?>

               
                <?php if($type == 1): ?>
                <dl>
                    <dt>
                        装修： 
                    </dt>
                    <dd <?php if(!request_get('zhuangxiu')):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('zhuangxiu', '0')">
                            不限
                        </a>
                    </dd>
                    <input type="hidden" name="zhuangxiu"  id="house_zhuangxiu" value="<?php echo request_get('zhuangxiu') ?>">
                    <?php foreach ($zhuangxiu as $k => $r): ?>
                    	<dd  <?php if(request_get('zhuangxiu') == $k):?> class="active"<?php endif;?>>
                        <a href="javascript:;" onclick="fill_input('house_zhuangxiu','<?php echo $k ?>')">
                           <?php echo $r; ?>
                        </a>
                    </dd>
                    <?php endforeach ?>
                </dl>
                    <?php elseif($type == 2): ?>
                        <dl>
                        <dt>
                            标签： 
                        </dt>
                        <input type="hidden" name="biaoqian"  id="house_biaoqian" value="<?php echo request_get('zhuangxiu') ?>">
                        <dd <?php if(!request_get('biaoqian')):?> class="active"<?php endif;?>>
                            <a href="javascript:;" onclick="fill_input('house_biaoqian', '0')">
                                不限
                            </a>
                        </dd>
                        <?php foreach ($biaoqian as $k => $r): ?>
                            <dd  <?php if(request_get('biaoqian') == $k):?> class="active"<?php endif;?>>
                            <a href="javascript:;" onclick="fill_input('house_biaoqian','<?php echo $k ?>')">
                               <?php echo $r; ?>
                            </a>
                        </dd>
                        <?php endforeach ?>
                    </dl>
                <?php endif; ?>

            </div>
        </div>
        </form>
        <script>
            $(".lb_top_2 a").click(function(){
                var i=$(this).prevAll().length;
                $(".lb_top_3 .qh").eq(i).show().siblings().hide();
                $(this).addClass('active').siblings().removeClass('active');
            });
        </script>
    </div>
    <div class="lb_center">
        共找到<span><?php echo !empty($total_rows) ? $total_rows : 0 ?></span>套房源
    </div>
    <div class="lb_bottom clearfix">
	<?php if(!empty($list)): ?>        
		<?php foreach ($list as $k => $r): ?>
			
        <div class="lb_bottom_list clearfix">
            <div class="lb_bottom_list_img">
                <a href="<?php echo site_url('house/show/'.$r['id']) ?>">
                    <img src="<?php echo $r['thumb'] ?>" alt="">
                </a>
            </div>
            <div class="lb_bottom_list_nr">
                <h2>
                    <a href="<?php echo site_url('house/show/'.$r['id']) ?>">
						<?php echo $r['title'] ?>
                    </a>
                </h2>
                <ul>
                    <li>
                        <i class="yi"></i><?php echo $r['village'] ?>
                        <?php if($r['type'] != 4): ?>&nbsp;&nbsp;|
                            <?php if(!empty($r['shi']) && !empty($r['ting'])): ?>
                        &nbsp;&nbsp;<?php echo $r['shi'] ?>室<?php echo $r['ting']?>厅&nbsp;&nbsp;|
                            <?php endif; ?>
                        &nbsp;&nbsp;<?php echo $r['acreage'] ?>平米
                        <?php echo !empty($chaoxiang[$r['chaoxiang']]) ? $chaoxiang[$r['chaoxiang']].'&nbsp;&nbsp;|&nbsp;&nbsp;' : '' ?>
                        <?php echo !empty( $zhuangxiu[$r['zhuangxiu']] ) ?  $zhuangxiu[$r['zhuangxiu']].'&nbsp;&nbsp;|&nbsp;&nbsp;'  : ''?>
                         <?php echo !empty($dianti[$r['dianti']]) ? $dianti[$r['dianti']].'&nbsp;&nbsp;' : '' ?>
                    <?php endif; ?>
                    </li>
                    <?php if($r['type'] != 4): ?>
                    <li>
                        <i class="er"></i><?php echo $r['ting_shi_txt'] ?> <?php echo $r['acreage_txt'] ?> - <?php echo !empty($r['subway_info']['1']['name']) ? $r['subway_info']['1']['name'] : ''?>
                    </li>
                    <li>
                        <i class="san"></i><!--181人关注 / 共112次带看 / --> <?php echo mdate($r['fb_time']) ?>发布
                    </li>
                <?php endif; ?>

                </ul>
                <div class="tag">
                    <span>距离
                    <?php echo !empty($r['subway_info']['0']['name']) ? $r['subway_info']['0']['name'] : ''?>
                    <?php echo !empty($r['subway_info']['1']['name']) ? $r['subway_info']['1']['name'] : ''?>
                    <?php echo $r['meter'] ?>米</span>
                   	<?php if(!empty($r['house_cert_year'])): ?>
                   		 <span>
				            房本满<?php echo $r['house_cert_year'] ?>年
                    </span>
                   	<?php endif ?>
                    	<?php if(!empty($r['label'])): ?>
                    	<?php $r['label'] = str_replace('，', ',', $r['label']); ?>
                    	<?php $label = explode(',', $r['label']) ?>
				        <?php if(!empty($label)): ?>
				        	<?php foreach ($label as $key => $value): ?>
			                    <span>
							            <?php echo $value ?>
			                    </span>
				        <?php endforeach ?>
				    <?php endif; ?>
				    <?php endif; ?>
                    <span><?php echo $r['watch_time'] ?></span>
                </div>
            </div>
            <?php if($r['type'] == 1 && $r['sales_type'] == 1): ?>
            <div class="lb_bottom_list_jg">
             <div class="lb_bottom_list_jg_1">
                   <span><?php echo intval($r['month_price']); ?></span>元/月
                </div>
                <?php echo date('Y.m.d',$r['fb_time']); ?>更新
                </div>
			<?php elseif(!empty($r['total_price']) && $r['type'] != 4 ): ?>
            <div class="lb_bottom_list_jg">
                <div class="lb_bottom_list_jg_1">
                    <span><?php echo intval($r['total_price']); ?></span>万
                </div>
                单价<?php echo intval($r['unit_price']); ?>元/平米
            </div>
        <?php elseif($r['type'] == 4): ?>
            <div class="lb_bottom_list_jg">
             <div class="lb_bottom_list_jg_1">
                   均价 <span><?php echo intval($r['avg_price']); ?></span>元/平
                </div>
                建面<?php echo intval($r['build_acreage']); ?>m²
        </div>
             </div>
    <?php endif; ?>
    </div>

		<?php endforeach ?>
    <?php endif; ?>
    </div>
       
    <div class="page">
      <?php echo !empty($page_html) ? $page_html : '' ?>
    </div>
</div>

<script>
    function goto(url){
        window.location.href = url;
    }
	function filter_pos(obj,tar){
		$(obj).parent().addClass('active').siblings().removeClass('active');
		$('.erji').hide();
		$('#'+tar).show();
	}

    <?php if(request_get('city_id') ): ?>
    get_subarea('','<?php echo request_get('city_id') ?>', 'house_area');
    <?php endif; ?>

    <?php if(request_get('area_id') ): ?>
    get_subarea('','<?php echo request_get('area_id') ?>', 'house_address');
    <?php endif; ?>

    <?php if($direct_province): ?>
    get_subarea('','<?php echo $direct_province ?>', 'house_area');
    $('#house_city').hide();
    <?php endif; ?>

	function get_subarea(obj,parent, tar){
		if(obj){
			$(obj).parent().addClass('active').siblings().removeClass('active');
		}
       
        data = {'parent': parent, 'id' : '<?php echo request_get('area_id') ?>', 'tar' : tar};
        if(tar == 'house_address'){
            data = {'parent': parent, 'id' : '<?php echo request_get('address_id') ?>', 'tar' : tar};
        }

	    $.post('<?php echo site_url('linkage/get_list_house')?>', data, function(res) {
	      if(tar){
            if(res.data){
                $('#'+tar).html(res.data).show();
            }else{
                $('#'+tar).hide();
            }
	      }
	    }, 'json');
	}
	function fill_input(tar, v, submit){
        submit = typeof( submit) == 'undefined' ? 1 : submit;
		$('#'+tar).val(v);
		if(submit){
            $('#searchForm').submit();
        }
	}
</script> 
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?fcf7089918a89bbc548151be7c90be90";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>