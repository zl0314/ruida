<div class="login">
    <div class="login_top">
        <span>
            已有账号？
            <a href="<?php echo site_url('user/signin') ?>">
                马上登录
            </a>
        </span>
        <a href="<?php echo site_url() ?>">返回首页</a>
    </div>
    <form action="" id="regForm" method="post">
    <div class="login_center">
        <div class="login_logo">
            <img src="/static/web/images/logo.png" alt="">
        </div>
        <div class="login_nr">
            <input type="text" value="" name="mobile" placeholder="请输入手机号" class="zc_wbk"><font>*</font>
        </div>
        <div class="login_nr">
            <input type="text" value=""  name="email" placeholder="请输入邮箱"  class="zc_wbk"><font>*</font>
        </div>
        <div class="login_nr">
            <input type="password" value="" name="pwd"   placeholder="请输入密码" class="zc_wbk"><font>*</font>
        </div>
        <div class="login_nr">
            <input type="password" value="" name="repwd"  placeholder="请重新输入密码"  class="zc_wbk"><font>*</font>
        </div>
        <div class="login_nr">
            <label><input type="checkbox" name="agree" value="1">我已阅读并同意《<a href="javascript:;">瑞达联行用户使用协议</a>》</label>
        </div>
        <div class="login_nr">
            <a href="javascript:;" onclick="reg(this)" class="login_but">
                立即注册
            </a>
        </div>
    </div>
</form>
<script>
function reg(obj){
    if(ping == 1){
        return;
    }
    ping == 1;
    $(obj).html('数据提交中..');
	var str = $('#regForm').serialize();
	$.post('<?php echo site_url('user/signup') ?>', str, function(res) {
		if(res.success == 1){
            $(obj).html('注册成功');
			window.location.href = '<?php echo site_url('/') ?>';
		}else{
            $(obj).html('立即注册');
			alert(res.message);
		}
	}, 'json');	
}

</script>