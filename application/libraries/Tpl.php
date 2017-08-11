<?php
/**
 * 自动加载模板
 * @author zhang <nice5good@126.com>
 * @Date : 2016-12-15
 */
require_once(APPPATH.'libraries/smarty/Smarty.class.php');

class Tpl extends Smarty{
    public $CI;
    public $siteclass;
    public $sitemethod;
    public $data            = array();
    public $template_file   = '';
    
    // //smarty参数设置
    public $left_delimiter      = '<{';
    public $right_delimiter     = '}>';
    public $template_dir        = '';
    public $compile_dir         = '';
    public $cache_dir           = '';
    public $debugging           = TRUE;
    public $suffix              = '.php';
    
    public function __construct(){
        parent::__construct();
        $this->CI = get_instance();
        $this->data = null;

        $this->template_dir   = APPPATH . 'views/';
        $this->compile_dir    = APPPATH . 'cache/templates_c/';
        $this->cache_dir      = APPPATH . 'cache/cache/';
        $this->template_file  = !empty( $this->CI->uri->segments[1] ) ?  $this->CI->uri->segments[1] : 'index';
        $this->template_file .= !empty( $this->CI->uri->segments[2] ) ?  '/'. $this->CI->uri->segments[2] : '/index';
        $this->template_file .= 
                            !empty( $this->CI->uri->segments[3]) && ( $this->CI->uri->segments[1] == 'manager' )  
                            ? '/'.$this->CI->uri->segments[3] 
                            : ( !empty($this->CI->uri->segments[1]) && $this->CI->uri->segments[1] == 'manager' ? '/index' : '');
    }
    
    /**
     * 加载模板
     * @param string $template
     */
    public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL){
        $this->init_tpl_dir();
        $template = $template ? $template : $this->template_file;
        // $resource = $this->fetch($template, $cache_id, $compile_id, $parent);
        $data = !empty($this->CI->data) ? $this->CI->data : array();
        if(strpos($template, $data['sitemethod']) ===  FALSE){
            // $template .= '/'.$data['sitemethod'];
        }
        if(!empty($this->CI->data['header'])){
            $this->CI->load->view($this->CI->data['header'], $data);
        }

        $this->CI->load->view($template, $data);

        if(!empty($this->CI->data['footer'])){
            $this->CI->load->view($this->CI->data['footer'], $data);
        }
        
        // echo $resource;
    }

    /**
     * [给模板赋值]
     **/
    public function assign( $tpl_var, $value = NULL, $nocache = false ) {
        if( is_array($tpl_var) ) {
            foreach( $tpl_var as $k => $v ) {
                $this->assign($k , $v );
            }
            return true;
        }
        $this->CI->data[$tpl_var] = $value;
    }

    /**
     * 创建模板目录以及模板文件
     */
    public function init_tpl_dir(){
        $siteclass = $this->CI->router->class;
        $sitemethod = $this->CI->router->method;
        $this->siteclass = strtolower($siteclass);
        $this->sitemethod = strtolower($sitemethod);
        //创建目录 以及 当前方法的文件
        // $template_file = $this->template_dir.$this->siteclass.'/'.$this->sitemethod.$this->suffix;

        $template_file = $this->template_dir.$this->template_file.$this->suffix;

        //创建目录
        if(!file_exists($template_file)){
            creat_dir_with_filepath($template_file);
        }
        //创建以当前方法为文件名的文件
        if(!file_exists($template_file)){
            $handle = @fopen($template_file, 'w');
            @fwrite($handle, 'welcome');
            @fclose($handle);
        }
    }
    
    
}