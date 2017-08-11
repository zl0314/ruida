<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * [管理员管理]
 * @date 2015-6-2
 **/
class Adminusercp extends Base_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->checkAdminLogin();
		$this->load->model('Result_model');
        $this->load->model('adminuser_model', 'model');
	}
	
	/**
	 * [管理员列表]
	 * @date 2015-6-2
	 **/
	public function index()
	{
		$where = array(
			'isdelete' => 0
		);

			$data = get_page('adminuser', $where, $this->Result_model,10,'id desc');
			$this->tpl->assign($data);
		
		$this->tpl->display();
	}
	
	/**
	 * [添加管理员]
	 * @date 2015-6-2
	 **/
	public function add( $id = '' )
	{
		$id = intval( $id );
		if( empty( $_POST ))
		{
			$where = array(
				'id' => $id ,
			);
			$this->data['vo'] = $this->model->getRow('*' , $where );
			if( empty($this->data['vo']) )
			{
				$this->data['vo'] = array(
					'id' => '',
					'username' => '',
					'nickname' => '',
					'is_root' => 0,
				);
			}
			$this->tpl->display();
		}
		else
		{
			
			$data = $this->input->post('data');
			$data['addtime'] = time();
			
			#添加
			if( empty($data['id']))
			{
				$data['id'] = null;
				if( empty( $data['username']) || empty( $data['password']))
				{
					$this->message('用户名和密码不能为空', HTTP_REFERER);
				}

				if($data['password']!=$data['password2']){
					$this->message('两次密码不一致', HTTP_REFERER);
				}

				$where = array(
					'username' => $data['username']
				);
				$vo = $this->model->getRow('*' , $where );
				if( !empty($vo))
				{
					$this->message('用户名已经存在', HTTP_REFERER);
				}
			}

			if( empty($data['nickname']) )
			{
				$this->message('真实姓名不能为空', HTTP_REFERER);
			}
			if($data['password']!=$data['password2']){
				$this->message('两次密码不一致', HTTP_REFERER);
			}

			#编辑
			if( !empty($data['id']))
			{
				if( $data['password'] )
				{
					$data['password'] = md5( $data['password'] );
				}	
				else 
				{
					unset( $data['password']);
				}
			}
			else
			{
				$data['password'] = md5($data['password']);
				$data['addtime'] = time();
			}
			unset($data['password2']);
			
			if( $data['is_root']  != 1 ) $data['is_root'] = 0;
			$this->model->save($data);
			$this->message('操作成功' , site_url('manager/'.$this->siteclass.'/index'));
		}
	}
	
	/**
	 * [修改密码]
	 * @date 2015-6-2
	 **/
	public function updpass()
	{
		if( empty( $_POST) )
		{
			$this->tpl->display();
		}
		else
		{
			$currpass = $this->input->post('currpass');
			$newpass  = $this->input->post('newpass');
			$repeatpass = $this->input->post('repeatpass');
			if( strlen($newpass) < 6)
			{
				$this->message('新密码长度不能小于6位');
			}
			$newpass = md5($newpass);
			$repeatpass = md5($repeatpass);
			if( $newpass != $repeatpass)
			{
				$this->message('两次密码输入错误');
			}
			
			if( md5( $currpass) != $this->session->userdata('password'))
			{
				$this->message('原密码输入错误');
			}
			
			if( md5( $currpass) == $newpass)
			{
				$this->message('原密码和新密码一致');
			}
			
			$data = array(
				'password' => $newpass
			);
			$where = array(
				'id' => $this->session->userdata('admin_id'),
			);
			$rec = $this->model->updateData( $data , $where );
			if( !$rec )
			{
				$this->message('操作失败');
			}
			$this->session->set_userdata('user_id', '');
			$this->session->set_userdata('username', '');
			$this->session->set_userdata('password', '');
			$this->session->set_userdata('nickname', '');
			$this->session->set_userdata('is_root', '');
			$this->session->set_userdata('company_id', '');
			
			$this->message('修改成功' , site_url('manager/'.'admincp/login'));
		}
	}
	

	/**
	 * [删除]
	 * @date 2015-5-11
	 **/
	function del( $id = '')
	{
		$id = intval( $id );
		$where = array(
			'id' => $id
		);
		$vo = $this->model->getRow('*' , $where );

		if( empty($vo) )
		{
			$this->message('请选择要删除的条目');
		}
		$this->model->delData( $where );
		$this->message('删除成功' , HTTP_REFERER);
	}
	
	/**
	 * [授权]
	 * @date 2015-7-5
	 **/
	function right( $user_id = 0){
		$menus = $this->get_all_privileges();
		$admin_privileges = $this->getAdminPrivileges($user_id);
		$admin_privileges = unserialize($admin_privileges);
		foreach($menus as $k => $r){
			foreach($r['lists'] as $lk => $lv){
				$all_menus[$lk] = $lv;
			}
		}
		
		if( empty($_POST)){
			foreach ($all_menus as $key=>$val){
				$classmenu[] = $key;
			}

			$where = array('id' => $user_id);
			$this->data['vo'] = $this->model->getRow('*', $where);
			$this->data['classmenu'] = $classmenu;
			$this->data['right_menus'] = $menus;
			$this->data['admin_privileges'] = $admin_privileges;
			$this->tpl->display();
		} else {
			$user_id = $this->input->post('user_id');
			$privileges = request_post('privileges');
			$hotelids = request_post('hotelids');
			$privileges = (!empty($privileges) && is_array($privileges)) ? $privileges : array();
			
			$privileges_ser = serialize($privileges);
			$data = array(
					'id' => $user_id ,
					'permissions' => $privileges_ser,
					'hotelids'=>json_encode($hotelids)
			);
			$this->model->saveData( $data );
			$this->message('授权成功' , site_url('manager/'.$this->siteclass.'/index'));
		}
	}
}