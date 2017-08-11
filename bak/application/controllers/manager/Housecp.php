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
        $vars = array(
            'zhuangxiu' => Hresource::get_zhuangxiu(),
            'type' => Hresource::get_house_type(),
            'chaoxiang' => Hresource::get_chaoxiang(),
            'dianti' => Hresource::get_dianti(),
            'sales_type' => Hresource::get_sales_type(),
            'weizhi' => Hresource::get_position(),
            'new_house_type' => Hresource::get_new_house_type(),
            'biaoqian' => Hresource::get_label(),
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
        if(request_get('village')){
            $where['like']['village'] = request_get('village');
        }
        if(request_get('title')){
            $where['like']['title'] = request_get('title');
        }
        if(request_get('type')){
            $where['type'] = request_get('type');
        }
        if(request_get('sales_type')){
            $where['sales_type'] = request_get('sales_type');
        }
        
        if(request_get('start_time')){
            $where['fb_time >'] = strtotime(request_get('start_time'));
        }
        if(request_get('end_time')){
            $where['fb_time <'] = strtotime(request_get('end_time'));
        }
        if(request_get('acreage') && request_get('acreage_str')){
            $acreage_search_arr = array('1' => '<=', '2' => '>=');
            $where['acreage '.$acreage_search_arr[request_get('acreage')]] = request_get('acreage_str');
        }
        if(request_get('total_price') && request_get('total_price_str')){
            $acreage_search_arr = array('1' => '<=', '2' => '>=');
            $where['total_price '.$acreage_search_arr[request_get('total_price')]] = request_get('total_price_str');
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
        $msg = '';
        $vo = array();
        if(!empty($_POST)){
            $data = $this->input->post('data');

            if(!$data['id']){
                $data['addtime'] = time();
                $data['id'] = null;
            }
            $msg = $this->checkdate($data);
            $data['fb_time'] = strtotime($data['fb_time']);
            $data['scrollpic'] = !empty($data['scrollpic']) ? json_encode($data['scrollpic']) : '';
            $vo = $data;
            
            if($msg ==''){
                $data['recomment_house'] = !empty($data['recomment_house']) ? implode(',', $data['recomment_house']) : '';
                $data['ting'] = intval($data['ting']);
                $data['shi'] = intval($data['shi']);
                $this->Result_model->save('house', $data);
                $this->message('保存成功' , site_url('manager/'.$this->siteclass));
            }
        }else{
            if ($id) {
                $where = array(
                    'id' => $id
                );
                $vo = $this->Result_model->getRow('house', '*' , $where );
            }
            
            $this->data['id'] = $id;
        }
        $vars = array(
            'vo' => $vo,
            'msg' => $msg
        );
        $this->tpl->assign($vars);
        $this->tpl->display();
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

    private function checkdate($data){
        $msg = '';
        if(empty($data['title'])){
            $msg = '标题不能为空';
        }else if(empty($data['second_title'])){
            $msg = '副标题不能为空';
        }else if(empty($data['house_cert_year'])){
            // $msg = '请填写房本满多少年';
        }else if(empty($data['village'])){
            $msg = '小区名不能为空';
        }else if(empty($data['label'])){
            // $msg = '列表页面标签不能为空';
        }else if(empty($data['watch_time'])){
            $msg = '看房时间不能为空';
        }else if(empty($data['thumb'])){
            $msg = '缩略图不能为空';
        }else if(empty($data['type'])){
            $msg = '请选择房屋类型';
        }else if(empty($data['sales_type']) && $data['type'] == 1){
            $msg = '请选择出售类型';
        }else if(empty($data['total_price']) && $data['type'] != 4 && $data['sales_type'] == 2){
            $msg = '总价不能为空';
        }else if(empty($data['unit_price']) && $data['type'] != 4  && $data['sales_type'] == 2){
            $msg = '单价不能为空';
        }else if(empty($data['biaoqian']) && $data['type'] == 2 ){
            $msg = '投资房屋标签不能为空';
        }else if(empty($data['avg_price']) && $data['type'] == 4){
            $msg = '均价不能为空';
        }else if(empty($data['build_acreage']) && $data['type'] == 4){
            $msg = '建筑面积不能为空';
        }else if(empty($data['address']) && $data['type'] == 4){
            $msg = '详细地址不能为空';
        }else if(empty($data['new_house_type']) && $data['type'] == 4){
            $msg = '新房类型不能为空';
        }else if(empty($data['province_id']) || empty($data['city_id']) || empty($data['area_id']) ){
            $msg = '请选择房屋所在的地区';
        }else if(empty($data['huan'])){
            $msg = '请填写房屋在几环';
        }else if(empty($data['subway'])){
            $msg = '请选择地铁线路';
        }else if(empty($data['subway_station'])){
            $msg = '请选择地铁站';
        }else if(empty($data['chaoxiang'])){
            $msg = '朝向不能为空';
        }else if(empty($data['ting'])){
            // $msg = '请填写房屋有几厅';
        }else if(empty($data['shi'])){
            // $msg = '请填写房屋有几室';
        }else if(empty($data['acreage'])){
            $msg = '面积不能为空';
        }else if(empty($data['zhuangxiu'])){
            $msg = '请选择装修程度';
        }else if(empty($data['dianti'])){
            $msg = '请选择是否有电梯';
        }else if(empty($data['weizhi'])){
            $msg = '请选择位置';
        }else if(empty($data['fb_time'])){
            $msg = '发布时间不能为空';
        }else if(empty($data['scrollpic'])){
            $msg = '轮播图不能为空';
        }else if(empty($data['base_intro'])){
            $msg = '基本信息不能为空';
        }else if(empty($data['trade_intro'])){
            // $msg = '交易属性不能为空';
        }else if(empty($data['hx_intro'])){
            $msg = '户型介绍不能为空';
        }else if(empty($data['zb_intro'])){
            $msg = '周边介绍不能为空';
        }else if(empty($data['xiaoqu_intro'])){
            // $msg = '小区介绍不能为空';
        }else if(empty($data['house_pics'])){
            $msg = '房屋图片不能为空';
        }
        return $msg;
    }
}