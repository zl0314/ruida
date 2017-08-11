
<!-- footer -->
<div class="footer clearfix">
<?php if($siteclass == 'index'):?>
    <div class="f_top_box clearfix">
        <div class="warp clearfix">
            <ul>
                <li>
                    <img src="/static/web/images/f_ico1.png" alt="">
                    <span>信息真实</span>
                </li>
                <li>
                    <img src="/static/web/images/f_ico2.png" alt="">
                    <span>专车接送</span>
                </li>
                <li>
                    <img src="/static/web/images/f_ico3.png" alt="">
                    <span>一对一服务</span>
                </li>
            </ul>
        </div>
    </div>
<?php endif;?>
    <div class="warp clearfix">
        <div class="footer_top">
            <a href="<?php echo site_url('pages/aboutus') ?>">关于我们</a>
             <a href="<?php echo site_url('pages/contactus') ?>">联系我们</a>
            <a href="<?php echo site_url('pages/statement') ?>">隐私声明</a>
            <?php if($siteclass == 'index'):?>
             <div class="footer_dh">
                客服电话<span><?php echo !empty($webset['customer_tel']) ? $webset['customer_tel'] : '' ?></span>24小时
            </div>
          <?php endif;?> 
        </div>
        <div class="footer_center clearfix">
            <h2>合作与友情链接</h2>
            <?php if(!empty($friend_link)): ?>
                <?php foreach ($friend_link as $k => $r): ?>
                        <a target="_blank" href="<?php echo $r['link_url'] ?>"><?php echo $r['name'] ?></a>
                <?php endforeach ?>
            <?php endif; ?>
        </div>
        <div class="footer_bottom">
            <?php echo $webset['footinfo']?>
        </div>
    </div>
</div>
</body>
</html>