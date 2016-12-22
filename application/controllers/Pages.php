<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
    }


    /**
     * 站点首页
     */
    public function index($source = 0){
		
		$vars = array();
        $this->tpl->assign($vars);
        $this->tpl->display();
    }


}







