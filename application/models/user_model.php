<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends MY_Model{
	public $table	= 'user' ;
	
	/**
	 * @auther ZhangLong
	 * @version 2016-06-28
	 */
	function __construct(){
		parent::__construct() ;
	}
}