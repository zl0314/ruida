<<<<<<< HEAD
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Houtaicp extends Base_Controller {

	public function __construct(){
		$this->model_array = array('adminuser_model');
		$this->load_cur_model = false;
		
		parent::__construct();
		
		if($this->sitemethod != 'login' && $this->sitemethod != 'logout'){
			$this->checkAdminLogin();
		}
	}

	public function index(){
		$this->header = '';
		$this->footer = '';
		$this->tpl->display();		
	}
	
	public function center(){
		//echo '<pre>';print_r( $this->session->all_userdata());exit;
		$_LANG['yes'] = '是';
		$_LANG['no'] = '否';
	
		/* 系统信息 */
		$sys_info['os']            = PHP_OS;
		$sys_info['ip']            = !empty($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['REMOTE_ADDR'];
		$sys_info['web_server']    = $_SERVER['SERVER_SOFTWARE'];
		$sys_info['php_ver']       = PHP_VERSION;
		//$sys_info['mysql_ver']     = $mysql_ver;
		$sys_info['zlib']          = function_exists('gzclose') ? $_LANG['yes']:$_LANG['no'];
		$sys_info['safe_mode']     = (boolean) ini_get('safe_mode') ?  $_LANG['yes']:$_LANG['no'];
		$sys_info['safe_mode_gid'] = (boolean) ini_get('safe_mode_gid') ? $_LANG['yes'] : $_LANG['no'];
		$sys_info['timezone']      = function_exists("date_default_timezone_get") ? date_default_timezone_get() : '无时区';
		$sys_info['curr_time']    = date('Y-m-d H:i:s' , time());
		$sys_info['socket']        = function_exists('fsockopen') ? $_LANG['yes'] : $_LANG['no'];
	
		/* 检查系统支持的图片类型 */
		$sys_info['gd'] = '';
		if ( (imagetypes() & IMG_JPG) > 0)
		{
			$sys_info['gd'] .= ' JPEG';
		}
	
		if ( (imagetypes() & IMG_GIF) > 0)
		{
			$sys_info['gd'] .= ' GIF';
		}
	
		if ( (imagetypes() & IMG_PNG) > 0)
		{
			$sys_info['gd'] .= ' PNG';
		}
	
		/* 允许上传的最大文件大小 */
		$sys_info['max_filesize'] = ini_get('upload_max_filesize');
	
	
		$this->data['sys_info'] = $sys_info;
	
		$this->tpl->display();
	}
	
	public function login(){
		$this->header = '';
		$this->footer = '';
		
		if( empty($_POST)){
			$this->tpl->display();
		}else{
			$username = trim($this->input->post('username' , true ));
			$password = trim($this->input->post('password' , true ));
			if( empty( $username) || empty( $password))
			{
				$this->message('登录信息错误', site_url('houtaicp/login'));
			}
			$this->load->model('Adminuser_model' , 'model');
			$userInfo = $this->model->getRow('*' , array('username' => $username));
				
			if( empty($userInfo) )
			{
				$this->message('用户名不存在', site_url('houtaicp/login'));
			}
	
			$password = md5( $password );
			if( $password != $userInfo['password'])
			{
				$this->message('密码错误', site_url('houtaicp/login'));
			}
	
			$this->session->set_userdata('admin_id', $userInfo['id']);
			$this->session->set_userdata('username', $userInfo['username']);
			$this->session->set_userdata('password', $userInfo['password']);
			$this->session->set_userdata('nickname', $userInfo['nickname']);
			$this->session->set_userdata('is_root', $userInfo['is_root']);
// 			$this->session->set_userdata('permissions', @$userInfo['right']);
			$this->session->set_userdata('is_enterprise', $userInfo['is_enterprise']);
			
			$this->message('登录成功', site_url('houtaicp/index'));
		}
	
	}
	
	public function logout(){
		$this->session->set_userdata('user_id', '');
		$this->session->set_userdata('admin_id', '');
		$this->session->set_userdata('username', '');
		$this->session->set_userdata('password', '');
		$this->session->set_userdata('nickname', '');
		$this->session->set_userdata('is_root', '');
		$this->session->set_userdata('company_id', '');
		$this->session->set_userdata('permissions', '');
		$this->session->set_userdata('is_enterprise', '');
		
		$this->message('退出成功', site_url('houtaicp/login'));
	}
	
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Houtaicp extends Base_Controller {

	public function __construct(){
		$this->model_array = array('adminuser_model');
		$this->load_cur_model = false;
		
		parent::__construct();
		
		if($this->sitemethod != 'login' && $this->sitemethod != 'logout'){
			$this->checkAdminLogin();
		}
	}

	public function index(){
		$this->header = '';
		$this->footer = '';
		$this->tpl->display();		
	}
	
	public function center(){
		//echo '<pre>';print_r( $this->session->all_userdata());exit;
		$_LANG['yes'] = '是';
		$_LANG['no'] = '否';
	
		/* 系统信息 */
		$sys_info['os']            = PHP_OS;
		$sys_info['ip']            = !empty($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['REMOTE_ADDR'];
		$sys_info['web_server']    = $_SERVER['SERVER_SOFTWARE'];
		$sys_info['php_ver']       = PHP_VERSION;
		//$sys_info['mysql_ver']     = $mysql_ver;
		$sys_info['zlib']          = function_exists('gzclose') ? $_LANG['yes']:$_LANG['no'];
		$sys_info['safe_mode']     = (boolean) ini_get('safe_mode') ?  $_LANG['yes']:$_LANG['no'];
		$sys_info['safe_mode_gid'] = (boolean) ini_get('safe_mode_gid') ? $_LANG['yes'] : $_LANG['no'];
		$sys_info['timezone']      = function_exists("date_default_timezone_get") ? date_default_timezone_get() : '无时区';
		$sys_info['curr_time']    = date('Y-m-d H:i:s' , time());
		$sys_info['socket']        = function_exists('fsockopen') ? $_LANG['yes'] : $_LANG['no'];
	
		/* 检查系统支持的图片类型 */
		$sys_info['gd'] = '';
		if ( (imagetypes() & IMG_JPG) > 0)
		{
			$sys_info['gd'] .= ' JPEG';
		}
	
		if ( (imagetypes() & IMG_GIF) > 0)
		{
			$sys_info['gd'] .= ' GIF';
		}
	
		if ( (imagetypes() & IMG_PNG) > 0)
		{
			$sys_info['gd'] .= ' PNG';
		}
	
		/* 允许上传的最大文件大小 */
		$sys_info['max_filesize'] = ini_get('upload_max_filesize');
	
	
		$this->data['sys_info'] = $sys_info;
	
		$this->tpl->display();
	}
	
	public function login(){
		$this->header = '';
		$this->footer = '';
		
		if( empty($_POST)){
			$this->tpl->display();
		}else{
			$username = trim($this->input->post('username' , true ));
			$password = trim($this->input->post('password' , true ));
			if( empty( $username) || empty( $password))
			{
				$this->message('登录信息错误', site_url('houtaicp/login'));
			}
			$this->load->model('Adminuser_model' , 'model');
			$userInfo = $this->model->getRow('*' , array('username' => $username));
				
			if( empty($userInfo) )
			{
				$this->message('用户名不存在', site_url('houtaicp/login'));
			}
	
			$password = md5( $password );
			if( $password != $userInfo['password'])
			{
				$this->message('密码错误', site_url('houtaicp/login'));
			}
	
			$this->session->set_userdata('admin_id', $userInfo['id']);
			$this->session->set_userdata('username', $userInfo['username']);
			$this->session->set_userdata('password', $userInfo['password']);
			$this->session->set_userdata('nickname', $userInfo['nickname']);
			$this->session->set_userdata('is_root', $userInfo['is_root']);
// 			$this->session->set_userdata('permissions', @$userInfo['right']);
			$this->session->set_userdata('is_enterprise', $userInfo['is_enterprise']);
			
			$this->message('登录成功', site_url('houtaicp/index'));
		}
	
	}
	
	public function logout(){
		$this->session->set_userdata('user_id', '');
		$this->session->set_userdata('admin_id', '');
		$this->session->set_userdata('username', '');
		$this->session->set_userdata('password', '');
		$this->session->set_userdata('nickname', '');
		$this->session->set_userdata('is_root', '');
		$this->session->set_userdata('company_id', '');
		$this->session->set_userdata('permissions', '');
		$this->session->set_userdata('is_enterprise', '');
		
		$this->message('退出成功', site_url('houtaicp/login'));
	}
	
>>>>>>> e6baf0896a38a189b19ef3324aa13a6eddae7ffa
}