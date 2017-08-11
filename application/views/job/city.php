<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo !empty($pagetitle) ? $pagetitle : $webset['site_title'];?></title>

<link type="text/css" rel="stylesheet" href="/static/web/css/style.css" />
<script type="text/javascript" src="/static/web/js/jquery.js"></script>
</head>
<body  style="background-image: url(/static/web/images/zp_bg.jpg); background-repeat:no-repeat; background-position:center top; background-size: 100% auto">
<!-- ====header=== -->
<div class="warp clearfix">
    <div class="hd_bottom">
        <div class="logo left">
            <img src="/static/web/images/logo.png" alt="">
        </div>
        <div class="i_nav right">
            <ul>
                <li>
                    <a href="<?=site_url('/')?>" target="_blank">
                        首页                
                    </a>
                </li>
                <?php foreach($city_list as $k => $r):?>
                <li>
                    <a  target="_blank" href="<?=site_url('job?city='.$r['id'])?>">
                        <?=$r['name']?>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
<!-- =====main======= -->
<div class="warp clearfix">
    <div class="zp_sy clearfix">
        <img src="/static/web/images/cp_img.png" alt="">
        <a href="<?=site_url('job')?>">
            浏览更多职位
        </a>
    </div>
</div>
</body>
</html>