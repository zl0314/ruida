<style>
	body{
		background-image: url(/static/web/images/top_bg.jpg); background-repeat:no-repeat;
background-attachment:fixed; background-position:center top;
	}
</style>
<!-- ====main=== -->
<div class="warp clearfix">
	<div class="i_banner">
		<img src="/static/web/images/i_banner.png" alt="">
	</div>
	<div class="search">
		<div class="search_top">
			<a href="javascript:;" class="active">
				商业地产
			</a>
			<a href="javascript:;">
				  投资地产
			</a>
			<a href="javascript:;">
				 学区房/豪宅
			</a>
			<a href="javascript:;">
				 新房
			</a>
		</div>
		<div class="search_bottom">
			<input type="text" value="请输入区域、商圈或小区名开始找房" class="i_ss_wbk left">
			<input type="button" value="" class="i_ss_but left">
		</div>
		<script type="text/javascript">
			$(".search_top a").click(function() {
				$(this).addClass('active').siblings().removeClass('active');
			});
		</script>
	</div>
</div>
<!-- 联系我们 -->
<div class="lxwm">
	<div class="warp clearfix">
		<div class="lxwm_box clearfix">
			<img src="/static/web/images/lxwm.png" alt="">
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
			<div class="rmsq_bottom_list left ml">
				<a href="#">
					<img src="/static/web/images/i1.jpg" alt="">
					<span>国贸</span>
				</a>
			</div>
			<div class="rmsq_bottom_list left">
				<a href="#">
					<img src="/static/web/images/i2.jpg" alt="">
					<span>中关村</span>
				</a>
			</div>
			<div class="rmsq_bottom_list left">
				<a href="#">
					<img src="/static/web/images/i3.jpg" alt="">
					<span>知春路</span>
				</a>
			</div>
			<div class="rmsq_bottom_list_2 left ml">
				<a href="#">
					<img src="/static/web/images/i4.jpg" alt="">
					<span>朝外</span>
				</a>
			</div>
			<div class="rmsq_bottom_list left">
				<a href="#">
					<img src="/static/web/images/i5.jpg" alt="">
					<span>上地</span>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- ====商业地产==== -->
<div class="sydc clearfix">
	<div class="warp clearfix">
		<div class="sydc_title">
			<span>
				<a href="javascript:;">
					更多商业地产
				</a>
			</span>
			商业地产
		</div>
		<div class="sydc_bottom clearfix">
			<div class="sydc_bottom_list ml">
				<a href="javascript:;">
					<img src="/static/web/images/i_img.jpg" alt="">
				</a>
				<div class="sydc_bottom_nr">
					<a href="#">
						天畅园精装户型方正两居室视野好可观万达大湖
					</a>
					<p>单价102141元/平米 1050万</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ====投资地产==== -->
<div class="tzdc clearfix">
	<div class="warp clearfix">
		<div class="sydc_title">
			<span>
				<a href="javascript:;">
					更多投资地产
				</a>
			</span>
			投资地产
		</div>
		<div class="sydc_bottom clearfix">
			<div class="sydc_bottom_list ml">
				<a href="#">
					<img src="/static/web/images/i_img.jpg" alt="">
				</a>
				<div class="sydc_bottom_nr">
					<a href="#">
						天畅园精装户型方正两居室视野好可观万达大湖
					</a>
					<p>单价102141元/平米 1050万</p>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!-- ====学区房/豪宅==== -->
<div class="sydc clearfix">
	<div class="warp clearfix">
		<div class="sydc_title">
			<span>
				<a href="#">
					更多学区房/豪宅
				</a>
			</span>
			学区房/豪宅
		</div>
		<div class="sydc_bottom clearfix">
			<div class="sydc_bottom_list ml">
				<a href="#">
					<img src="/static/web/images/i_img.jpg" alt="">
				</a>
				<div class="sydc_bottom_nr">
					<a href="#">
						天畅园精装户型方正两居室视野好可观万达大湖
					</a>
					<p>单价102141元/平米 1050万</p>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- ======弹窗======== -->
<form action="" method="post" id="zxForm">
<input type="hidden" name="type" id="zx_type" value="1">
<div class="tc">
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
					<input type="text" class="i_wbk1" name="captcha" placeholder="验证码"><img src="<?php echo site_url('api/captcha') ?>" title="点击切换验证码" style="cursor: pointer" onclick="this.src='<?php echo site_url('api/captcha') ?>'" class="inputcheckbox" width="80" alt="">
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
		$.post('<?php echo site_url('/index/zx')?>', str, function(res) {
			if(res.success == 1){
				alert(res.message)
			}else{
				alert(res.message);
			}
		}, 'json');
	}	
</script>
