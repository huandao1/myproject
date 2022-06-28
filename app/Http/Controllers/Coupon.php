<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Coupon extends Controller
{

    public function index(Request $request){
        /*$jssdk = new \JSSDK ( "wx9f41b1af5dba9971", "e2e3f0a592093e3127eb7a6a91143f0d" );
        $signPackage = $jssdk->GetSignPackage ();*/
        $time1 = time ();
        $array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => $time1,
            'AccessToken' => session('AccessToken')
        );
        $array ['Sign'] =create_botong_sign($array);
        $data = json_encode ($array);
        $url = read_config("URL").'/api/Users/GetMebUserInfo';
        $personInfo = json_decode(curl_request($url,$data),true);
        if ($personInfo ['RetCode'] == 5) {
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';
            die ();
        }
        $CarNo=trim($request->filled('CarNo')?$request->query('CarNo'):'');
        if (empty($CarNo)) {
            $time = time();

            $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time);
            $array['Sign'] =create_botong_sign($array);
            $data= json_encode($array);
            $url=read_config("URL").'/api/Cars/List';
            $carli= json_decode(curl_request($url,$data),true);
            if (sizeof($carli['Data']['Items'])>0) {
                foreach ($carli['Data']['Items'] as $key => $v) {
                    if ($v['Bind']==1) {
                        $CarNo=$v['CarNo'];
                    }
                }
            }
        }
        $array = array (
            'AppId' => read_config("AppId"),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'pageSize' => 9999,
            'UseType'=>2,
            'PayType'=>0,
            'PlateNumber'=>$CarNo,
            'VoucherStatus' => 1 //1-有效
        );
        $array ['Sign'] = create_botong_sign ( $array );
        $rspn = curl_request(read_config("URL").'/api/Parkings/GetVoucherInfo',json_encode($array));
        $coupon_list = json_decode($rspn,true);
        $action=trim($request->input('action'));
        if ($action=="ajaxget") {
            echo $rspn;
        }
        return view('coupon.index',['coupon_list' => $coupon_list]);
    }

    public function getlist(Request $request){
        $VoucherStatus = $request->filled('VoucherStatus')?$request->input('VoucherStatus'):0;
        $array = array (
            'AppId' => read_config("AppId"),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'pageSize' => 9999,
            'UseType'=>2,
            'PayType'=>0,
            'VoucherStatus' => $VoucherStatus
        );

        $array ['Sign'] = create_botong_sign($array);
        $rspn = curl_request(read_config("URL").'/api/Parkings/GetVoucherInfo',json_encode($array));
        echo $rspn;
    }

}
