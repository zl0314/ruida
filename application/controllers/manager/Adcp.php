<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * [轮播图管理]
 * @date 2015-5-12
 **/
class Adcp extends Base_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
		$this->load->model('Result_model');
        $this->load->model('ad_model', 'model');
		$this->posArr = array(
			'index-index' => '首页',
			'special-index' => '专题首页',
			'wap-index-index' => '手机端首页',
			
			'hotel-lists' => '度假产品',
			
			'login-log' => '用户注册&用户登录',
		);
		$this->data['posArr'] = $this->posArr;
    }

    /**
     * [列表]
     * @date 2015-5-12
     **/
    public function index()
    {
        $this->data['pos'] = request_get('pos');
        $search = array();
        $where = array();
        if(request_get('title')){
            $where['search']['like']['title'] = request_get('title');
        }

        $data = get_page('ad', $where,$this->Result_model);
        
        $this->tpl->assign($data);
        $this->tpl->assign($search);
        $this->tpl->display();
    }

    /**
     * [编辑和添加]
     * @date 2015-5-12
     **/
    public function add( $id = '' )
    {
        $id = intval( $id);

        if(!empty($_POST)){
            $data = $this->input->post('data');
            if(!$data['id']){
                $data['addtime'] = time();
                $data['id'] = null;
            }

          
            $this->model->save($data);
            $this->message('保存成功' , site_url('manager/'.$this->siteclass));
        }else{
            if ($id) {
                $where = array(
                    'id' => $id
                );
                $this->data['vo'] = $this->model->getRow('*' , $where );
            }
            
            $this->data['id'] = $id;
            $this->tpl->display();
        }
    }

}