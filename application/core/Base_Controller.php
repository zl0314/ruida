<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends Common_Controller {
	function __construct(){
		parent::__construct() ;
		
		$admin_id = $this->session->userdata('admin_id');
		$this->admin_id = $admin_id;
		$this->is_root = $this->session->userdata('is_root');

        $this->data['header'] = 'manager/common_header';
        $this->data['footer'] = 'manager/common_footer';
	}
	
	/**
	 * 检查管理员是否登录
	 * @param bool $toLogin 是否跳转到登录页
	 * @return boolean
	 */
	public function checkAdminLogin($toLogin = true){
		if($this->admin_id == ''){
			if($toLogin){
				redirect('manager/admincp/login');
			}else{
				return false;
			}
		}else{
			$this->check_privileges($this->siteclass, $this->sitemethod);
		}
	}
	
	//检查后台帐号权限
	public function check_privileges($class, $method, $output = 'html'){
		$is_root = $this->session->userdata('is_root');
		$privileges = $this->getAdminPrivileges();
		$this->data['menus'] = $this->get_all_privileges_by_siteclass();
		$this->data['admin_menus'] = $this->get_all_privileges();
		if($is_root == '1'){
			$this->data['privileges'] = $this->data['menus'];
			return true;
		}
		if(strpos($method, 'public') !== false){
			return true;
		}
		$privileges = unserialize($privileges);
		$this->data['privileges'] = $privileges;
		$class_arr = isset($privileges[$class]) ? $privileges[$class] : array();
		$result = FALSE;
		if($class_arr){
			if(in_array($method, $class_arr)){
				$result = TRUE;
			}
		}
		
		if(!$result){
			if($output == 'html'){
				$this->message('对不起，您没有权限进行此操作。');
			}else{
				fail('对不起，您没有权限进行此操作。');
			}
		}
	}
	
	//得到当前管理员的权限
	public function getAdminPrivileges($user_id = 0){
		$user_id = $user_id ? $user_id : $this->admin_id;
		$privileges = GetOne("SELECT permissions FROM ".tname('adminuser')." WHERE id='{$user_id}'");
		$privileges = empty($privileges) ? '' : $privileges;
		return $privileges;
	}

	//得到当前管理员的可管理项目ids
	public function getAdminProjectids($user_id = 0){
		$user_id = $user_id ? $user_id : $this->admin_id;
		$privileges = GetOne("SELECT projectids FROM ".tname('adminuser')." WHERE id='{$user_id}'");
		$privileges = empty($privileges) ? '' : json_decode($privileges,true);
		return $privileges;
	}
	
	//得到adminmenu.php中所有权限
	public function get_all_privileges(){
		include APPPATH."config/adminmenu.php";
		$admin_privileges = array();
		foreach ($ADMIN_MENU['menu'] as $key => $val){
			$row = array();
			$admin_privileges[$key] = $val;
		}
		return $admin_privileges;
	}
	
	//以siteclass为键，得到权限节点
	public function get_all_privileges_by_siteclass(){
		include APPPATH."config/adminmenu.php";
		$privileges = array();
		foreach ($ADMIN_MENU['menu'] as $key => $val){
			$row = array();
			$row = $val['lists'];
			foreach($row as $k => $r){
				$privileges[$k] = $r['method'];
				$privileges[$k]['topmenu'] = $r['name'];
			}
		}
		return $privileges;
	}

		/**
	 * 前台提示信息
	 * @param string $err   输出信息
	 * @param string $url  跳转到URL
	 * @param int $sec  跳转秒数
	 * @param int $is_right 是否是正确的时候显示的信息
	 */
	public function message( $err ='', $url='', $sec = '1' , $is_right = 0){
		if( $err ){
			$this->data['sec'] = $sec*1000;
			$this->data['url'] = reMoveXss($url);
			$this->data['err'] = reMoveXss($err);
			$this->load->view('manager/message', $this->data);
		}
	}

	public function watermark($source, $target = '', $w_pos = '', $w_img = '', $w_text = '99danji',$w_font = 8, $w_color = '#ff0000') {
		$this->w_img = './static/web/images/logo.png';
		$this->w_pos = 9;
		$this->w_minwidth = 209;
		$this->w_minheight = 52;
		$this->w_quality = 80;
		$this->w_pct = 85;
	 
		$w_pos = $w_pos ? $w_pos : $this->w_pos;
		$w_img = $w_img ? $w_img : $this->w_img;
		//if(!$this->watermark_enable || !$this->check($source)) return false;
		if(!$target) $target = $source;
		//$w_img = PHPCMS_PATH.$w_img;
		//define('WWW_PATH', dirname(dirname(dirname(__FILE__)));
		//$w_img = '../../../images/water/'.$w_img;
		$source_info = getimagesize($source);
		$source_w    = $source_info[0];
		$source_h    = $source_info[1];
		//if($source_w < $this->w_minwidth || $source_h < $this->w_minheight) return false;
		switch($source_info[2]) {
			case 1 :
				$source_img = imagecreatefromgif($source);
				break;
			case 2 :
				$source_img = imagecreatefromjpeg($source);
				break;
			case 3 :
				$source_img = imagecreatefrompng($source);
				break;
			default :
				return false;
		}
		if(!empty($w_img) && file_exists($w_img)) {
			$ifwaterimage = 1;
			$water_info   = getimagesize($w_img);
			$width        = $water_info[0];
			$height       = $water_info[1];
			switch($water_info[2]) {
				case 1 :
					$water_img = imagecreatefromgif($w_img);
					break;
				case 2 :
					$water_img = imagecreatefromjpeg($w_img);
					break;
				case 3 :
					$water_img = imagecreatefrompng($w_img);
					break;
				default :
					return;
			}
		} else {        
			$ifwaterimage = 0;
			$temp = imagettfbbox(ceil($w_font*2.5), 0, './static/web/images/elephant.ttf', $w_text);
			$width = $temp[2] - $temp[6];
			$height = $temp[3] - $temp[7];
			unset($temp);
		}
		switch($w_pos) {
			case 1:
				$wx = 5;
				$wy = 5;
				break;
			case 2:
				$wx = ($source_w - $width) / 2;
				$wy = 0;
				break;
			case 3:
				$wx = $source_w - $width;
				$wy = 0;
				break;
			case 4:
				$wx = 0;
				$wy = ($source_h - $height) / 2;
				break;
			case 5:
				$wx = ($source_w - $width) / 2;
				$wy = ($source_h - $height) / 2;
				break;
			case 6:
				$wx = $source_w - $width;
				$wy = ($source_h - $height) / 2;
				break;
			case 7:
				$wx = 0;
				$wy = $source_h - $height;
				break;
			case 8:
				$wx = ($source_w - $width) / 2;
				$wy = $source_h - $height;
				break;
			case 9:
				$wx = $source_w - $width;
				$wy = $source_h - $height;
				break;
			case 10:
				$wx = rand(0,($source_w - $width));
				$wy = rand(0,($source_h - $height));
				break;              
			default:
				$wx = rand(0,($source_w - $width));
				$wy = rand(0,($source_h - $height));
				break;
		}
		if($ifwaterimage) {
			if($water_info[2] == 3) {
				imagecopy($source_img, $water_img, $wx, $wy, 0, 0, $width, $height);
			} else {
				imagecopymerge($source_img, $water_img, $wx, $wy, 0, 0, $width, $height, $this->w_pct);
			}
		} else {
			if(!empty($w_color) && (strlen($w_color)==7)) {
				$r = hexdec(substr($w_color,1,2));
				$g = hexdec(substr($w_color,3,2));
				$b = hexdec(substr($w_color,5));
			} else {
				return;
			}
			imagestring($source_img,$w_font,$wx,$wy,$w_text,imagecolorallocate($source_img,$r,$g,$b));
		}
		
		switch($source_info[2]) {
			case 1 :
				imagegif($source_img, $target);
				break;
			case 2 :
				imagejpeg($source_img, $target, $this->w_quality);
				break;
			case 3 :
				imagepng($source_img, $target);
				break;
			default :
				return;
		}
	 
		if(isset($water_info)) {
			unset($water_info);
		}
		if(isset($water_img)) {
			imagedestroy($water_img);
		}
		unset($source_info);
		imagedestroy($source_img);
		return true;
	}
}


/**
 *检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
 *参　　数：$sql_str: 提交的变量
 *返 回 值：返回检测结果，ture or false
 */

if( !function_exists("inject_check") ){
    function inject_check($sql_str) {
        return @eregi('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); // 进行过滤
    }
}

//过滤XSS攻击
if(!function_exists("reMoveXss")){
    function reMoveXss($val) {
        // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
        // this prevents some character re-spacing such as <java\0script>
        // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
        $val = preg_replace('/([\x00-\x08|\x0b-\x0c|\x0e-\x19])/', '', $val);

        // straight replacements, the user should never need these since they're normal characters
        // this prevents like <IMG SRC=@avascript:alert('XSS')>
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            // ;? matches the ;, which is optional
            // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
            // @ @ search for the hex values
            $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
            // @ @ 0{0,7} matches '0' zero to seven times
            $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
        }

        // now the only remaining whitespace attacks are \t, \n, and \r
        $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', '<script', 'object', 'iframe', 'frame', 'frameset', 'ilayer'/* , 'layer' */, 'bgsound', 'base');
        $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);

        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                        $pattern .= '|';
                        $pattern .= '|(&#0{0,8}([9|10|13]);)';
                        $pattern .= ')*';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
                    // no replacements were made, so exit the loop
                    $found = false;
                }
            }
        }
        return $val;
    }

    
}