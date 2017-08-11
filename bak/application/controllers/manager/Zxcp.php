<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * [咨询管理]
 * @date 2015-5-12
 **/
class Zxcp extends Base_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
        $this->load->model('Result_model');
    }

    /**
     * [列表]
     * @date 2015-5-12
     **/
    public function index(){
        $where = array();

        if(request_get('type')){
            $where['type'] = request_get('type');
        }
        if(request_get('mobile')){
            $where['like']['mobile'] = request_get('mobile');
        }
        if(request_get('email')){
            $where['like']['email'] = request_get('email');
        }
        $data = get_page('zx',$where,$this->Result_model);
        
        $this->tpl->assign($data);
        $this->tpl->display();
    }
}