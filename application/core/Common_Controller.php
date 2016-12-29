<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('Result_model');
		
        $site_class = $this->router->class;
        $site_method = $this->router->method;
        $this->siteclass = strtolower($site_class);
        $this->sitemethod = strtolower($site_method);

        $this->data['sitemethod'] = $this->sitemethod;
        $this->data['siteclass'] = $this->siteclass;

	}

	/**
	 * 得到缓存信息
	 * @param  string $cache_name 缓存名
	 * @param  string $type       获取类型， row 一行记录， list 记录集合
	 * @param  array  $where      过滤条件
	 */
	public function get_cache($cache_name, $where = array(), $field = '*', $orderby = 'id desc' ){
		$tb = $cache_name;
		// $cache_data = $this->cache->file->get($cache_name);
		// if(empty($cache_data)){
			$cache_data = $this->Result_model->getList($tb, $field, $where, 0, null, $orderby);
		// 	$data = array();
		// 	foreach ($cache_data as $key => $r) {
		// 		$data[$r['id']] = $r;
		// 	}
		// 	$this->cache->file->save($cache_name, $data, CACHE_EXP);
		// 	$cache_data = $data;
		// }
		return $cache_data;
	}
}