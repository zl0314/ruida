<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
    /**
     * @author ZhangLong
     *
     */
    function __construct(){
        parent::__construct();
        $this->data['header'] = 'header_';
    }


    /**
     * 站点首页
     */
    public function index($type = ''){
        $where = array();
        if($type){
            $where['type'] = $type;
        }
        // $_GET['per_page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $data = get_page('news', $where, $this->Result_model, 5, 'fb_time desc');

        //右边栏信息
        $this->getLeftInfo();

		$vars = array(
           'type' => $type
        );
        $this->tpl->assign($vars);
        $this->tpl->assign($data);

        $this->tpl->display();
    }

    public function show($id = 0){
        $id = intval($id);
        $row = $this->Result_model->getRow('news', '*', array('id' => $id));
        if(empty($row)){
            $this->message('信息不存在');
        }
        //更新阅读数
        $this->Result_model->update('news', array('id' => $id), array('view_count' => $row['view_count'] + 1));

        //侧边栏信息
        $this->getLeftInfo();

        //上一篇
        $prev_where = array(
            'id <' =>  $id
        );
        $prev = $this->Result_model->getRow('news', 'id,title', $prev_where, 'id desc');

        //下一篇 
        $next_where = array(
            'id >' => $id
        );
        $next = $this->Result_model->getRow('news', 'id,title', $next_where, 'id asc');


        $vars = array(
            'row' => $row,
            'prev' => $prev,
            'next' => $next,
            'type' => $row['type']
        );
        $this->tpl->assign($vars);
        $this->tpl->display();

    }

    //得到侧边的公众号  和 阅读量排行榜
    public function getLeftInfo($where = array()){
        //相关推荐
        // ,'id <>' => $id
        $recommend_where = array('thumb <>' => '', 'is_recommend' => 1 );
        // $where['type'] = $row['type'];
        $recomment_list = $this->Result_model->getList('news', 'title,id,thumb', $recommend_where, 4, 0, 'id desc', false);

        //阅读量降序排行
        // $top_where = array('id <>' => $id);
            $top_where = array();
        $top_list = $this->Result_model->getList('news', 'title,id,thumb', $top_where, 4, 0, 'view_count desc', false);

        $vars = array(
            'recomment_list' => $recomment_list,
            'top_list' => $top_list,
        );
        $this->tpl->assign($vars);
    }

}







