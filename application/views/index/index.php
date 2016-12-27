<style>
body{
	background-image: url(<?php echo !empty(!empty($ad_row)) ? $ad_row['pic'] : '/static/web/images/top_bg.jpg' ; ?>); 
	background-repeat:no-repeat;
	background-attachment:fixed; background-position:center top;
}
</style>
<!-- ====main=== -->
<div class="warp clearfix">
	<div class="i_banner">
		<img src="/static/web/images/i_banner.png" alt="">
	</div>
	<form action="<?php echo site_url('house') ?>" method="get">
	<div class="search">
		<div class="search_top">
			<a href="javascript:;" class="active" onclick="$('#house_type').val(1)">
				商业地产
			</a>
			<a href="javascript:;"  onclick="$('#house_type').val(2)">
				  投资地产
			</a>
			<a href="javascript:;"  onclick="$('#house_type').val(3)">
				 学区房/豪宅
			</a>
			<a href="javascript:;"  onclick="$('#house_type').val(4)">
				 新房
			</a>
		</div>
		<div class="search_bottom">
			<input type="hidden" name="t" value="1" id="house_type">
			<input type="text" placeholder ="请输入小区名开始找房" name="q" class="i_ss_wbk left">
			<input type="submit" value="" class="i_ss_but left">
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
	$(".search_top a").click(function() {
		$(this).addClass('active').siblings().removeClass('active');
	});
</script>
<!-- 联系我们 -->
<div class="lxwm">
	<div class="warp clearfix">
		<div class="lxwm_box clearfix">
			<?php if(!empty($ad_row_banner2)): ?>
				<img src="<?php echo $ad_row_banner2['pic'] ?>" alt="">
			<?php else: ?>
				<img src="/static/web/images/lxwm.png" alt="">
			<?php endif; ?>
			<div class="lxwm_anniu">
				<a href="javascript:;">
					委托找房
				</a>
				<a href="javascript:;">
					投放房源
				</a>
			</div>
		</div>
	</div>
</div>

<?php if(!empty($ad_row_rmsq)): ?>
<!-- 热门商圈 -->
<div class="rmsp clearfix">
	<div class="warp clearfix">
		<div class="rmsq_title">
			<h2>
				热门商圈
			</h2>
			<p>核心地段，成熟配套</p>
		</div>
		<div class="rmsq_bottom clearfix">
		<?php if(!empty($ad_row_rmsq[0])): ?>
			<div class="rmsq_bottom_list left ml">
				<a href="<?php echo get_add_http_url($ad_row_rmsq[0]['url']) ?>">
					<img src="<?php echo $ad_row_rmsq[0]['pic'] ?>" alt="">
					<span><?php echo $ad_row_rmsq[0]['title'] ?></span>
				</a>
			</div>
		<?php endif; ?>
		<?php if(!empty($ad_row_rmsq[1])): ?>
			<div class="rmsq_bottom_list left">
				<a href="<?php echo get_add_http_url($ad_row_rmsq[1]['url']) ?>">
					<img src="<?php echo $ad_row_rmsq[1]['pic'] ?>" alt="">
					<span><?php echo $ad_row_rmsq[1]['title'] ?></span>
				</a>
			</div>
		<?php endif; ?>	

		<?php if(!empty($ad_row_rmsq[2])): ?>
			<div class="rmsq_bottom_list left">
				<a href="<?php echo get_add_http_url($ad_row_rmsq[2]['url']) ?>">
					<img src="<?php echo $ad_row_rmsq[2]['pic'] ?>" alt="">
					<span><?php echo $ad_row_rmsq[2]['title'] ?></span>
				</a>
			</div>
		<?php endif; ?>	
		<?php if(!empty($ad_row_rmsq[3])): ?>
			<div class="rmsq_bottom_list_2 left ml">
				<a href="<?php echo get_add_http_url($ad_row_rmsq[3]['url']) ?>">
					<img src="<?php echo $ad_row_rmsq[3]['pic'] ?>" alt="">
					<span><?php echo $ad_row_rmsq[3]['title'] ?></span>
				</a>
			</div>
		<?php endif; ?>
		<?php if(!empty($ad_row_rmsq[4])): ?>
			<div class="rmsq_bottom_list left">
				<a href="<?php echo get_add_http_url($ad_row_rmsq[4]['url']) ?>">
					<img src="<?php echo $ad_row_rmsq[4]['pic'] ?>" alt="">
					<span><?php echo $ad_row_rmsq[4]['title'] ?></span>
				</a>
			</div>
		<?php endif; ?>			
		</div>
	</div>
</div>
<?php endif; ?>

<?php if(!empty($house_list_bussness)): ?>
<!-- ====商业地产==== -->
<div class="sydc clearfix">
	<div class="warp clearfix">
		<div class="sydc_title">
			<span>
				<a href="<?php echo site_url('house?t=1') ?>">
					更多商业地产
				</a>
			</span>
			商业地产
		</div>
		<div class="sydc_bottom clearfix">
			<?php foreach ($house_list_bussness as $key => $r): ?>
			<div class="sydc_bottom_list  <?php if($key == 0): ?>ml<?php endif;?>"">
				<a href="<?php echo site_url('house/show/'.$r['id']) ?>">
					<img src="<?php echo $r['thumb'] ?>" alt="">
				</a>
				<div class="sydc_bottom_nr">
					<a href="<?php echo site_url('house/show/'.$r['id']) ?>">
						<?php echo $r['title'] ?>
					</a>
					<p>单价<?php echo intval($r['unit_price'])?>元/平米 <?php echo intval($r['total_price']) ?>万</p>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if(!empty($house_list_tz)): ?>

<!-- ====投资地产==== -->
<div class="tzdc clearfix">
	<div class="warp clearfix">
		<div class="sydc_title">
			<span>
				<a href="<?php echo site_url('house?t=2') ?>">
					更多投资地产
				</a>
			</span>
			投资地产
		</div>
		<div class="sydc_bottom clearfix">
			<?php foreach ($house_list_tz as $key => $r): ?>
			<div class="sydc_bottom_list  <?php if($key == 0): ?>ml<?php endif;?>"">
				<a href="<?php echo site_url('house/show/'.$r['id']) ?>">
					<img src="<?php echo $r['thumb'] ?>" alt="">
				</a>
				<div class="sydc_bottom_nr">
					<a href="<?php echo site_url('house/show/'.$r['id']) ?>">
						<?php echo $r['title'] ?>
					</a>
					<p>单价<?php echo intval($r['unit_price'])?>元/平米 <?php echo intval($r['total_price']) ?>万</p>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if(!empty($house_list_xqhz)): ?>

<!-- ====学区房/豪宅==== -->
<div class="sydc clearfix">
	<div class="warp clearfix">
		<div class="sydc_title">
			<span>
				<a href="<?php echo site_url('house/?t=3') ?>">
					更多学区房/豪宅
				</a>
			</span>
			学区房/豪宅
		</div>
		<div class="sydc_bottom clearfix">
			<?php foreach ($house_list_xqhz as $key => $r): ?>
			<div class="sydc_bottom_list <?php if($key == 0): ?>ml<?php endif;?>">
				<a href="<?php echo site_url('house/show/'.$r['id']) ?>">
					<img src="<?php echo $r['thumb'] ?>" alt="">
				</a>
				<div class="sydc_bottom_nr">
					<a href="<?php echo site_url('house/show/'.$r['id']) ?>">
						<?php echo $r['title'] ?>
					</a>
					<p>单价<?php echo intval($r['unit_price'])?>元/平米 <?php echo intval($r['total_price']) ?>万</p>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php endif; ?>
<script>
	
</script>
<!-- ======弹窗======== -->
<form action="" method="post" id="zxForm">
<input type="hidden" name="type" id="zx_type" value="1">
<div class="tc" id="tc">
	<div class="tc_title">
		委托找房
	</div>
	<div class="tc_bottom">
		<table>
			<tr>
				<td align="left">
					<input type="text" name="mobile" class="i_wbk" value="<?php echo Userinfo::getUserInfo('mobile') ?>" placeholder="手机号">
				</td>
			</tr>
			<tr align="left">
				<td>
					<input type="text" class="i_wbk" name="email" value="<?php echo Userinfo::getUserInfo('email') ?>" placeholder="邮   箱">
				</td>
			</tr>
			<tr align="left">
				<td>
					<input type="text" class="i_wbk1" name="captcha" placeholder="验证码"><img src="<?php echo site_url('Api/captcha') ?>" title="点击切换验证码" style="cursor: pointer" onclick="this.src='<?php echo site_url('Api/captcha') ?>'" class="inputcheckbox" width="80" alt="">
				</td>
			</tr>
			<tr align="center">
				<td>
					<input type="button" value="提交" class="i_but" onclick="submitzx(this)">
				</td>
			</tr>
			<tr>
				<td>
					请留下您的联系方式，稍后客服人员会跟您联系。
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
<div class="bgzzc"></div>

<script type="text/javascript">
	$(".lxwm_anniu a").click(function() {
		if($(this).index()==0){
			$(".tc_title").text("委托找房");
			$('#zx_type').val(1);
		}
		if($(this).index()==1){
			$(".tc_title").text("投放房源");
			$('#zx_type').val(2);
		}
		$(".bgzzc").css({
	        display:"block",
	        height:$(document).height()
	    })
	    $(".tc").css({
	    	display:"block",
	    	top:($(window).height()-$(".tc").height())/2+"px"
	    })
	});
	$(".bgzzc").click(function() {
		$(".bgzzc").hide();
		$(".tc").hide();
	});

	function submitzx(obj){
		var str = $('#zxForm').serialize();
		if(ping == 1){
			return false;
		}
		ping = 1;
		$(obj).val('数据提交中..')
		$.post('<?php echo site_url('/index/zx')?>', str, function(res) {
			ping = 0;
			if(res.success == 1){
				$('#tc').hide();
				$('.bgzzc').hide();
				$('#zxForm')[0].reset();
				alert(res.message)
			}else{
				$(obj).val('提交')
				alert(res.message);
			}
		}, 'json');
	}	
</script>
