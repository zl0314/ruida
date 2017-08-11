<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends Common_Controller {
	function __construct(){
		parent::__construct();
		$system_setting = $this->Result_model->getRow('system_setting', array());
		$this->data['webset'] = json_decode($system_setting['setting'], 1);

		$this->data['friend_link'] = $this->Result_model->getList('friend_link', 'id,link_url,name',array(), 0, null, 'listorder desc, id desc');

        $this->data['header'] = 'header_';
        $this->data['footer'] = 'footer';
	}

	
	/**
	 * 前台提示信息
	 * @param string $err   输出信息
	 * @param string $url  跳转到URL
	 * @param int $sec  跳转秒数
	 * @param int $is_right 是否是正确的时候显示的信息
	 */
	public function message( $err ='', $url='', $sec = '1' , $is_right = 0){
		if( $err ){
			$this->data['sec'] = $sec*1000;
			$this->data['url'] = reMoveXss($url);
			$this->data['err'] = reMoveXss($err);
			$this->load->view('message', $this->data);
		}
	}


	//设置页面标题
	public function set_page_title($title){
		if($title){
			$this->data['pagetitle'] = $title;
		}
	}
}