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
		$this->data['header'] = 'user_header';
		$this->data['footer'] = 'user_footer';
	}
	
	public function index(){
		
	}
	
	//登录
	public function signin(){
		$forward = request_get('forward') ? request_get('forward') : request_post('forward');
		$this->data['forward'] = $forward;
		if( empty($_POST)){
			$this->set_page_title('登录');
			$this->tpl->display();

		} else {
			submitcheck('dosubmit');
			$mobile = $this->input->post('mobile' , true );
			$password = $this->input->post('pwd' , true );
			$where = array(
				'mobile' => $mobile
			);
			
			if($mobile == ''){
				fail('手机号不能为空');
			}else if(!istelphone($mobile)){
				fail('手机号不正确');
			}else if($password == ''){
				fail('密码不能为空');
			}
			$row = $this->user_model->getRow('*' , $where );
			
			if( empty($row)){
				fail('用户名不存在');
			}
			if( !check_password($password , $row['salt'] , $row['password'])){
				fail('密码错误');
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
			success(array('forward' => urldecode($forward)));
		}
	}
	
	public function signup(){
		if($this->uid){
			redirect(site_url('/'));
		}
		if( empty($_POST)){
			$this->set_page_title('注册');
			$vars = array(
			);
			$this->tpl->assign($vars);
			$this->tpl->display();
		}else {
			submitcheck('dosubmit');
			$data = request_post();

			$repassword = request_post('repwd');
			$checkbox = request_post('agree');
			$code = request_post('smscode');
			//信息验证
			
			if($data['mobile'] == ''){
				fail('手机号不能为空');
			}
			if(!istelphone($data['mobile'])){
				fail('手机号不正确');
			}
			
			if($data['password'] == ''){
				fail('密码不能为空');
			}
			if($data['password'] == $data['username']){
				fail('密码不能和用户名相同');
			}

			if($repassword == ''){
				fail('确认密码不能为空');
			}
			if( strlen($data['password'])<6){
				fail('密码长度不能小于6位');
			}
			if( $repassword != $data['password'] ){
				fail('两次密码输入不一致');
			}
			
			if(  $code == '' ){
				fail('手机验证码不能为空');
			}
			if(  !empty($sms_vo['code']) && $sms_vo['code'] !=  $code){
				fail('手机验证码错误');
			}
			if(!empty($sms_vo['code']) && time() > ( $sms_vo['addtime'] + 600 ) ){
				fail('手机验证码已过期');
			}
			
			$exists = $this->checkExist('mobile', $data['mobile']);
			if($exists){
				fail('手机号已注册');
			}
			
			
			$salt = password_salt();
			$data['salt'] = $salt;
			$data['password'] = password( $data['password'] , $salt);
			$rec = $this->user_model->saveData( $data );
			if( !$rec ){
				fail('系统繁忙，请稍后再试');
			}else{
				$info = array(
					'id' => $rec,
					'password' => $data['password'],
					'username' => $data['username'] 
				);
				$this->encryptUserinfo($info);
				success('注册成功');
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
