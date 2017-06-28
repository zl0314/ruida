<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['default'] = array(
		'upload_path' => './uploads/default/'.date('Y/m/d/'),
		'allowed_types' => 'gif|jpg|png|jpeg|mp4|MP4',
		'encrypt_name' => TRUE,
		'create_thumb' => FALSE,
		'max_size' => 8328951,
);

$config['scrollpic'] = array(
		'upload_path' => './uploads/scrollpic/'.date('Y/m/d/'),
		'allowed_types' => '*',
		'encrypt_name' => TRUE,
		'create_thumb' => false,
		'max_size' => 2100,

);

$config['files'] = array(
    'upload_path' => './uploads/files/'.date('Y/m/d/'),
    'allowed_types' => '*',
    'encrypt_name' => TRUE,
    'create_thumb' => false,
    'max_size' => 8328951,

);

/* 
/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */