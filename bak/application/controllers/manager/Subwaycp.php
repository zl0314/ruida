<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * [城市管理]
 * @date 2015-6-2
 **/
class Subwaycp extends Base_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->checkAdminLogin();
	    $this->load->model('subway_model' , 'model');
	    $this->load->model('Result_model');
	}
	
	public function index($parentid = 0){
		$parentid = intval($parentid);
		$where = array();
		$where = array(
			'parentid' => $parentid
		);
		if(request_get('name')){
			$where['like'] = array(
				'name' =>  request_get('name')
			);
		}
		$data = get_page('subway',$where, $this->Result_model,10,'id desc');
		$parent_linkage = array();
		if($parentid){
			$parent_linkage = $this->model->getRow('name', array('id' => $parentid));
		}
		$this->tpl->assign($data);
		$vars = array(
			'parent_linkage' => $parent_linkage,
		);
		$this->tpl->assign($vars);
		
		$this->tpl->display();
	}
	
	//城市添加
	public function add($id = 0){
		$id = intval($id);
		$vo = array();
		$parentid = request_get('parentid') ? request_get('parentid') : 0 ;
		$msg = '';
		if(request_post()){
			$data = request_post('data');
			if(empty($data['name'])){
				$msg = '城市名称不能为空';
			}
			if($msg == ''){
				if(!empty($data['id'])){
					$this->model->save($data);
					$this->cache->file->delete('subway');
					redirect(site_url('manager/subwaycp/index/'.$data['parentid']));
				}else if(empty($data['id'])){
					$data['parentid'] = !empty($data['parentid']) ? intval($data['parentid']) : 0;
					$names = str_replace(array("\r","\n","\t"), ',', $data['name']);
					$names = explode(',', $names);
					$names = array_filter($names);
					if(!empty($names)){
						foreach($names as $k => $r){
							$save_data = array(
								'parentid' => $data['parentid'],
								'name' => trim($r)
							);
							$row = $this->model->getRow('id', array('name' => $r));
							if(empty($row)){
								$this->model->save($save_data);
							}
						}
						$this->cache->file->delete('subway');
						redirect(site_url('manager/subwaycp/index/'.$data['parentid']));
					}else{
						$msg = '请输入城市名';
					}
				}
			}
			$vo = $data;
		}else{
			$parent_linkage = array();
			if($parentid){
				$parent_linkage = $this->model->getRow('name', array('id' => $parentid));
			}
			$vo = $this->model->getRow('*', array('id' => $id));
		}

		$vars = array(
			'vo' => $vo,
			'parent_linkage' => $parent_linkage,
			'parentid' => $parentid
		);
		$this->tpl->assign($vars);
		$this->tpl->display();
	}
}