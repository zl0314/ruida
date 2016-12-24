<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
        $this->load->model('ad_model');
        $this->load->model('Result_model');
    }

    /**
     * 站点首页
     */
    public function index($source = 0){
        $where = array(
            'pos' => 'index-index'
        );
		$ad_row = $this->ad_model->get_pos_ad($where);
		$vars = array();
        $this->tpl->assign($vars);
        $this->tpl->display();
    }

    /**
     * 首页投放房源/委托找房的资讯信息记录
     */
    public function zx(){
        if(request_post()){
            $session_captcha = strtolower($this->session->userdata('captcha'));

            $post = request_post();
            if(empty($post['mobile'])){
                fail('手机号不能为空');
            }else if(!istelphone($post['mobile'])){
                fail('手机号格式不正确');
            }else if(empty($post['email'])){
                fail('邮箱地址不能为空');
            }else if(!isemail($post['email'])){
                fail('邮箱地址不正确');
            }else if(empty($post['captcha'])){
                fail('验证码不能为空');
            }else if(strtolower($post['captcha']) != $session_captcha){
                fail('验证码不正确');
            }
            $where = array(
                'mobile' => $post['mobile'],
                'type' => request_post('type'),
            );
            $row = $this->Result_model->getRow('zx', 'id', $where);
            if(!empty($row)){
                fail('已经提交过信息，不能重复提交');
            }else{
                $data = array(
                    'mobile' => $post['mobile'],
                    'email' => $post['email'],
                    'addtime' => time(), 
                    'type' => $post['type']
                );
                $res = $this->Result_model->save('zx',$data);
                success($res, '信息提交成功,稍后客服人员会跟您联系');
            }
        }else{
            fail('请正确提交信息');
        }
    }

}







