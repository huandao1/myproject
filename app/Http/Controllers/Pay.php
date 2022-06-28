<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Pay extends Controller
{
    public function noapply(Request $request)
    {
        $urls=array();
        $time1 = time ();
        $user_array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => $time1,
            'AccessToken' => session('AccessToken')
        );
        $user_array ['Sign'] = create_botong_sign($user_array);
        $user_data = json_encode ($user_array);
        $user_url = read_config("URL"). '/api/Users/GetMebUserInfo';
        $urls[]=array('url'=>$user_url,'params'=>$user_data);


        //获取车牌
        $time = time();
        $secure_key = read_config("SecretKey");
        $appid = read_config("AppId");
        $array=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time);
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/List';
        $urls[]=array('url'=>$url,'params'=>$data);


        $res_arr=curl_multi_request($urls);
        $personInfo=json_decode($res_arr[0],true);
        if ($personInfo ['RetCode'] == 5) {
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';
            die ();
        }

        $carno_data = $res_arr[1];

        if($request->isMethod('post')){
            $carCode=trim($request->input('carCode'));
            $pageIndex = 1;
            $pageSize = 1000;
            $array1=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'citycode'=>read_config("citycode"),'carCode'=>$carCode,'pageIndex'=>$pageIndex,'pageSize'=>$pageSize);
            $array1['Sign'] = create_botong_sign($array1);
            $data1= json_encode($array1);
            $url1=read_config("URL").'/api/Transaction/GetNoApplyArrearsListDetail';
            echo curl_request($url1,$data1);die;
        }
        return view('pay.noapply',['carno_data'=>$carno_data]);
    }

    public function getarrears(Request $request){
        $time = time();
        $carCode=trim($request->input('carCode'));
        $pageIndex = trim($request->input('PageIndex'));
        $pageSize = trim($request->input('PageSize'));
        $array1=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'citycode'=>read_config("citycode"),'PlateNumber'=>$carCode,'pageIndex'=>$pageIndex,'pageSize'=>$pageSize);
        $array1['Sign'] = create_botong_sign($array1);
        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/GetNoApplyArrearsListDetail';
        $result=curl_request($url1,$data1);
        echo $result;die;
    }


    public function zhangdan(){
        $time = time();
        $secure_key = read_config("SecretKey");
        $appid = read_config("AppId");
        $DeviceToken=read_config("DeviceToken");
        $array=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'LastId'=>0);
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Accounts/OrderList';

        $rspn = curl_request($url,$data);

        $arrdata = json_decode($rspn,true);

        $arrdata0['Data']['Items']=array();

        if(isset($arrdata['Data']['Items']) && !empty($arrdata['Data']['Items'])){
            foreach ($arrdata['Data']['Items'] as $key => &$value) {
                $value['mounth']=substr($value['CreateTime'],6,1);
                $value['day']=substr($value['CreateTime'],5,5);
                $value['hour']=substr($value['CreateTime'],11,8);
            }
            unset($value);

            foreach ($arrdata['Data']['Items'] as $key => $value) {
                if($value['PayStatus']==1){
                    $arrdata0['Data']['Items'][]=$value;
                }
            }
        }

        $array1=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'pageSize'=>9999,'lastID'=>0,'CityCode'=>read_config("citycode"),'BargainOrderType'=>'0');
        $array1['Sign'] = create_botong_sign($array1);

        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Parkings/GetParkHistoryOrderList';

        $rspn = curl_request($url1,$data1);


        $arrdata1 = json_decode($rspn,true);
        if($arrdata1['RetCode'] == 5){
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';
            die ();
        }
        if(isset($arrdata1['Data']['Items']) && !empty($arrdata1['Data']['Items'])){
            foreach ($arrdata1['Data']['Items'] as $key => &$value) {
                // $value['CreateTime']=substr($value['CreateTime'],0,10);
                $value['mounth']=substr($value['BerthStartParkingTime'],6,1);
                $value['day']=substr($value['BerthStartParkingTime'],5,5);
                $value['hour']=substr($value['BerthStartParkingTime'],11,8);
            }
            unset($value);
        }else{
            $arrdata1['Data']['Items']=array();
        }


        $array2=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'pageSize'=>9999,'lastID'=>0,'CityCode'=>read_config("citycode"),'BargainOrderType'=>'1');
        $array2['Sign'] = create_botong_sign($array2);
        $data2= json_encode($array2);
        $url2=read_config("URL").'/api/Parkings/GetParkHistoryOrderList';

        $rspn = curl_request($url2,$data2);


        $arrdata2 = json_decode($rspn,true);
        if($arrdata2['RetCode'] == 5){
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';
            die ();
        }
        if(isset($arrdata2['Data']['Items']) && !empty($arrdata2['Data']['Items'])){
            foreach ($arrdata2['Data']['Items'] as $key => &$value) {
                $value['mounth']=substr($value['BerthStartParkingTime'],6,1);
                $value['day']=substr($value['BerthStartParkingTime'],5,5);
                $value['hour']=substr($value['BerthStartParkingTime'],11,8);
            }
            unset($value);
        }else{
            $arrdata2['Data']['Items']=array();
        }


        return view('pay.zhangdan',['arrdata0'=>$arrdata0,'arrdata1'=>$arrdata1,'arrdata2'=>$arrdata2]);
    }

    public function detail(){
        $time = time();
        $secure_key = read_config("SecretKey");
        $appid = read_config("AppId");
        $DeviceToken=read_config("DeviceToken");
        $array1=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'pageSize'=>9999,'lastID'=>0,'CityCode'=>read_config("citycode"),'BargainOrderType'=>'0');
        $array1['Sign'] =create_botong_sign($array1);
        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Parkings/GetParkHistoryOrderList';


        $rspn = curl_request($url1,$data1);


        $arrdata1 = json_decode($rspn,true);
        if(isset($arrdata1['Data']['Items']) && !empty($arrdata1['Data']['Items'])){
            foreach ($arrdata1['Data']['Items'] as $key => &$value) {
                $value['mounth']=substr($value['BerthStartParkingTime'],6,1);
                $value['day']=substr($value['BerthStartParkingTime'],5,5);
                $value['hour']=substr($value['BerthStartParkingTime'],11,8);
            }
            unset($value);
        }else{
            $arrdata1['Data']['Items']=array();
        }


        $array2=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'pageSize'=>9999,'lastID'=>0,'CityCode'=>read_config("citycode"),'BargainOrderType'=>'1');
        $array2['Sign'] =create_botong_sign($array2);
        $data2= json_encode($array2);
        $url2=read_config("URL").'/api/Parkings/GetParkHistoryOrderList';
        $rspn = curl_request($url2,$data2);
        $arrdata2 = json_decode($rspn,true);
        if(isset($arrdata2['Data']['Items']) && !empty($arrdata2['Data']['Items'])){
            foreach ($arrdata2['Data']['Items'] as $key => &$value) {
                $value['mounth']=substr($value['BerthStartParkingTime'],6,1);
                $value['day']=substr($value['BerthStartParkingTime'],5,5);
                $value['hour']=substr($value['BerthStartParkingTime'],11,8);
            }
            unset($value);
        }else{
            $arrdata2['Data']['Items']=array();
        }

        return view('pay.detail',['arrdata1'=>$arrdata1,'arrdata2'=>$arrdata2]);
    }


    public function bupay(Request $request){
        if($request->isMethod('post')){
            $time1=time();
            $paypwd=MD5($request->input('paypwd'));
            $ordercode=$request->input('ordercode');
            $time=$request->input('time');
            $PayPrice=$request->input('PayPrice');
            $BargainOrder=$request->filled('BargainOrder')?$request->input('BargainOrder'):'';

            $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'paypwd'=>$paypwd,'ordercode'=>$ordercode,'time'=>$time,'PayPrice'=>$PayPrice,'citycode'=>read_config("citycode"),'bargainordercode'=>$BargainOrder);

            $array['Sign'] = create_botong_sign($array);

            $data= json_encode($array);
            $url=read_config("URL").'/api/Transaction/ArrearsPay';
            return curl_request($url,$data);
        }
        $urls=array();
        $time1=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'lastID'=>0,'pageSize'=>9,'CityCode'=>read_config("citycode"));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Transaction/GetArrearsList';
        $urls[]=array('url'=>$url,'params'=>$data);

        $time = time();
        $appid = read_config("AppId");
        $array=array('AppId'=>$appid,'AccessToken'=>session('AccessToken'),'Nonce'=>$time);
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/List';
        $urls[]=array('url'=>$url,'params'=>$data);


        $res_arr=curl_multi_request($urls);
        $arrdata1=json_decode($res_arr[0],true);
        $carno_data = json_decode($res_arr[1],true);
        foreach ($carno_data['Data']['Items'] as $key => $value) {
            if ($value['Bind']==1) {
                $PlateNumber=$value['CarNo'];
            }
        }

        if($request->filled('carno')){
            $PlateNumber=$request->query('carno');
        }
        if($request->isMethod('post') || $PlateNumber){
            $carCode=$request->input('carCode')?trim($request->input('carCode')):$PlateNumber;
            $pageIndex = 1;
            $pageSize = 1000;
            $array1=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'citycode'=>read_config("citycode"),'PlateNumber'=>$carCode,'pageIndex'=>$pageIndex,'pageSize'=>$pageSize);
            $array1['Sign'] = create_botong_sign($array1);
            $data1= json_encode($array1);
            $url1=read_config("URL").'/api/Transaction/GetArrearsList';
            $result = json_decode(curl_request($url1,$data1),true);
            $otypearr=array("预付费","后付费","PDA订单");
        }
        $type=0;
        if($request->isMethod('get') && $request->filled("type")){
            $type=$request->query('type');
        }
        return view('pay.bupay',['arrdata1'=>$arrdata1,'carno_data'=>$carno_data,'result'=>$result,'carCode'=>$carCode,'type'=>$type]);
    }

    public function bupay1(Request $request){
        $time1=time();
        $paypwd=MD5($request->post('paypwd'));
        $ordercode=$request->post('ordercode');
        $time=$request->post('time');
        $PayPrice=$request->post('PayPrice');
        $BargainOrder=$request->filled('BargainOrder')?$request->post('BargainOrder'):'';

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'paypwd'=>$paypwd,'ordercode'=>$ordercode,'time'=>$time,'PayPrice'=>$PayPrice,'citycode'=>read_config('citycode'),'bargainordercode'=>$BargainOrder);
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Transaction/ArrearsPay';
        return curl_request($url,$data);
    }

    public function bj_dingdan(Request $request){
        $sectionname = $request->filled('SectionName')? $request->query('SectionName') : 0;
        $berthcode = $request->filled('berthcode') ? $request->query('berthcode') : 0;
        $time = $request->filled('time') ? $request->query('time') : 0;
        $star_times=$request->query('BerthStartParkingTime');
        $PayPrice = $request->filled('PayPrice') ? $request->query('PayPrice') : 0;
        $trade_type = 2;
        $PlateNumber=trim($request->query('PlateNumber'));
        $price=$request->filled('price')?$request->query('price'):$request->query('ActualPrice');
        $paytype=$request->filled('PayType')?$request->query('PayType'):1;

        $getine=time()-(strtotime($star_times)+$time*60);


//获取用户优惠券
        $array_coupon = array (
            'AppId' => read_config("AppId"),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'pageSize' => 9999,
            'UseType'=>1,
            'PayType'=>intval($paytype),
            'VoucherStatus' => 1 //1-有效
        );

        $array_coupon ['Sign'] = create_botong_sign($array_coupon);
        $rspn = curl_request ( read_config("URL") . '/api/Parkings/GetVoucherInfo', json_encode ( $array_coupon ) );
        $coupon_list = json_decode($rspn,true);
        $i=0;
        $res=array();
        // var_dump($array_coupon);
        $py=array($paytype,0);
        foreach ($coupon_list['Data']['DiscountData'] as $t =>$j) {
            floatval($j['FSMoney']);
            // var_dump($j['FSMoney']);
            if ($j['FSMoney']<=floatval($price)&&in_array($j['PaymentType'],$py)) {
                $i++;
                $res[]=$j;
            }
        }
        foreach ($coupon_list['Data']['Items'] as $x =>$y) {
            floatval($y['FSMoney']);
            // var_dump($y['PaymentType']);
            if (in_array($y['PaymentType'],$py)) {
                $i++;
            }
        }
//获取当前停车是否已使用优惠券
        $array = array (
            'AppId' => read_config("AppId"),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'BargainOrderCode' => $request->query('BargainOrder')
        );

        $array ['Sign'] = create_botong_sign($array);
        $rspn = curl_request ( read_config("URL") . '/api/Parkings/CheckVoucherUse', json_encode ( $array ) );
        $coupon_use_array = json_decode($rspn,true);
        $BargainOrder= $request->filled('BargainOrder')?$request->query('BargainOrder'):0;
        $BerthCode=$request->filled('BerthCode')?$request->query('BerthCode'):0;
        return view('pay.bj_dingdan',['berthcode'=>$berthcode,'sectionname'=>$sectionname,'star_times'=>$star_times,'coupon_use_array'=>$coupon_use_array,'coupon_list'=>$coupon_list,'price'=>$price,'res'=>$res,'BargainOrder'=>$BargainOrder,'BerthCode'=>$BerthCode,'time'=>$time,'getine'=>$getine,'i'=>$i]);
    }

    public function dingdan(Request $request){
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'CityCode'=>read_config('citycode'));

        $array['Sign']=create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/UserParkingPay/GetParkRPOrderList';

        $arrdata = json_decode(curl_request($url,$data),true);
        $chi_time=GetRTime(intval($arrdata['Data']['RemainTime']));

        $price=$request->filled('price')?$request->query('price'):$request->query('ActualPrice');
        $paytype=$request->filled('PayType')?$request->query('PayType'):1;


//获取用户优惠券
        $array_coupon = array (
            'AppId' => read_config("AppId"),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'pageSize' => 9999,
            'UseType'=>1,
            'PayType'=>2,
            'VoucherStatus' => 1 //1-有效
        );

        $array_coupon ['Sign'] = create_botong_sign($array_coupon);
        $rspn = curl_request ( read_config("URL") . '/api/Parkings/GetVoucherInfo', json_encode ( $array_coupon ) );
        $coupon_list = json_decode($rspn,true);
        $i=0;
        $res=array();

// var_dump( $coupon_list );
        $py=array($paytype,0);

        foreach ($coupon_list['Data']['DiscountData'] as $t =>$j) {
            floatval($j['FSMoney']);

            if ($j['FSMoney']<=floatval($price)&&in_array($j['PaymentType'],$py)) {
                $i++;
                $res[]=$j;
            }
        }
        foreach ($coupon_list['Data']['Items'] as $x =>$y) {
            floatval($y['FSMoney']);

            if (in_array( $y['PaymentType'],$py)) {
                $i++;
            }
        }
      return view('pay.dingdan',['arrdata'=>$arrdata,'chi_time'=>$chi_time,'i'=>$i,'price'=>$price,'coupon_list'=>$coupon_list,'res'=>$res,'py'=>$py]);
    }

    public function OrderHaveArrears(Request $request){
        $time1=time();
        $BargainOrder=$request-input('BargainOrder');

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'BargainOrder'=>$BargainOrder,'CityCode'=>read_config("citycode"));

        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Transaction/OrderHaveArrears';
        return curl_request($url,$data);
    }

    public function lubpark(Request $request){
        $time1=time();
        $array1=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'citycode'=>read_config("citycode"));
        $array1['Sign'] =create_botong_sign($array1);

        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/Parking';
        $datas1 = json_decode(curl_request($url1,$data1),true);

        if($datas1['RetCode']==5){
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';die;
        }

        if($datas1['Data']['code']=="is_parking"||$datas1['Data']['data']['IsArrears']=="1"){
            header('Location:pay_jishi?id=1');die;
        }


        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/GetMebUserInfo';
        $personInfo =json_decode(curl_request($url,$data),true);

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'citycode'=>read_config('citycode'));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Parkings/GetBerthMinTime';
        $datas2 =json_decode(curl_request($url,$data),true);
        $minUnit=!empty($datas2['Data']["minUnit"])?$datas2['Data']["minUnit"]:60;
        session(['minUnit'=>$minUnit]);
        $firstMinTime=!empty($datas2['Data']["firstMinTime"])?$datas2['Data']["firstMinTime"]:60;
        session(['firstMinTime'=>$firstMinTime]);

        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'citycode'=>read_config('AccessToken'));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Parkings/GetApplicationType';
        $arr_data=json_decode(curl_request($url,$data),true);


        if($request->filled('berthcode')){
            $jump_berthcode = $request->query('berthcode');
        }else{
            $jump_berthcode = '';
        }
     return view('pay.lubpark',['arr_data'=>$arr_data,'jump_berthcode'=>$jump_berthcode]);
    }

    public function lubpark01(Request $request){
        if($request->isMethod('post')){
            $time = time();

            $berthcode=trim($request->input('berthcode'));
            $paypwd=MD5(trim($request->input('paypwd')));
            // echo $paypwd;die;
            $PayPrice =trim($request->input('PayPrice'));
            $times=intval(trim($request->input('times')));
            $CarNo=trim($request->input('CarNo'));

            if($CarNo==''){
                $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time);

                $array['Sign'] = create_botong_sign($array);

                $data= json_encode($array);
                $url=read_config("URL").'/api/Cars/List';

                $arrdata = json_decode(curl_request($url,$data),true);
                $CarNo=!empty($arrdata['Data']['Items'][0]['CarNo'])?$arrdata['Data']['Items'][0]['CarNo']:'';
            }

            $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'time'=>$times,'AccessToken'=>session('AccessToken'),'berthcode'=>$berthcode,'paypwd'=>$paypwd,'PayPrice'=>$PayPrice,'citycode'=>read_config('AccessToken'),'ApplyMethod'=>'4','PlateNumber'=>$CarNo);

            $array['Sign'] =create_botong_sign($array);

            $data= json_encode($array);
            $url=read_config("URL").'/api/Transaction/ParkApply';
            return curl_request($url,$data);
        }
    }

    public function lubpark02(Request $request){
        if($request->isMethod('post')){
            $time = time();

            $berthcode=trim($request->input('berthcode'));
            $paypwd=MD5(trim($request->input('paypwd')));
            // echo $paypwd;die;
            //$PayPrice =trim($_POST['PayPrice']);
            $times=intval(trim($request->input('times')));

            $array=array('AppId'=>read_config('AppId'),'Nonce'=>$time,'time'=>$times,'AccessToken'=>session('AccessToken'),'berthcode'=>$berthcode,'paypwd'=>$paypwd,'citycode'=>read_config('citycode'));

            $array['Sign'] = create_botong_sign($array);

            $data= json_encode($array);
            $url=read_config('URL').'/api/Transaction/BespeakApply';
            return curl_request($url,$data);


        }
    }

    public function lubpark2(Request $request){
        $berthcode = $request->query('berthcode');

        $ordercode = $request->query('ordercode');
        $ordercode=!empty($ordercode)?$ordercode:0;

        $RemainTime=$request->query('RemainTime');
        $RemainTime=!empty($RemainTime)?$RemainTime:0;

        $time=time();
        $date=date("Y-m-d");
        $array=array('AppId'=>read_config('AppId'),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'CityCode'=>read_config('citycode'),'berthcode'=>$berthcode,'berthdate'=>$date);

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Transaction/GetParkingChargeTime';
        $datainfo =json_decode(curl_request($url,$data),true);

        if($datainfo['Data']['status']==1){
            $time_t="今日收费时段为".$datainfo['Data']['data']['startTime']."-".$datainfo['Data']['data']['endTime'];
        }else{
            $time_t=$datainfo['Data']['msg'];
        }

        $time1=time();
        $array=array('AppId'=>read_config('AppId'),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'));
        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Users/GetMebUserInfo';
        $personInfo =json_decode(curl_request($url,$data),true);

        //获取用户优惠券
        $array = array (
            'AppId' => read_config('AppId'),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'pageSize' => 9999,
            'UseType'=>1,
            'PayType'=>1,
            'VoucherStatus' => 1 //1-有效
        );

        $array ['Sign'] = create_botong_sign($array);
        $rspn = curl_request (read_config('URL') . '/api/Parkings/GetVoucherInfo',json_encode($array));
        $coupon_list = json_decode($rspn,true);
        $i=0;
        $res=array();

// var_dump($coupon_list);
        $py=array(1,0);

        foreach ($coupon_list['Data']['DiscountData'] as $t =>$j) {
            floatval($j['FSMoney']);
            if (in_array($j['PaymentType'],$py)) {
                $i++;
                $res[]=$j;
            }
        }
        foreach ($coupon_list['Data']['Items'] as $x =>$y) {
            floatval($y['FSMoney']);
            if (in_array( $y['PaymentType'],$py)) {
                $i++;
            }
        }

//获取当前停车是否已使用优惠券
        $array = array (
            'AppId' => read_config('AppId'),
            'AccessToken' => session('AccessToken'),
            'Nonce' => time (),
            'BargainOrderCode' => $request->query('ordercode')
        );

        $array ['Sign'] = create_botong_sign($array);

        $rspn = curl_request(read_config('URL').'/api/Parkings/CheckVoucherUse',json_encode($array));
        $coupon_use_array = json_decode($rspn,true);
        return view('pay.lubpark2',['coupon_use_array'=>$coupon_use_array,'coupon_list'=>$coupon_list,'berthcode'=>$berthcode,'ordercode'=>$ordercode,'RemainTime'=>$RemainTime,'time_t'=>$time_t,'i'=>$i,'personInfo'=>$personInfo]);
    }

    public function renewapply(Request $request){
        $time1=time();
        $array=array('AppId'=>read_config('AppId'),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Users/GetMebUserInfo';
        $personInfo =json_decode(curl_request($url,$data),true);
        if($personInfo['RetCode']==5){
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';die;
        }
        $ordercode=$request->filled('ordercode')?$request->query('ordercode'):0;
        $PayPrice=$request->filled('PayPrice')?$request->query('PayPrice'):0;
        $berthcode=$request->filled('berthcode')?$request->query('berthcode'):0;
        $time=$request->filled('time')?$request->query('time'):0;

        $VoucherID=$request->filled('VoucherID')?$request->query('VoucherID'):-1;
        $VPNMId=$request->filled('VPNMId')?$request->query('VPNMId'):-1;
        $CouponType=$request->filled('CouponType')?$request->query('CouponType'):0;
        $CouponAmount=$request->filled('CouponAmount')?$request->query('CouponAmount'):0;


        //支付金额小于或等于0的处理
        if(($PayPrice - $CouponAmount )<=0){

            $req_arr = array (
                'AppId' => read_config('AppId'),
                'Nonce' => time (),
                'ordercode' => $ordercode,
                'berthcode' => $berthcode,
                "citycode" => read_config('citycode'),
                "paytype" => 4,
                'PayPrice' => $PayPrice,
                'time' => $time,
                'VoucherID'=>$VoucherID,
                'VPNMId'=>$VPNMId,
                "trade_type" => 2,
                "ApplyMethod"=>4,
                "openid" => session('openid'),
                'AccessToken' => session('AccessToken')
            );

            if($CouponType==1){
                $req_arr['FreeTime'] = $CouponAmount;
                $req_arr['FreePrice'] = 0;
            }else{
                $req_arr['FreePrice'] = $CouponAmount;
                $req_arr['FreeTime'] = 0;
            }

            $req_arr ['Sign'] = create_botong_sign($req_arr);

            $rspn = curl_request(read_config('URL').'/api/Transaction/RenewApply',json_encode($req_arr));
            $arrdata = json_decode ( $rspn, true );

            //使用优惠支付，无需调起支付
            if($arrdata['RetCode']==-1){
                echo "<script>alert('" . $arrdata['Message'] . "');window.location.href='pay_lubpark2';</script>"; die;
            }elseif($arrdata['Data']['ApplyMenth']==0){
                if($arrdata['Data']['webResponse']['status']==1){
                    echo "<script>window.location.href='pay_success_tips';</script>"; die;
                }else{
                    echo "<script>alert('" . $arrdata['Data']['webResponse']['msg'] . "');window.location.href='pay_lubpark2';</script>"; die;
                }
            }
        }
        return view('pay.renewapply',['PayPrice'=>$PayPrice,'ordercode'=>$ordercode,'time'=>$time,'BargainOrder'=>$ordercode,'VPNMId'=>$VPNMId,'VoucherID'=>$VoucherID,'CouponAmount'=>$CouponAmount,'CouponType'=>$CouponType]);
    }

    public function lubpark1(Request $request){
        $time1=time();
        $array1=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'citycode'=>read_config('citycode'));
        $array1['Sign'] = create_botong_sign($array1);

        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/GetUserBespeak';
        $datas1 = json_decode(curl_request($url1,$data1),true);

        if($datas1['Data']['code']=="is_bespeak"){
            header('Location:pay_bespeak');die;

        }


        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'));

        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/GetMebUserInfo';
        $personInfo =json_decode(curl_request($url,$data),true);
        $minUnit=session('minUnit');
        $firstMinTime=session('firstMinTime');
        return view('pay.lubpark1',['personInfo'=>$personInfo,'minUnit'=>$minUnit,'firstMinTime'=>$firstMinTime]);
    }

    public function bespeak(Request $request){
        $time1=time();
        $array1=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'citycode'=>read_config('citycode'));

        $array1['Sign'] = create_botong_sign($array1);

        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/GetUserBespeak';
        $datas1 = json_decode(curl_request($url1,$data1),true);
        $endtime = strtotime($datas1['Data']['data']['ApplyTime'])+intval($datas1['Data']['data']['ApplyDuration'])*60;
        $datas1['Data']['data']['endtime']=date("H:i",$endtime);

        if($datas1['Data']['code']=='no_bespeak'){
            return "<script>window.location.href='pay_lubpark1';</script>";
        }

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'));

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/GetMebUserInfo';
        $personInfo =json_decode(curl_request($url,$data),true);
        return view('pay.bespeak',['datas1'=>$datas1]);
    }

    public function apply_hou(Request $request){
        $time = time();

        $CarNo=trim($request->input('CarNo'));
        if($CarNo==''){



            $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time);

            $array['Sign'] = create_botong_sign($array);

            $data= json_encode($array);
            $url=read_config("URL").'/api/Cars/List';

            $arrdata = json_decode(curl_request($url,$data),true);
            $CarNo=!empty($arrdata['Data']['Items'][0]['CarNo'])?$arrdata['Data']['Items'][0]['CarNo']:'';

        }

        $berthcode=trim($request->input('berthcode'));

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'berthcode'=>$berthcode,'AccessToken'=>session('AccessToken'),'CityCode'=>read_config('citycode'),'ApplyMethod'=>'4','PlateNumber'=>$CarNo);

        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Transaction/ParkLastApply';
        return curl_request($url,$data);
    }

    public function chargetime(Request $request){
        $berthcode = $request->post('berthcode');

        $time=time();
        $unix_time=strtotime("+1 day");
        $date=date("Y-m-d",$unix_time);
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'CityCode'=>read_config('citycode'),'berthcode'=>$berthcode,'berthdate'=>$date);

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Transaction/GetParkingChargeTime';
        $datainfo =json_decode(curl_request($url,$data),true);

        if($datainfo['Data']['status']==1){
            $time_t="次日收费时段为".$datainfo['Data']['data']['startTime']."-".$datainfo['Data']['data']['endTime'];
        }else{
            $time_t=$datainfo['Data']['msg'];
        }
        return $time_t;

    }

    public function chargetime1(Request $request){
        $berthcode = $request->input('berthcode');

        $time=time();

        $date=date("Y-m-d");
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'CityCode'=>read_config('AccessToken'),'berthcode'=>$berthcode,'berthdate'=>$date);
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Transaction/GetParkingChargeTime';

        $rspn_data = curl_request($url,$data);

        $datainfo =json_decode($rspn_data,true);


        if($datainfo['Data']['status']==1){
            $time_t="今日收费时段为".$datainfo['Data']['data']['startTime']."-".$datainfo['Data']['data']['endTime'];
        }else{
            $time_t=$datainfo['Data']['msg'];
        }
        return $time_t;
    }

    public function berthstatus(Request $request){
        $time = time();
        $berthcode=trim($request->input('berthcode'));

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'berthcode'=>$berthcode,'AccessToken'=>session('AccessToken'),'citycode'=>read_config('citycode'));

        $array['Sign'] =create_botong_sign($array);


        $data= json_encode($array);
        $url=read_config("URL").'/api/Transaction/BerthStatus';

        $response_data = curl_request($url,$data);

        return $response_data;
    }

    public function couponget(Request $request){
        $array = array (
            'AppId' => read_config("AppId"),
            'AccessToken' =>session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'pageSize' => 9999,
            'UseType'=>1,
            'PayType'=>1,
            'VoucherStatus' => 1,
            'PlateNumber'=>trim($request->input('carno'))
        );

        $array ['Sign'] = create_botong_sign ( $array );

        $action=trim($request->input('action'));
        $total_money=trim($request->input('price'));
        if ($action=="ajaxget") {
            $rspn = curl_request ( read_config("URL") . '/api/Parkings/GetVoucherInfo', json_encode ( $array ) );


            $coupon_list = json_decode ( $rspn, true );
            $py=array(1,0);
            $i=0;
            $res=array();

            foreach ($coupon_list['Data']['DiscountData'] as $t =>$j) {
                floatval($j['FSMoney']);

                if ($j['FSMoney']<=floatval($total_money)&&in_array($j['PaymentType'],$py)) {
                    $t++;
                    $res[]=$j;
                }
            }
            foreach ($coupon_list['Data']['Items'] as $k =>$v) {

                intval($v['FSMoney']);
                if ($v['FSMoney']<=intval($total_money)&&in_array($v['PaymentType'],$py)) {
                    $i++;
                    $res[]=$v;
                }

            }

            return json_encode($res);
        }
    }

    public function getparkprice(Request $request){
        $time = time();
        $berthcode=trim($request->input('berthcode'));
        $parktimes=trim($request->input('parktimes'));
        $stype=$request->filled('stype')?$request->input('stype'):'';
        $ordercode=$request->filled('ordercode')?$request->input('ordercode'):'';

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'berthcode'=>$berthcode,'AccessToken'=>session('AccessToken'),'parktimes'=>$parktimes,'citycode'=>read_config('citycode'),'stype'=>$stype,'ordercode'=>$ordercode);

        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);

        $url=read_config("URL").'/api/Transaction/GetParkPrice';
        $rspn = curl_request($url,$data);

       return $rspn;
    }

    public function roompark(Request $request){
        $time = time();

        if (session('AccessToken')) {
            $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time);
        }else{
            $array=array('AppId'=>read_config("AppId"),'OpenId'=>session('AccessToken'),'Nonce'=>$time);
        }

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Cars/List';
        $rspn = curl_request($url,$data);
        $che_list = json_decode ($rspn, true );

        if (sizeof($che_list['Data']['Items'])>=1) {
            header('Location: pay_roompark_se');
            exit;
        }else{
            header('Location:chepai?source=first');
            exit;
        }
    }

    public function roompark_se(Request $request){
        $time = time();

        if (session('AccessToken')) {
            $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time);
        }else{
            $array=array('AppId'=>read_config("AppId"),'OpenId'=>session('openid'),'Nonce'=>$time);
        }

        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Cars/List';
        $arrdata = json_decode(curl_request($url,$data),true);
        return view('pay.roompark_se',['arrdata'=>$arrdata]);
    }

    public function parkapply(Request $request){
        $time1=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'));

        $array['Sign'] =create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Users/GetMebUserInfo';
        $personInfo =json_decode(curl_request($url,$data),true);
        if($personInfo['RetCode']==5){
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';die;
        }
        $ordercode=$request->filled('ordercode')?$request->query('ordercode'):0;
        $PayPrice=$request->filled('PayPrice')?$request->query('PayPrice'):0;
        $BargainOrder=$request->filled('BargainOrder')?$request->query('BargainOrder'):0;
        $berthcode=$request->filled('berthcode')?$request->query('berthcode'):0;
        $time=$request->filled('time')?$request->query('time'):0;
        $PlateNumber=$request->filled('PlateNumber')?$request->query('PlateNumber'):0;
        $VoucherID=$request->filled('VoucherID')?$request->query('VoucherID'):-1;
        $VPNMId=$request->filled('VPNMId')?$request->query('VPNMId'):0;
        $CouponType=$request->filled('CouponType')?$request->query('CouponType'):0;
        $CouponAmount=$request->filled('CouponAmount')?$request->query('CouponAmount'):0;


        //支付金额小于或等于0的处理
        if(($PayPrice - $CouponAmount )<=0){

            $req_arr = array (
                'AppId' => read_config("AppId"),
                'Nonce' => time (),
                'berthcode' => $berthcode,
                "citycode" => read_config('citycode'),
                "paytype" => 4,
                'PayPrice' => $PayPrice,
                'time' => $time,
                'VoucherID'=>$VoucherID,
                'VPNMId'=>$VPNMId,
                "trade_type" => 2,
                "ApplyMethod"=>4,
                "openid" => session('openid'),
                'AccessToken' => session('AccessToken')
            );

            if($CouponType==1){
                $req_arr['FreeTime'] = $CouponAmount;
                $req_arr['FreePrice'] = 0;
            }else{
                $req_arr['FreePrice'] = $CouponAmount;
                $req_arr['FreeTime'] = 0;
            }

            if(!empty($request->query('PlateNumber'))){
                $req_arr['PlateNumber'] = $PlateNumber;
            }

            $req_arr ['Sign'] = create_botong_sign($req_arr);

            $rspn = curl_request (read_config('URL') . '/api/Transaction/ParkApply', json_encode ( $req_arr ) );

            $arrdata = json_decode ( $rspn, true );

            if($arrdata['RetCode']==-1){
                echo "<script>alert('" . $arrdata['Message'] . "');window.location.href='pay_lubpark';</script>"; die;
            }elseif($arrdata['Data']['ApplyMenth']==0){
                if($arrdata['Data']['webResponse']['status']==1){
                    echo "<script>window.location.href='pay_success_tips';</script>"; die;
                }else{
                    echo "<script>alert('" . $arrdata['Data']['webResponse']['msg'] . "');window.location.href='pay_lubpark';</script>"; die;
                }
            }


        }
      return view('pay.parkapply',['ordercode'=>$ordercode,'PayPrice'=>$PayPrice,'time'=>$time,'BargainOrder'=>$BargainOrder]);
    }

    public function parkapplypayyinliang(Request $request){
        $paytype = $request->filled('paytype')?$request->query('paytype'):2;
        $VoucherID=$request->filled('VoucherID')?$request->query('VoucherID'):0;
        $Vpnmid=$request->filled('VPNMId')?$request->query('VPNMId'):-1;
        $CouponType=$request->filled('CouponType')?$request->query('CouponType'):-1;
        $CouponAmount=$request->filled('CouponAmount')?$request->query('CouponAmount'):0;

        $array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => time (),
            'berthcode' => $request->query('berthcode'),
            "citycode" => session('citycode'),
            "paytype" => $paytype,
            'PayPrice' => $request->query('PayPrice'),
            'time' => $request->query('time'),
            'PreePrice' => 0,
            'FreeTime' => 0,
            'VoucherID'=>$VoucherID,
            'VPNMId'=>$Vpnmid,
            "trade_type" =>2,
            "ApplyMethod"=>4,
            "openid" => session('openid'),
            'AccessToken' => session('AccessToken')
        );

        if($CouponType==1){
            $array['FreeTime'] = $CouponAmount;
            $array['FreePrice'] = 0;
        }else{
            $array['FreePrice'] = $CouponAmount;
            $array['FreeTime'] = 0;
        }

        if(!empty($request->query('PlateNumber'))){
            $array['PlateNumber'] = $request->query('PlateNumber');
        }

        $array ['Sign'] = create_botong_sign($array);

        $data = json_encode ( $array );
        $url = read_config("URL") . '/api/Transaction/ParkApply';

        $result=curl_request($url,$data);
        $arrdata = json_decode ( $result, true );
        if ($arrdata['RetCode'] == -1) {
            echo "<script> alert('支付失败'); window.location.href='pay_lubpark';</script>";
        }
        if($paytype==4){
            header("Location:".$arrdata['Data']['result']['WFTResponse']['Content']);die;
        }
        return $result;
    }

    public function paymoney(Request $request){
        $time = time();
        $Amount=trim($request->input('num'));

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'Amount'=>$Amount,'AccessToken'=>session('AccessToken'),'PayType'=>2,'openid'=>session('openid'),'trade_type'=>'2');

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config('URL').'/api/Accounts/Recharge';
        return curl_request($url,$data);
    }

    public function later_pay(Request $request){
        session(['url'=>"chepai1"]);
        $time1=time();
        $array1=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'citycode'=>read_config('citycode'));
        $array1['Sign'] = create_botong_sign($array1);

        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/Parking';
        $datas1 = json_decode(curl_request($url1,$data1),true);
        if($datas1['RetCode']==5){
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';die;
        }

        if($datas1['Data']['data']['IsArrears']=="1"||$datas1['Data']['code']=="is_parking"){
            header('Location:pay_jishi?id=1');die;
        }
     return view('pay.later_pay');
    }

    public function dingdan_noapply(Request $request){
        $AccessToken = session('AccessToken');
        $pageIndex = 1;
        $pageSize = 1000;
        $carCode = $request->filled('carCode')?$request->query('carCode'):'';
        $ordercode = $request->filled('ordercode')?$request->query('ordercode'):'';
        $time1=time();
        $array1=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time1,'citycode'=>read_config("citycode"),'PlateNumber'=>$carCode,'pageIndex'=>$pageIndex,'pageSize'=>$pageSize);
        $array1['Sign'] = create_botong_sign($array1);
        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/GetNoApplyArrearsListDetail';

        //echo curl_request($url,$data);
        $arrdata = json_decode(curl_request($url1,$data1),true);
        if (!$arrdata['Data']) {
            echo "<script>alert('订单已结束');window.location.href='pay_lubpark';</script>"; die;
        }
        $resdata=array();
        foreach($arrdata['Data']['items'] as $k=>$v){
            if($v['ArrearsOrderCode']==$ordercode)
                $resdata['Data']=$v;

        }
        $chi_time=GetRTime(intval($resdata['Data']['RemainTime']));

        $price=$request->query('price')?$request->query('priced'):$resdata['Data']['ArrearsPrice'];
        $paytype=$request->filled('PayType')?$request->query('PayType'):3;

        $time=$request->filled('time')?$request->query('time'):0;
        $getine=time()-(strtotime($resdata['Data']['EndParkingTime'])+$time*60);



//获取用户优惠券
        $array_coupon = array (
            'AppId' => read_config("AppId"),
            'AccessToken' =>session('AccessToken'),
            'Nonce' => time (),
            'lastID' => 0,
            'PlateNumber'=>$resdata['Data']['InPeccancyPlateNumber'],
            'pageSize' => 9999,
            'UseType'=>1,
            'PayType'=>3,
            'VoucherStatus' => 1 //1-有效
        );

        $array_coupon ['Sign'] = create_botong_sign($array_coupon);

        $rspn = curl_request ( read_config("URL") . '/api/Parkings/GetVoucherInfo', json_encode($array_coupon));

        $coupon_list = json_decode($rspn,true);
        $i=0;
        $res=array();

        // var_dump( $coupon_list );
        $py=array($paytype,0);

        foreach ($coupon_list['Data']['DiscountData'] as $t =>$j) {
            floatval($j['FSMoney']);
            if ($j['FSMoney']<=floatval($price)&&in_array($j['PaymentType'],$py)) {
                $i++;
                $res[]=$j;
            }
        }
        foreach ($coupon_list['Data']['Items'] as $x =>$y) {
            floatval($y['FSMoney']);

            if (in_array( $y['PaymentType'],$py)) {
                $i++;
            }
        }
        //var_dump($i);
        //获取当前停车是否已使用优惠券
        $array = array (
            'AppId' => read_config("AppId"),
            'PlateNumber' => $carCode,
            'Nonce' => time (),
            'BargainOrderCode' => $ordercode
        );

        $array ['Sign'] = create_botong_sign($array);
        $rspn = curl_request ( read_config("URL") . '/api/Parkings/CheckVoucherUse', json_encode($array));
        $coupon_use_array = json_decode($rspn,true);
        return view('pay.dingdan_noapply',['resdata'=>$resdata,'getine'=>$getine,'coupon_use_array'=>$coupon_use_array,'i'=>$i,'price'=>$price,'coupon_list'=>$coupon_list,'res'=>$res]);
    }

    public function zhifu_noapply(Request $request){
        $ordercode = $request->filled('ordercode') ? $request->query('ordercode') : 0;
        $PayPrice = $request->filled('PayPrice')? $request->query('PayPrice') : 0;
        $VoucherID = $request->filled('VoucherID')?$request->query('VoucherID'):0;
        $VPNMId = $request->filled('VPNMId')?$request->query('VPNMId'):0;
        $CouponType = $request->filled('CouponType')?$request->query('CouponType'):0;
        $CouponAmount = $request->filled('CouponAmount')?$request->query('CouponAmount'):0;

        if (($PayPrice - $CouponAmount) <= 0) {

            $req_array = array (
                'AppId' => read_config("AppId"),
                'Nonce' => time (),
                'ordercode' => $ordercode,
                "citycode" => read_config("citycode"),
                "paytype" => 4,
                'PayPrice' => $PayPrice,
                'VoucherID' => $VoucherID,
                "trade_type" => 2,
                'VPNMId'=>$VPNMId,
                "openid" => session('openid'),
                'AccessToken' => session('AccessToken')
            );

            if ($CouponType == 1) {
                $req_array ['FreeTime'] = $CouponAmount;
                $req_array ['FreePrice'] = 0;
            } else {
                $req_array ['FreePrice'] = $CouponAmount;
                $req_array ['FreeTime'] = 0;
            }

            $req_array ['Sign'] = create_botong_sign($req_array);

            $rspn = curl_request ( read_config("URL") . '/api/Transaction/NoApplyArrearspay', json_encode ( $req_array ) );

            $rspn_data = json_decode ( $rspn, true );

            //var_dump($rspn_data);die();
            //使用优惠支付，无需调起支付
            if($rspn_data['RetCode']==-1){
                echo "<script>alert('" . $rspn_data['Message'] . "');window.location.href='pay_dingdan';</script>"; die;
            }elseif($rspn_data['Data']['ApplyMenth']==0){
                if($rspn_data['Data']['webResponse']['status']==1){
                    echo "<script>alert('" . $rspn_data['Data']['webResponse']['msg'] . "');window.location.href='user_index';</script>"; die;
                }else{
                    echo "<script>alert('" . $rspn_data['Data']['webResponse']['msg'] . "');history.go(-1);</script>"; die;
                }
            }

        }
        return view('pay.zhifu_noapply',['ordercode'=>$ordercode,'PayPrice'=>$PayPrice,'VoucherID'=>$VoucherID,'CouponAmount'=>$CouponAmount,'CouponType'=>$CouponType]);
    }

    public function zhifu(Request $request){
        $time1 = time ();
        $array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => $time1,
            'AccessToken' => session('AccessToken')
        );
        $array ['Sign'] = create_botong_sign($array);

        $data = json_encode ( $array );
        $url = read_config("URL"). '/api/Users/GetMebUserInfo';
        $personInfo = json_decode (curl_request ( $url, $data ),true);
        if ($personInfo ['RetCode'] == 5) {
            echo '<script>alert("登录过期，请重新登录!");window.location.href="login_sms";</script>';
            die ();
        }

        $ordercode = $request->filled('ordercode') ?  $request->query('ordercode') : 0;
        $PayPrice = $request->filled('PayPrice') ? $request->query('PayPrice') : 0;
        $BargainOrder = $request->filled('BargainOrder') ? $request->query('BargainOrder') : 0;
        $berthcode = $request->filled('berthcode') ? $request->query('berthcode'): 0;
        $time = $request->filled('time') ? $request->query('time') : 0;

        $VoucherID = $request->filled('VoucherID') ? $request->query('VoucherID') : 0;
        $CouponType = $request->filled('CouponType') ? $request->query('CouponType') : 0;
        $CouponAmount = $request->filled('CouponAmount') ? $request->query('CouponAmount') : 0;


// 支付金额小于或等于0的处理
        if (($PayPrice - $CouponAmount) <= 0) {

            $req_array = array (
                'AppId' => read_config("AppId"),
                'Nonce' => time (),
                'bargainordercode' => $BargainOrder,
                'ordercode' => $ordercode,
                'berthcode' => $berthcode,
                "citycode" => session('citycode'),
                "paytype" => 4,
                'PayPrice' => $PayPrice,
                'VoucherID' => $VoucherID,
                "trade_type" => 2,
                "openid" => session('openid'),
                'AccessToken' => session('AccessToken')
            );

            if ($CouponType == 1) {
                $req_array ['FreeTime'] = $CouponAmount;
                $req_array ['FreePrice'] = 0;
            } else {
                $req_array ['FreePrice'] = $CouponAmount;
                $req_array ['FreeTime'] = 0;
            }

            $req_array ['Sign'] = create_botong_sign($req_array);


            $rspn = curl_request ( read_config("AppId") . '/api/Transaction/ArrearsLastPay', json_encode ( $req_array ) );

            $rspn_data = json_decode ( $rspn, true );

            //使用优惠支付，无需调起支付
            if($rspn_data['RetCode']==-1){
                echo "<script>alert('" . $rspn_data['Message'] . "');window.location.href='pay_dingdan';</script>"; die;
            }elseif($rspn_data['Data']['ApplyMenth']==0){
                if($rspn_data['Data']['webResponse']['status']==1){
                    echo "<script>alert('" . $rspn_data['Data']['webResponse']['msg'] . "');window.location.href='pay_jishi';</script>"; die;
                }else{
                    echo "<script>alert('" . $rspn_data['Data']['webResponse']['msg'] . "');window.location.href='pay_dingdan';</script>"; die;
                }
            }

        }
    return view('pay.zhifu',['personInfo'=>$personInfo,'ordercode'=>$ordercode,'PayPrice'=>$PayPrice,'time'=>$time,'BargainOrder'=>$BargainOrder,'berthcode'=>$berthcode,'VoucherID'=>$VoucherID,'CouponAmount'=>$CouponAmount,'CouponType'=>$CouponType]);
    }

    public function lastpayyinliang(Request $request){
        $paytype = $request->filled('paytype') ? $request->query('paytype'): 2;
        $VoucherID = $request->filled('VoucherID') ? $request->query('VoucherID') : 0;
        $CouponType = $request->filled('CouponType') ? $request->get('CouponType') : 0;
        $CouponAmount = $request->filled('CouponAmount') ? $request->get('CouponAmount') : 0;

        $array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => time (),
            'bargainordercode' => $request->query('bargainordercode'),
            'ordercode' => $request->query('ordercode'),
            'berthcode' => $request->query('berthcode'),
            "citycode" => read_config('citycode'),
            "paytype" => $paytype,
            'PayPrice' => $request->query('PayPrice'),
            'VoucherID'=>$VoucherID,
            "trade_type" => 2,
            "openid" => session('openid'),
            'AccessToken' => session('AccessToken')
        );

        if ($CouponType == 1) {
            $array ['FreeTime'] = $CouponAmount;
            $array ['FreePrice'] = 0;
        } else {
            $array ['FreePrice'] = $CouponAmount;
            $array ['FreeTime'] = 0;
        }


        $signArr = array ();
        foreach ( $array as $k => $v ) {
            if (strlen ( $v ) > 0)
                $signArr [$k] = $k . '=' . $v;
        }
        ksort ( $signArr );
        $array ['Sign'] = base64_encode ( hash_hmac ( 'sha256', implode ( '&', $signArr ), SecretKey, true ) );

        $data = json_encode ( $array );
// var_dump($data);
        $url = URL . '/api/Transaction/ArrearsLastPay';
        $rspn = curl_request ( $url, $data );

        $arrdata = json_decode ( $rspn, true );
        $arr2 = $arrdata['Data']['result']['WFTResponse'];
        if($paytype==4){

            header("Location:".$arr2['Content']);die;

        }
        echo $rspn;die();
    }

    public function noapplypayyinliang(Request $request){
        $ordercode = $request->filled('ordercode')?$request->query('ordercode'):0;
        $PayPrice = $request->filled('PayPrice')?$request->query('PayPrice'):0;
        $trade_type = $request->query('trade_type');
        $paytype = $request->query('paytype');
        $VoucherID = $request->filled('VoucherID')? $request->query('VoucherID'):0;
        $CouponType = $request->filled('CouponType')? $request->query('CouponType'):0;
        $CouponAmount = $request->filled('CouponAmount')? $request->query('CouponAmount'):0;

        $time1 = time ();
        $req_array = array (
            'AppId' => read_config("AppId"),
            'Nonce' => time (),
            'ordercode' => $ordercode,
            "citycode" => read_config("citycode"),
            "paytype" => $paytype,
            'PayPrice' => $PayPrice,
            'VoucherID' => $VoucherID,
            "trade_type" => 2,
            "openid" => session('openid'),
            'AccessToken' => session('AccessToken')
        );

        if ($CouponType == 1) {
            $req_array ['FreeTime'] = $CouponAmount;
            $req_array ['FreePrice'] = 0;
        } else {
            $req_array ['FreePrice'] = $CouponAmount;
            $req_array ['FreeTime'] = 0;
        }

        $req_array ['Sign'] = create_botong_sign($req_array);

        $rspn = curl_request ( read_config("URL") . '/api/Transaction/NoApplyArrearspay', json_encode ( $req_array ) );

        $arrdata = json_decode ( $rspn, true );

        $arr2 = $arrdata['Data']['result']['WFTResponse'];
        if($paytype==4){
            header("Location:".$arrdata['Data']['result']['WFTResponse']['Content']);die;

        }
        return view('pay.noapplypayyinliang',['rspn'=>$rspn]);
    }

    public function jishi(Request $request){
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'CityCode'=>read_config("citycode"));
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/UserParkingPay/GetParkRPOrderList';
        $arrdata=curl_request($url,$data);
        if($request->isMethod('post')){
            return $arrdata;
        }
        $arrdata = json_decode($arrdata,true);
        $star_times=strtotime($arrdata['Data']['BerthStartParkingTime']);

        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'citycode'=>read_config("citycode"));
        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Parkings/GetApplicationType';
        $arr_data=json_decode(curl_request($url,$data),true);
        $id=$request->filled('id')?$request->query('id'):0;

        return view('pay.jishi',['arrdata'=>$arrdata,'arr_data'=>$arr_data,'id'=>$id]);
    }

    public function yichang1(Request $request){
        $time1=time();
        $ordercode=$request->input('ordercode');
        $memberberthendparkingtime=trim($request->input('memberberthendparkingtime'));


        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'ordercode'=>$ordercode,'memberberthendparkingtime'=>$memberberthendparkingtime,'citycode'=>read_config("citycode"),'comcontent'=>'');

        $array['Sign'] = create_botong_sign($array);

        $data= json_encode($array);
        $url=read_config("URL").'/api/Transaction/FinishOrder';
        return curl_request($url,$data);
    }

    public function jiance(Request $request){
        $time1=time();
        $array1=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'citycode'=>read_config('citycode'));

        $array1['Sign'] = create_botong_sign($array1);

        $data1= json_encode($array1);
        $url1=read_config("URL").'/api/Transaction/Parking';

        $result = curl_request($url1,$data1);

        return $result;

    }

}
