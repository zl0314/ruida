<?php
class Ad_model extends MY_Model
{
    public $table   = 'ad' ;

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
            $ad_row = $this->getList('*', $where, 0, null, 'listorder desc');
            if(count($ad_row) == 1){
                return $ad_row['0'];
            }
        }
        return $ad_row;
    }
}