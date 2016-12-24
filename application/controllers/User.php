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
		if($this->uid){
			redirect(site_url('/'));
		}
	}
	
	//登录
	public function signin(){
		if($this->uid){
			redirect(site_url('/'));
		}
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
				'mobile' => $row['mobile'],
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
			$post = request_post();

			$repassword = request_post('repwd');
			$checkbox = request_post('agree');
			//信息验证
			
			if($post['mobile'] == ''){
				fail('手机号不能为空');
			}
			if(!istelphone($post['mobile'])){
				fail('手机号不正确');
			}
			if(empty($post['email'])){
				fail('邮箱地址不能为空');
			}
			if(!isemail($post['email'])){
				fail('邮箱地址不正确');
			}
			
			if(empty($post['pwd'])){
				fail('密码不能为空');
			}
			if($post['pwd'] == $post['mobile']){
				fail('密码不能和用户名相同');
			}

			if($repassword == ''){
				fail('确认密码不能为空');
			}
			if( strlen($post['pwd'])<6){
				fail('密码长度不能小于6位');
			}
			if( $repassword != $post['pwd'] ){
				fail('两次密码输入不一致');
			}
			
			// if(  $code == '' ){
			// 	fail('手机验证码不能为空');
			// }
			// if(  !empty($sms_vo['code']) && $sms_vo['code'] !=  $code){
			// 	fail('手机验证码错误');
			// }
			// if(!empty($sms_vo['code']) && time() > ( $sms_vo['addtime'] + 600 ) ){
			// 	fail('手机验证码已过期');
			// }
			
			$exists = $this->checkExist('mobile', $post['mobile']);
			if($exists){
				fail('手机号已注册');
			}
			
			if(empty($post['agree'])){
				fail('请阅读并同意《瑞达联行用户使用协议》');
			}

			$salt = password_salt();
			$post['salt'] = $salt;
			$post['password'] = password( $post['pwd'] , $salt);
			$post['username'] = $post['mobile'];
			$post['addtime'] = time();
			$post['last_login_time'] = time();

			$data = array(
				'mobile' => $post['mobile'],
				'username' => $post['mobile'],
				'password' => $post['password'],
				'addtime' => $post['addtime'],
				'last_login_time' => $post['last_login_time'],
				'salt' => $post['salt'],
				'email' => $post['email'],
			);
			$rec = $this->user_model->saveData( $data );
			if( !$rec ){
				fail('系统繁忙，请稍后再试');
			}else{
				$info = array(
					'id' => $rec,
					'password' => $post['password'],
					'mobile' => $post['mobile'] 
				);
				$this->encryptUserinfo($info);
				success('注册成功');
			}
		}
	}

	//加密用户信息
	protected function encryptUserinfo($data, $toUserCenter = false){
		$expire = 3600*24*7;
		$encryptCookie = authcode($data['id'].'|'.$data['password'].'|'.$data['mobile'], 'ENCODE', '', $expire);
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


    //退出登录
    public function logout()
    {
        $cookie = array('name' => 'userinfo', 'value' => '', 'expire' => '-3000');
        $this->input->set_cookie($cookie);
        set_cookie('userinfo', '', time() - 86400 );
        session_destroy();
        $_SESESSION['userinfo'] = '';
        $this->session->set_userdata('userinfo', '');
        redirect(site_url(''));
    }

}
