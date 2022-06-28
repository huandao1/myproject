<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function index(Request $request){

        if ($request->filled('payment_success')) {

            if ($request->query('payment_success') == 'y') {
                if (empty(session('AccessToken')) && $request->query('ordertype') == '10') {
                    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                    echo "<script> alert('缴费已取消！');</script>";
                    sleep(2);
                    echo "<script>window.location.href='https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=Mzg4MzIyMTE2NA==&scene=124#wechat_redirect';</script>";
                    return;
                }
                if ($request->query('ordertype') == '02') {
                    echo "<script> alert('缴费已取消！'); window.location.href='jishi.php';</script>";
                }
                if ($request->query('ordertype') == '03') {
                    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                    echo "<script> alert('PDA代缴费已取消！');</script>";
                    sleep(2);
                    echo "<script>window.location.href='https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=Mzg4MzIyMTE2NA==&scene=124#wechat_redirect';</script>";
                    return;
                }
                if ($request->query('ordertype') == '04') {
                    echo "<script> window.location.href='lubpark.php?id=1';</script>";
                }
                if ($request->query('ordertype') == '05') {
                    echo "<script> window.location.href='lubpark.php?id=1';</script>";
                }
                if ($request->query('ordertype') == '06') {
                    echo "<script> alert('欠费补缴订单缴费已取消！');</script>";
                }
            } else {
                if ($request->query('ordertype') == '02') {
                    echo "<script> alert('后付费缴费失败！'); window.location.href='jishi.php';</script>";
                }
                if ($request->query('ordertype') == '03') {
                    echo "<script> alert('PDA代缴费失败！');</script>";
                    sleep(2);
                    echo "<script>window.location.href='https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=Mzg4MzIyMTE2NA==&scene=124#wechat_redirect';</script>";
                    return;
                }
                if ($request->query('ordertype') == '04') {
                    echo "<script> alert('预付费缴费失败！'); window.location.href='jishi.php';</script>";
                }
                if ($request->query('ordertype') == '05') {
                    echo "<script> alert('续费订单缴费失败！'); window.location.href='jishi.php';</script>";
                }
                if ($request->query('ordertype') == '06') {
                    echo "<script> alert('欠费补缴订单缴费失败！');</script>";
                }
            }
        }


        $time1 = time ();
        $array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => $time1,
            'AccessToken' => session('AccessToken')
        );
        $array ['Sign'] = create_botong_sign($array);
        $data = json_encode ( $array );
        $url = read_config("URL") . '/api/Users/GetMebUserInfo';
        $personInfo = json_decode ( curl_request ( $url, $data ), true );
        if ($personInfo ['RetCode'] == 5) {
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';
            die ();
        }

        session(['MobileNO' => $personInfo['Data']['Items'][0]['MobileNO']]);


        return view('user.index',['headimgurl' => session('headimgurl'),'personInfo' => $personInfo,'AccessToken' => session('AccessToken'),'openid'=>session('openid')]);
    }


}
