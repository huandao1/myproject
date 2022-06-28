<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Invoice extends Controller
{
    public function index(){
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'LastId'=>0,'pageSize'=>10);

        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Invoice/InvoiceTitleList';

        $arrdata1 = json_decode(curl_request($url,$data),true);
        return view('invoice.index',['arrdata1'=>$arrdata1]);
    }

    public function order(){
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'LastId'=>0,'pageSize'=>10);
        $array['Sign'] =  create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Invoice/GetEInvoiceOrderList';

        $res = curl_request($url,$data);

        $arrdata1 = json_decode($res,true);
        $last=$arrdata1['Data']['LastId'];
        return view('invoice.order',['arrdata1'=>$arrdata1,'last'=>$last]);
    }

    public function cou_order(){
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'lastId'=>0,'pageSize'=>10);
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Invoice/GetMonthOrderList';

        $res = curl_request($url,$data);

        $arrdata1 = json_decode($res,true);
        $last=$arrdata1['Data']['LastId'];
        return view('invoice.cou_order',['arrdata1'=>$arrdata1,'last'=>$last]);
    }

    public function cou_post(Request $request){
        if($request->filled('getmore')){
            $time=time();
            $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'lastId'=>$request->input('lastid'),'pageSize'=>$request->input('page'));
            $signArr = array();
            $array['Sign'] =create_botong_sign($array);
            $data= json_encode($array);
            $url=read_config("URL").'/api/Invoice/GetMonthOrderList';

            $res = curl_request($url,$data);

            echo $res; die();
        }
        if($request->filled('kpje')){
            $TaxpayerNumber=str_replace(" ",'',$request->input('TaxpayerNumber'));
            $TitleType=trim($request->input('TitleType'));
            $EMail=trim($request->input('email'));
            $EInvoiceType=trim($request->input('EInvoiceType'));
            $OrderCodeList=trim($request->input('OrderCodeList'));
            $TitleName =trim($request->input('TitleName'));
            $BusinessAddress =trim($request->input('BusinessAddress'));
            $BankAccount =trim($request->input('BankAccount'));
            $PhoneNumber =trim($request->input('PhoneNumber'));
            $DiscountCharge ="0.00";
            $InvoicePrice =trim($request->input('InvoicePrice'));
            $Remark =trim($request->input('Remark'));
            $OrderCodeList=substr($OrderCodeList,0,strlen($OrderCodeList)-1);
            $time=time();

            $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'TitleType'=>$TitleType,'TaxpayerNumber'=>$TaxpayerNumber,'TitleName'=>$TitleName,'BusinessAddress'=>$BusinessAddress,'BankAccount'=>$BankAccount,'PhoneNumber'=>$PhoneNumber,"Remark"=>$Remark,"OrderCodeList"=>$OrderCodeList,"DiscountCharge"=>$DiscountCharge,"EInvoiceType"=>$EInvoiceType,"InvoicePrice"=>$InvoicePrice,"EMail"=>$EMail);


            $array['Sign'] = create_botong_sign($array);
            $data= json_encode($array);
            $url=read_config("URL").'/api/Invoice/CouponEInvoiceApply';

            $result=curl_request($url,$data);

            echo $result;
            die();
        }
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'pageIndex'=>0,'pageSize'=>10);

        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Invoice/InvoiceTitleList';
        echo curl_request($url,$data);
    }

    public function post(Request $request)
    {
        if ($request->filled('getmore')) {
            $time = time();
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'AccessToken' => session('AccessToken'), 'LastId' =>$request->input('lastid'),'pageSize' => $request->input('page'));
            $array['Sign'] = create_botong_sign($array);
            $data = json_encode($array);
            $url = read_config("URL") . '/api/Invoice/GetEInvoiceOrderList';
            $res = curl_request($url, $data);
            echo $res;
            die();

        }
        if ($request->filled('kpje')) {
            $TaxpayerNumber = str_replace(" ", '', $request->input('TaxpayerNumber'));
            $TitleType = trim($request->input('TitleType'));
            $EMail = trim($request->input('email'));
            $EInvoiceType = trim($request->input('EInvoiceType'));
            $OrderCodeList = trim($request->input('OrderCodeList'));
            $TitleName = trim($request->input('TitleName'));
            $BusinessAddress = trim($request->input('BusinessAddress'));
            $BankAccount = trim($request->input('BankAccount'));
            $PhoneNumber = trim($request->input('PhoneNumber'));
            $DiscountCharge = trim($request->input('kpje'));
            $InvoicePrice = trim($request->input('InvoicePrice'));
            $Remark = trim($request->input('Remark'));
            $OrderCodeList = substr($OrderCodeList, 0, strlen($OrderCodeList) - 1);
            $time = time();
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'AccessToken' =>session('AccessToken'), 'TitleType' => $TitleType, 'TaxpayerNumber' => $TaxpayerNumber, 'TitleName' => $TitleName, 'BusinessAddress' => $BusinessAddress, 'BankAccount' => $BankAccount, 'PhoneNumber' => $PhoneNumber, "Remark" => $Remark, "OrderCodeList" => $OrderCodeList, "DiscountCharge" => $DiscountCharge, "EInvoiceType" => $EInvoiceType, "InvoicePrice" => $InvoicePrice, "EMail" => $EMail);

            $array['Sign'] = create_botong_sign($array);
            $data = json_encode($array);
            $url = read_config("URL") . '/api/Invoice/EInvoiceApply';

            $res = curl_request($url, $data);


            echo $res;
            die();

        }
        $time = time();
        $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'AccessToken' => session('AccessToken'), 'pageIndex' => 0, 'pageSize' => 10);

        $array['Sign'] = create_botong_sign($array);
        $data = json_encode($array);
        $url = read_config("URL") . '/api/Invoice/InvoiceTitleList';

        echo curl_request($url, $data);
    }

   public function history(Request $request){
       $p= $request->filled('p')?$request->query('p'):0;
       $time=time();
       $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'LastId'=>$p,'pageSize'=>10);
       $array['Sign'] = create_botong_sign($array);
       $data= json_encode($array);
       $url=read_config("URL").'/api/Invoice/EInvoiceQuery';
       $arrdata1 = json_decode(curl_request($url,$data),true);
       return view('invoice.history',['arrdata1'=>$arrdata1]);
   }

   public function detail(Request $request){
       $EInvoiceCode=trim($request->query('eid'));
       $EInvoiceType=trim($request->query('EInvoiceType'));
       if (empty($EInvoiceCode)) {
           echo"<script>alert('参数出错');history.go(-2);</script>"; die();
       }
       $time=time();
       $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'pageIndex'=>0,'pageSize'=>10,'EInvoiceCode'=>$EInvoiceCode);

       $array['Sign'] = create_botong_sign($array);
       $data= json_encode($array);
       if ($EInvoiceType==1){
           $url=read_config("URL").'/api/Invoice/MonthEInvoiceDetail';
       }else{
           $url=read_config("URL").'/api/Invoice/EInvoiceDetail';
       }
       $arrdata1 = json_decode(curl_request($url,$data),true);
       return view('invoice.detail',['arrdata1'=>$arrdata1,'EInvoiceCode'=>$EInvoiceCode,'EInvoiceType'=>$EInvoiceType]);
   }

    public function resend(Request $request)
    {
        $email = $request->filled('email') ? $request->query('email') : '';
        $EInvoiceCode = trim($request->query('encode'));
        if (!empty($request->input('email'))) {
            $time = time();
            $email = trim($request->input('email'));
            $EInvoiceCode = trim($request->input('EInvoiceCode'));
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'AccessToken' => session('AccessToken'), 'EMail' => $email, 'EInvoiceCode' => $EInvoiceCode);
            $array['Sign'] = create_botong_sign($array);
            $data = json_encode($array);
            $url = read_config("URL") . '/api/Invoice/EInvoiceSendEmail';

            $arrdata = json_decode(curl_request($url, $data), true);
            if ($arrdata['RetCode'] == 0) {
                echo "<script>alert('提交成功');window.location.href = 'invoice';</script>";
                die();
            } else {
                echo "<script>alert('" . $arrdata['Message'] . "');window.history.go(-1);</script>";
                die();
            }
        }
        return view('invoice.resend', ['email' => $email, 'EInvoiceCode' => $EInvoiceCode]);
    }

    public function order_show(Request $request){
        $EInvoiceCode=trim($request->query('eid'));
        $EInvoiceType=trim($request->query('EInvoiceType'));
        if (empty($EInvoiceCode)) {
            echo"<script>alert('参数出错');history.go(-2);</script>"; die();
        }
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'LastId'=>0,'pageSize'=>10,'EInvoiceCode'=>$EInvoiceCode);

        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        if ($EInvoiceType==1){
            $url=read_config("URL").'/api/Invoice/MonthEInvoiceDetail';
        }else{
            $url=read_config("URL").'/api/Invoice/EInvoiceDetail';
        }


        $arrdata1 = json_decode(curl_request($url,$data),true);
        return view('invoice.order_show',['arrdata1'=>$arrdata1]);
    }

    public function cou_order_show(Request $request){
        $EInvoiceCode=trim($request->query('eid'));
        if (empty($EInvoiceCode)) {
            echo"<script>alert('参数出错');history.go(-2);</script>"; die();
        }
        $time=time();
        $array=array('AppId'=>read_config("AppId"),'Nonce'=>$time,'AccessToken'=>session('AccessToken'),'pageIndex'=>0,'pageSize'=>10,'EInvoiceCode'=>$EInvoiceCode);
        $array['Sign'] = create_botong_sign($array);
        $data= json_encode($array);
        $url=read_config("URL").'/api/Invoice/EInvoiceDetail';
        if ($request->query('type')) {
            $url=read_config("URL").'/api/Invoice/MonthEInvoiceDetail';
        }
        $arrdata1 = json_decode(curl_request($url,$data),true);
        return view('invoice.cou_order_show',['arrdata1'=>$arrdata1]);
    }


    public function up_add(Request $request)
    {
        if ($request->isMethod('post')) {
            $TaxpayerNumber = str_replace(" ", '', $request->input('TaxpayerNumber'));
            $TitleType = trim($request->input('typeli'));
            // echo $paypwd;die;
            $TitleName = trim($request->input('TitleName'));
            $BusinessAddress = trim($request->input('BusinessAddress'));
            $BankAccount = trim($request->input('BankAccount'));
            $PhoneNumber = trim($request->input('PhoneNumber'));


            $time = time();
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'AccessToken' => session('AccessToken'), 'type' => 0, 'TitleType' => $TitleType, 'TaxpayerNumber' => $TaxpayerNumber, 'TitleName' => $TitleName, 'BusinessAddress' => $BusinessAddress, 'BankAccount' => $BankAccount, 'PhoneNumber' => $PhoneNumber);
            $TitleId = $request->filled('TitleId') ? $request->input('TitleId') : '';
            $array = array('AppId' => read_config("AppId"), 'Nonce' => $time, 'AccessToken' => session('AccessToken'), 'type' => 1, 'TitleType' => $TitleType, 'TitleId' => $TitleId, 'TaxpayerNumber' => $TaxpayerNumber, 'TitleName' => $TitleName, 'BusinessAddress' => $BusinessAddress, 'BankAccount' => $BankAccount, 'PhoneNumber' => $PhoneNumber);
            $array['Sign'] = create_botong_sign($array);
            $data = json_encode($array);
            $url = read_config("URL") . '/api/Invoice/InvoiceTitleManage';

            if ($TitleId != "") {
                echo curl_request($url, $data);
                die();
            }
            // var_dump($data);
            $arrdata1 = json_decode(curl_request($url, $data), true);
            if ($arrdata1['RetCode'] == 0) {
                echo "<script>
         alert('添加成功');window.location.href = 'invoice';</script>";
            }


        }
        return view('invoice.up_add');
    }

}
