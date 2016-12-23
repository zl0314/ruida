<?php

function get_page($tb, $where = array(), $model = null, $perpage = 10, $order = '', $page_query = '', $pk_name= 'id' ){
    $order = $order == '' ? $pk_name . ' DESC' : $order;
    $page['total_rows'] = $model->getOne($tb, 'Count('.$pk_name.') as cnt' , $where);
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