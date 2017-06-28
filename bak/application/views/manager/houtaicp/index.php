<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo ADMIN_TITLE?></title>
<link type="text/css" rel="stylesheet" href="/static/admin/admin.css" media="screen" />
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
</head>
<script>
$(function(){
	$('.menu-group li').click(function(){
		$('.menu-group li').removeClass('current');
		$(this).addClass('current');
	});
	$('.header-ul li').click(function(){
		_index = $(this).index();
		$('.header-ul li').removeClass('current');
		$('.header-ul li:eq('+_index+')').addClass('current');
		$('.menu-group').hide();
		$('.menu-group:eq('+_index+')').show();
	});
});
</script>
<body>
<div id="header">
  <h1><a href="<?php echo site_url('/')?>" target="_blank"><?php echo ADMIN_TITLE?></a></h1>
  
  
  <ul class="header-ul">
  <?php $privileges_keys = array_keys($privileges)?>
  <?php if(!empty($admin_menus)):?>
	<?php foreach( $admin_menus as $k => $r):?>
		<?php foreach($r['lists'] as $lk => $lr):?>
			<?php if(in_array($lk, $privileges_keys)):?>
    			<li class="<?php if($k == 0){ echo 'current';}?>"><a href="javascript:;"><?php echo $r['name']?></a></li>
			<?php break; endif;?>
		<?php endforeach;?>
	<?php 
	endforeach;
	endif;
	?>
  </ul>
  <p><span>您好 ，<?php echo $this->session->userdata('nickname');?>，欢迎回来, </span><a href="<?php echo site_url('houtaicp/logout');?>">退出</a></p>
</div>
<div id="mainDiv" class="main-frame" style="height: 677px; ">
  <iframe src="<?php echo site_url('houtaicp/center');?>" id="mainframe" name="mainframe" width="100%" height="100%" frameborder="0" title="main frame content"></iframe>
</div>
<div id="side-menu" style="height: 677px; "> 
	<?php if(!empty($admin_menus)):?>
	<?php foreach( $admin_menus as $k => $r):?>
	<div class="menu-group" style="display:<?php if($k == 0){echo 'block';}else{ echo 'none';} ?>">
	
	<?php if(!empty($r['lists'])):?>
	<?php foreach( $r['lists'] as $subk => $subr):?>
	<?php if($subr['status'] == 0){continue;}?>
	<?php if(isset($privileges[$subk])):?>
	
    <h2 class="first"><?php echo $subr['name']?></h2>
    <ul>
    
     <?php if(!empty($subr['method'])):?>
		 <?php foreach( $subr['method'] as $methodk => $methodr):?>
			 <?php if($methodr['status'] == 0){continue;}?>
				 <?php if(in_array($methodk, $privileges[$subk]) || isset($privileges[$subk][$methodk]) ):?>
			      <li ><a href="<?php echo site_url($subk.'/'.$methodk);?>" target="mainframe"><?php echo $methodr['name']?></a></li>
			     <?php endif;?>
		     <?php endforeach;?>
		     <?php endif;?>
	    </ul>
    <?php endif;?>
  <?php endforeach;?>
   <?php endif;?>
   
   </div>
   <?php endforeach;?>
   <?php endif;?>
   
</div>
<script>
//初始化 自适应窗口大小
var autoSize = function(){
	var height = document.documentElement.clientHeight - 89;
	//$('#side-menu').css('height',height+'px');
	$('#mainDiv').css('height',height+'px');
}
autoSize();
$(window).resize(autoSize);
</script>
</body>
</html>