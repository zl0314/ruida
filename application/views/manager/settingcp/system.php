
<div class="main-cont clear">
  <div class="tab-box">
    
    <div class="tab-con-s1" id="skin-tabs">
      <div class="tab">
        <div class="main-cont">
          <div class="set-area">
                <form id="MyFrom" name="MyFrom" action="" method="post">
              <div class="form" style="display:;">
              <input type="hidden" value="<?=!empty($row['id']) ? $row['id'] : '' ?>" name="id">
                    <div class="form-row">
						<label for="web_name" class="form-field">站点名称</label>
						<div class="form-cont">
								<input type="text" class="input-txt" id="web_name" name="setting[site_title]" value="<?=!empty($setting['site_title']) ? $setting['site_title'] : '' ?>" />
								<span class="form-tips">请填写运营站点的名称</span>
						</div>
						</div>
						
						<div class="form-row" >
						<label for="keywords" class="form-field">网站关键字</label>
						<div class="form-cont">
								<input type="text" class="input-txt" id="keywords" name="setting[keywords]" value="<?=!empty($setting['keywords']) ? $setting['keywords'] : '' ?>" />
								<span class="form-tips">META标签的keyword内容</span>
						</div>
						</div>
						
						<div class="form-row" >
							<label for="description" class="form-field">网站描述</label>
							<input type="text" class="input-txt" id="description" name="setting[description]" value="<?=!empty($setting['description']) ? $setting['description'] : '' ?>" />	
							<span class="form-tips">META标签的description内容</span>
						</div>
						
						<div class="form-row" >
							<label for="contact_tel" class="form-field">联系电话</label>
							<input type="text" class="input-txt" id="contact_tel" name="setting[contact_tel]" value="<?=!empty($setting['contact_tel']) ? $setting['contact_tel'] : '' ?>" />	
							<span class="form-tips"></span>
						</div>
						
						<div class="form-row" >
							<label for="contact_wechat" class="form-field">联系微信</label>
							<input type="text" class="input-txt" id="contact_wechat" name="setting[contact_wechat]" value="<?=!empty($setting['contact_wechat']) ? $setting['contact_wechat'] : '' ?>" />	
							<span class="form-tips"></span>
						</div>
						

						<div class="form-row" >
							<label for="contact_email" class="form-field">联系邮箱</label>
							<input type="text" class="input-txt" id="contact_email" name="setting[contact_email]" value="<?=!empty($setting['contact_email']) ? $setting['contact_email'] : '' ?>" />	
						</div>

					<div class="form-row" >
							<label for="customer_tel" class="form-field">客服电话</label>
							<input type="text" class="input-txt" id="customer_tel" name="setting[customer_tel]" value="<?=!empty($setting['customer_tel']) ? $setting['customer_tel'] : '' ?>" />	
						</div>

						<div class="form-row" >
							<label for="service_line" class="form-field">服务热线</label>
							<input type="text" class="input-txt" id="service_line" name="setting[service_line]" value="<?=!empty($setting['service_line']) ? $setting['service_line'] : '' ?>" />	
						</div>
						
						 
					<div class="form-row" >
							<label for="company_address" class="form-field">公司地址</label>
							<input type="text" class="input-txt" id="company_address" name="setting[company_address]" value="<?=!empty($setting['company_address']) ? $setting['company_address'] : '' ?>" />	
						</div>

					<div class="form-row" >
							<label for="footinfo" class="form-field">底部信息</label>
							<textarea class="input-area" id="footinfo" name="setting[footinfo]"><?=!empty($setting['footinfo']) ? $setting['footinfo'] : '' ?></textarea>
						</div>
						
						<div class="form-row">
							  <label for="wechat_qr" class="form-field">官方微信</label>
							  <div class="form-cont">
								  <input id="wechat_qr" type="text" name="setting[wechat_qr]"  class="input-txt" value="<?=!empty($setting['wechat_qr']) ? $setting['wechat_qr'] : '';?>" />
								  <input type="button"class="ajaxUploadBtn"  id="wechat_qr_button" onclick="ajaxUpload('wechat_qr','setting')" value="上传图片" style="width:70px; height:25px;">
								  <span class="form-tips">宽245px, 高183px</span>
							  </div>
						  </div>
						  
						</div>
                      <div class="btn-area">
						<input class="input-button" type="submit" value="提交">
                    </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
