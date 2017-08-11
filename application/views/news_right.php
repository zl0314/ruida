<div class="zp_box_right right">
            <div class="zp_box_ewm">
                <h2>
                    关注公众号<br>
                    浏览更多职位
                </h2>
                <img src="<?php if(!empty($webset['wechat_qr'])):?><?=$webset['wechat_qr']?><?php else:?>/static/web/images/ewm.jpg<?php endif;?>" alt="">
            </div>

    <?php if(!empty($top_list)):?>
            <div class="zp_box_list">
                <div class="zp_box_list_bt">
                    热门资讯
                </div>
                <div class="zp_box_list_bottom">
                    <ul>
                    <?php foreach ($top_list as $v): ?>
                        <li>
                            <a href="<?php echo site_url('news/show/'.$v['id'])?>">
                                <i></i><?=mb_substr($v['title'], 0, 14)?>
                            </a>
                        </li>
                   <?php endforeach ?>
                    </ul>
                </div>
            </div>
        <?php endif;?>

        </div>