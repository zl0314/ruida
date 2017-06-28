<!-- ========main======= -->
<div class="warp clearfix">
   <?php $this->load->view('location'); ?>
    <div class="banner">
	<?php if(!empty($ad_row)): ?>
        <img src="<?php echo $ad_row['pic'] ?>" alt="">
	<?php else: ?>
        <img src="/static/web/images/gy_banner.jpg" alt="">
	<?php endif; ?>
    </div>
    <div class="gy_text clearfix">
       <?php echo $page['content'] ?>
    </div>
</div>