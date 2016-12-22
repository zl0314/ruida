<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct(){
		parent::__construct() ;
		
		$this->data['webset'] = $this->cache->file->get('system_setting');

        $site_class = $this->router->class;
        $site_method = $this->router->method;
        $this->siteclass = strtolower($site_class);
        $this->sitemethod = strtolower($site_method);

        $this->data['header'] = 'header';
        $this->data['footer'] = 'footer';
        
        $this->data['sitemethod'] = $this->sitemethod;
        $this->data['siteclass'] = $this->siteclass;

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
			if($this->is_app){
				$this->fail($err);
			}
			$this->data['sec'] = $sec*1000;
			$this->data['url'] = reMoveXss($url);
			$this->data['err'] = reMoveXss($err);
			$this->load->view('message', $this->data);
		}
	}
}