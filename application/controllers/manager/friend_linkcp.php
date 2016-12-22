<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Friend_linkcp extends Base_Controller{
	public $model;
	public function __construct()
	{
		parent::__construct();
		$this->checkAdminLogin(true);
		$this->load->model('Result_model');
        $this->load->model('friend_link_model', 'model');
	}
	
	
	public function index()
	{

		$where = array();
		$data = get_page('friend_link', $where, $this->Result_model, '10', 'listorder desc, id desc');
		$this->tpl->assign($data);
		$this->tpl->display();
	}
	
	public function add( $id = 0 )
	{
		$id = intval( $id);
		$msg = '';
		if(!empty($_POST)){
			$data = $this->input->post('data');
			if($data['name'] == ''){
				$msg = '标题不能为空';
			}else if($data['link_url'] == ''){
				$msg = '链接地址不能为空';
			}
			if($msg == ''){
				if(!$data['id']){
					$data['addtime'] = time();
					$data['id'] = null;
				}
				$this->model->save($data);
				 redirect('manager/'.'/friend_linkcp');
				$this->message('保存成功' );
			}
			$this->data['vo'] = $data;
		}else{
			$where = array(
					'id' => $id
			);
			$this->data['vo'] = $this->model->getRow('*' , $where );
			if( empty($this->data['vo']) )
			{
				$this->data['vo'] = array(
						'isshow' => '1',
				);
			}
			$where = array();
		}
		$this->data['msg'] = $msg;
		$this->tpl->display();
	}
}