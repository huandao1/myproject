<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Card extends Controller
{

    public function cardlist(Request $request){
        return view('card.list');
    }

   public function getcardlist(Request $request){
       $time1=time();
       $action=$request->input('action');
       if ($action=="list") {
           # code...
           $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'CityCode'=>read_config("citycode"),'CardStatus'=>1);
           $array['Sign'] = create_botong_sign($array);

           $data= json_encode($array);
           $url=read_config("URL").'/api/Coupon/GetUserMonthCard';
           $result=curl_request($url,$data);
           echo $result;die();
       }
       if ($action=="parklist") {
           # code...
           $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time1,'AccessToken'=>session('AccessToken'),'CityCode'=>read_config("citycode"));
           $array['Sign'] =create_botong_sign($array);

           $data= json_encode($array);
           $url=read_config("URL").'/api/Coupon/GetMonthCardPolicy';
           $result=curl_request($url,$data);
           echo $result;die();
       }
       if ($action=="carlist") {
           $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time1);
           $array['Sign'] =create_botong_sign($array);
           $data= json_encode($array);
           $url=read_config("URL").'/api/Cars/List';
           $result=curl_request($url,$data);
           echo $result;die();

       }
       if ($action=="cardpay") {
           $array0=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time1,'CityCode'=>read_config("citycode"), 'PlateNumber' => $request->input('PlateNumber'));

           $array0['Sign'] =create_botong_sign($array0);

           $data0= json_encode($array0);
           $url0=read_config("URL").'/api/Transaction/GetArrearsStatus';
           $arrearscount =json_decode(curl_request($url0,$data0),true); //查询欠费单数量

           if ($arrearscount['Data']['PDANum']!=0||$arrearscount['Data']['ParkNum']!=0) {
               echo  json_encode(array('countstate' =>1 ));die;
           }
           $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time1,'CityCode'=>read_config("citycode"),
               "PayType" => 4,
               'MCId' =>$request->input('MCId'),
               'MonthNum' =>$request->input('MonthNum'),
               'CardPrice' =>$request->input('CardPrice'),
               'PlateNumber' =>$request->input('PlateNumber'),
               'PlateNumberType'=>$request->input('PlateNumberType'),
               'CommunityID' =>$request->input('CommunityID'),
               "trade_type" => 2,
               'BuyingChannel'=>3,
               "openid" => session('openid'));

           $array['Sign'] = create_botong_sign($array);

           $data= json_encode($array);
           $url=read_config("URL").'/api/Coupon/UserBuyMonthCard';
           $rspn = curl_request ( $url, $data );
           echo $rspn;die();
       }
       if ($action=="recardpay") {
           $array=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time1,'CityCode'=>read_config("citycode"),
               "PayType" => 4,
               'MCId' => $request->input('MCId'),
               'MCCode'=> $request->input('MCCode'),
               'MonthNum' => $request->input('MonthNum'),
               'CardPrice' => $request->input('CardPrice'),
               'PlateNumber' => $request->input('PlateNumber'),
               'PlateNumberType'=>$request->input('PlateNumberType'),
               'CommunityID' => $request->input('CommunityID'),
               "trade_type" => 2,
               'BuyingChannel'=>3,
               "openid" => session('openid'));

           $array['Sign'] = create_botong_sign($array);

           $data= json_encode($array);
           $url=read_config("URL").'/api/Coupon/UserRenewMonthCard ';
           $rspn = curl_request ( $url, $data );
           echo $rspn;die();

       }
   }

   public function renew(Request $request){
       $time = time();
       $carCode=trim($request->input('carCode'));
       $pageIndex = trim($request->input('PageIndex'));
       $pageSize = trim($request->input('PageSize'));
       $array1=array('AppId'=>read_config("AppId"),'AccessToken'=>session('AccessToken'),'Nonce'=>$time,'citycode'=>read_config("citycode"),'carCode'=>$carCode,'pageIndex'=>$pageIndex,'pageSize'=>$pageSize);
       $array1['Sign'] = create_botong_sign($array1);
       $data1= json_encode($array1);
       $url1=read_config("URL").'/api/Transaction/GetNoApplyArrearsList';
       $otypearr=array("预付费","后付费","PDA订单");
       $result=curl_request($url1,$data1);
       echo $result;die();
    }

}
