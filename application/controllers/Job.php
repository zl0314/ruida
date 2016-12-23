<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
        $this->load->model('Result_model');
        $this->load->model('ad_model');

        $where = array(
            'pos' => 'index-index'
        );
        $ad_row = $this->ad_model->get_pos_ad($where);
        $vars = array(
            'ad_row' => $ad_row,
        );
        $this->tpl->assign($vars);
    }


    public function index(){
        //招聘列表
        $where  = array();
        $data = get_page('job', $where, $this->Result_model, 1, 'listorder desc, id desc');
		$vars = array(
            'posname' => '加入我们'
        );
        $this->tpl->assign($vars);
        $this->tpl->assign($data);
        $this->tpl->display();
    }

    public function show($id = 0){
        $id = intval($id);
        if($id){
            $where = array('id' => $id);
            $row = $this->Result_model->getRow('job', '*', $where);
            if(!empty($row)){
                $vars = array(
                    'row' => $row,
                    'posname' => '招聘详情'
                );
                $this->tpl->assign($vars);
                $this->tpl->display();
            }else{
                $this->message('信息不存在');
            }
        }else{
            $this->message('参数错误');
        }
    }

}







