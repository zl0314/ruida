<!-- ========main======= -->
<div class="warp clearfix">
    <div class="user">
       <i></i><a href="<?=site_url()?>">首页</a> > <a href="javascript:;">房产咨询</a>
    </div>
    <div class="banner">
        <img src="/static/web/images/dc_banner.jpg" alt="">
    </div>
    <div class="zp_box">
        <div class="zp_box_left left">
            <?php $this->load->view('news/news_header')?>
            
            <div class="zp_box_left_bottom">
                <?php if(!empty($list)):?>
                	<?php foreach ($list as $r) :?>
                		
                <div class="fczx_list">
                    <dl>
                        <dt>
                            <a href="<?php echo site_url('news/show/'.$r['id'])?>">
                                <?php if(!empty($r['thumb'])):?><img src="<?=$r['thumb']?>" alt=""><?php else:?><img src="/static/web/images/dc_img2.jpg" alt=""><?php endif;?>
                            </a>
                        </dt>
                        <dd>
                            <a href="<?php echo site_url('news/show/'.$r['id'])?>">
                                <?=$r['title']?>
                            </a>
                             <?=mb_substr(strip_tags(htmlspecialchars_decode($r['content'])), 0, 100)?>
                        </dd>
                    </dl>
                </div>
            <?php endforeach;?>

        <?php else:?>
        	<div style="width:100%;height:50px; padding-top:30px; text-align: center;;">暂时没有任何咨询...</div>
            <?php endif;?>
                <div class="page">
                    <?= $page_html?>
                </div>
            </div>
        </div>
            <?php $this->load->view('news_right')?>
        
    </div>
</div>
