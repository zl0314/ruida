<!-- ========main======= -->
<div class="warp clearfix">
    <div class="user">
     <?php $this->load->view('location'); ?>
    </div>
    <div class="banner">
        <?php if(!empty($ad_row)): ?>
        <img src="<?php echo $ad_row['pic'] ?>" alt="">
	<?php else: ?>
        <img src="/static/web/images/jr_banner.jpg" alt="">
	<?php endif; ?>
    </div>
    <div class="jrwm_xx clearfix">
        <div class="jrwm_xx_title">
            <?php echo $row['title'] ?><span>工作年限： <?php echo $row['worker_age'] ?></span>
        </div>
        <div class="jrwm_xx_nr">
            <h2>工作职责</h2>
          	<?php echo $row['duty'] ?>
            <h2>工作要求</h2>
          	<?php echo $row['ability'] ?>
        
        </div>
        <div class="jrwm_xx_but">
           <!--  <a href="javascript:;">
                <i></i>马上投递
            </a> -->
            申请职位时邮件主题标明营配岗位及工作地点<br>
            简历投至： <?php echo !empty($webset['job_email']) ? $webset['job_email'] : 'join@lianjia.com' ?>
        </div>
    </div>
</div>
