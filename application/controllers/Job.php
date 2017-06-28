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
            'pos' => 'job-index'
        );
        $ad_row = $this->ad_model->get_pos_ad($where);
        $vars = array(
            'ad_row' => $ad_row,
        );
        $this->tpl->assign($vars);
    }


    public function index($type = 0){
        //招聘列表
        $where  = array();
        if($type){
            $where['type'] = $type;
        }
        if(request_get('city')){
            $where['city_id'] = request_get('city');
        }
        $data = get_page('job', $where, $this->Result_model, 10, 'listorder desc, id desc');
        foreach($data['list'] as $k => $r){
            $data['list'][$k]['city_name'] = $this->Result_model->getOne('linkage', 'name', array('id' => $r['city_id']));
        } 
		$vars = array(
            'posname' => '加入我们',
            'type' => $type
        );
        $this->getLeftInfo();

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
                //更新阅读数
                $this->Result_model->update('job', array('id' => $id), array('view_count' => $row['view_count'] + 1));

                $this->getLeftInfo();
                $this->tpl->assign($vars);
                $this->tpl->display();
            }else{
                $this->message('信息不存在');
            }
        }else{
            $this->message('参数错误');
        }
    }

    public function city(){
        $this->data['header'] = '';
        $this->data['footer'] = '';
        $city_list = $this->Result_model->getList('linkage', 'id,name', array('recommend_to_job_index' => 1));
        
        $vars = array(
            'city_list' => $city_list
        );
        $this->tpl->assign($vars);
        $this->tpl->display();
    }
    //得到侧边的公众号  和 阅读量排行榜
    public function getLeftInfo($where = array()){
        //相关推荐
       
        $top_where = array();
        $top_list = $this->Result_model->getList('job', 'title,id', $top_where, 4, 0, 'view_count desc', false);

        $vars = array(
            'top_list' => $top_list,
        );
        $this->tpl->assign($vars);
    }

}







