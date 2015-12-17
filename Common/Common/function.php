<?php

function getOrderStatusAll ($type = '')
{
    $all = array();
    $all[0] = '未处理';
    $all[1] = '已分配';
    if('1' == $type ||(!$type)){
        $all[2] = '已沟通A(接近谈成)';
        $all[3] = '已沟通B(很有希望)';
        $all[4] = '已沟通C(还需沟通)';
        $all[5] = '已沟通D(冷淡)';
        $all[6] = '达成意向';
        $all[11] = '向基金公司要合同';
        $all[13] = '已发合同';
        $all[14] = '合同返回';
        $all[15] = '已交易签约';
        $all[19] = '合同已发（违约）';
    }
    if('2' == $type ||(!$type)){
        $all[21] = '已发赎回申请';
        $all[22] = '申请书返回';
        $all[23] = '申请书寄给基金公司';
        $all[24] = '份额确认';
        $all[25] = '打款成功';
    }

    $all[98] = '异常订单';
    $all[99] = '售后服务';


    
    return $all;
}

function getOrderStatus ($status)
{
    $all = getOrderStatusAll();
    
    if (isset($all[$status])) {
        return $all[$status];
    }
    
    return '未定义';
}

function getOrderLevelAll ()
{
    $levels = array();
    $levels[5] = '正常';
    $levels[3] = '低';
    $levels[7] = '高';
    
    return $levels;
}

function getOrderLevel ($level)
{
    $levels = getOrderLevelAll();
    if (isset($levels[$level])) {
        return $levels[$level];
    }
    
    return '未定义';
}

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

/**
 * 判断问题是都已经解决
 * 0 未解决
 * 1 已解决
 *
 * @param unknown $is_answer
 * @return string
 */
function is_answer ($is_answer)
{
    if ($is_answer === 0 || $is_answer === '0') {
        return '未解决';
    } else {
        return '已解决';
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
 * 截取字符串钱3哦位
 *
 * @param unknown $char
 */
function get30char ($char)
{
    return substr($char, 0, 30);
}

/**
 * 根据资金处理标志返回具体的中文
 *
 * @param unknown $deal_remark
 */
function get_deal_remark ($deal_remark)
{
    if ($deal_remark === 0 || $deal_remark === '0') {
        return '已付款';
    } elseif ($deal_remark == 1) {
        return '无需付款';
    } elseif ($deal_remark == 2) {
        return '等待付款结果';
    } elseif ($deal_remark == 3) {
        return '付款失败';
    }
}

/**
 * 根据确认标示返回具体中文
 *
 * @param unknown $conf_remark
 * @return string
 */
function get_conf_remark ($conf_remark)
{
    if ($conf_remark === 0 || $conf_remark === '0') {
        return '未确认';
    } elseif ($conf_remark == 1) {
        return '已撤单';
    } elseif ($conf_remark == 2) {
        return '未完全确认';
    } elseif ($conf_remark == 3) {
        return '确认成功';
    } elseif ($conf_remark == 4) {
        return '确认失败';
    } elseif ($conf_remark == 5) {
        return '认购交易确认';
    } elseif ($conf_remark == 6) {
        return '作废';
    }
}

/**
 * 根据风险提示标志返回风险提示中文
 */
function get_risk_warning ($risk_warning)
{
    if ((!$risk_warning) || $risk_warning == 0 || $risk_warning == '0') {
        return '未提示';
    } else {
        return '已提示';
    }
}

/**
 * 根据风险审核标志返回风险审核中文
 */
function get_risk_check ($risk_check)
{
    if ($risk_check === 0 || $risk_check === '0') {
        return '未审核';
    } else {
        return '已审核';
    }
}

/**
 * 未接电话是否回拨
 */
function get_is_reply ($is_reply)
{
    if ($is_reply === 0 || $is_reply === '0') {
        return '未回拨';
    } else {
        return '已回拨';
    }
}

/**
 * 根据用户的ID获取电话号码的伪码
 *
 * @param unknown $custId
 * @return mixed
 */
function get_mobileno_by_custacco_id ($custId)
{
    $mobileno = "";
    $url = C("GET_MOBILE_PSEUDOCODE_URL");
    // $url = "http://172.20.202.100:11580/getmobilepseudocode?custid=".$custId;
    $url = $url . "?custid=" . $custId;
    $mobilenoData = file_get_contents($url);
    $mobilenoData = json_decode($mobilenoData, true);
    $mobileno = $mobilenoData['pseudocode'];
    if (strlen($mobileno) <= 3) {
        $mobileno = get_mobileno_by_custacco_id2($custId);
    }
    
    return $mobileno;
}

/**
 * 当不能获取电话号码的伪码的时候调用
 *
 * @param unknown $custId
 */
function get_mobileno_by_custacco_id2 ($custId)
{
    $mobileno = "";
    $url = C('GET_MOBILE_PSEUDOCODE_URL2');
    
    $url = $url . "?controller=net&action=pseudocode&custid=" . $custId;
    $mobilenoData = file_get_contents($url);
    $mobilenoData = json_decode($mobilenoData, true);
    $retcode = $mobilenoData['retcode'];
    if ($retcode == '0000') {
        $mobileno = $mobilenoData['data'];
    }
    
    return $mobileno;
}
/**
 * 根据用户真实的手机号码来获取伪码
 * @param unknown $real_tel
 */
function get_mobileno_by_real_tel($real_tel){
    $mobileno = "";
    $url = C('GET_MOBILE_BY_REAL_TEL_URL');
    
    $url = $url . "?reqtype=query_akd_tel_as&mobile=". $real_tel ."&source=001";
    
    $opts = array(
            'http'=>array(
                    'method'=>"GET",
                    'timeout'=>1,//单位秒
            )
    );
    $cnt=0;
    while($cnt<3 && ($xml=file_get_contents($url, false, stream_context_create($opts)))===FALSE){
        $cnt++;
    }

   /*
     $xml = '<?xml version="1.0" encoding="GB2312"?><query_akd_tel_as><ret code="0" msg="查询成功"/><item mobile_as="754000504"/></query_akd_tel_as>';
    */
    $encode = mb_detect_encoding($xml,
            array(
                    "ASCII",
                    "UTF-8",
                    "GBK",
                    "GB2312"
            ));
    if ($encode == 'UTF-8') {
        $xml = mb_convert_encoding($xml, "GBK", "UTF-8");
    }
    if($xml){
        $p = xml_parser_create();
        xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, 1);
        xml_parser_set_option($p, XML_OPTION_SKIP_WHITE, 1);
        $vals = array();
        $index = array();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        if (isset($vals)&&is_array($vals)&&$vals){
            
           $code =  $vals[1]['attributes']['CODE'];
           if ($code === '0'){
               return "#".$vals[2]['attributes']['MOBILE_AS']."#";
           }else{
               return "";
           }
        }else {
            return "";
        }
    }else {
        return  "";
    }
}

/**
 * 通过交易代码获取其对应的中文
 *
 * @param unknown $businesscode
 * @return Ambigous <string, unknown>
 */
function get_businesscode_name ($businesscode)
{
    $businesscode = ltrim($businesscode,'0');
    $businesscodeArr = get_businesscode_arr();
    $businesscode_name = isset($businesscodeArr[$businesscode]) ? $businesscodeArr[$businesscode] : "";
    return $businesscode_name;
}

/**
 * 根据基金代码获取基金的名称
 * @param unknown $fundcode
 */
function get_fundcode_name($fundcode){
    $fund = M('Parm_fundinfo');
    $where = array('vc_fundcode'=>$fundcode);
    $vc_fundname = $fund->field('vc_fundname')->where($where)->select();
    if($vc_fundname){
        $vc_fundname = $vc_fundname[0]['vc_fundname'];
    }else {
        $vc_fundname = $fundcode;
    }
    
    return $vc_fundname;
    
    
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
/**
 * 获取上一个工作日
 * @return multitype:string
 */
function get_work_day(){
    $today = date('Y-m-d');
    $parm_workday = M('Parm_workday');
    $where['d_date'] = array('lt',$today);
    $where['c_flag'] = array('eq','1');
    $last_day = $parm_workday->where($where)->order('d_date desc')->limit(1)->select();
    $last_day = $last_day[0]['d_date'];
    
    $last_day = $last_day.' 15:00:00';
    
    return array('start_date'=>$last_day,
                 'end_date'=>date('Y-m-d H:i:s'));
    
}
/**
 * 解码成电话伪码
 * @param unknown $tel
 * @return boolean|Ambigous <string, boolean>
 */
function _decode_mobileNo($tel){
    $tel = trim($tel);
    if (substr($tel, 0, 2) == "m=") {
        $param_arr = $this->parse_url_param($tel);
        if (count($param_arr) < 2) {
            return false;
        }
        //建个拆分参数的函数
        if ($param_arr['m'] == 1 && strlen($param_arr['p']) > 0) {
            $tel = base64_decode($param_arr['p']);
            $pos1 = strpos($tel, '#');
            if (! ($pos1 === FALSE)) {
                $tel = $this->getSurefireTelas($tel);
                //print_debug("解密的号码(伪码): $tel\n");
                if($tel){
                    return $tel;
                }else {
                    return "";
                }
            }
        }
        else {
            return "";
        }
    }else {
        return "";
    }
}

/**
 * 当要搜索的号码不是以'#'开头或者不是以'#'结尾的话，就把其当做加密伪码去解密，
 * 如果解密得到结果就将号码赋值给$searchValue['searchMobileNo']
 * 反之把其当做，真实的电话号码，将其转化为伪码后进行搜索
 * @param unknown $mobile
 * @return Ambigous <string, boolean, Ambigous>|string
 */
function _fix_customer_mobile($mobile){
    if(isset($mobile)&&$mobile){
        if(("#" != substr($mobile, 0,1))
                ||("#" != substr($mobile, strlen($mobile)-1,1))
        ){
            $res = _decode_mobileNo($mobile);
            if($res){
                $mobile = $res;
            }else {
                $res =  get_mobileno_by_real_tel($mobile);
                if($res){
                    $mobile = $res;
                }else {
                    $mobile = "";
                }
            }
        }
        return $mobile;
    }else {
        return "";
    }
}

/**
 * 直接根据SQL语句从ifund获取的数据
 *
 * @param unknown $sql
 * @return boolean|mixed
 */
function getOrcaleData($sql)
{

    if (!$sql) return false;
    $sql="AppSQL=".urlencode(iconv('GBK', 'UTF-8', $sql));

    $url="http://172.20.200.16/thsft/DBService/?dbtype=pgsql&UserName=APP_WEB_AJJ&PWD=APP_WEB_AJJ_JJDX&AppReturn=php";;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $sql);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_ENCODING ,'gzip');
    $res = curl_exec($ch);
     
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($http_status==200) {
        return $res;

    }
    return false;

}
/**
 * 将从ifund获取的数据进行反序列化
 * 并取出其中的值
 * @param unknown $res
 */
function fix_unserialize($res){
    $data = array();

    if ($res){
        $res = unserialize($res);

        if (isset($res['Data'])){
            $data =  $res['Data'];
        }
    }
     
    return $data;
}





function get_businesscode_arr ()
{
    $businesscodeArr = array(
            "1" => "基金账户开户申请",
            "2" => "基金账户销户申请",
            "3" => "账户资料修改申请",
            "4" => "交易帐户冻结",
            "5" => "交易帐户解冻",
            "6" => "交易帐户挂失",
            "7" => "交易帐户解挂",
            "8" => "基金帐户登记",
            "9" => "基金帐户取消",
            "11" => "交易账户开户申请",
            "12" => "交易账户销户申请",
            "13" => "银行资料修改",
            "15" => "账户开户申请",
            "16" => "帐户重要资料修改",
            "17" => "账户销户申请",
            "18" => "交易账户解锁",
            "19" => "信息验证",
            "20" => "基金认购申请",
            "22" => "基金申购申请",
            "24" => "基金赎回申请",
            "25" => "预约赎回申请",
            "26" => "转托管申请",
            "27" => "转托管转入申请",
            "28" => "转托管转出申请",
            "29" => "分红方式变更申请",
            "30" => "未使用",
            "31" => "基金份额冻结申请",
            "32" => "基金份额解冻申请",
            "33" => "非交易过户申请",
            "34" => "非交易过户转入申请",
            "35" => "非交易过户转出申请",
            "36" => "基金转换申请",
            "37" => "基金转换转入申请",
            "38" => "基金转换转出申请",
            "39" => "定时定额投资申请",
            "40" => "退款申请",
            "41" => "补款申请",
            "42" => "强行赎回申请",
            "44" => "强行调增",
            "45" => "强行调减",
            "52" => "撤单申请",
            "53" => "撤预约单申请",
            "54" => "无效资金申请",
            "55" => "跨TA基金转换",
            "59" => "开通定期定额申请",
            "60" => "终止定期定额申请",
            "61" => "定期定额变更申请",
            "90" => "交易账号修改",
            "91" => "挂失交易卡申请",
            "92" => "解挂交易卡申请",
            "93" => "修改密码申请",
            "94" => "挂失密码申请",
            "95" => "撤消定期定额申请",
            "96" => "挂失基金账户查询密码",
            "97" => "挂失交易账户查询密码",
            "98" => "快速取现",
            "99" => "修改交易账户查询密码",
            "101" => "基金账户开户确认",
            "102" => "基金账户销户确认",
            "103" => "账户资料修改确认",
            "104" => "交易帐户冻结确认",
            "105" => "交易帐户解冻确认",
            "106" => "交易帐户挂失确认",
            "107" => "交易帐户解挂确认",
            "108" => "基金帐户登记确认",
            "109" => "基金帐户取消确认",
            "111" => "交易账户开户确认",
            "112" => "交易账户销户确认",
            "115" => "帐户开户确认",
            "116" => "重要资料修改确认",
            "117" => "账户销户确认",
            "118" => "交易账户解锁",
            "120" => "基金认购接受",
            "122" => "基金申购确认",
            "124" => "基金赎回确认",
            "125" => "预约赎回接受",
            "126" => "转托管确认",
            "127" => "转托管转入确认",
            "128" => "转托管转出确认",
            "129" => "分红方式变更确认",
            "130" => "认购结果",
            "131" => "基金份额冻结确认",
            "132" => "基金份额解冻确认",
            "133" => "非交易过户确认",
            "134" => "非交易过户入确认",
            "135" => "非交易过户出确认",
            "136" => "基金转换确认",
            "137" => "基金转换转入确认",
            "138" => "基金转换转出确认",
            "139" => "定时定额投资确认",
            "140" => "退款确认",
            "141" => "补款确认",
            "142" => "强行赎回",
            "143" => "红利发放",
            "144" => "强行调增",
            "145" => "强行调减",
            "146" => "配号",
            "149" => "募集失败",
            "150" => "基金清盘",
            "151" => "基金终止",
            "152" => "撤单确认",
            "153" => "撤预约单确认",
            "154" => "无效资金确认",
            "155" => "跨TA基金转换确认",
            "159" => "开通定期定额确认",
            "160" => "终止定期定额确认",
            "161" => "定期定额变更确认",
            "190" => "交易账号修改确认",
            "191" => "交易帐号密码修改",
            "192" => "开通网上交易",
            "198" => "快速过户确认",
            "215" => "实时资料修改",
            "601" => "新增经办人信息",
            "602" => "修改经办人信息",
            "603" => "删除经办人信息",
            "604" => "修改投资者风险承担等级",
            "701" => "基金转换时申购",
            "702" => "基金转换时赎回",
            "703" => "基金转换时补差",
            "998" => "投资者资金到账",
            "999" => "投资者退款"
    );
    
    return $businesscodeArr;
}


