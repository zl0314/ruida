<?php

function get_page($tb, $where = array(), $model = null, $perpage = 10, $order = '', $page_query = '', $pk_name= 'id', $having_field ='' ){
    $order = $order == '' ? $pk_name . ' DESC' : $order;
    $having_field = !empty($having_field) ? ','.$having_field : '';
    $total_rows_row = $model->getRow($tb, "Count(*) as cnt $having_field" , $where, $order);
    $page['total_rows'] = $total_rows_row['cnt'];
    // 加载分页类
    $CI =& get_instance();
    $CI->load->library('pagination');
    $pagination = new CI_Pagination();

    //路由
    $RTR =& load_class('Router');
    // 当前 控制器
    $siteclass = $RTR->fetch_class();
    //  当前方法
    $sitemethod = $RTR->fetch_method();

    // 分页属性配置
    $current_page = intval(max(1 , $CI->input->get('per_page')));

    //每页数量
    $page['per_page'] = isset( $page['per_page'] ) ? $page['per_page'] : ( $perpage ? $perpage : 10);
    $page['cur_page'] = ( $current_page < 1 ) ? 1 : $current_page;
    //页码
    $page['offset'] = ($page['cur_page']-1)*$page['per_page'];


    $page['first_link'] = ' 第一页 ';
    $page['last_link'] = ' 末页 ';
    $page['next_link'] = ' 下一页 ';
    $page['prev_link'] = ' 上一页 ';
    $page['use_page_numbers'] = TRUE;
    $page['page_query_string'] = TRUE;
    
    $GLOBALS['total_rows'] = $page['total_rows'];
    $GLOBALS['curpage'] = $page['cur_page'];
    $GLOBALS['perpage'] = $page['per_page'];

    //查询数据
    $data = array();
    $data['total_rows'] = $page['total_rows'];
    
    if($model){
        $data['list'] = $model->getList($tb, '*' , $where ,$page['per_page'] , $page['offset'] , $order);
        $page['base_url'] = '';
        $page['base_url'] .= $page_query ? $page['base_url'].'/'.$page_query : $page['base_url'];
        $page['base_url'] .= sprintf('?hash=1');
        if(!empty($_SERVER['QUERY_STRING'])){
            $strA = explode('&', $_SERVER['QUERY_STRING']);
            $con = '&';
            $strA = array_unique($strA);
            foreach($strA as $k => $r){
                $rA = explode('=', $r);
                if($rA[0] != 'per_page'){
                    $page['base_url'] .= $con.$rA[0].'='.$rA[1];
                }

            }
        }
        $pagination->initialize( $page );
        $data['page_html'] = $pagination->create_links();
    }
    return $data;
}

/**
 * 创建多级文件夹 参数为带有文件名的路径
 * @param string $path 路径名称
 */
function creat_dir_with_filepath($path,$mode=0777){
    return creat_dir(dirname($path),$mode);
}

/**
 * 创建多级文件夹
 * @param string $path 路径名称
 */
function creat_dir($path,$mode=0777){
    if(!is_dir($path)){
        if(creat_dir(dirname($path))){
            return @mkdir($path,$mode);
        }
    }else{
        return true;
    }
}


/**
 * 执行成功输出, 用ajax请求输出JSON数据
 * @param array $data
 * @param string $message
 * @param boolean $is_app
 * @param int $success
 */
function success($data = array() , $message = '', $is_app = false, $success = '1'){
    if($is_app){
        header('Content-type:text/json');
    }
    $result = array(
        'success' => $success,
        'data' => $data,
        'message' => $message,
    );
    echo json_encode( $result );exit;
}

/**
 * 执行失败输出, 用ajax请求输出JSON数据
 * @param array $data
 * @param string $message
 * @param boolean $is_app
 * @param int $success
 */
function fail($message = '', $data = array(), $is_app = false){
    success($data, $message, $is_app, '0');
}
/*
 * 获取完整表名
 * @param string $tb 
 */
function tname($tb){
   return DB_PREFIX.$tb;
}
/**
 * 打印数组，
 * @param array $arr
 */
function PR($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

//过滤字符
function newhtmlspecialchars($string) {
    if(is_array($string)){
        return array_map('newhtmlspecialchars', $string);
    } else {
        $string = htmlspecialchars($string);
        $string = sstripslashes($string);
        $string = saddslashes($string);
        return trim($string);
    }
}
//去掉slassh
function sstripslashes($string) {
    if(is_array($string)) {
        foreach($string as $key => $val) {
            $string[$key] = sstripslashes($val);
        }
    } else {
        $string = stripslashes($string);
    }
    return $string;
}
function saddslashes($string) {
    if(is_array($string)) {
        foreach($string as $key => $val) {
            $string[$key] = saddslashes($val);
        }
    } else {
        $string = addslashes($string);
    }
    return $string;
}


//获取一行记录
function getRow($sql = '', $tbname = '', $field = '') {
    $CI = & get_instance();
    $CI->load->database();
    $db = $CI->db;
    if(!is_array($sql)){
        $query = $db->query($sql .' LIMIT 1');
        if($query){
            $result = $query->row_array();
            return $result;
        }
    }else if(is_array($sql)){
        $wheresql = '';
        $con = '';
        foreach($sql as $k => $v){
            $wheresql .= $con."`$k` = '$v'";
            $con = ' AND ';
        }
        $sql = "SELECT $field FROM ".tname($tbname) . " WHERE $wheresql";
        $query = $db->query($sql .' LIMIT 1');
        if($query){
            $result = $query->row_array();
            return $result;
        }
    }
    return null;
}
//获取值
function getOne($sql, $tbname = '', $field = ''){
    if($row = GetRow($sql, $tbname, $field)){
        $row = array_values($row);
        return $row[0];
    }
    return null;
}

//更新数据
function updatetable($tablename, $setsqlarr, $wheresqlarr) {
    $CI =& get_instance();
    $CI->load->database();
    $db = $CI->db;
    $setsql = $comma = '';
    foreach ($setsqlarr as $set_key => $set_value) {
        $setsql .= $comma.'`'.$set_key.'`'.'=\''.$set_value.'\'';
        $comma = ', ';
    }
    $where = $comma = '';
    if(empty($wheresqlarr)) {
        $where = '1';
    } elseif(is_array($wheresqlarr)) {
        foreach ($wheresqlarr as $key => $value) {
            $where .= $comma.'`'.$key.'`'.'=\''.$value.'\'';
            $comma = ' AND ';
        }
    } else {
        $where = $wheresqlarr;
    }
    return $db->query('UPDATE '.tname($tablename).' SET '.$setsql.' WHERE '.$where);
}
//添加数据
function inserttable($tablename, $insertsqlarr, $returnid = 0, $replace = false) {
    $CI =& get_instance();

    $insertkeysql = $insertvaluesql = $comma = '';
    foreach ($insertsqlarr as $insert_key => $insert_value) {
        $insertkeysql .= $comma.'`'.$insert_key.'`';
        $insertvaluesql .= $comma.'\''.$insert_value.'\'';
        $comma = ', ';
    }
    $method = $replace?'REPLACE':'INSERT';
    $query = $CI->db->query($method.' INTO '.tname($tablename).' ('.$insertkeysql.') VALUES ('.$insertvaluesql.')');
    if($returnid && !$replace) {
        return $CI->db->insert_id();
    }
    return $query;
}


/**
 * 得到$_POST下某值
 * @param string $key
 * @param bool $strict 是否严谨模式，在严谨模式下，会判断值是否不为空
 * @return array string  NULL
 * @author ZhangLong
 * @date 2015-05-12
 */
function request_post($key = '', $strict = false){
    if($key){
        if( isset($_POST[$key]) ){
            return newhtmlspecialchars($_POST[$key]);
        }else if($strict == true && !empty($_POST[$key])){
            return newhtmlspecialchars($_POST[$key]);
        }else{
            return null;
        }
    }else{
        return newhtmlspecialchars($_POST);
    }
}
/**
 * 得到$_GET下某值
 * @param string $key
 * @param bool $strict 是否严谨模式，在严谨模式下，会判断值是否不为空
 * @return array string  NULL
 * @author ZhangLong
 * @date 2015-05-12
 */
function request_get($key = '', $strict = false){
    if($key){
        if( isset($_GET[$key]) ){
            return newhtmlspecialchars($_GET[$key]);
        }else if($strict == true && !empty($_GET[$key])){
            return newhtmlspecialchars($_GET[$key]);
        }else{
            return null;
        }
    }else{
        return newhtmlspecialchars($_GET);
    }
}

//判断提交是否正确
function submitcheck($var, $echotype = 1) {
    if(!empty($_POST[$var]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if((empty($_SERVER['HTTP_REFERER']) || preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])) && $_POST['formhash'] == formhash()) {
            return TRUE;
        } else {
            if($echotype == 2){
                exit('您的请求来路不正确或表单验证串不符，无法提交');
            }else{
                fail('您的请求来路不正确或表单验证串不符，无法提交');
            }
        }
    } else {
        return FALSE;
    }
}
/**
 * 表单验证随即码
 * @param int $from  来源 1前台 （会将UID加入到formhash中） 2后台
 */
function formhash($set = 1, $from = 1) {
    $formhash = substr(md5(substr(SITE_TIME, 0, -4).'|'.md5(SITEKEY)), 8, 8);
    return $formhash;
}
//根据原图片，给图片加前缀
function getNewImg($url, $prefix = 'thumb_', $addpath = true){
    $sourceImg = explode('/', $url);
    $imgName = $sourceImg[count($sourceImg) - 1];
    unset( $sourceImg[count($sourceImg) - 1]);
    if($addpath){
        $newImg = '.'.implode('/', $sourceImg).'/'.$prefix.$imgName;
    }else{
        $newImg = implode('/', $sourceImg).'/'.$prefix.$imgName;
    }
    return $newImg;
}


//用户cookie信息加密
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

    $ckey_length = 4;
    // 随机密钥长度 取值 0-32;
    // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
    // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方。
    // 当此值为 0 时，则不产生随机密钥，也就是用户每次登录的加密值都一样，反之则每次登录产生的加密值都不一样。

    $key = md5($key ? $key : SITEKEY);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}


/**
 +----------------------------------------------------------
 * 字符串命名风格转换
 * type
 * =0 将Java风格转换为C的风格
 * =1 将C风格转换为Java的风格
 +----------------------------------------------------------
 * @access protected
 +----------------------------------------------------------
 * @param string $name 字符串
 * @param integer $type 转换类型
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function parse_name($name,$type=0) {
    if($type) {
        return ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));
    }else{
        $name = preg_replace("/[A-Z]/", "_\\0", $name);
        return strtolower(trim($name, "_"));
    }
}



//判断是否为邮箱格式
function isemail($email) {
    return strlen ( $email ) > 8 && preg_match ( "/^[-_+.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+([a-z]{2,4})|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email );
}

function isusername($string){
    //只允许汉字，大小写字母，数字作为用户名
    return preg_match("/^[\x{4e00}-\x{9fa5}|a-z|A-Z|0-9]+$/u", $string);
}

//是否是正确的URL
function is_url($url){
    return preg_match('/http:\/\/([a-zA-Z0-9-]*\.)+[a-zA-Z]{2,3}/', $url);
}

//姓名格式判断
function isrealname($string){
    //只允许汉字，大小写字母，数字作为用户名
    return preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $string);
}

/**
 * @desc 检查是否是合法的手机号格式，现阶段合法的格式：以13,15,18,17开头的11位数字
 * @param $cellphone
 */
function istelphone($cellphone) {
    $pattern = "/^(13|15|18|17|14){1}\d{9}$/";
    return str_match($pattern, $cellphone);
}
//检查是否是合法的固定电话
function iscellphone($telphone) {
    $pattern = "/^(0){1}[0-9]{2,3}\-\d{7,8}(\-\d{1,6})?$/";
    return str_match($pattern, $telphone);
}

//是否身份证号
function isidcard($idcard){
    $cardnumPattern = '/^\d{6}((1[89])|(2\d))\d{2}((0\d)|(1[0-2]))((3[01])|([0-2]\d))\d{3}(\d|X)$/i';
    $match = preg_match($cardnumPattern, $idcard);
    return $match;
}
//字符串匹配
function str_match($pattern, $str){
    if(!empty($str)){
        if(preg_match($pattern, $str)) {
            return TRUE;
        }
    }
    return FALSE;
}

//用户密码获取随机码，
function password_salt($len = 6){
    $salt = substr(md5(time().uniqid().SITEKEY), 0, $len);
    return $salt;
}

//用户密码加密  密码+salt
function password($password, $salt = '', $returnarr = false){
    $salt = $salt ? $salt : password_salt();
    $password = md5(md5($password).$salt);
    if($returnarr){
        return array('password' => $password, 'salt' => $salt);
    }
    return $password;
}

//检查用户密码是否正确
/**
 * $post_password 用户输入密码
 * $salt 此用户名下salt字段
 * $dbpassword 此用户 表中的密码
 */
function check_password($post_password, $salt, $dbpassword){
    if($post_password && $salt && $dbpassword){
        $password = md5(md5($post_password).$salt);
        if($password == $dbpassword){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
//如果URL没有HTTP， 添加HTTP， 如果URL为空，则链接为javascript:;
function get_add_http_url($url){
    if($url){
        if(strpos($url, 'http') !== false){
            return $url;
        }else{
            return 'http://'.$url;
        }
    }else{
        return 'javascript:;';
    }
}

function mdate($time = NULL) {
    $text = '';
    $time = $time === NULL || $time > time() ? time() : intval($time);
    $t = time() - $time; //时间差 （秒）
    $y = date('Y', $time)-date('Y', time());//是否跨年
    switch($t){
     case $t == 0:
       $text = '刚刚';
       break;
     case $t < 60:
      $text = $t . '秒前'; // 一分钟内
      break;
     case $t < 60 * 60:
      $text = floor($t / 60) . '分钟前'; //一小时内
      break;
     case $t < 60 * 60 * 24:
      $text = floor($t / (60 * 60)) . '小时前'; // 一天内
      break;
     case $t < 60 * 60 * 24 * 3:
      $text = floor($time/(60*60*24)) ==1 ?'昨天 ' . date('H:i', $time) : '前天 ' . date('H:i', $time) ; //昨天和前天
      break;
     case $t < 60 * 60 * 24 * 30:
      $text = date('m月d日 H:i', $time); //一个月内
      break;
     case $t < 60 * 60 * 24 * 365&&$y==0:
      $text = date('m月d日', $time); //一年内
      break;
     default:
      $text = date('Y年m月d日', $time); //一年以前
      break; 
    }
    return $text;
}