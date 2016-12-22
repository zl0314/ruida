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
    	$ad_row = array();
    	if(!empty($where)){
    		$ad_row = $this->getRow('*', $where);
    	}
    	return $ad_row;
    }
}