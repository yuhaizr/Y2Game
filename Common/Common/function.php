<?php

function guid ()
{
    // if (function_exists('com_create_guid')){
    // return com_create_guid();
    // }else{
    mt_srand((double) microtime() * 10000); // optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45); // "-"
    $uuid =     // chr(123)// "{"
    substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen .
             substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen .
             substr($charid, 20, 12);
    // .chr(125);// "}"
    return $uuid;
    // }
}

/**
 * 取证书KEY
 *
 * @param <type> $cert
 * @return <type>
 */
function get_cert_md5 ($cert)
{
    $cert = str_replace("\n", "", $cert);
    $cert = str_replace("-----BEGIN CERTIFICATE-----", "", $cert);
    $cert = str_replace("-----END CERTIFICATE-----", "", $cert);
    return strtoupper(md5(base64_decode($cert)));
}

/**
 * 判断用户是否签约，0未签约，1已签约
 *
 * @param unknown $status
 * @return string
 */
function IsSigned ($status)
{
    if ($status === 0 || $status === '0') {
        return "未签约";
    } else {
        return "已签约";
    }
}

/**
 * 判断用户是否已经注册,根据是否存在用户id来判断
 *
 * @param unknown $status
 * @return string
 */
function isRegister ($cust_id)
{
    if ($cust_id) {
        return "已注册";
    } else {
        return "未注册";
    }
}



function fix_date ($date)
{
    $date = str_replace(array(
            "+",
            "'"
    ), " ", $date);
    return $date;
}


/**
 * 修改身份证号码的格式
 * 中间添加*号
 * @param unknown $identitycard
 */
function fix_identitycard($identitycard){
    if($identitycard&&(strlen($identitycard)>13)){
        $identitycard = substr_replace($identitycard,'********',6,8 );
    }

    return $identitycard;
}

/**
 * 添加文件锁
 * @param unknown $tmpFileStr
 * @param string $locktype
 * @return resource|boolean
 */
function lock_thisfile($tmpFileStr,$locktype=false){
    
    $lock_url = APP_PATH.'Runtime/lockFile/';
    if(!file_exists($lock_url)){
        mkdir($lock_url);
    }
    $tmpFileStr = $lock_url.$tmpFileStr;
    if($locktype == false){
        $locktype = LOCK_EX|LOCK_NB;
    }

    $can_write = 0;
    $lockfp = fopen($tmpFileStr.".txt","w");

    if($lockfp){
        $can_write = flock($lockfp,$locktype);
    }

    if($can_write){
        return $lockfp;
    }else{
        if($lockfp){
            fclose($lockfp);
            unlink($tmpFileStr.".lock");
        }
        return false;
    }
}
/**
 * 去除文件锁
 * @param unknown $tmpFileStr
 */
function unlock_thisfile($fp,$tmpFileStr){
    $lock_url = APP_PATH.'Runtime/lockFile/';
    $tmpFileStr = $lock_url.$tmpFileStr.".txt";
    $a = file_exists($tmpFileStr);
    if (file_exists($tmpFileStr)){
       	@flock($fp,LOCK_UN);
		@fclose($fp);
		@unlink($tmpFileStr);
    }
    

}

/**
 * 根据时间范围字符串返回开始时间和结束时间
 * 如果$time_range为空则返回当天零点到当前时间
 * @param unknown $time_range
 */
function fix_range_time($time_range){
    if((!isset($time_range))
            ||(!$time_range)){
        $start_date = date('Y-m-d 00:00:00');
        $end_date = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')) + 60*3);
    }else{
        $TimeArr = explode('__', $time_range);
        $start_date = date("Y-m-d 00:00:00",
                strtotime(trim($TimeArr[0])));
       // $end_date = date("Y-m-d H:i:s", strtotime(trim($TimeArr[1])));
       $end_date =  date("Y-m-d", strtotime(trim($TimeArr[1])))." 23:59:59";
    }
    return array('start_date'=>$start_date,
                 'end_date'=>$end_date);
}


function echoJson($status,$message,$data = array()){
    
    $res = array(
            'status' => $status
           ,'message' => $message
           ,'data' => $data 
    );
    
    $res = json_encode($res);
    echo  $res;
    exit();
}

