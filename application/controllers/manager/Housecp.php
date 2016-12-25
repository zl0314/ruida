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
        // $this->checkAdminLogin();
		$this->load->model('Result_model');
        $vars = array(
            'zhuangxiu' => Hresource::get_zhuangxiu(),
            'type' => Hresource::get_house_type(),
            'chaoxiang' => Hresource::get_chaoxiang(),
            'dianti' => Hresource::get_dianti(),
            'sales_type' => Hresource::get_sales_type(),
            'weizhi' => Hresource::get_position(),
            'yongtu' => Hresource::get_functionality(),
            'area' => $this->get_cache('linkage', array('parentid' => 0), '*', 'id asc'),
            'subway' => $this->get_cache('subway', array('parentid' => 0), '*', 'listorder desc, id asc'),
        );
        $this->tpl->assign($vars);
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

        $data = get_page('house', $where,$this->Result_model, 10, 'fb_time desc');
        
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
            $data['fb_time'] = strtotime($data['fb_time']);
            $data['recomment_house'] = !empty($data['recomment_house']) ? implode(',', $data['recomment_house']) : '';
            $data['scrollpic'] = !empty($data['scrollpic']) ? json_encode($data['scrollpic']) : '';
            
            $this->Result_model->save('house', $data);
            $this->message('保存成功' , site_url('manager/'.$this->siteclass));
        }else{
            if ($id) {
                $where = array(
                    'id' => $id
                );
                $this->data['vo'] = $this->Result_model->getRow('house', '*' , $where );
            }
            
            $this->data['id'] = $id;
            $this->tpl->display();
        }
    }

    //得到所有房源列表，添加房源的时候，推荐房源会用到
    public function public_get_recomment_house(){
        $opt = '<option value="">请选择</option>';
        if(request_post()){
            $id = request_post('id');
            $where = array();
            if($id){
                $where = array('id <>' => $id);
            }
            $lists = $this->Result_model->getList('house', 'id,title', $where );
            if(!empty($lists)){
                foreach($lists as $k => $r){
                    $opt .= '<option value="'.$r['id'].'">'.$r['title'].'</option>';
                }
            }
        }
        success($opt);
    }

}