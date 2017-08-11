<?php $this->load->view('common_header');?>

<div class="main-cont clear">
  <div class="tab-box">
<style>
.table_form tr{ height:40px;}
.table_form th{ font-weight:normal}
</style>
    <div class="tab-con-s1" id="skin-tabs">
      <div class="tab">
        <div class="main-cont">
          <div class="set-area">
            <form id="MyFrom" name="MyFrom" action="" method="post">
               <table width="100%"  class="table_form">
			  <tr>
			  <input type="hidden" name="setting[id]" value="<?=!empty($setting['id']) ? $setting['id'] : '' ?>">
			    <th width="120">邮件发送模式</th>
			    <td class="y-bg">
			     <input name="setting[mail_type]" checkbox="mail_type" class="ipt-radio" value="1" onclick="showsmtp(this)" type="radio"  checked> SMTP 函数发送    
			     <!-- <input name="setting[mail_type]" checkbox="mail_type" value="0" onclick="showsmtp(this)" type="radio"  disabled/> mail 模块发送 --> 
				</td>
			  </tr>
			  <tbody id="smtpcfg" style="">
			  <tr>
			    <th>邮件服务器</th>
			    <td class="y-bg"><input type="text" class="input-txt" name="setting[mail_server]" id="mail_server" size="30" value="<?=!empty($setting['mail_server']) ? $setting['mail_server'] : 'smtp.qq.com' ?>"/></td>
			  </tr>  
			  <tr>
			    <th>邮件发送端口</th>
			    <td class="y-bg"><input type="text" class="input-txt" name="setting[mail_port]" id="mail_port" size="30" value="<?=!empty($setting['mail_port']) ? $setting['mail_port'] : '25' ?>"/></td>
			  </tr> 
			  <tr>
			    <th>发件人地址</th>
			    <td class="y-bg"><input type="text" class="input-txt" name="setting[mail_from]" id="mail_from" size="30" value="<?=!empty($setting['mail_from']) ? $setting['mail_from'] : 'test@admin.com' ?>"/></td>
			  </tr>   
			  <!-- <tr>
			    <th>AUTH LOGIN验证</th>
			    <td class="y-bg">
			    <input name="setting[mail_auth]" checkbox="mail_auth" value="1" type="radio"  checked> 开启	<input name="setting[mail_auth]" checkbox="mail_auth" value="0" type="radio" > 关闭</td>
			  </tr> 
			 -->
				  <tr>
				    <th>验证用户名</th>
				    <td class="y-bg"><input type="text" class="input-txt" name="setting[mail_user]" id="mail_user" size="30" value="<?=!empty($setting['mail_user']) ? $setting['mail_user'] : 'test@admin.com' ?>"/></td>
				  </tr> 
				  <tr>
				    <th>验证密码</th>
				    <td class="y-bg"><input type="password" class="input-txt" name="setting[mail_password]" id="mail_password" size="30" value="<?=!empty($setting['mail_password']) ? $setting['mail_password'] : '' ?>"/></td>
				  </tr>
			
			 </tbody>
			  <tr>
			    <th>邮件设置测试</th>
			    <td class="y-bg"><input type="text" class="input-txt" name="mail_to" id="mail_to" size="30" value="<?=!empty($setting['mail_test']) ? $setting['mail_test'] : '' ?>"/> 
			    <input type="button" class="button " onClick="javascript:test_mail();" value="测试发送"></td>
			  </tr>
			  
			  <tr>
			    <th></th>
			    <td class="y-bg">
			    <input type="submit" class="button" value="保存"></td>
			  </tr>     
			             
  </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function test_mail() {
	var mail_type = $('input[checkbox=mail_type][checked]').val();
	var mail_auth = $('input[checkbox=mail_auth][checked]').val();
    $.post('<?php echo site_url('setting/public_test_mail')?>?mail_to='+$('#mail_to').val(),{mail_type:mail_type,mail_server:$('#mail_server').val(),mail_port:$('#mail_port').val(),mail_user:$('#mail_user').val(),mail_password:$('#mail_password').val(),mail_auth:mail_auth,mail_from:$('#mail_from').val()}, function(data){
		alert(data);
	});
}
</script>
<?php $this->load->view('common_footer');?>
