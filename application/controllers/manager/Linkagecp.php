<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * [城市管理]
 * @date 2015-6-2
 **/
class Linkagecp extends Base_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->checkAdminLogin();
	    $this->load->model('linkage_model' , 'model');
	    $this->load->model('Result_model');
	    $this->data['recommend'] = array('0' => '不推荐', '1' => '推荐');
	}
	
	public function index($parentid = 0){
		$parentid = intval($parentid);
		$where = array(
			'parentid' => $parentid,
		);
		if(request_get('name')){
			$where['like'] = array(
				'name' =>  request_get('name')
			);
		}
<<<<<<< HEAD
		$data = get_page('linkage',$where, $this->Result_model,10,'listorder desc, id desc');
=======
		$data = get_page('linkage',$where, $this->Result_model,10,'listorder desc, id asc');
>>>>>>> e6baf0896a38a189b19ef3324aa13a6eddae7ffa
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
			$parentid  = !empty($data['parentid']) ? $data['parentid'] : '';
			if(empty($data['name'])){
				$msg = '城市名称不能为空';
			}
			if($msg == ''){
				if(!empty($data['id'])){
					$this->model->save($data);
					redirect(site_url('manager/linkagecp/index/'.$parentid));
				}else if(empty($data['id'])){
					$data['parentid'] = !empty($data['parentid']) ? intval($data['parentid']) : 0;
					$names = str_replace(array("\r","\n","\t"), ',', $data['name']);
					$names = explode(',', $names);
					$names = array_filter($names);
					if(!empty($names)){
						foreach($names as $k => $r){
							$save_data = array(
								'parentid' => $data['parentid'],
								'name' => trim($r),
								'recommend_to_job_index' => $data['recommend_to_job_index'],
							);
							$row = $this->model->getRow('id', array('name' => $r));
							if(empty($row)){
								$this->model->save($save_data);
							}
						}
						redirect(site_url('manager/linkagecp/index/'.$parentid));
					}else{
						$msg = '请输入城市名';
					}
				}
				$this->cache->file->delete('linkage');
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

	//**
	//m删除操作
	public function del($id){
		//先查询城市下面有没有子城市，
		//有子城市， 内容的都不能删除
		$row = $this->Result_model->getRow('linkage', '*', array('parentid' => $id));
		if(!empty($row)){
			$this->message('请将此城市下子项目删除后再删除城市');
		}else{
			$where = array(
				'or' => array(
					'province_id' => $id,
					'city_id' => $id,
					'area_id' => $id,
					'address_id' => $id
				)
			);
			$house_row = $this->Result_model->getRow('house', 'id', $where);
			if(!empty($house_row)){
				$this->message('请将此城市下子项内容删除后再进行删除');
			}else{
				$this->Result_model->delete('linkage', array('id' => $id));
				$this->message('删除成功',site_url('manager/linkagecp'));
			}
		}
	}
}