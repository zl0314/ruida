<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户信息
 * @author 
 * @version 2.0 2012-04-20
 */
class Userinfo{
	static $CI;
	
	public function __construct(){
		self::$CI = &get_instance();
		self::getUserAuthinfo();
	}
    public static function uid(){
		$uid = self::getUserinfo('id');
		return $uid ;	
	}
	
	public static function getUserinfo($field = 'mobile', $uid = ''){
		$uid = $uid ? $uid : self::getUserAuthinfo('id');
		$sql = "select $field from ".tname('user')." where id = '$uid'";
		if($field == '*'){
			return getRow($sql);
		}else if(strpos($field, ',') !== false){
			return getRow($sql);
		}else{
			return getOne($sql);
		}
	}

	//从加密Cookie(userinfo)中获取信息
	public static function getUserAuthinfo($fetch = 'id'){
		$cookieInfo = get_cookie('userinfo');
		$cookieInfo = authcode($cookieInfo , 'DECODE', '', 3600*24*7);
		
//		$sess_userinfo = self::$CI->session->userdata('userinfo');
//		$sess_userinfo = authcode($sess_userinfo, 'DECODE', SITEKEY, 3600*24*7);
		
		// && $sess_userinfo
		if($cookieInfo){
			@list($uid, $pwd, $mobile) = explode('|', $cookieInfo);
//			@list($sess_uid, $sess_pwd, $sess_username) = explode('|', $sess_userinfo);
			
			$sql = "select * from ".tname('user')." where id = '$uid'";
			$userinfo = getRow($sql);
			$return = '';
			//|| $userinfo['password'] == $sess_pwd
			if( $userinfo['password'] == $pwd ){
				$array = array('id' => $uid, 'password' => $pwd, 'mobile' => $mobile);
				switch ($fetch){
					case 'id' :
						$return = $uid;
						break;
					case 'password' :
						$return = $pwd;
						break;
					case 'mobile' :
						$return = $mobile;
						break;
					case '*' :
						$return = $array;
						break;
					default :
						$return = $array;
						break;
				}
			}else{
				set_cookie('userinfo', '', time() - 86400 );
			}
			return $return;
		}else{
			return '';
		}
	}
	
	
	
}

?>