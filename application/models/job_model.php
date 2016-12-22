<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Job_model extends MY_Model{
	public $table	= 'job' ;
	
	/**
	 * @auther ZhangLong
	 * @version 2016-07-08
	 */
	function __construct(){
		parent::__construct() ;
	}
}