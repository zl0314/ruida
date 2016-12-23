
<!-- footer -->
<div class="footer clearfix">
    <div class="warp clearfix">
        <div class="footer_top">
            <a href="<?php echo site_url('pages/aboutus') ?>">关于我们</a>
            <!-- <a href="<?php echo site_url('pages/contactus') ?>">联系我们</a> -->
            <a href="<?php echo site_url('pages/statement') ?>">隐私声明</a>
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