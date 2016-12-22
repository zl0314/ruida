<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * [房源管理]
 * @date 2015-5-12
 **/
class Housecp extends Base_Controller {
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
    public function index()
    {
        $search = array();
        $where = array();
        if(request_get('title')){
            $where['search']['like']['title'] = request_get('title');
        }

        $data = get_page('house', $where,$this->Result_model);
        
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
                $this->data['vo'] = $this->Result_model->getRow('hresource', '*' , $where );
            }
            
            $this->data['id'] = $id;
            $this->tpl->display();
        }
    }

}