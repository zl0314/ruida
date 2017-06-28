<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagescp extends Base_Controller{
	public $model;
	public function __construct()
	{
		parent::__construct();
		$this->checkAdminLogin();
		$this->load->model('Result_model');
        $this->load->model('pages_model', 'model');

		$this->data['template_arr'] = array(
				'aboutus' => '关于我们',
				'contactus' => ' 联系我们',
				'statement' => '隐私声明',
				'agreement' => '注册协议',
		);
	}

	public function index()
	{
		$where = array();
		$data = get_page('pages', $where, $this->Result_model, 10, 'id desc');
		$this->tpl->assign('page_html', $data['page_html']);
		$this->tpl->assign('list', $data['list']);

		$this->tpl->display();
	}
	
	public function add( $id = 0 )
	{
		
		$id = intval( $id );
		$msg = '';
		if(!empty($_POST)){
			$data = $this->input->post('data');
			if($data['name'] == ''){
				$msg = '标题不能为空';
			}else if($data['content'] == ''){
				$msg = '内容不能为空';
			}else if($data['hook'] == ''){
				$msg = '模板不能为空';
			}
			$row = $this->model->getRow('id',array('hook' => $data['hook']));
			if(!empty($row['id']) && !$data['id']){
				$msg = '此模板的页面已经存在 ，不能重复添加';
			}
			if($msg == ''){
				if(!$data['id']){
					$data['addtime'] = time();
					$data['id'] = null;
				}
				$this->model->save($data);
				$this->message('保存成功' , site_url('manager/'.$this->siteclass));
			}
			$this->data['vo'] = $data;
		}else{
			$where = array(
					'id' => $id
			);
			$this->data['vo'] = $this->model->getRow('*' , $where );
			$where = array();
		}
		$this->data['msg'] = $msg;
		$this->tpl->display();
	}
}