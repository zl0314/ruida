<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * [招聘管理]
 * @date 2016-3-22
 **/
class Jobcp extends Base_Controller {
	public $model;
	
    public function __construct(){
        parent::__construct();
        $this->checkAdminLogin();
        $this->load->model('Result_model');
        $this->load->model('job_model', 'model');

    }

    public function index(){
        $where = array();
		$search = array();
        if(request_get('title')){
            $where['like']['title'] = request_get('title');
        }
        // 列表数据  分页数据
        $data =  get_page('job',$where, $this->Result_model, null , 'listorder desc, id desc');
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
            $data = $this->input->post('data');
            if($data['title'] == ''){
                $msg = '标题不能为空';
            }else if(empty($data['worker_age'])){
                $msg = '招工作年限不能为空';
            }else if(empty($data['toppic'])){
//                $msg = '详情页顶部图片不能为空';
            }else if(empty($data['fuli'])){
                $msg = '福利待遇不能为空';
            }else if(empty($data['intro'])){
                $msg = '列表描述信息不能为空';
            }else if(empty($data['duty'])){
                $msg = '岗位职责不能为空';
            }else if(empty($data['ability'])){
				$msg = '任职资格不能为空';
			}



            if($msg == ''){
                if(!$data['id']){
                    $data['addtime'] = time();
                    $data['id'] = null;
                }
				
                $this->model->save($data);
                $this->message('保存成功' , site_url('manager/'.$this->siteclass));
            }
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

  
}
