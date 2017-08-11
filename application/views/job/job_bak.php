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
    <div class="zp_box">
        <div class="zp_box_left left">
            <div class="zp_box_left_top">
                <ul>
                 <li  >
                        <a <?php if('0' == $type) {echo 'class="cur"';}?> href="<?= site_url('job/index/?city='.request_get('city')) ?>">
                           全部
                        </a>

                   <?php foreach($jobType as $k => $r):?>
                    <li  >
                        <a href="<?= site_url('Job/index/'.$k.'?city='.request_get('city')) ?>" <?php if($k == $type) {echo 'class="cur"';}?>>
                            <?=$r?>
                        </a>
                    </li>
                   <?php endforeach;?>
                </ul>
            </div>
            <div class="zp_box_left_bottom">
            <?php if(!empty($list)): ?>
            <?php foreach ($list as $key => $r): ?>

                    <div class="jr_list">
                        <span class="ck_more">
                            <a href="<?php echo site_url('job/show/'.$r['id']); ?>">查看详情</a>
                        </span>
                        <h2>
                            <a href="<?php echo site_url('job/show/'.$r['id']); ?>"><?php echo $r['title'] ?></a>
                           <?php $r['fuli'] = str_replace('，', ',', $r['fuli']); ?>
                            <?php $label = explode(',', $r['fuli']) ?>
                            <?php if(!empty($label)): ?>
                            <span class="fl_bq">
                            <?php foreach ($label as $key => $value): ?>
                                <a href="javascript:;"><?php echo $value ?></a>
                            <?php endforeach ?>
                            </span>
                        <?php endif; ?>
                        </h2>
                        <?php echo $r['intro'] ?>
                    </div>
                    
                    <?php endforeach ?>
             <?php else: ?>
                <div style="width:100%;height:50px;line-height: 50px;text-align: center; font-size:19px">暂时没有任何招聘信息...</div>
                <?php endif; ?>

               <?php if(!empty($page_html)): ?>
                    <div class="page">
                       <?php echo $page_html; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

       <?php $this->load->view('job/right')?>


</div>
</div>