<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @date 2015-6-2
 **/
class China extends MY_Controller {
	public function __construct(){
	    parent::__construct();
	}
	
	
	public function index(){
		$sql = 'SELECT
				a.id,
				b.id AS city_id,
				b. name as city_name,
				b.pic
			FROM
				'.tname('house').' AS a
			LEFT JOIN   '.tname('linkage').' as b on a.province_id=b.id group by a.province_id';

		$list = $this->Result_model->getListBySql($sql);
		$vars = array(
			'list' => $list
        );
        $this->tpl->assign($vars);
        $this->tpl->display();

	}
}