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
            'page-index-aboutus' => '关于我们',
            'page-index-statement' => '隐私声明',
            'job-index' => '加入我们',
			'page-index-agreement' => '注册协议',
            'index-index-banner2' => '首页第二2屏背景图',
            'index-index-rmsq' => '热门商圈',
            'house-index-4' => '房源列表页面',
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
        if(request_get('pos')){
            $where['pos'] = request_get('pos');
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