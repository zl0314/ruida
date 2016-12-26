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
            'area' => $this->Result_model->getList('linkage', 'id,name', array('parentid' => 2)),
            'subway' => $this->get_cache('subway', array('parentid' => 0), '*', 'listorder desc, id asc'),
        );
        $this->tpl->assign($vars);
    }

    /**
     * 站点首页
     */
    public function index($is_new_house = false){
        $type = request_get('t');

        $where = array(
            'type' => $type
        );
        if($type == 1 && !request_get('sales_type')){
            $where['sales_type'] = 2;
        }
        if(!$type){
            $this->message('参数错误');
        }
        if(request_get('k')){
            $where['like']['village'] = request_get('k');
        }
        if(request_get('city_id') != 'all' && request_get('city_id')){
            $where['city_id'] = request_get('city_id');
        }
        if(request_get('area_id')){
            $where['area_id'] = request_get('area_id');
        }
        if(request_get('sales_type')){
            $where['sales_type'] = request_get('sales_type');
        }        
        if(request_get('subway')){
            $where['subway'] = request_get('subway');
        }
        if(request_get('biaoqian')){
            $where['biaoqian'] = request_get('biaoqian');
        }
        if(request_get('mianji')  && !request_get('mianji_max') && !request_get('mianji_max')){
            $acreage = $this->data['mianji'];
            $acreage = $acreage[request_get('mianji')];
            $acreage_arr = explode('-', $acreage);
            if(!empty($acreage_arr[0]) && empty($acreage_arr[1])){
                $where['acreage <='] = intval($acreage_arr[0]);
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
        
        if(request_get('price') && !request_get('price_min') && !request_get('price_max') ){
            // if($type != 4){
                $price = $this->data['jiage'];
                $price = $price[request_get('price')];
                $price_arr = explode('-', $price);
                if(!empty($price_arr[0]) && empty($price_arr[1])){
                    $where['total_price <='] = intval($price_arr[0]);
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

        if(request_get('yongtu')){
            $where['yongtu'] = request_get('yongtu');
        }
        if(request_get('zhuangxiu')){
            $where['zhuangxiu'] = request_get('zhuangxiu');
        }
        $data = get_page('house', $where,$this->Result_model);
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
        //区域 地点
        $vars = array(
            'posname' => '房屋详情',
            'row' => $row,
            'subway_info' => $subway_info,
            'area_info' => $area_info,
            'recomment_house' => $recomment_house,
            'type' => $row['type']
        );
        $this->tpl->assign($vars);
        $this->tpl->display();
    }

    public function lists(){
        $this->index(true);
    }
}







