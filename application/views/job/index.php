<!-- ========main======= -->
<div class="warp clearfix">
    <?php $this->load->view('location'); ?>
    <div class="banner">
        <?php if(!empty($ad_row)): ?>
        <img src="<?php echo $ad_row['pic'] ?>" alt="">
	<?php else: ?>
        <img src="/static/web/images/jr_banner.jpg" alt="">
	<?php endif; ?>
    </div>
    <?php if(!empty($list)): ?>
    	<?php foreach ($list as $key => $r): ?>
    		
    	<?php endforeach ?>
    <div class="jr_list">
        <span class="ck_more">
            <a href="<?php echo site_url('job/show/'.$r['id']); ?>">查看详情</a>
        </span>
        <h2>
            <a href="<?php echo site_url('job/show/'.$r['id']); ?>"><?php echo $r['title'] ?></a>
        </h2>
        工作年限： <?php echo $r['worker_age'] ?>&nbsp;&nbsp;发布时间： <?php echo date('Y-m-d', $r['addtime']) ?><br>
        <?php echo $r['intro'] ?>
        <?php $r['fuli'] = str_replace('，', ',', $r['fuli']); ?>
        <?php $label = explode(',', $r['fuli']) ?>
        <?php if(!empty($label)): ?>
        <span class="fl_bq">
        <?php foreach ($label as $key => $value): ?>
            <a href="javascript:;"><?php echo $value ?></a>
        <?php endforeach ?>
        </span>
    <?php endif; ?>
    </div>
<?php else: ?>
	<div style="width:100%;height:50px;line-height: 50px;text-align: center; font-size:19px">暂时没有任何招聘信息...</div>
    <?php endif; ?>
    <?php if(!empty($page_html)): ?>
    <div class="page">
       <?php echo $page_html; ?>
    </div>
<?php endif; ?>
</div>
