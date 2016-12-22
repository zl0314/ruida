<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author ZhangLong
 * @date 2015-7-6
 **/
class User extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model', 'user_model');
		$this->uid = Userinfo::uid();
	}
	
	public function index(){
		
	}
	
	//登录
	public function signin(){
		$forward = request_get('forward') ? request_get('forward') : request_post('forward');
		$this->data['forward'] = $forward;
		if( empty($_POST)){
			$this->set_page_title('登录');
			$this->set_back_top_title('登录');
			$this->display();

		} else {
			submitcheck('dosubmit');
			$mobile = $this->input->post('mobile' , true );
			$password = $this->input->post('pwd' , true );
			$where = array(
				'mobile' => $mobile
			);
			
			if($mobile == ''){
				$this->fail('手机号不能为空');
			}else if(!istelphone($mobile)){
				$this->fail('手机号不正确');
			}else if($password == ''){
				$this->fail('密码不能为空');
			}
			$row = $this->user_model->getRow('*' , $where );
			
			if( empty($row)){
				$this->fail('用户名不存在');
			}
			if( !check_password($password , $row['salt'] , $row['password'])){
				$this->fail('密码错误');
			}
			
			$data = array(
				'id' => $row['id'],
				'password' => $row['password'],
				'username' => $row['username'],
				'forward' => urldecode($forward)
			);

			//更新信息
			$this->user_model->updateData(array('last_login_time' => time()), array('id' => $row['id']));
			$this->encryptUserinfo($data);
			$this->success(array('forward' => urldecode($forward)));
		}
	}
	
	public function signup(){
		if($this->uid){
			redirect(site_url('/'));
		}
		$doctor_id = intval($doctor_id);
		$invite_id = request_get('invite_id');
		if( empty($_POST)){
			$this->get_linkage();
			$this->set_page_title('注册');
			$this->set_back_top_title('注册');
			$vars = array(
			);
			$this->assign($vars);
			$this->display();
		}else {
			submitcheck('dosubmit');
			$data = request_post();

			$repassword = request_post('repwd');
			$checkbox = request_post('agree');
			$code = request_post('smscode');
			//发送验证码	
			$this->load->model('sms_log_model');
			$where = array(
				'mobile' => $data['mobile'] ,
				'source' => 'register'
			);
			$sms_vo = $this->sms_log_model->getRow('id,code,mobile,addtime' , $where , 'id Desc');
			//信息验证
			
			if($data['mobile'] == ''){
				$this->fail('手机号不能为空');
			}
			if(!istelphone($data['mobile'])){
				$this->fail('手机号不正确');
			}
			
			if($data['password'] == ''){
				$this->fail('密码不能为空');
			}
			if($data['password'] == $data['username']){
				$this->fail('密码不能和用户名相同');
			}

			if($repassword == ''){
				$this->fail('确认密码不能为空');
			}
			if( strlen($data['password'])<6){
				$this->fail('密码长度不能小于6位');
			}
			if( $repassword != $data['password'] ){
				$this->fail('两次密码输入不一致');
			}
			
			if(  $code == '' ){
				$this->fail('手机验证码不能为空');
			}
			if(  !empty($sms_vo['code']) && $sms_vo['code'] !=  $code){
				$this->fail('手机验证码错误');
			}
			if(!empty($sms_vo['code']) && time() > ( $sms_vo['addtime'] + 600 ) ){
				$this->fail('手机验证码已过期');
			}
			
			$exists = $this->checkExist('mobile', $data['mobile']);
			if($exists){
				$this->fail('手机号已注册');
			}
			
			
			$salt = password_salt();
			$data['salt'] = $salt;
			$data['password'] = password( $data['password'] , $salt);
			$rec = $this->user_model->saveData( $data );
			if( !$rec ){
				$this->fail('系统繁忙，请稍后再试');
			}else{
				$info = array(
					'id' => $rec,
					'password' => $data['password'],
					'username' => $data['username'] 
				);
				$this->encryptUserinfo($info);
				$this->success('注册成功');
			}
		}
	}

	//加密用户信息
	protected function encryptUserinfo($data, $toUserCenter = false){
		$expire = 3600*24*7;
		$encryptCookie = authcode($data['id'].'|'.$data['password'].'|'.$data['username'], 'ENCODE', '', $expire);
		$this->session->set_userdata('userinfo', $encryptCookie);
		$this->input->set_cookie('userinfo',$encryptCookie, $expire);
	}
	
	//发送验证码
	public function sendsms(){
		$smstype = $this->input->post('smstype');
		$smstype = $smstype!= '' ? $smstype : 'register';
		submitcheck('dosubmit');
		$mobile = $this->input->post('mobile');
		$model = $this->input->post('model');
		$where = array('mobile' => $mobile );
		$vo = $this->user_model->getRow('*', $where);
		if( $smstype == 'unremember' && empty($vo) ){
			$this->fail('手机号还没有注册');
		}
		if( $smstype== 'register' && !empty($vo) ){
			$this->fail('手机号已经注册');
		}
		if( $smstype == 'unremember' && empty($vo) ){
			$this->fail('手机号还没有注册');
		}
		$this->load->model('Sms_log_model', 'sms_log_model');
		$code = rand(100000 , 999999);
		
		$sms_content['unremember'] = '您好！您正在修改亿可之星生态医药网密码，修改验证码为：%s（十分钟内有效） 请妥善保存';
		$sms_content['register'] = '您好！欢迎加入亿可之星生态医药网，注册验证码为：%s（十分钟内有效）请妥善保存。';
		$sms_content['forgetpwd'] = '您好！您正在修改亿可之星生态医药网密码，修改验证码为：%s（十分钟内有效） 请妥善保存。';
		$sms_content['add_bank'] = '您好！您正在亿可之星生态医药网绑定您的银行卡，验证码为：%s（十分钟内有效） 请妥善保存。';
		if(empty($mobile)){
			$this->fail('手机号不能为空');
		}else if(!istelphone($mobile)){
			$this->fail('请填写正确手机号');
		}
		$res = 1;
		// $res = sendUserMessage($mobile, sprintf( $sms_content[$smstype] , $code ));
		if($res){
			$data = array(
					'code' => $code,
					'message' => sprintf( $sms_content[$smstype] , $code ),
					'mobile' => $mobile,
					'addtime' => time(),
					'source' => $smstype
			);
			$this->sms_log_model->saveData( $data );
			$arr = array(
					'err' => 0,
					// 'msg' => '验证码发送成功，请注意查收',
					'msg' => sprintf( $sms_content[$smstype] , $code )
			);
			$this->success( $arr);
		}else{
			$this->fail('验证码发送失败'.$res);
		}
	}

	public function forgetpwd(){
		if($this->uid){
			redirect(site_url('member'));
		}

		if(!empty($_POST)){
			submitcheck('dosubmit');
			$mobile = request_post('mobile');
			$code = request_post('smscode');
			$password = request_post('pwd');
			$repassword = request_post('repwd');
			
			if($mobile == ''){
				$this->fail('手机号不能为空');
			}
			if(!istelphone($mobile)){
				$this->fail('手机号不正确');
			}
			if($code == ''){
				$this->fail('验证码不能为空');
			}
			
			$where = array('mobile' => $mobile );
			$userRow = $this->user_model->getRow('id,username,mobile', $where );
			if(empty($userRow['id'])){
				$this->fail('手机号还没有注册');
			}
			
			$this->load->model('Sms_log_model', 'sms_log_model');
			$where = array('mobile' => $mobile,'source' => 'forgetpwd' );
			$codeRow = $this->sms_log_model->getRow('code,addtime', $where, 'id desc');
			if(empty($codeRow)){
				$this->fail('验证码不能为空');
			}
			if($code != $codeRow['code']){
				$this->fail('验证码不正确');
			}
			if($codeRow['addtime'] + 600 < time()){
				$this->fail('验证码已过期');
			}
			if($password == ''){
				$this->fail('密码不能为空');
			}
			if($repassword == ''){
				$this->fail('确认密码不能为空');
			}
			if( strlen($password)<6){
				$this->fail('密码长度不能小于6位');
			}
			if( $repassword != $password ){
				$this->fail('两次密码输入不一致');
			}
			$where = array('id' => $userRow['id']);
			$salt = password_salt();
			$password = password($password, $salt);
			$data = array('password' => $password, 'salt' => $salt);
			$res = $this->user_model->updateData($data, $where);
			if($res){
				$this->success('修改密码成功');
			}else{
				$this->fail('修改密码失败');
			}
			exit;
		}
		
		$this->set_page_title('忘记密码');
		$this->set_back_top_title('忘记密码');
		$this->display();
	}

	/**
	 * 本类方法检查 注册信息是否重复
	 * @param string $filed
	 * @param string $val
	 * @return boolean
	 */
	protected function checkExist( $filed, $val){
		if($val){
			$where = array(
					$filed => $val,
			);
			$vo = $this->user_model->getRow('*' , $where );
			if( $vo ){
				return true;
			}
		}else{
			return false;
		}
	}

}
