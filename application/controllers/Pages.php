<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
        $this->load->model('ad_model');
        $this->load->model('Result_model');
    }


    /**
     * 站点首页
     */
    public function index($hook = ''){
        $where = array(
            'pos' => 'page-index-aboutus'
        );
        $ad_row = $this->ad_model->get_pos_ad($where);

        if(!empty($hook)){
            $where = array('hook' => $hook);
            $page = $this->Result_model->getRow('pages', '*', $where);
        }
        if(empty($page)){
            $this->message('信息不存在');
        }
        
		$vars = array(
            'ad_row' => $ad_row,
            'page' => $page,
            'posname' => '关于我们',
            'hook' => $hook
        );
        $this->tpl->assign($vars);
        $this->tpl->display();
    }


}







