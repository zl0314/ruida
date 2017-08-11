<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * [标签管理]
 * @date 2016-3-22
 **/
class Newscp extends Base_Controller {
	public $model;
	
    public function __construct(){
        parent::__construct();
        $this->checkAdminLogin();
        $this->load->model('Result_model');
        $this->load->model('news_model', 'model');

      
        $this->tpl->assign('newsType', $this->newsType);
    }

    public function index(){
        $where = array();
		$search = array();
        if(request_get('title')){
            $where['like']['title'] = request_get('title');
        }
        // 列表数据  分页数据
        $data =  get_page('news', $where, $this->Result_model, null , 'listorder desc, id desc');
		$this->tpl->assign($data);
        $this->tpl->assign('search', $search);

        $this->tpl->display();
    }

    /* *
     *  添加项目咨询
     */
    public function add( $id = ''){
        $id = intval($id);
        $msg = '';
        if(!empty($_POST)){
            $data = request_post('data');
            if($data['title'] == ''){
                $msg = '标题为空';
            }
            if(empty($data['type'])){
                $msg = '请选择新闻分类';
            }
            if(empty($data['thumb'])){
                // $msg = '缩略图不能为空';
            }
            if(empty($data['content'])){
                $msg = '内容不能为空';
            }



            if($msg == ''){
                if(!$data['id']){
                    $data['addtime'] = time();
                    $data['fb_time'] = strtotime($data['fb_time']);
                    $data['id'] = null;
                }else{
                    $data['fb_time'] = strtotime($data['fb_time']);
                }
                $this->model->save($data);
                $this->message('保存成功' , site_url('manager/'.$this->siteclass));
            }
            $data['fb_time'] = strtotime($data['fb_time']);
            $this->data['vo'] = $data;

        }else{
			if($id){
				$where = array(
                    'id' => $id
				);
				$this->data['vo'] = $this->model->getRow('*' , $where );
			}
            
        }
        $this->data['msg'] = $msg;
        $this->tpl->display('manager/'.$this->siteclass.'/add');
    }

    public function edit($id = 0){
        $this->add($id);
    }
    
}