<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingcp extends Base_Controller {

	public function __construct(){
		parent::__construct();
		$this->checkAdminLogin();
		$this->load->model('setting_model');
	}
	
	/**
	*系统设置
	*/
	public function system(){
		if( !empty( $_POST ) )
		{
			$setting = request_post('setting');
			$data = request_post();
			if($data['id'] == ''){
				$data['id'] = null;
			}
			$data['setting'] = json_encode($setting);
			
			$this->setting_model->saveData($data);
			$this->cache->file->save('system_setting', $setting, CACHE_EXP);
			$this->message('保存成功' , site_url('manager/'.$this->siteclass.'/'.$this->sitemethod ));
			return true;
		}
		
		$row = $this->setting_model->getRow('*');
		if(!empty($row['setting'])){
			$this->data['setting'] = json_decode($row['setting'], 1);
		}
		$this->tpl->assign('row', $row);
		
		$this->tpl->display();
	}
	
	
}