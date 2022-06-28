<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Carcode extends Controller
{

    //车牌列表
    public function chepaicheck(){
        $time = time();
        $secure_key = read_config("SecretKey");
        $appid = read_config("AppId");
        $DeviceToken=read_config("DeviceToken");
        $array=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time);
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/List';
        $arrdata = json_decode(curl_request($url,$data),true);
        return view('carcode.chepaicheck',['arrdata'=>$arrdata]);
    }

    //车牌取消绑定
    public function carno(Request $request){
        $time = time();
        $CarNo=trim($request->input('CarNo'));
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'CarNo'=>$CarNo,'AccessToken'=>session('AccessToken'));
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/Delete';
        echo curl_request($url,$data);
    }

    //修改该车牌为默认车牌
    public function morenche(Request $request){
        $time = time();
        $CarNo=trim($request->input('CarNo'));
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'CarNo'=>$CarNo,'AccessToken'=>session('AccessToken'));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/CreateBind';
        echo curl_request($url,$data);
    }


    public function chepai(Request $request){
        if ($request->filled('source')) {
            $jump_url = addslashes($request->query('source'));
            $jump_url = htmlspecialchars($request->query('source'));
            $jump_url = strip_tags($request->query('source'));
        } else {
            $jump_url = "";
        }


        if ($request->filled('berthcode')) {
            $berthcode = addslashes($request->query('berthcode'));
            $berthcode = htmlspecialchars($request->query('berthcode'));
            $berthcode = strip_tags($request->query('berthcode'));
        } else
            $berthcode = "";

        if ($request->isMethod('post')) {

            $time = time();
            $pchepai = trim($request->input('pchepai'));
            $chepai = trim($request->input('chepai'));
            $CarNo = $pchepai . $chepai;

            $secure_key = read_config("SecretKey");
            $appid = read_config("AppId");
            $DeviceToken = read_config("DeviceToken");

            if (session('AccessToken')) {
                $array = array('AppId' => $appid, 'AccessToken' => session('AccessToken'), 'Nonce' => $time, 'CarNo' => $CarNo);
            } else {
                $array = array('AppId' => $appid, 'OpenId' => session('openid'), 'Nonce' => $time, 'CarNo' => $CarNo);
            }


            $array['Sign'] = create_botong_sign($array);

            $data = json_encode($array);
            $url = read_config("URL") . '/api/Cars/Create';

            $arrdata = json_decode(curl_request($url, $data), true);
            // echo $url."<br>";
            // var_dump($arrdata);die;
            if ($arrdata['Message'] == 'success') {

                if ($request->filled('jump_url') && $request->input('jump_url') == 'first')
                    echo "<script>alert('添加成功!');window.location.replace('jishi.php?CarNo=" . $CarNo . "&id=2');</script>";
                else if ($request->input('jump_url') == 'lubpark.php')
                    echo "<script>alert('添加成功!');window.location.replace('lubpark.php?CarNo=firstadd&berthcode=" . $_POST['berthcode'] . ")';</script>";
                else if ($request->input('jump_url') == 'pay_noapply')
                    echo "<script>alert('添加成功!');window.location.replace('pay_noapply?CarNo=" . $CarNo . "&berthcode=" . $_POST['berthcode'] . "');</script>";
                else
                    echo "<script>alert('添加成功!');window.history.go(-2);</script>";
            } else {
                // echo "<script>alert('".$arrdata['Message']."');</script>";
                if (strpos($arrdata['Message'], "Token") !== false)
                    echo "<script>alert('账号失效！请重新登陆');window.location.href='login_sms';</script>";
                else

                    echo "<script>alert('" . $arrdata['Message'] . "');window.location.replace('chepai?source=" . $request->input('jump_url') . "')</script>";
            }
        }
        return view('carcode.chepai',['jump_url'=>$jump_url,'berthcode'=>$berthcode]);
    }

    public function choosechepai(Request $request){
        $time = time();

        $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time);

        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/List';
       return curl_request($url,$data);
    }

}
