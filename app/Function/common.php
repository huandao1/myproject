<?php

function get_action(){
    $action=request()->route()->getAction();

    $action=explode("\\",$action['controller']);
    $action=explode("@",end($action));
    return $action;
}


function GetRTime($t){

    $d=0;
    $h=0;
    $m=0;
    $s=0;
    if($t>=0){
        // d=Math.floor(t/1000/60/60/24);
        $h=floor($t/60/60);
        $m=floor($t/60%60);
        $s=floor($t%60);
    }
    if($h<=9){
        $h='0'.$h;
    }
    if($m<=9){
        $m='0'.$m;
    }
    if($s<=9){
        $s='0'.$s;
    }
    return $h.":".$m.":".$s;

}

function curl_request($url, $data = null) {
    $headers = array (
        "Content-type: application/json;charset=\"utf-8\""
    );
    // $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$this->openid."&lang=zh_CN";
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );

    curl_setopt ( $ch, CURLOPT_URL, $url ); //
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); //
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); //

    // curl_setopt($ch, CURLOPT_VERIFYPEER,FALSE);//
    // curl_setopt($ch, CURLOPT_VERIFYHOST,FALSE);//
    if (! empty ( $data )) {
        curl_setopt ( $ch, CURLOPT_POST, 1 ); //
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data ); //
    }
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

    //打印日志
    $action=get_action();
    logResult($action[0]."_".$action[1].".log","Url_".$url);
    logResult($action[0]."_".$action[1].".log", "Request_" . $data);
    $info = curl_exec ( $ch );
    logResult($action[0]."_".$action[1].".log", "Response_" . $info);
    // var_dump(curl_error(($ch)));
    curl_close ( $ch );
    return $info;
}

//并发请求
function curl_multi_request($urls) {
    $mh = curl_multi_init();
    $urlHandlers = [];
    $urlData = [];
    // 初始化多个请求句柄为一个
    foreach($urls as $value) {
        $headers = array (
            "Content-type: application/json;charset=\"utf-8\""
        );
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        $url = $value['url'];

        curl_setopt ( $ch, CURLOPT_URL, $url ); //
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); //
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); //

        $data = $value['params'];
        if (!empty ( $data )) {
            curl_setopt ( $ch, CURLOPT_POST, 1 ); //
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data ); //
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $urlHandlers[] = $ch;
        curl_multi_add_handle($mh, $ch);
        //打印日志
        $action=get_action();
        logResult($action[0]."_".$action[1].".log","Url_".$url);
        logResult($action[0]."_".$action[1].".log", "Request_" . $data);
    }


    $active = null;
    // 检测操作的初始状态是否OK，CURLM_CALL_MULTI_PERFORM为常量值-1
    do {
        // 返回的$active是活跃连接的数量，$mrc是返回值，正常为0，异常为-1
        $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    // 如果还有活动的请求，同时操作状态OK，CURLM_OK为常量值0
    while ($active && $mrc == CURLM_OK) {
        // 持续查询状态并不利于处理任务，每50ms检查一次，此时释放CPU，降低机器负载
        usleep(50000);
        // 如果批处理句柄OK，重复检查操作状态直至OK。select返回值异常时为-1，正常为1（因为只有1个批处理句柄）
        if (curl_multi_select($mh) != -1) {
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }
    // 获取返回结果
    foreach($urlHandlers as $index => $ch) {
        $urlData[$index] = curl_multi_getcontent($ch);

        //打印日志
        logResult($action[0]."_".$action[1].".log", "Response_" . $urlData[$index]);

        // 移除单个curl句柄
        curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);
    return $urlData;
}

/*
 * 访问泊通平台接口签名生成
 * param $array - 签名数组
 * return 签名字符串
 */
function create_botong_sign($array = null) {
    $signArr = array ();
    foreach ( $array as $k => $v ) {
        if (strlen ( $v ) > 0)
            $signArr [$k] = $k . '=' . $v;
    }
    ksort ( $signArr );
    return base64_encode ( hash_hmac ( 'sha256', implode ( '&', $signArr ), read_config('SecretKey'), true ) );
}

function logResult($filename, $content) {
        $y=date("Y",time());
        $m=date("m",time());
        $d=date("d",time());
        if(!is_dir(storage_path('logs/'.$y))){
            @mkdir(storage_path('logs/'.$y));
            @mkdir(storage_path('logs/'.$y.'/'.$m));
            @mkdir(storage_path('logs/'.$y.'/'.$m.'/'.$d));
        }else if(!is_dir(storage_path('logs/'.$y.'/'.$m))){
            @mkdir(storage_path('logs/'.$y.'/'.$m));
            @mkdir(storage_path('logs/'.$y.'/'.$m.'/'.$d));
        }else if(!is_dir(storage_path('logs/'.$y.'/'.$m.'/'.$d))){
            @mkdir(storage_path('logs/'.$y.'/'.$m.'/'.$d));
        }
        $path = storage_path('logs/'.$y.'/'.$m.'/'.$d.'/'.$filename);
        $fp = fopen($path, 'a+');
        flock($fp, LOCK_EX);// 加锁
        $phone=session('phone') ? session('phone') : '无';
        fwrite($fp, date('Y-m-d H:i:s') . "\n" .'Phone_'.$phone.'_'. $content . "\n\n");
        flock($fp, LOCK_UN);// 解锁
        fclose($fp);
}

function read_config($key){
    $debug=config('common.debug');
    if($debug == 1){
        return config('common.debug_'.$key);
    }else{
        return config('common.'.$key);
    }
}

function getNonceStr($length = 32)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str ="";
    for ( $i = 0; $i < $length; $i++ )  {
        $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
    }
    return $str;
}
function ToUrlParams($arr)
{
    $buff = "";
    foreach ($arr as $k => $v)
    {
        if($k != "sign" && $v != "" && !is_array($v)){
            $buff .= $k . "=" . $v . "&";
        }
    }

    $buff = trim($buff, "&");
    return $buff;
}
function MakeSign($arr)
{
    //签名步骤一：按字典序排序参数
    ksort($arr);
    $string = ToUrlParams($arr);
    //签名步骤二：在string后加入KEY
    $string = $string . "&key=".read_config('wxKey');
    //签名步骤三：MD5加密
    $string = md5($string);
    //签名步骤四：所有字符转为大写
    $result = strtoupper($string);
    return $result;
}


?>