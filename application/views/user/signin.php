<div class="login">
    <div class="login_top">
        <span>
            还没有账号？
            <a href="<?php echo site_url('user/signup') ?>">
                马上注册
            </a>
        </span>
        <a href="<?php echo site_url('') ?>">返回首页</a>
    </div>
    <form action="" id="loginForm" method="post">
    <div class="login_center">
        <div class="login_logo">
            <img src="/static/web/images/logo.png" alt="">
        </div>
        <div class="login_nr">
            <input type="text" value="" name="mobile" id="mobile" placeholder="请输入手机号" class="zc_wbk sjh">
        </div>
        <div class="login_nr">
            <input type="password" value="" name="pwd" id="password" placeholder="请输入密码" class="zc_wbk mm">
        </div>
        <div class="login_nr">
            <label><input type="checkbox" name="remember" value="1">下次自动登录</label>
        </div>
        <div class="login_nr">
            <a href="javascript:;" onclick="login(this)" class="login_but">
                立即登录
            </a>
        </div>
    </div>
    </form>

<script>
function login(obj){
    var str = $('#loginForm').serialize();
    $.post('<?php echo site_url('user/signin') ?>', str, function(res) {
        if(res.success == 1){
            window.location.href = '<?php echo site_url('/') ?>';
        }else{
            alert(res.message);
        }
    }, 'json'); 
}
</script>