<div class="warp clearfix">
    <div class="user">
        <i></i><a href="<?=site_url()?>">首页</a> > <a href="<?=site_url('news')?>"><?= $newsType[$row['type']]?></a>
    </div>
    <div class="banner">
        <img src="/static/web/images/dc_banner.jpg" alt="">
    </div>
    <div class="zp_box">
        <div class="zp_box_left left">
            <?php $this->load->view('news/news_header')?>
            
            <div class="zp_box_left_bottom">
                <div class="fc_xx_title">
                    <?=$row['title']?>
                    <span>
                        来源：<?=$row['source']?>
                        时间：<?=date('Y-m-d', $row['fb_time'])?>
                    </span>
                </div>
                <div class="fc_xx_bottom">
                    
                    <?=htmlspecialchars_decode($row['content'])?>
                </div>

                <div class="fc_xx_bottom_a">
                    <?php if (!empty($prev)): ?>
                    	<a href="<?php echo site_url('news/show/'.$prev['id'])?>">
                        上一条： <?php echo $prev['title']?>
                    </a>
                    <?php endif ?>
                    
					<?php if (!empty($next)): ?>
                    <a href="<?php echo site_url('news/show/'.$next['id'])?>">
                        下一条：<?php echo $next['title']?>
                    </a>
                    <?php endif ?>

                </div>
            </div>

            <?php if(!empty($recomment_list)):?>
            <div class="zp_box_left_tj">
                <div class="zp_box_left_tj_title">
                    <span>相关推荐</span>
                </div>
                <div class="zp_box_left_tj_bottom">
                	<?php foreach ($recomment_list as $v): ?>
                		
                    <div class="zp_box_left_tj_bottom_list">
                        <a href="<?php echo site_url('news/show/'.$v['id'])?>">
                            <img src="<?= $v['thumb']?>" alt="">
                            <div class="tj_nr">
                                <?= $v['title']?>
                            </div>
                        </a>
                    </div>
                	<?php endforeach ?>
                     
                </div>
            </div>
        <?php endif;?>

        </div>
            <?php $this->load->view('news_right')?>

        
    </div>
</div>
