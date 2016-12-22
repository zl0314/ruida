<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('Result_model');
		$this->data['webset'] = $this->get_cache('system_setting', 'getRow');
		$this->data['friend_link'] = $this->get_cache('friend_link', 'getList', array('isshow' => 1), 'name,link_url,id,listorder', 'listorder desc');

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
			$this->data['sec'] = $sec*1000;
			$this->data['url'] = reMoveXss($url);
			$this->data['err'] = reMoveXss($err);
			$this->load->view('message', $this->data);
		}
	}
	/**
	 * 得到缓存信息
	 * @param  string $cache_name 缓存名
	 * @param  string $type       获取类型， row 一行记录， list 记录集合
	 * @param  array  $where      过滤条件
	 */
	public function get_cache($cache_name, $type = 'getList', $where = array(), $field = '*', $orderby = 'id desc' ){
		$tb = $cache_name;
		if(!empty($where)){
			// $cache_name = md5($cache_name.json_encode($where));
		}
		$cache_data = $this->cache->file->get($cache_name);
		if(empty($cache_data)){
			$cache_data = $this->Result_model->$type($tb, $field, $where, 0, null, $orderby);
			$data = array();
			if($type == 'getList'){
				foreach ($cache_data as $key => $r) {
					$data[$r['id']] = $r;
				}
			}
			$this->cache->file->save($cache_name, $data);
			$cache_data = $data;
		}

		return $cache_data;
	}
}