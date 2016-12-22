<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
        $this->load->model('ad_model');
    }

    /**
     * 站点首页
     */
    public function index($source = 0){
        $where = array(
            'pos' => 'index-index'
        );
		$ad_row = $this->ad_model->get_pos_ad($where);
		$vars = array();
        $this->tpl->assign($vars);
        $this->tpl->display();
    }


}







