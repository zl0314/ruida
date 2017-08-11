<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_found extends MY_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
	public function index() {
	  echo 'The page not found！';
	}
}
