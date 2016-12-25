<?php
class Ad_model extends MY_Model
{
    public $table	= 'ad' ;

    /**
     * @auther ZhangLong
     * @version 2016-3-22
     */
    function __construct()
    {
        parent::__construct() ;
    }

    public function get_pos_ad($where){
    	$ad_list = array();
    	if(!empty($where)){
    		$ad_list = $this->getList('*', $where, null);
    	}
        if(count($ad_list) == 1){
            return $ad_list[0];
        }
    	return $ad_list;
    }
}