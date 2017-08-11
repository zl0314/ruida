<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo !empty($pagetitle) ? $pagetitle : $webset['site_title'];?></title>
<link type="text/css" rel="stylesheet" href="/static/web/css/style.css" />
<script type="text/javascript" src="/static/web/js/jquery.js"></script>
<script type="text/javascript" src="/static/js/common.js"></script>
<meta name="keywords" content="<?php echo !empty($webset['keywords']) ? $webset['keywords'] : ''; ?>" />
<meta name="description" content="<?php echo !empty($webset['description']) ? $webset['description'] : ''; ?>" />
</head>
<body >
<!-- ====header=== -->
<div class="warp clearfix">
    <div class="hd_top">
       <?php if(!Userinfo::uid()): ?>
            <span>
                <a href="<?php echo site_url('user/signin') ?>">
                    <i class="dl_ico"></i>登录
                </a>
                <a href="<?php echo site_url('user/signup') ?>">
                    <i class="zc_ico"></i>立即注册
                </a>
            </span>
        <?php else: ?>
            <span>
                <a href="javascript:;">
                    <?php echo Userinfo::getUserInfo('mobile') ?>
                </a>
                <a href="<?php echo site_url('user/logout') ?>">
                    <i ></i>退出
                </a>
            </span>
        <?php endif; ?>
    </div>
    <div class="hd_bottom">
        <div class="logo left">
            <img src="/static/web/images/logo.png" alt="">
        </div>
        <div class="i_nav right">
            <ul>
                <li <?php if(in_array($siteclass, array('index'))): ?>class="cur"<?php endif; ?>>
                        <a href="<?php echo site_url() ?>">
                            首页
                        </a>
                    </li>
                 <li <?php if(!empty($type) && in_array($type, array('1'))): ?>class="cur"<?php endif; ?>>
                        <a href="<?php echo site_url('house?t=1')?>">
                            商业地产
                        </a>
                    </li>
                 <li <?php if(!empty($type) && in_array($type, array('2'))): ?>class="cur"<?php endif; ?>>
                        <a href="<?php echo site_url('house?t=2')?>">
                            投资地产
                        </a>
                    </li>
                    <li <?php if(!empty($type) && in_array($type, array('3'))): ?>class="cur"<?php endif; ?>>
                        <a href="<?php echo site_url('house?t=3')?>">
                            学区房/豪宅
                        </a>
                    </li>
                    <li <?php if(!empty($type) && in_array($type, array('4'))): ?>class="cur"<?php endif; ?>>
                        <a href="<?php echo site_url('house?t=4')?>">
                            新房
                        </a>
                    </li>
                <li>
                    <a href="#">
                        全国地产服务
                    </a>
                </li>
                <li  <?php if(in_array($siteclass, array('job'))): ?>class="cur"<?php endif; ?>>
                        <a href="<?php echo site_url('job') ?>">
                            加入我们
                        </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
