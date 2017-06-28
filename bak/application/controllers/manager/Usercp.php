<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercp extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkAdminLogin();
		$this->load->model('Result_model');
	}
	
	public function index( $id = 0 ){
		
		$this->data['list'] = array();
		$this->data['page_html'] = '';
		$where = array();
		$id = intval($id);
		$export = isset($_GET['export']) ? 1 : '';
		$trade_user = array();
		
		
		//搜索条件
		if(request_get('mobile')){
			$where['like']['mobile'] = request_get('mobile');
		}
		
		
		if($id){
			$where = array('id' => $id);
		}
		
		$data = get_page('user',$where, $this->Result_model, null, 'id desc');
		$this->data['list'] = $data['list'];
		
		$this->tpl->assign($data);
		$this->data['search'] = request_get();
		$this->data['search']['status'] = isset( $_GET['status'] ) ? $_GET['status'] : 'all';
		
		$this->tpl->display();
	}
	
	public function edit( $id = 0 ){
		$id = intval($id);
		$where = array('id' => $id);
		$row = $this->Result_model->getRow('*', $where);
		$apply_classes = array();
		if(!$row){
			$this->message('用户不存在 ',site_url('user'));
		}

		if(!empty($_POST)){
			$data = $this->input->post('data');
			$class_info = $this->input->post('class_info');
			//密码不为空，修改密码
			if(!empty($data['password'])){
				$salt = password_salt();
				$password = password($data['password'], $salt);
				$data['password'] = $password;
				$data['salt'] = $salt;
			}else{
				unset($data['password']);
			}
			

			$result = $this->Result_model->save($data);
			if($result){
				$this->message('修改信息成功',site_url('manager/'.$this->siteclass));
			}
		}
		$vars = array(
			'apply_classes' => $apply_classes
		);
		$this->tpl->assign($vars);
		$this->data['vo'] = $row;
		$this->tpl->display();
	}

}