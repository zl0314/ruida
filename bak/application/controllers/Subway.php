<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @date 2015-6-2
 **/
class Subway extends MY_Controller {
	public $subway;
	public function __construct(){
	    parent::__construct();
	    $this->load->model('Result_model');
	    if(request_post('parent')){
	    	$where = array('parentid' => request_post('parent'));
	    	$this->subway = $this->Result_model->getList('subway', 'id,name,parentid', $where);
	    }
	}
	
	
	//获得区域下所有城市
	public function get_lists(){
		$str = request_post('optstr') ? request_post('optstr'): '请选择';
		$opt = '<option value="">'.$str.'</option>';
		if(!empty($this->subway)){
			foreach($this->subway as $k => $r){
				$sel = '';
				if($r['id'] == request_post('id')){
					$sel = 'selected';
				}
				$opt .= '<option value="'.$r['id'].'" '.$sel.' >'.$r['name'].'</option>';
			}
		}
		success($opt);
	}
}