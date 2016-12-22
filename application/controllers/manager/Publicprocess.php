<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * [公共批量操作]
 * @date 2015-5-12
 **/
class Publicprocess extends Base_Controller {
	public $_model;
	public function __construct()
	{
		$this->use_model = false;
		parent::__construct();
		$this->checkAdminLogin();
		if(!submitcheck('dosubmit',1 ,1)){
			exit('ERROR');
		}
		$model = request_post('model') ? request_post('model') : request_get('model');
		if(strpos($model,'cp') !== FALSE){
			$model = str_replace(array('cp', '_cp'), '', $model);
		}
		if($model){
			$model = strtolower($model).'_model';
			$model = str_replace('__', '_',$model);
			$mod_path = APPPATH;
			if(file_exists($mod_path.'models'.DIRECTORY_SEPARATOR.$model.'.php')){
				$this->load->model($model , '_model');
			}else{
				$this->model = null;
			}
		}
	}
	
	/**
	 * [批量排序]
	 * @date 2015-5-12
	 **/
	public function listorder(){
		$data = request_post('data') ? request_post('data') : array();
		$orderfield = request_post('order_field') ? request_post('order_field') : 'listorder';
		if($data){
			$dataArr = explode(',', $data);
			foreach($dataArr as $k => $v){
				$vA = explode('-', $v);
				$data = array($orderfield => !empty($vA[1]) ? $vA[1] : 0);
				$where = array('id' => $vA[0]);
				if($this->_model){
					$this->_model->updateData($data, $where);
				}
			}
			echo 'ok';
		}
	}
	
	
	/**
	 * [批量删除]
	 * @date 2015-5-13
	 **/
	public function delete(){
		$model = request_post('model') ? request_post('model') : request_get('model');
		$this->check_privileges($model, 'delete', 'json');
		$ids = request_post('ids') ? request_post('ids') : request_get('ids');
		if(!is_array($ids)){
			$ids = array($ids);
		}
		if($ids){
			foreach($ids as $k => $id){
				$where = array('id' => $id);
				if($this->_model){
					$this->_model->delData($where);
				}
			}
			exit('ok');
		}
	}
}