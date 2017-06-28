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

        $data = get_page($where,$this->model);
        
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

            
            if($data['title'] == ''){
                $this->jump('广告名称不能为空');
            }
           
            $this->model->save($data);
            $this->jump('保存成功' , site_url($this->siteclass));
        }else{
            if ($id) {
                $where = array(
                    'id' => $id
                );
                $this->data['row'] = $this->model->getRow('*' , $where );
            }
            
            $this->data['id'] = $id;
            $this->tpl->display($this->siteclass.'/add');
        }
    }

    /**
     * 广告编辑
     * @param  $id [新闻ID]
     */
   public function edit($id = 0){
        $this->add($id);
   }

}