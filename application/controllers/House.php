<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class House extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
        $this->load->model('ad_model');
        $this->load->model('Result_model');
        $type = request_get('t');
        $province_id = request_get('province_id') ? request_get('province_id') : '';

        //所有省
        $province_where = array('recommend_to_job_index'=> 1) ;
        if(request_get('show_all_province') == 'all'){
            $province_where = array('parentid' => 0);
        }
        $province = $this->Result_model->getList('linkage', 'id,name', $province_where, 0, 0, 'listorder desc, id desc');
        //直辖市处理
        $direct_province = '';
        if(in_array(request_get('province_id'), array(2,3,4,5))){
            $direct_province =  $this->Result_model->getOne('linkage', 'id', array('parentid' => request_get('province_id')));
        }
        //所有城市
        $city_where = array();
        $city = array();
        if($province_id != 'all'){
            $city_where['parentid'] = request_get('province_id');
            $city = $this->Result_model->getList('linkage', 'id,name', $city_where, 0, 0, 'listorder desc, id desc');

        }
        $vars = array(
            'zhuangxiu' => Hresource::get_zhuangxiu(),
            'type' => Hresource::get_house_type(),
            'chaoxiang' => Hresource::get_chaoxiang(),
            'dianti' => Hresource::get_dianti(),
            'sales_type' => Hresource::get_sales_type(),
            'weizhi' => Hresource::get_position(),
            'mianji' => Hresource::get_acreage(),
            'jiage' => Hresource::get_prices($type),
            'htype' => Hresource::get_htype(),
            'biaoqian' => Hresource::get_label(),
            'new_house_type' => Hresource::get_new_house_type(),
            'yongtu' => Hresource::get_functionality($type),
            'province' => $province,
            'city' => $city,
            'direct_province' => $direct_province,
            'subway' => $this->get_cache('subway', array('parentid' => 0), '*', 'listorder desc, id asc'),
        );
        
        $this->tpl->assign($vars);
    }

    /**
     * 房源列表
     */
    public function index($is_new_house = false){
        $type = request_get('t');

        //start 搜索条件==========================
        $where = array(
           
        );
        //分类
        if($type != 5){
            $where['type'] = $type;
        }
        //省
        if(request_get('province_id')){
            $where['province_id'] = request_get('province_id');
        }
        //商业地产 销售类型
        if($type == 1 && !request_get('sales_type')){
            $where['sales_type'] = 2;
            $_GET['sales_type'] = 2;
        }
        //商业地产 销售类型
        if(request_get('sales_type')){
            $where['sales_type'] = request_get('sales_type');
        }
        //房产类型
        if(!$type){
            $this->message('参数错误');
        }
        if(!in_array($type, array(1, 2, 3, 4, 5))){
            $this->message('参数错误');
        }
        //搜索关键字
        if(request_get('q')){
            $q = request_get('q');

            //进行分组查询
            if(request_get('sales_type')){
                unset($where['sales_type']);
                unset($where['type']);
                $where['group_select']['group_start'] = array('type' => request_get('t'), 'sales_type' => request_get('sales_type'));
                $where['group_select']['and_group_start'] = array(
                    'like' => array('title' => $q),
                    'or_like' => array('second_title' => $q, 'village' => $q)
                );
            }else{
                unset($where['type']);
                if($type != 5){
                    $where['group_select']['group_start'] = array('type' => request_get('t'));
                }
                $where['group_select']['and_group_start'] = array(
                    'like' => array('title' => $q),
                    'or_like' => array('second_title' => $q, 'village' => $q)
                );
            }

        }
        //省市ID
        if(request_get('city_id') != 'all' && request_get('city_id')){
            $where['city_id'] = request_get('city_id');
        }
        //区域ID 
        if(request_get('area_id')){
            $where['area_id'] = request_get('area_id');
        }
        if(request_get('address_id')){
            $where['address_id'] = request_get('address_id');
        }
        //地铁站
        if(request_get('subway')){
            $where['subway'] = request_get('subway');
        }
        //房产标签
        if(request_get('biaoqian')){
            $where['biaoqian'] = request_get('biaoqian');
        }
        //新房推荐类型
        if(request_get('new_house_type')){
            $where['new_house_type'] = request_get('new_house_type');
        }
        //房屋类型
        if(request_get('house_type')){
            $htype = request_get('house_type') >=6 ? 5 : request_get('house_type');
            $where['shi'] = $htype;
        }

        //面积搜索的处理
        if(request_get('mianji')  && !request_get('mianji_max') && !request_get('mianji_max')){
            $acreage = $this->data['mianji'];
            $acreage = $acreage[request_get('mianji')];
            $acreage_arr = explode('-', $acreage);
            if(!empty($acreage_arr[0]) && empty($acreage_arr[1])){
                if(strpos($acreage_arr[0], '以上') !== false){
                    $where['acreage >='] = intval($acreage_arr[0]);
                }else{
                    $where['acreage <='] = intval($acreage_arr[0]);
                }
            }else{
                $where['acreage >='] = intval($acreage_arr[0]);
            }

            if(!empty($acreage_arr[1])){
                $where['acreage <='] = intval($acreage_arr[1]);
            }
        }
        if(request_get('mianji_min') && request_get('mianji_max')){
            $where['acreage >='] = request_get('mianji_min');
            $where['acreage <='] = request_get('mianji_max');
        }
        
        //价格搜索的处理
        if(request_get('price') && !request_get('price_min') && !request_get('price_max') ){
            // if($type != 4){
                $price = $this->data['jiage'];
                $price = $price[request_get('price')];
                $price_arr = explode('-', $price);
                if(!empty($price_arr[0]) && empty($price_arr[1])){
                    if(strpos($price_arr[0], '以上') !== false){
                        $where['total_price >='] = intval($price_arr[0]);
                    }else{
                        $where['total_price <='] = intval($price_arr[0]);
                    }

                }else{
                    $where['total_price >='] = intval($price_arr[0]);
                }
                if(!empty($price_arr[1])){
                    $where['total_price <='] = intval($price_arr[1]);
                }
            // }
        }
        if(request_get('price_min') && request_get('price_max')){
            $where['total_price >='] = request_get('price_min');
            $where['total_price <='] = request_get('price_max');
        }

        //用途
        if(request_get('yongtu')){
            $where['yongtu'] = request_get('yongtu');
        }
        //装修
        if(request_get('zhuangxiu')){
            $where['zhuangxiu'] = request_get('zhuangxiu');
        }
        //end搜索条件==========================

        $data = get_page('house', $where,$this->Result_model, 10, '', null, 'id');
        foreach ($data['list'] as $key => $r) {
            if(!empty($r['subway']) || !empty($r['subway_station'])){
                $data_where = array(
                    'in' => array(
                        'id' => array($r['subway'], $r['subway_station'])
                    )
                );
                $data['list'][$key]['subway_info'] = $this->Result_model->getList('subway', 'id,name', $data_where);
            }
        }
        $this->tpl->assign($data);

        //新房列表背景图
        $ad_row = array();
        if($type == 4){
            $where = array(
                'pos' => 'house-index-4'
            );
            $ad_row = $this->ad_model->get_pos_ad($where);
        }
        $vars = array(
            'type' => $type,
            'posname' => $this->data['type'][$type],
            'ad_row' => $ad_row
        );
        $this->tpl->assign($vars);
        $template = $type == 4 && $is_new_house == false ? 'house/index_new_house' : '';
        $this->tpl->display($template);
    }

    /**
     * 房源详情岩浆
     * @param  int $id [房源DI]
     */
    public function show($id = 0){
        $row = array();
        if(!$id){
            $this->message('参数错误');
        }
        $where = array(
            'id' => $id
        );
        $row  = $this->Result_model->getRow('house',' *', $where);
        if(empty($row)){
            $this->message('您访问的内容不存在');
        }
        //加载图片处理类
        $this->load->library('picthumb');

        //地铁线路，地铁站
        $subway_where = array(
            'in' => array(
                'id' => array(
                    $row['subway'],$row['subway_station']
                )
            )
        );
        $subway_info = $this->Result_model->getList('subway', 'id,name', $subway_where);

        //地铁线路，地铁站
        $area_where = array(
            'in' => array(
                'id' => array(
                    $row['area_id'],$row['address_id']
                )
            )
        );
        $area_info = $this->Result_model->getList('linkage', 'id,name', $area_where);

        //推荐房源
        $recomment_house = array();
        if(!empty($row['recomment_house'])){
            $recomment_house_id = explode(',', $row['recomment_house']);
            $recomment_house_where = array(
                'in' => array('id' => $recomment_house_id)
            );
            $recomment_house = $this->Result_model->getList('house','id,title,shi,ting,acreage,thumb,village', $recomment_house_where);
        }


        //轮播图缩略图片处理
        $scrollpic = array();
        $thumb_pic_array = array();
        if(!empty($row['scrollpic'])){
            $scrollpic = json_decode($row['scrollpic']);
            foreach ($scrollpic as $k => $pic) {
                $thumb_pic = getNewImg($pic, 'thumb/');
                $source_thumb_pic = getNewImg($pic, 'thumb/', false);
                if(!file_exists($thumb_pic)){
                    creat_dir_with_filepath($thumb_pic);
                    $source_pic = '.'.$pic;
                    if(file_exists($source_pic)){
                        $thumb = PhpThumbFactory::create($source_pic);
                        $thumb->resize(116, 82);
                        $thumb->save($thumb_pic);
                    }
                }
                $thumb_pic_array[] = array(
                    'thumb' => $source_thumb_pic,
                    'source' => $pic
                );
            }
        }
        $vars = array(
            'posname' => '房屋详情',
            'row' => $row,
            'subway_info' => $subway_info,
            'area_info' => $area_info,
            'recomment_house' => $recomment_house,
            'type' => $row['type'], 
            'thumb_pic_array' => $thumb_pic_array
        );
        $this->tpl->assign($vars);
        $this->tpl->display();
    }

    public function lists(){
        $this->index(true);
    }
}







