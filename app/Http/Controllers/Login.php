<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Login extends Controller
{

    public function test(Request $request)
    {
        /*$request_json2=json_encode(array(
           'param1'=>'test2'
        ));
        $result=curl_request('http://laravel.ittun.com/test2',$request_json2);

        $request_json3=json_encode(array(
            'param1'=>'test3'
        ));

        curl_request('http://laravel.ittun.com/test3',$request_json3);*/

        /*$urls = array(array('url' => 'http://laravel.ittun.com/test2', 'params' => json_encode(array(
            'param1' => 'test2'
        ))), array('url' => 'http://laravel.ittun.com/test3', 'params' => json_encode(array(
            'param1' => 'test3'
        ))));
        $result=curl_multi_request($urls);*/
        /*并发请求返回数据的样例
        array(2) { [0]=> string(18) "{"result":"test2"}" [1]=> string(18) "{"result":"test3"}" }*/

        $url=url('test2');

       if($request->input('phone') == 1322){
           return 'yes';
       }

       return view('login.test');
    }

    public function test2(Request $request){
        sleep(5);
        echo json_encode(array('result'=>'test2'));
    }

    public function test3(Request $request){
        sleep(5);
        echo json_encode(array('result'=>'test3'));
    }

    //短信验证码登录
    public function login_sms(Request $request)
    {
        if ($request->isMethod('post')) {
            $phone = trim($request->input('phone'));
            $auth_code = trim($request->input('auth_code'));
            $time = time();
            $login_type = 2;//用户登录方式（0、	用户名密码登录（1、	用户openid登录（2、短信验证码快捷登录）
            $auth_code = trim($request->input('authcode'));
            $UserOpenId = session('openid');
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'MobilePhone' => $phone, 'DeviceToken' => read_config("DeviceToken"), 'UserOpenId' => $UserOpenId, 'LoginType' => $login_type, 'CityCode' => read_config("citycode"), 'AuthCode' => $auth_code);
            $array['Sign'] = create_botong_sign($array);
            $data = json_encode($array);


            $url = read_config("URL") . '/api/Users/Login';

            $rspn = curl_request($url, $data);


            $re_data = json_decode($rspn, true);
            // var_dump($re_data);
            $backurl="";
            if ($re_data['Message'] == 'success') {
                session(['AccessToken' => $re_data['Data']['AccessToken']]);
                $openid=session('openid');

                $num = DB::table('potong')->where('openid',$openid)->count('id');

                if ($num > 0) {
                    DB::table('potong')
                        ->where('openid', $openid)
                        ->update(['accesstoken' => session('AccessToken'), 'addtime' => $time, 'phone' => $phone, 'password' => '', 'imgurl' => session('headimgurl')]);
                } else {
                    DB::table('potong')->insert(
                        ['openid' => $openid, 'imgurl' => session("headimgurl"), 'phone' => $phone, 'password' => '', 'accesstoken' => session('AccessToken'), 'addtime' => $time]
                    );
                }

                $backurl='pay_noapply';

                if (session('backurl') != "") {
                    $backurl = session('backurl');
                }

                $msg = $re_data['Message'];

            } else {
                $msg = $re_data['Message'];
            }
            $result = array('msg' => $msg, 'backurl' => $backurl, 'code' => 0, 'RetCode' => $re_data['RetCode']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);exit;
        }
        if($request->filled('source')){
            session(['backurl'=>$request->query('source')]);
        }
        $backurl=session('backurl');
        return view('login.sms', ['backurl' => $backurl]);
    }

    //账号密码登录
    public function login_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $time = time();
            $phone = trim($request->input('phone'));
            $Password = MD5(trim($request->input('password')));
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'MobilePhone' => $phone, 'Password' => $Password, 'DeviceToken' => 'Agz7f_fJBt_OuUerjaNCepuVsuvT7Cgr8vuj3p', 'UserOpenId' => session('openid'));
            $array['Sign'] =create_botong_sign($array);
            $data = json_encode($array);

            $url = read_config("URL") . '/api/Users/Login';


            $rspn = curl_request($url, $data);


            $re_data = json_decode($rspn, true);

            if ($re_data['Message'] == 'success') {
                session(['AccessToken' => $re_data['Data']['AccessToken']]);
                $openid=session('openid');
                $num = DB::table('potong')->where('openid',$openid)->count('id');
                if ($num > 0) {
                    DB::table('potong')->where('openid',$openid)->update(['accesstoken' => session('AccessToken'),'addtime'=>$time,'phone'=>$phone,'password'=>$Password,'imgurl'=>session('headimgurl')]);
                } else {
                    DB::table('potong')->insert(
                        ['openid' => $openid, 'imgurl' => session("headimgurl"),'phone'=>$phone,'password'=>$Password,'accesstoken'=>session('AccessToken'),'addtime'=>$time]
                    );
                }

                $backurl='pay_noapply';

                if(session('backurl') != ""){
                    $backurl=session('backurl');
                }

                $msg=$re_data['Message'];
            } else {
                if ($re_data['RetCode'] == 1004) {
                    $msg=$re_data['Message'];
                    $backurl='zhuce';
                } else if ($re_data['RetCode'] == 1005) {
                    $msg=$re_data['Message'];
                    $backurl='login_password?phone='.$phone;
                } else {
                    $msg=$re_data['Message'];
                    $backurl="";
                }
            }
           $result=array('msg'=>$msg,'backurl'=>$backurl,'code'=>0,'RetCode'=>$re_data['RetCode']);
           return json_encode($result,JSON_UNESCAPED_UNICODE);
        }

        $phone=$request->query("phone");
        $phone=!empty($phone) ? $phone : '';
        $url=$request->query("url");
        $url=!empty($url) ? $url : '';
        return view('login.password',['phone'=>$phone,'url'=>$url]);
    }

    //账号注册
    public function zhuce(Request $request)
    {
        if ($request->isMethod('post')) {
            $time = time();
            $phone = trim($request->input('phone'));
            $password = MD5(trim($request->input('password')));
            $password1 = trim($request->input('password'));
            $authcode = trim($request->input('authcode'));
            $InviteCode = trim($request->input('authcode'));
            $request->validate([
                'vcode' => ['required', 'captcha'],
            ]);


            $secure_key = read_config("SecretKey");
            $appid = read_config("AppId");
            $DeviceToken = read_config("DeviceToken");
            $array = array('AppId' => $appid, 'MobilePhone' => $phone, 'Nonce' => $time, 'AuthCode' => $authcode, 'InviteCode' => $InviteCode, 'Password' => $password, 'DeviceToken' => $DeviceToken, 'SourceType' => 2, 'citycode' => read_config("citycode"), 'UserOpenId' => session('openid'));
            $array['Sign'] = create_botong_sign($array);
            $data = json_encode($array);

            $url = read_config("URL") . '/api/Users/Register';


            $arrdata = curl_request($url, $data);



            $arrdata = json_decode($arrdata,true);

            if ($arrdata['RetCode'] == 1001) {
                $result = array(
                    'code' => 0,
                    'msg' => '注册失败，验证码不匹配!',
                    'RetCode' => 1001
                );

            } else if ($arrdata['RetCode'] == 1002) {
                $result = array(
                    'code' => 0,
                    'msg' => '您好，您的手机已注册!',
                    'RetCode' => 1002
                );


            } else if ($arrdata['RetCode'] == 1004) {
                $result = array(
                    'code' => 0,
                    'msg' => '注册失败，密码不正确!',
                    'RetCode' => 1004
                );


            } else if ($arrdata['Message'] == 'success') {
                $id=DB::table('potong')->insertGetId(
                    ['openid' => session('openid'), 'imgurl' => session("headimgurl"),'phone'=>$phone,'password'=>$password,'accesstoken'=>$arrdata['Data']['AccessToken'],'addtime'=>$time]
                );

                if ($id) {
                    session(['AccessToken'=>$arrdata['Data']['AccessToken']]);
                    //echo "<script>alert('注册成功!');window.location.href='setpaypsw.php';</script>";die;
                    if(session('AppeType') != ""){
                        $backurl='getsale.php';
                    }else{
                        $backurl='pay_noapply';
                    }

                    $result = array(
                        'code' => 0,
                        'msg' => $arrdata['Message'],
                        'backurl'=>'pay_noapply'
                    );

                }
            } else {
                $result = array(
                    'code' => 0,
                    'msg' => $arrdata['Message']
                );


            }
            return json_encode($result,JSON_UNESCAPED_UNICODE);
        }

        $phone=$request->query("phone");
        $phone=!empty($phone) ? $phone : '';
        $password1=$request->query("password1");
        $password1=!empty($password1) ? $password1 : '';
        $authcode=$request->query("authcode");
        $authcode=!empty($authcode) ? $authcode : '';
        return view('login.zhuce',['phone'=>$phone,'password1'=>$password1,'authcode'=>$authcode]);
    }

    //发送短信验证码
    public function send_sms(Request $request){
        $time = time();
        $phone=trim($request->input('phone'));

        $appid = read_config("AppId");
        $array=array('AppId'=>$appid,'MobilePhone'=>$phone,'Nonce'=>$time,'msgtype'=>'Login_CheckCode');
        $array['Sign'] =create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/Smscode';

        $result=curl_request($url,$data);

        return $result;
    }


    //找回密码时的短信验证码
    public function send_forgetsms(Request $request){
        $time = time();
        $phone=trim($request->input('phone'));
        $msgtype=$request->filled('msgtype')?$request->input('msgtype'):'Find_LoginPWD';

        $array=array('AppId'=>read_config("AppId"),'MobilePhone'=>$phone,'Nonce'=>$time,'msgtype'=>$msgtype);

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/Smscode';
        echo curl_request($url,$data);exit;
    }

    //修改账户密码
    public function passwordedit(Request $request){
        if($request->isMethod('post')){

            $time = time();
            $phone=trim($request->input('phone'));
            $OriginPsw=MD5(trim($request->input('originpsw')));
            $NewPsw=MD5(trim($request->input('newpsw')));

            $appid = read_config('AppId');

            $array=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'OriginPsw'=>$OriginPsw,'NewPsw'=>$NewPsw);

            $array['Sign'] = create_botong_sign($array);

            $data= json_encode($array);
            $url=read_config("URL").'/api/Users/PasswordUpdate';

            $arrdata = json_decode(curl_request($url,$data),true);
            if($arrdata['Message']=='success'){
                $res=DB::table('potong')->where('openid',session('openid'))->update(['password'=>$NewPsw]);
                if($res){
                    echo "<script>alert('修改账户密码成功!');window.location.href='login_password';</script>";
                }
            }else{
                echo "<script>alert('".$arrdata['Message']."');</script>";
            }
        }
     return view('login.passwordedit');
    }

    //忘记密码
    public function fgetpay(Request $request){
        if($request->isMethod('post')){
            $request->flash();

            $time = time();
            $PayPsw=MD5(trim($request->input('PayPsw')));
            $authcode=trim($request->input('authcode'));
            $MobilePhone=trim($request->input('phone'));
            $vcode=$request->input('vcode');
            $request->validate([
                'vcode' => ['required', 'captcha'],
            ]);

            $appid = read_config('AppId');

            $array=array('AppId'=>$appid,'Nonce'=>$time,'AuthCode'=>$authcode,'Password'=>$PayPsw,'MobilePhone'=>$MobilePhone);

            $array['Sign'] = create_botong_sign($array);

            $data= json_encode($array);
            $url=read_config("URL").'/api/Users/PasswordReset';
            // echo curl_request($url,$data);die;
            $arrdata = json_decode(curl_request($url,$data),true);
            // var_dump($arrdata);

            if($arrdata['Message']=='success'){
                echo "<script>alert('找回登录密码成功！');window.location.href='login_password';</script>";
            }else{
                echo "<script>alert('".$arrdata['Message']."');</script>";
            }


        }
       return view('login.fgetpay');
    }


    //退出登录
    public function login_out(){
        $time = time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'));
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/Logout';
        $re_data= json_decode(curl_request($url,$data),true);

        if($re_data['Message']=='success'){
            $num = DB::table('potong')->where('openid',session('openid'))->count('id');
            if($num>0){
                DB::table('potong')->where('openid', '=', session('openid'))->delete();
            }
            echo "<script>alert('退出登录成功');window.location.href='login_sms';</script>";
        }else{
            if (strpos($re_data['Message'],"Token")!==false){
                echo "<script>alert('账号失效！请重新登陆');window.location.href='login_sms';</script>";
            }else{
                echo "<script>alert('".$re_data['Message']."');</script>";
            }


        }
    }

}
