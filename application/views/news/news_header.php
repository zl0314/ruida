<div class="zp_box_left_top">
    <ul>
        <li>
            <a href="<?=site_url('news')?>" <?php if(empty($type) ):?> class="cur" <?php endif?>>
                全  部
            </a>
        </li>
        <li>
            <a href="<?=site_url('news/index/1')?>" <?php if($type == 1):?> class="cur" <?php endif?>>
                商业地产
            </a>
        </li>
        <li>
            <a href="<?=site_url('news/index/2')?>" <?php if($type == 2):?> class="cur" <?php endif?>> 
                投资地产
            </a>
        </li>
        <li>
            <a href="<?=site_url('news/index/3')?>" <?php if($type == 3):?> class="cur" <?php endif?>>
                全国地产
            </a>
        </li>
        <li>
            <a href="<?=site_url('news/index/4')?>" <?php if($type == 4):?> class="cur" <?php endif?>>
                其它
            </a>
        </li>
    </ul>
</div>