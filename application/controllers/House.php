<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class House extends MY_Controller {
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
    public function index(){
        $type = request_get('t');
		$vars = array(
            'type' => $type
        );
        $this->tpl->assign($vars);
        $this->tpl->display();
    }


}







